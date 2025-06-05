<footer class="bg-blue-800 text-white py-4 px-6" id="contact">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 items-center gap-4">
        <!-- Logo dan Info -->
        <div class="flex items-center space-x-4 justify-center md:justify-start">
            <img src="{{ asset('img/logo.png') }}" alt="Logo DKI Jakarta" class="w-16 h-auto">
            <div class="text-sm">
                <p class="font-semibold">PROVINSI DKI JAKARTA</p>
                <p>KANTOR LURAH</p>
                <p>KRAMAT</p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center text-xs md:text-sm">
            <p class="font-bold text-white">&copy; Copyright 2025. All Rights Reserved</p>
            <p>Designed by <a href="#" class="underline font-semibold hover:text-gray-300">Jakarta Pusat</a></p>
        </div>

        <!-- Social Media -->
        <div class="flex justify-center md:justify-end space-x-6 text-white text-xl">
            <a href="https://www.instagram.com/" class="hover:text-pink-500 transition-colors duration-200"
                target="_blank" rel="noopener noreferrer">
                <x-ri-instagram-line class="w-6 h-6" />
            </a>
            <a href="https://www.facebook.com/" class="hover:text-blue-400 transition-colors duration-200"
                target="_blank" rel="noopener noreferrer">
                <x-ri-facebook-circle-line class="w-6 h-6" />
            </a>
            <a href="https://twitter.com/" class="hover:text-gray-400 transition-colors duration-200" target="_blank"
                rel="noopener noreferrer">
                <x-ri-twitter-x-line class="w-6 h-6" />
            </a>
        </div>
    </div>
</footer>
