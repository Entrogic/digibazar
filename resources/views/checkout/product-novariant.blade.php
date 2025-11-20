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

                            <!-- Attributes -->



                            @if ($product->short_description)
                                <p class="text-gray-600 mb-2">{{ $product->short_description }}</p>
                            @endif


                            @if ($product->variants->count())
                                <div class="mb-4 py-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">পছন্দের বৈচিত্র্য</label>
                                    <select id="variant-select" name="variant_id"
                                        class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- পছন্দের বৈচিত্র্য নির্বাচন করুন --</option>
                                        @foreach ($product->variants as $variant)
                                            <option value="{{ $variant->id }}" data-price="{{ $variant->price }}"
                                                data-stock="{{ $variant->stock }}">
                                                {{ $variant->sku }} -
                                                @foreach ($variant->values as $v)
                                                    {{ $v->attributeValue->value }}
                                                @endforeach
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif



                            <!-- Price -->
                            <div id="p-dynamic-info">
                                <div class="mb-4">
                                    <div class="flex items-center space-x-3">
                                        <p>Price:</p>
                                        <span id="p-price" class="text-2xl font-bold text-green-600"
                                            data-val="${data.price}">{{ $product->price }} BDT</span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mt-1">স্টকে আছে:{{ $product->stock_quantity }} টি</p>
                                </div>
                            </div>

                            <!-- Category -->
                            {{-- @if ($product->category)
                                <div class="mb-4">
                                    <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif --}}


                        </div>
                    </div>

                    @if ($product->variants->count())
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Product Variants</h2>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left font-medium text-gray-700">SKU</th>
                                            @foreach ($attributes as $attribute)
                                                <th class="px-4 py-2 text-left font-medium text-gray-700">
                                                    {{ $attribute->name }}</th>
                                            @endforeach
                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Price</th>
                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($product->variants as $variant)
                                            <tr>
                                                <td class="px-4 py-2">{{ $variant->sku }}</td>

                                                @foreach ($attributes as $attribute)
                                                    @php
                                                        $value = $variant->values->firstWhere(
                                                            'attribute_id',
                                                            $attribute->id,
                                                        );
                                                    @endphp
                                                    <td class="px-4 py-2">{{ $value?->attributeValue?->value ?? '-' }}</td>
                                                @endforeach

                                                <td class="px-4 py-2">৳{{ number_format($variant->price, 2) }}</td>
                                                <td class="px-4 py-2">{{ $variant->stock }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

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
                        <input type="hidden" name="variant_id" id="variant_id">

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">পরিমাণ</label>
                            <div class="flex items-center space-x-3">
                                <button id="qty-minus" type="button"
                                    class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center text-lg font-semibold">
                                    -
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1"
                                    max="{{ $product->stock_quantity }}"
                                    class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button id="qty-plus" type="button"
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
                                <label for="customer_address"
                                    class="block text-sm font-medium text-gray-700 mb-1">সম্পূর্ণ
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
                            </div>
                        </div>


                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">ডেলিভারি পদ্ধতি</h3>

                            <div class="space-y-3">

                                <!-- Dhakar Vitore -->
                                <label
                                    class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="delivery_method" value="100" class="text-blue-600"
                                        checked>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">🚚</span>
                                        <div>
                                            <div class="font-medium">ঢাকার ভিতরে</div>
                                            <div class="text-sm text-gray-600">ডেলিভারি চার্জ: 100 টাকা</div>
                                        </div>
                                    </div>
                                </label>

                                <!-- Dhakar Baire -->
                                <label
                                    class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="delivery_method" value="500" class="text-blue-600">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">📦</span>
                                        <div>
                                            <div class="font-medium">ঢাকার বাইরে</div>
                                            <div class="text-sm text-gray-600">ডেলিভারি চার্জ: 500 টাকা</div>
                                        </div>
                                    </div>
                                </label>

                            </div>
                        </div>


                        <!-- Order Summary -->
                        <div class="bg-gray-50 rounded-lg p-4" id="order-summary">
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
                                    <span id="d-charge" class="text-green-600">100</span>
                                </div>
                                <hr class="my-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>মোট:</span>
                                    <span id="total-price" class="text-green-600"></span>
                                    <input type="hidden" name="total" value="" id="total">
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
@endsection

@push('scripts')
    <script>
        $("input[name='delivery_method']").change(function() {
            var value = $("input[name='delivery_method']:checked").val();
            // console.log("Selected:", value);
            $('#d-charge').text(value);

            updateSummary();
        });


        function updateSummary() {

            let qty = parseInt($('#quantity').val());
            let price = parseFloat("{{ $product->price }}");

            if (price > 0) {

                // Subtotal
                let subtotal = qty * price;

                $('#unit-price').text(price);
                $('#quantity-display').text(qty);
                $('#total-price').text(subtotal.toFixed(2));

                // Delivery Charge (convert to number)
                let deliveryCharge = parseFloat($('#d-charge').text()) || 0;

                console.log("Delivery:", deliveryCharge);

                // Total = subtotal + delivery
                let total = subtotal + deliveryCharge;

                $('#total').val(total.toFixed(2));
                $('#total-price').text(total.toFixed(2));
            }
        }


        updateSummary();


        $('#qty-plus').click(function() {
            let qty = $('#quantity');
            let newVal = parseInt(qty.val()) + 1;
            qty.val(newVal);
            updateSummary();
        });

        $('#qty-minus').click(function() {
            let qty = $('#quantity');

            if (parseInt(qty.val()) > 1) {
                let newVal = parseInt(qty.val()) - 1;
                qty.val(newVal);
            }
            updateSummary();
        });
    </script>
@endpush
