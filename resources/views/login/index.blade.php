<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <title>Login</title>
</head>
<body>
  <div class="min-h-screen flex items-center justify-center bg-white mt-2.5">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
  
      @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          {{ session('success') }}
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <button type="button" class="text-green-700" data-bs-dismiss="alert" aria-label="Close">
              &times;
            </button>
          </span>
        </div>
      @endif
  
      @if(session()->has('loginError'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          {{ session('loginError') }}
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <button type="button" class="text-red-700" data-bs-dismiss="alert" aria-label="Close">
              &times;
            </button>
          </span>
        </div>
      @endif
  
      <main>
        <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Please login</h1>
        <form action="/login" method="post">
          @csrf
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input type="email" name="email" id="email" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full @error('email') @enderror" placeholder="name@example.com" required value="{{ old('email') }}">
            @error('email')
              <div class="text-red-500 text-sm mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full" placeholder="Password" required>
          </div>
  
          <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-300">
            Login
          </button>
        </form>
  
        <small class="block text-center text-sm text-gray-500 mt-4">
          Not registered? <a href="/register" class="text-blue-600 hover:underline">Register Now!</a>
        </small>
      </main>
    </div>
  </div>
</body>
</html>