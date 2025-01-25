@extends('templates.logRis')

@section('content')
    <!-- Left Section: Registration Form -->
    <div class="w-full md:w-1/2 p-10 shadow-xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Buat Akun Anda</h1>
            <p class="text-gray-500 mt-2">Daftar untuk mencari penawaran barang hemat terbaik.</p>
        </div>

        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="post" class="space-y-6">
            @csrf
            <!-- Full Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="bi bi-person text-gray-400"></i>
                    </span>
                    <input type="text" name="name" id="name" required placeholder="Enter your full name"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('name') }}">
                </div>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- username field --}}
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="bi bi-person-badge text-gray-400"></i>
                    </span>
                    <input type="text" name="username" id="username" required placeholder="Enter your username"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('username') }}">
                </div>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="bi bi-envelope text-gray-400"></i>
                    </span>
                    <input type="email" name="email" id="email" required placeholder="Enter your email"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('email') }}">
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
                    <input type="password" name="password" id="password" required placeholder="Create a password"
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
                class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 font-bold w-full">
                Sign Up
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Masuk</a>
            </p>
        </div>
    </div>
@endsection
