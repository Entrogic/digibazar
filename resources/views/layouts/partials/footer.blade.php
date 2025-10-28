<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Logo & Description Column -->
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <span class="text-2xl font-bold">{{ \App\Models\Setting::get('site_name', 'DiziBazar') }}</span>
                    <span
                        class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-sm">✓</span>
                </div>
                <p class="text-gray-400 leading-relaxed mb-4">
                    {{ \App\Models\Setting::get('footer_about', 'আমরা বিশ্বাস করি, সময়মত মানসম্পন্ন পণ্য সরবরাহ করার মাধ্যমে গ্রাহকদের সেবা প্রদান করা। আমাদের লক্ষ্য হলো প্রতিটি গ্রাহকের চাহিদা পূরণ করা।') }}
                </p>
                <div class="flex space-x-4">
                    @if (\App\Models\Setting::get('facebook_url'))
                        <a href="{{ \App\Models\Setting::get('facebook_url') }}"
                            class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if (\App\Models\Setting::get('twitter_url'))
                        <a href="{{ \App\Models\Setting::get('twitter_url') }}"
                            class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if (\App\Models\Setting::get('instagram_url'))
                        <a href="{{ \App\Models\Setting::get('instagram_url') }}"
                            class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h3 class="text-lg font-semibold mb-6">দ্রুত লিংক</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">হোম</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">পণ্য</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">আমাদের সম্পর্কে</a>
                    </li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">যোগাযোগ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">প্রাইভেসি পলিসি</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info Column -->
            <div>
                <h3 class="text-lg font-semibold mb-6">যোগাযোগ করুন</h3>
                <div class="space-y-3 text-gray-400">
                    @if (\App\Models\Setting::get('address'))
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-green-500"></i>
                            <span>{{ \App\Models\Setting::get('address') }}</span>
                        </div>
                    @endif
                    @if (\App\Models\Setting::get('phone'))
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-green-500"></i>
                            <span>{{ \App\Models\Setting::get('phone') }}</span>
                        </div>
                    @endif
                    @if (\App\Models\Setting::get('email'))
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-green-500"></i>
                            <span>{{ \App\Models\Setting::get('email') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'DiziBazar') }}. সকল অধিকার সংরক্ষিত।
            </p>
        </div>
    </div>
</footer>
