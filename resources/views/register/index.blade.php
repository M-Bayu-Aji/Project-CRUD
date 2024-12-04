@extends('templates.app')

@section('container-content')
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="w-full max-w-lg bg-white shadow my-5 rounded-lg p-8">
            <main>
                <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Registration Form</h1>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="block text-sm my-2 font-medium text-gray-700">Name :</label>
                        <input type="text" name="name" id="name"
                            class="font-sans form-control @error('name')  @enderror"
                            placeholder="Name" required value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="block text-sm my-2 font-medium text-gray-700">Username :</label>
                        <input type="text" name="username" id="username"
                            class="font-sans form-control @error('username')  @enderror"
                            placeholder="Username" required value="{{ old('username') }}">
                        @error('username')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-sm my-2 font-medium text-gray-700">Email address :</label>
                        <input type="email" name="email" id="email"
                            class="font-sans form-control @error('email')  @enderror"
                            placeholder="name@example.com" required value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm my-2 font-medium text-gray-700">Password :</label>
                        <input type="password" name="password" id="password"
                            class="font-sans form-control @error('password')  @enderror"
                            placeholder="Password" required>
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-300">
                        Register
                    </button>
                </form>

                <small class="block text-center text-sm text-gray-500 mt-4">
                    Already registered? 
                    <form action="{{ route('login') }}" method="post" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline">Login</button>
                    </form>
                </small>
            </main>
        </div>
    </div>
@endsection
