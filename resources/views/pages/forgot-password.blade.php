@extends('templates.logRis')

@section('content')
    <!-- Left Section: Forgot Password Form -->
    <div class="w-full md:w-1/2 my-auto p-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Lupa Password?</h1>
            <p class="text-gray-500 mt-2">Masukkan email Anda untuk mengatur ulang password.</p>
        </div>

        <!-- Forgot Password Form -->
        <form action="{{ route('ForgotPassword') }}" method="post" class="space-y-6">
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

            <!-- Submit Button -->
            <button type="submit"
                class="w-full font-bold bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Kirim Link Reset Password
            </button>
        </form>

        <!-- Back to Login Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Ingat password Anda?
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
@endsection