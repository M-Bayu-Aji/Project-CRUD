@extends('templates.logRis')

@section('content')
    <!-- Left Section: Login Form -->
    <div class="w-full md:w-1/2 p-10 shadow-xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang kembali!</h1>
            <p class="text-gray-500 mt-2">Masuk untuk mencari penawaran barang hemat terbaik.</p>
        </div>

        <!-- Login Form -->
        <form action="/login" method="post" class="space-y-6">
            @csrf
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="bi bi-envelope text-gray-400"></i>
                    </span>
                    <input type="email" name="email" id="email" required placeholder="Enter your email"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>
                    </span>
                    <input type="password" name="password" id="password" required placeholder="Enter your password"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" id="togglePassword" class="text-gray-500 hover:text-green-600">
                            <i class="bi bi-eye"></i>
                        </button>
                    </span>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full font-bold bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Sign In
            </button>
        </form>
        
        <div class="mt-6 text-center flex flex-col">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="/register" class="text-blue-500 hover:underline">Register Sekarang</a>
            </p>
            <a href="/forgot-password" class="text-blue-500 hover:underline">Forgot Password?</a>
        </div>
    </div>
@endsection
