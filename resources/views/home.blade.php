@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero-bg py-32 text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                মুদি থেকে উৎস — সবকিছু পৌঁছে যাবে<br>
                আপনার দরজায়, মাত্র ১ ঘন্টায়!
            </h1>
            <p class="text-lg mb-8 text-gray-200">
                কাজকর্মে ব্যস্ততার মাঝে সময় বাঁচান তোলাসীড় সাহিল
            </p>
            <button
                class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full font-semibold inline-flex items-center space-x-2 transition">
                <span>এখনই কিনুন এলাকায়</span>
                <span>→</span>
            </button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        ⏱️
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">১ ঘণ্টায় নয়া ডেলিভারি</h3>
                        <p class="text-gray-600">সময়মত অর্ডার ডেলিভারি পাবার সময়</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        🥬
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">তাজা ও আসল পণ্য</h3>
                        <p class="text-gray-600">প্রতিটি খাবার পরামাণবিক মান যাচাই</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        💰
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">সাশ্রয়ী দাম</h3>
                        <p class="text-gray-600">বাজারের তুলনায়, একদম কম দামে</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">জনপ্রিয় ক্যাটাগরি</h2>
            <p class="text-center text-gray-600 mb-12">যে বিষয়গুলি পরিলক্ষ, প্রায় শতাংশের ন্যস আমরা:</p>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <!-- Category 1 -->
                <div class="bg-green-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🥬</div>
                    <p class="font-semibold">ফল ও সবজি</p>
                </div>

                <!-- Category 2 -->
                <div class="bg-red-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🥩</div>
                    <p class="font-semibold">মাছ ও মাংস</p>
                </div>

                <!-- Category 3 -->
                <div class="bg-blue-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🍳</div>
                    <p class="font-semibold">চাল, ডাল, তেলা</p>
                </div>

                <!-- Category 4 -->
                <div class="bg-purple-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🥛</div>
                    <p class="font-semibold">দুগ্ধজাত</p>
                </div>

                <!-- Category 5 -->
                <div class="bg-yellow-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🧀</div>
                    <p class="font-semibold">ঘরের শর্করাজান</p>
                </div>

                <!-- Category 6 -->
                <div class="bg-pink-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🍯</div>
                    <p class="font-semibold">মেয়ে জনপোষক</p>
                </div>

                <!-- Category 7 -->
                <div class="bg-green-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">📝</div>
                    <p class="font-semibold">স্টেশনারি ও বুদ্ধিযা<br>সাম্গী</p>
                </div>

                <!-- Category 8 -->
                <div class="bg-red-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🧴</div>
                    <p class="font-semibold">বিজন্নো ও এক নে<br>প্রযোবার</p>
                </div>

                <!-- Category 9 -->
                <div class="bg-yellow-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🧃</div>
                    <p class="font-semibold">খেলো বেলুন পণ্য</p>
                </div>

                <!-- Category 10 -->
                <div class="bg-purple-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🐕</div>
                    <p class="font-semibold">পেট অ্যানিম্যাল কস</p>
                </div>

                <!-- Category 11 -->
                <div class="bg-gray-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">🔧</div>
                    <p class="font-semibold">বাদমানবের থিয়োসিট</p>
                </div>

                <!-- Category 12 -->
                <div class="bg-pink-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <div class="text-4xl mb-2">👶</div>
                    <p class="font-semibold">শিশু ও বাবি পুয়েরার</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery Area Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">
                🛵 ডেলিভারি এলাকা
            </h2>
            <p class="text-center text-gray-600 mb-12">
                আমরা এখন বাতিস লিখতে পর্যন্ত কাজকর্ম এলাকায়:
            </p>

            <div class="max-w-4xl mx-auto bg-green-50 rounded-2xl p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column - Delivery Areas -->
                    <div>
                        <h3 class="text-xl font-bold mb-4 flex items-center">
                            <span class="text-red-500 mr-2">📍</span>
                            কাজকর্ম এখন রাজন বাজারের আওতায়।
                        </h3>
                        <p class="text-gray-700 mb-4">কাজকর্ম লবুবদের বাজারের লবমের আমরা পৌঁছা!</p>

                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> উজিরপুরে
                            </li>
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> যুদবার
                            </li>
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> মিটবজির ১৪
                            </li>
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> রাজবিক অল্পান্তি
                            </li>
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> মিটবজির ২৩
                            </li>
                            <li class="flex items-center text-green-700">
                                <span class="mr-2">▸</span> রাজলিন সিটি
                            </li>
                        </ul>

                        <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded">
                            <p class="text-sm">
                                <span class="font-semibold">⚡ বোনাস:</span> মান ১ ঘণ্টায় নয়া ডেলিভারি!
                            </p>
                            <p class="text-sm text-gray-600">কাজকর্ম অল্পান বাথী নিয়মের অর্ডারের দ্রুত পৌঁছায়।</p>
                        </div>
                    </div>

                    <!-- Right Column - Map -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="https://via.placeholder.com/400x300/e0e0e0/666666?text=Delivery+Map"
                            alt="Delivery Area Map" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Order Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">কিভাবে অর্ডার করবেন?</h2>
            <p class="text-center text-gray-600 mb-12">অর্ডার জন্য প্রদেশ নিলেব:</p>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <p class="font-semibold">সাথ এ ফোনে নম্বর লিখুন</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <p class="font-semibold">ফোনে চলুন মানল লাগবে<br>তো লিখুন</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <p class="font-semibold">অ্যাপসার থিরেরা নিন</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        4
                    </div>
                    <p class="font-semibold">ঘস অ্যাপারেটে কল কলে<br>কলবতার করলে</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="mb-6 text-lg">
                    ⚡ তোলাদের অন্থনা পীন-চে, ২০০ — ৫৪০ টাকা নজবা!
                </p>
                <button
                    class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full font-semibold inline-flex items-center space-x-2 transition">
                    <span>এখনই কিনুন এলাকায়</span>
                    <span>→</span>
                </button>
            </div>
        </div>
    </section>
@endsection
