@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            হোম
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">চেকআউট</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Details -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">পণ্যের বিবরণ</h2>

                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Product Image -->
                        <div class="md:w-1/2">
                            <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                class="w-full h-64 object-cover rounded-lg border">
                        </div>

                        <!-- Product Info -->
                        <div class="md:w-1/2">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $product->name }}</h3>

                            @if ($product->short_description)
                                <p class="text-gray-600 mb-4">{{ $product->short_description }}</p>
                            @endif

                            <!-- Price -->
                            <div class="mb-4">
                                <div class="flex items-center space-x-3">
                                    <span class="text-2xl font-bold text-green-600">{{ $product->formatted_price }}</span>
                                    @if ($product->compare_price)
                                        <span
                                            class="text-lg text-gray-500 line-through">{{ $product->formatted_compare_price }}</span>
                                    @endif
                                </div>
                                @if ($product->discount_percentage > 0)
                                    <span class="text-sm text-red-600 font-semibold">{{ $product->discount_percentage }}%
                                        ছাড়!</span>
                                @endif
                            </div>

                            <!-- Category -->
                            @if ($product->category)
                                <div class="mb-4">
                                    <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif

                            <!-- Stock Status -->
                            <div class="mb-4">
                                <span class="text-sm px-3 py-1 rounded-full {{ $product->stock_status_color }}">
                                    {{ $product->stock_status }}
                                </span>
                                <p class="text-sm text-gray-600 mt-1">স্টকে আছে: {{ $product->stock_quantity }} টি</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">অর্ডার তথ্য</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">পরিমাণ</label>
                            <div class="flex items-center space-x-3">
                                <button type="button" onclick="decreaseQuantity()"
                                    class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center text-lg font-semibold">
                                    -
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1"
                                    max="{{ $product->stock_quantity }}"
                                    class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" onclick="increaseQuantity({{ $product->stock_quantity }})"
                                    class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center text-lg font-semibold">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700">গ্রাহকের তথ্য</h3>

                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">নাম
                                    *</label>
                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="আপনার পূর্ণ নাম লিখুন">
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">ফোন নম্বর
                                    *</label>
                                <input type="tel" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="০১৭xxxxxxxx">
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">ইমেইল
                                    (ঐচ্ছিক)</label>
                                <input type="email" id="customer_email" name="customer_email"
                                    value="{{ old('customer_email') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="your@email.com">
                            </div>

                            <div>
                                <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">সম্পূর্ণ
                                    ঠিকানা *</label>
                                <textarea id="customer_address" name="customer_address" rows="3" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="বাড়ি/ফ্ল্যাট নং, রাস্তা, এলাকা, শহর">{{ old('customer_address') }}</textarea>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">পেমেন্ট পদ্ধতি</h3>

                            <div class="space-y-3">
                                <label
                                    class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" checked
                                        class="text-blue-600">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">💵</span>
                                        <div>
                                            <div class="font-medium">ক্যাশ অন ডেলিভারি</div>
                                            <div class="text-sm text-gray-600">পণ্য গ্রহণের সময় পেমেন্ট করুন</div>
                                        </div>
                                    </div>
                                </label>

                                {{-- <label
                                    class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment_method" value="mobile_banking"
                                        class="text-blue-600">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">📱</span>
                                        <div>
                                            <div class="font-medium">মোবাইল ব্যাংকিং</div>
                                            <div class="text-sm text-gray-600">বিকাশ, নগদ, রকেট</div>
                                        </div>
                                    </div>
                                </label> --}}
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700 mb-3">অর্ডার সারাংশ</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>পণ্যের দাম:</span>
                                    <span id="unit-price">{{ $product->formatted_price }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>পরিমাণ:</span>
                                    <span id="quantity-display">১</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>ডেলিভারি চার্জ:</span>
                                    <span class="text-green-600">বিনামূল্যে</span>
                                </div>
                                <hr class="my-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>মোট:</span>
                                    <span id="total-price" class="text-green-600">{{ $product->formatted_price }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg font-semibold text-lg transition duration-200 flex items-center justify-center space-x-2">
                            <span>🛒</span>
                            <span>অর্ডার নিশ্চিত করুন</span>
                        </button>

                        <p class="text-sm text-gray-600 text-center">
                            অর্ডার করার মাধ্যমে আপনি আমাদের
                            <a href="#" class="text-blue-600 hover:underline">শর্তাবলী</a>
                            মেনে নিচ্ছেন।
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const productPrice = {{ $product->price }};

        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const total = productPrice * quantity;

            document.getElementById('quantity-display').textContent = numberToBengali(quantity);
            document.getElementById('total-price').textContent = '৳' + numberToBengali(total.toLocaleString());
        }

        function increaseQuantity(maxStock) {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity < maxStock) {
                quantityInput.value = quantity + 1;
                updateTotal();
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                updateTotal();
            }
        }

        function numberToBengali(num) {
            const bengaliNumbers = {
                '0': '০',
                '1': '১',
                '2': '২',
                '3': '৩',
                '4': '৪',
                '5': '৫',
                '6': '৬',
                '7': '৭',
                '8': '৮',
                '9': '৯'
            };
            return num.toString().replace(/[0-9]/g, function(match) {
                return bengaliNumbers[match];
            });
        }

        // Listen for quantity input changes
        document.getElementById('quantity').addEventListener('input', updateTotal);
    </script>
@endsection
