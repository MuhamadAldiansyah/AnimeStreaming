<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
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
                    Sign in to your account
                </h1>
                <form class="space-y-4 md:space-y-6 mt-6" method="post" action="{{ route('login.action') }}">
                    @csrf
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><span class="block sm:inline">{{ $error }}</span></li>
                            @endforeach
                        </ul>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    @endif
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" required="">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input name="remember" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-indigo-600" required="">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-400">Remember me</label>
                            </div>
                        </div>
                        <a href="#" class="text-sm font-medium text-indigo-500 hover:underline">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                    <p class="text-sm font-light text-gray-400">
                        Don’t have an account yet? <a href="{{ route('register') }}" class="font-medium text-indigo-500 hover:underline">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</body>
 
</html>
