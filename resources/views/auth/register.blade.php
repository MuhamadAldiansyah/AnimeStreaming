<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <style>
        /* Additional styling for body background color */
        body {
            background-color: #1f2937; /* Black background */
        }
    </style>
</head>
 
<body class="bg-gray-900">
    <section class="flex items-center justify-center min-h-screen px-6 py-8">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center mb-6 text-2xl font-semibold text-gray-300">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <div>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-300 md:text-2xl">
                    Create an account
                </h1>
                <form action="{{ route('register.save') }}" method="POST" class="space-y-4 md:space-y-6 mt-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Your name</label>
                        <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" placeholder="name" required="">
                        @error('name')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" placeholder="name@company.com" required="">
                        @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" required="">
                        @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-300">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" required="">
                        @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-300">Profile Poto</label>
                        <input type="file" name="profile_photo" id="profile_photo" placeholder="masukan foto" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" required="">
                        @error('profile_photo')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-indigo-600" required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-400">I accept the <a class="font-medium text-indigo-500 hover:underline" href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <button type="submit" class="w-full flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create an account</button>
                    <p class="text-sm font-light text-gray-400">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-indigo-500 hover:underline">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</body>
 
</html>
