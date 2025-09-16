<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'slide-in': 'slideIn 0.8s ease-out forwards'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        slideIn: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0px)' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 flex items-center justify-center p-4">
    
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-float"></div>
        <div class="absolute top-1/3 right-20 w-16 h-16 bg-white bg-opacity-5 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/3 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 right-10 w-8 h-8 bg-white bg-opacity-5 rounded-full animate-float" style="animation-delay: 0.5s;"></div>
    </div>

    <!-- Main container -->
    <div class="relative w-full max-w-md">
        <!-- Glass morphism card -->
        <div class="bg-white bg-opacity-95 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white border-opacity-20 animate-slide-in">
            
            <!-- Error icon -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-red-500 to-pink-500 rounded-full mb-4 shadow-lg animate-pulse-slow">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-red-500 to-pink-500 bg-clip-text text-transparent mb-2">
                    Akses Ditolak
                </h1>
            </div>

            <!-- Error message -->
            <div class="text-center mb-8">
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg mb-4">
                    @if (session('error'))
                        <p class="text-gray-700 text-sm leading-relaxed">{{ session('error') }}</p>
                    @else
                        <p class="text-gray-700 text-sm leading-relaxed">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.</p>
                    @endif
                </div>
                
                <!-- Additional info -->
                <div class="flex items-center justify-center text-xs text-gray-500 mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Error Code: 403 - Forbidden
                </div>
            </div>

            <!-- Action buttons -->
            <div class="space-y-3">
                <!-- Back button with JavaScript fallback -->
                <button onclick="goBack()" 
                   class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl cursor-pointer">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Halaman Sebelumnya
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            // Coba kembali ke halaman sebelumnya
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Jika tidak ada history, redirect ke home page
                window.location.href = '/';
            }
        }
        
        // Alternative: Auto redirect after certain time (uncomment if needed)
        // setTimeout(function() {
        //     goBack();
        // }, 5000); // Redirect after 5 seconds
    </script>

</body>
</html>