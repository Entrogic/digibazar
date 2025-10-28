<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // General checkout page (for cart items, etc.)
        return view('checkout.index');
    }

    public function product(Product $product)
    {
        //dd($product);
        // Single product checkout
        if (!$product->is_active || $product->stock_quantity <= 0) {
            return redirect()->route('home')->with('error', 'এই পণ্যটি বর্তমানে পাওয়া যাচ্ছে না।');
        }

        return view('checkout.product', compact('product'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,mobile_banking',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock availability
        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'পর্যাপ্ত স্টক নেই। বর্তমানে স্টকে আছে: ' . $product->stock_quantity . ' টি।');
        }

        // Calculate total
        $unitPrice = $product->price;
        $totalPrice = $unitPrice * $request->quantity;

        // Create the order
        $order = Order::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Update product stock if tracking is enabled
        if ($product->track_stock) {
            $product->decrement('stock_quantity', $request->quantity);
        }

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with(['product', 'product.category'])->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'অর্ডার খুঁজে পাওয়া যায়নি।');
        }

        return view('checkout.success', compact('order'));
    }

    public function trackForm()
    {
        return view('orders.track-form');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'phone' => 'required|string',
        ]);

        $order = Order::where('order_number', $request->order_number)
            ->where('customer_phone', $request->phone)
            ->with(['product', 'product.category'])
            ->first();

        if (!$order) {
            return back()->with('error', 'অর্ডার খুঁজে পাওয়া যায়নি। অর্ডার নম্বর এবং ফোন নম্বর সঠিক কিনা যাচাই করুন।');
        }

        return view('orders.track-result', compact('order'));
    }
}
