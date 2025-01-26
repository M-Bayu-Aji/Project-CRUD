<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .wave-container svg {
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center relative">
    <div
        class="w-full max-w-6xl p-10 bg-white shadow-md rounded-2xl overflow-hidden flex flex-col md:flex-row animate-fade-in">
        @yield('content')
        <!-- Right Section: Image & Description -->
        <div class="hidden md:block w-3/4 bg-gradient-to-br bg-gray-200 p-8 flex flex-col justify-center items-center">
            <img src="{{ asset('img/image.png') }}" alt="Thrift Store Illustration"
                class="w-4/5 mx-auto h-auto object-contain mb-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Temukan fashion mu yang unik disini!</h2>
            <p class="text-gray-600 text-center mt-2">Jelajahi mode berkelanjutan dengan harga yang tak terkalahkan!</p>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
