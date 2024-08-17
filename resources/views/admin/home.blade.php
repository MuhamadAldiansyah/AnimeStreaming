<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Aldiansyah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        .nowrap {
        white-space: nowrap; 
        overflow: hidden;    
        text-overflow: ellipsis;
        max-width: 200px; /* Tentukan lebar maksimum kolom */ 
    }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex items-center justify-between flex-wrap">
            <!-- Navbar Brand -->
            <div class="text-white text-xl font-semibold d-flex">
                <a href="#" class="hover:text-gray-400">Aldiansyah</a>
            </div>

            <!-- Navbar Items (visible on larger screens) -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <!-- Profile Icon -->
                <div class="relative">
                    <button id="profile-button" class="text-white flex items-center space-x-2 hover:text-gray-400">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-8 h-8 rounded-full bg-gray-600">
                        <span class="block text-white font-semibold"></span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-600 rounded-lg shadow-lg hidden">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Profile</a>
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
            <a href="{{ route('admin') }}" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-backward"></i>
                <span class="sr-only">Home</span>
            </a>

            <!-- Kategori Icon -->
            <a href="{{ route('anime') }}" class="text-gray-400 hover:text-white">
                <i class="fas fa-home fa-lg"></i>
                <span class="sr-only">Anime</span>
            </a>

            <!-- Setting Icon -->
            <a href="{{ route('episode') }}" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-align-justify"></i>
                <span class="sr-only">Episode</span>
            </a>

        </div>
    </footer>

    <script>
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

        // Toggle the mobile menu
        document.getElementById('menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Close mobile menu when clicking the close button
        document.getElementById('close-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });

        // Functionality for the search
        document.getElementById('category-search').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#category-table tbody tr');
            rows.forEach(function(row) {
                var categoryName = row.cells[1].textContent.toLowerCase();
                if (categoryName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

      
    function openEditModals(id, name) {
        // Set form action URL dynamically
        document.getElementById('edit-category-form').action = `/admin/categories/update/${id}`;
        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-category-modal').classList.remove('hidden');
    }

    function closeEditModals() {
        document.getElementById('edit-category-modal').classList.add('hidden');
    }

    function openEditModals(id, name) {
        // Set form action URL dynamically
        document.getElementById('edit-category-form').action = `/admin/categories/update/${id}`;
        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-category-modal').classList.remove('hidden');
    }

    function closeEditModals() {
        document.getElementById('edit-category-modal').classList.add('hidden');
    }

      // Function to open Delete Confirmation Modal
      function openDeleteConfirmationModals(id) {
        document.getElementById('delete-form').action = `/admin/categories/delete/${id}`;
        document.getElementById('delete-confirmation-modal').classList.remove('hidden');
    }

    // Function to close Delete Confirmation Modal
    function closeDeleteConfirmationModal() {
        document.getElementById('delete-confirmation-modal').classList.add('hidden');
    }

    // Anime  
    function openEditModal(id, title, category_id, posterUrl) {
    // Set form action URL dynamically
    document.getElementById('edit-anime-form').action = `anime/update/${id}`;
    document.getElementById('edit-anime-id').value = id;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-category_id').value = category_id;

    // Set the current poster image
    const posterPreview = document.getElementById('poster-preview');
    posterPreview.src = posterUrl ? posterUrl : ''; // Set to default or empty if no URL

    document.getElementById('edit-anime-modal').classList.remove('hidden');
    }

    function previewImage() {
    const file = document.getElementById('edit-poster').files[0];
    const posterPreview = document.getElementById('poster-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onloadend = function () {
            posterPreview.src = reader.result;
        };
        reader.readAsDataURL(file);
    } else {
        // Clear the preview if no file is selected
        posterPreview.src = ''; 
    }
    }


    function closeEditModal() {
        document.getElementById('edit-anime-modal').classList.add('hidden');
    }
    
    function openDeleteConfirmationModal(id) {
        document.getElementById('delete-form').action = `anime/delete/${id}`;
        document.getElementById('delete-confirmation-modal').classList.remove('hidden');
    }

    function closeDeleteConfirmationModal() {
        document.getElementById('delete-confirmation-modal').classList.add('hidden');
    }

    function searchAnime() {
    // Ambil input dari kotak pencarian
    var input = document.getElementById('anime-search');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('anime-table');
    var tr = table.getElementsByTagName('tr');

    // Looping melalui semua baris di tabel, kecuali header
    for (var i = 1; i < tr.length; i++) {
        var tdTitle = tr[i].getElementsByTagName('td')[1]; // Kolom Title
        var tdDescription = tr[i].getElementsByTagName('td')[2]; // Kolom Description
        
        if (tdTitle || tdDescription) {
            var titleText = tdTitle.textContent || tdTitle.innerText;
            var descriptionText = tdDescription.textContent || tdDescription.innerText;
            
            // Jika ada kecocokan, tampilkan baris, jika tidak sembunyikan
            if (titleText.toLowerCase().indexOf(filter) > -1 || descriptionText.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}

function previewProfileImage() {
            const file = document.getElementById('edit-profile-photo').files[0];
            const preview = document.getElementById('profile-photo-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onloadend = function () {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '{{ asset('storage/' . auth()->user()->profile_photo) }}';
            }
        }

    </script>  
    
    {{-- <script>
        function openEditModalEpisode(id, anime_id, description, episode_number, videoUrl) {
        // Set values for the modal inputs
        document.getElementById('edit-episode-id').value = id;
        document.getElementById('edit-description').value = description;
        document.getElementById('edit-episode_number').value = episode_number;
        
        // Set the anime_id in the select element
        const animeSelect = document.getElementById('edit-anime_id');
        for (let i = 0; i < animeSelect.options.length; i++) {
            if (animeSelect.options[i].value == anime_id) {
                animeSelect.selectedIndex = i;
                break;
            }
        }
        
        // Set the action URL for the form
        const formAction = "{{ url('episodes/update') }}/" + id;
        document.getElementById('edit-episode-form').action = formAction;

        // Show the modal
        document.getElementById('edit-episode-modal').classList.remove('hidden');
        }

        function closeEditModalEpisode() {
            document.getElementById('edit-episode-modal').classList.add('hidden');
        }

    </script> --}}

</body>
</html>

