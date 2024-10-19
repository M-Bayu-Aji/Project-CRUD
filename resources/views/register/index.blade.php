<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <title>Register</title>
</head>
<body>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">
      <main>
        <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Registration Form</h1>
        <form action="/register" method="post">
          @csrf
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full @error('name')  @enderror" placeholder="Name" required value="{{ old('name') }}">
            @error('name')
              <div class="text-red-500 text-sm mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full @error('username')  @enderror" placeholder="Username" required value="{{ old('username') }}">
            @error('username')
              <div class="text-red-500 text-sm mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input type="email" name="email" id="email" class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full @error('email')  @enderror" placeholder="name@example.com" required value="{{ old('email') }}">
            @error('email')
              <div class="text-red-500 text-sm mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 w-full @error('password')  @enderror" placeholder="Password" required>
            @error('password')
              <div class="text-red-500 text-sm mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-300">
            Register
          </button>
        </form>
  
        <small class="block text-center text-sm text-gray-500 mt-4">
          Already registered? <a href="/login" class="text-blue-600 hover:underline">Login</a>
        </small>
      </main>
    </div>
  </div>  
</body>
</html>