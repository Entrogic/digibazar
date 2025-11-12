@extends('layouts.admin')

@section('content')
    <div class="py-6">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="md:flex md:items-center md:justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            <li>
                                <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Orders</span>
                                    Orders
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                    </svg>
                                    <span class="ml-4 text-sm font-medium text-gray-500">{{ $order->order_number }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Order Details
                    </h2>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('admin.orders.index') }}"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Back to Orders
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Order Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Details Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Order Information</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Order {{ $order->order_number }}</p>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Order Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $order->order_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Order Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('F d, Y h:i A') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Order Status</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $order->payment_method_label }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : ($order->payment_status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $order->payment_status_label }}
                                        </span>
                                    </dd>
                                </div>
                                @if ($order->delivered_at)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Delivered Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $order->delivered_at->format('F d, Y h:i A') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Product Details Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Product Details</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-20 w-20 rounded-lg object-cover" src="{{ $order->order_item->product->main_image }}"
                                        alt="{{ $order->order_item->product->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $order->order_item->product->name }}</h4>
                                    @if ($order->order_item->product->category)
                                        <p class="text-sm text-gray-500">Category: {{ $order->order_item->product->category->name }}
                                        </p>
                                    @endif
                                    @if ($order->order_item->product->sku)
                                        <p class="text-sm text-gray-500">SKU: {{ $order->order_item->product->sku }}</p>
                                    @endif

                                    <div class="mt-3 grid grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Unit Price:</span>
                                            <span class="font-medium">{{ $order->order_item->price }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Quantity:</span>
                                            <span class="font-medium">{{ $order->order_item->quantity }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Total:</span>
                                            <span class="font-medium text-lg">{{ $order->order_item->total }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Customer Information</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Customer Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $order->customer_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="tel:{{ $order->customer_phone }}"
                                            class="text-blue-600 hover:text-blue-500">
                                            {{ $order->customer_phone }}
                                        </a>
                                    </dd>
                                </div>
                                @if ($order->customer_email)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <a href="mailto:{{ $order->customer_email }}"
                                                class="text-blue-600 hover:text-blue-500">
                                                {{ $order->customer_email }}
                                            </a>
                                        </dd>
                                    </div>
                                @endif
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Delivery Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">
                                        {{ $order->customer_address }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    @if ($order->notes)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Order Notes</h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $order->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Order Actions Sidebar -->
                <div class="space-y-6">
                    <!-- Update Order Status -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Update Status</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Order
                                        Status</label>
                                    <select name="status" id="status"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>
                                            Confirmed</option>
                                        <option value="processing"
                                            {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="out_for_delivery"
                                            {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery
                                        </option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                            Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Update Payment Status -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Status</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('admin.orders.update-payment-status', $order) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="payment_status"
                                        class="block text-sm font-medium text-gray-700 mb-2">Payment Status</label>
                                    <select name="payment_status" id="payment_status"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="pending"
                                            {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>
                                            Paid</option>
                                        <option value="failed"
                                            {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
                                    Update Payment
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Add Notes -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Add Notes</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <form action="{{ route('admin.orders.add-notes', $order) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Order
                                        Notes</label>
                                    <textarea name="notes" id="notes" rows="4"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Add notes about this order...">{{ $order->notes }}</textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                                    Save Notes
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Order -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">Danger Zone</h3>
                            <p class="text-sm text-gray-500 mb-4">Permanently delete this order. This action cannot be
                                undone.</p>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                                    Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
