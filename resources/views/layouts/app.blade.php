<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raju Bazar - ডিজিবাজার</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Hind Siliguri', sans-serif;
        }
        
        .hero-bg {
            background: linear-gradient(rgba(30, 30, 50, 0.7), rgba(30, 30, 50, 0.7)), 
                        url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200') center/cover;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-gray-800">Digi</span>
                <span class="text-2xl font-bold text-gray-800">Bazar</span>
                <span class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-sm">✓</span>
            </div>
            <button class="text-green-600 flex items-center space-x-2 hover:text-green-700">
                <span>🏪</span>
                <span>হোমপেজ</span>
            </button>
        </div>
    </header>

   
    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-2xl font-bold">Digi</span>
                        <span class="text-2xl font-bold">Bazar</span>
                        <span class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-sm">✓</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        আমরা বিশ্বাস করি, সময়মত মান সম্বিত সুন্দরদের মাইক<br>
                        দৈত দরকার এক অবিচল কাজ লবনার ভূমিকা নাই, অনুরোধটি<br>
                        এখানে অর্ডার দেখে পৌঁছে খাবে ১ ঘন্টার মধ্যে, আপনি<br>
                        শুন বাগ সাবান তোলাসীড় সাহিল।
                    </p>
                </div>
                
                <!-- Right Column -->
                <div class="text-right">
                    <p class="text-gray-400">
                        © ১৬৮ রাজন লবন্ধান পাইনেল লমহবসন্ট।
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>