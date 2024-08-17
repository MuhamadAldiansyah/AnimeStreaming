<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Aldiansyah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Menjaga rasio gambar agar tetap proporsional */
        .poster-image {
            aspect-ratio: 2 / 3; /* Menyesuaikan dengan rasio gambar yang diinginkan */
        }

                /* Tambahkan di file CSS Anda */
        .h-65 {
            height: 13rem; /* Setinggi 16rem, atau sesuaikan sesuai kebutuhan */
        }

        @media (max-width: 768px) {
            .genre-scroll {
                display: flex;
                overflow-x: auto;
                white-space: nowrap;
                padding: 0 1rem;
            }
            .genre-scroll::-webkit-scrollbar {
                display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
            }
            .genre-scroll a {
                display: inline-block;
                margin-right: 0.75rem; /* Margin-right for spacing */
                min-width: 100px; /* Set a minimum width for each button */
            }
        }
        @media (min-width: 769px) {
            .genre-container {
                display: flex;
                flex-direction: column;
                position: sticky;
                top: 0;
                z-index: 40;
            }
            .genre-scroll {
                display: flex;
                flex-wrap: nowrap; /* Ensure genres are in a single row */
                overflow-x: auto; /* Allow horizontal scrolling */
                padding: 0 1rem; /* Add some padding */
                gap: 0.75rem; /* Space between genre items */
                background: #1f2937; /* Same as body background */
            }
            .genre-scroll::-webkit-scrollbar {
                display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
            }
            .genre-scroll a {
                flex-shrink: 0; /* Prevent shrinking */
                min-width: 120px; /* Adjust min-width for desktop */
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex items-center justify-between flex-wrap">
            <!-- Navbar Brand -->
            <div class="text-white text-xl font-semibold">
                <a href="#" class="hover:text-gray-400">Aldiansyah</a>
            </div>

            <!-- Navbar Items (visible on larger screens) -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <!-- Profile Icon -->
                <div class="relative">
                    <button id="profile-button" class="text-white flex items-center space-x-2 hover:text-gray-400">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-8 h-8 rounded-full bg-gray-600">
                        <span class="block text-white font-semibold">{{ auth()->user()->name }}</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-600 rounded-lg shadow-lg hidden">
                        <a href="{{ route('profiles') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Logout</a>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu Button (visible only on small screens) -->
            <div class="block lg:hidden">
                <button id="menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (hidden on larger screens) -->
       <!-- Mobile Menu (hidden on larger screens) -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
            <div class="container mx-auto p-4">
                <!-- Close Button -->
                <div class="flex justify-end">
                    <button id="close-menu" class="text-white">
                        <i class="fas fa-times fa-lg"></i>
                    </button>
                </div>
                <!-- Mobile Profile Icon -->
                <div class="flex items-center justify-center mt-4">
                    <button class="text-white flex items-center space-x-2 hover:text-gray-400">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-8 h-8 rounded-full bg-gray-600">
                        <span class="md:hidden">Profile</span>
                    </button>
                </div>
                <!-- Mobile Menu Links -->
                <div class="mt-6 space-y-4">
                    <a href="{{ route('profile') }}" class="block text-white hover:bg-gray-700 px-4 py-2 rounded">Profile</a>
                    <a href="{{ route('logout') }}" class="block text-white hover:bg-gray-700 px-4 py-2 rounded">Logout</a>
                </div>
            </div>
        </div>

    </nav>

    @yield('contents')
    
    <!-- Footer -->
    <footer class="bg-gray-800 fixed bottom-0 inset-x-0 z-50">
        <div class="container mx-auto px-4 py-2 flex justify-around items-center">
            <!-- Home Icon -->
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fas fa-home fa-lg"></i>
                <span class="sr-only">Home</span>
            </a>
        </div>
    </footer>

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        document.getElementById('close-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });

        // Toggle the profile dropdown menu
        document.getElementById('profile-button').addEventListener('click', function() {
            document.getElementById('profile-dropdown').classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.matches('#profile-button')) {
                var dropdowns = document.getElementsByClassName('dropdown-content');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('hidden')) {
                        openDropdown.classList.add('hidden');
                    }
                }
            }
        });
    </script>
</body>
</html>
