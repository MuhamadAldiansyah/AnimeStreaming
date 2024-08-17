@extends('admin.home')

@section('contents')
<!-- Main Content Area -->
<div class="container mx-auto flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6 p-6">
    <!-- Forms Section -->
    <div class="flex-1 space-y-6">
        <!-- Category Form -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-white">Manage Categories</h1>
            <form action="{{ route('admin') }}" method="POST" id="category-form" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Category Name</label>
                    <input type="text" name="name" id="name" 
                        class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                        placeholder="Enter category name" required>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" id="save-category" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                        Save Category
                    </button>
                    <button type="reset" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="flex-1 space-y-6">
        <!-- Table for Category Data -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg overflow-x-auto">
            <h1 class="text-2xl font-bold mb-4 text-white">Category Data</h1>
            <div class="mb-4">
                <label for="category-search" class="block mb-2 text-sm font-medium text-gray-300">Search Categories</label>
                <input type="text" id="category-search" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                    placeholder="Search by name">
            </div>
            <table id="category-table" class="min-w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg">
                <!-- Success Message -->
                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif
                <thead>
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">ID</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Category Name</th>
                        <th class="py-3 px-4 border-b border-gray-600 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $category)
                    <tr>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">{{ $category->name }}</td>
                        <td class="py-3 px-4 border-b border-gray-600 text-center">
                            <button class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500" onclick="openEditModals({{ $category->id }}, '{{ $category->name }}')">Edit</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-400" onclick="openDeleteConfirmationModals({{ $category->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach                        
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="edit-category-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-white">Edit Category</h2>
        <form action="" method="POST" id="edit-category-form">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-category-id">
            <div>
                <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-300">Category Name</label>
                <input type="text" name="name" id="edit-name" 
                    class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" 
                    placeholder="Enter category name" required>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                    Save Changes
                </button>
                <button type="reset" onclick="closeEditModals()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    reset
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-white">Confirm Deletion</h2>
        <p class="text-gray-300 mb-4">Are you sure you want to delete this category?</p>
        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                    Delete
                </button>
                <button type="button" onclick="closeDeleteConfirmationModal()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@endsection


