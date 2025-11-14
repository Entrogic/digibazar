<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['order_item.product', 'order_item.product.category']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order number or customer info
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->paginate(15);

        // Get statistics
        $stats = [
            'total_orders' => Order::get()->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => 20000,
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['order_item','order_item.product', 'order_item.product.category']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,out_for_delivery,delivered,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->update([
            'status' => $request->status,
            'delivered_at' => $request->status === 'delivered' ? now() : null,
        ]);

        // If order is cancelled, restore stock
        if ($request->status === 'cancelled' && $oldStatus !== 'cancelled') {
            if ($order->product->track_stock) {
                $order->product->increment('stock_quantity', $order->quantity);
            }
        }

        return back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update(['payment_status' => $request->payment_status]);

        return back()->with('success', 'Payment status updated successfully.');
    }

    /**
     * Add notes to order
     */
    public function addNotes(Request $request, Order $order)
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $order->update(['notes' => $request->notes]);

        return back()->with('success', 'Order notes updated successfully.');
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Order $order)
    {
        // Restore stock if order was not cancelled
        if ($order->status !== 'cancelled' && $order->product->track_stock) {
            $order->product->increment('stock_quantity', $order->quantity);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
