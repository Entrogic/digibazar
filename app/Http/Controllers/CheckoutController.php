<?php

namespace App\Http\Controllers;

use App\Models\Attribute as ModelsAttribute;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Attribute;
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
        $attributes = ModelsAttribute::all();

        return view('checkout.product', compact('product', 'attributes'));
    }

    public function process(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,mobile_banking',
        ]);

        $product = Product::findOrFail($request->product_id);

        $variant = ProductVariant::where('product_id', $request->product_id)->where('id', $request->variant_id)->first();
        
       

        

        // Create the order
        $order = Order::create([
    
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'product_name' => $product->name,
            'price' => $variant->price,
            'total' => $variant->price * $request->quantity,
        ]);

        // Update product stock if tracking is enabled
        if ($product->track_stock) {
            $prevStock = $variant->stock;
            $newStock = $prevStock - $request->quantity;
            $variant->update([
                'stock' => $newStock,
            ]);
        }

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success($orderNumber)
    {
        $order = Order::with(['order_item','order_item.product'])->where('order_number', $orderNumber)->first();

        //dd($order);
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
