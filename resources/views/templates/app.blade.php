<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    @vite('resources/css/app.css')
    <title>{{ $title }}</title>

    <style>
        /* Modern Navbar Styles */
        .modern-navbar {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modern-navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(30px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .nav-link-modern {
            position: relative;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link-modern:hover {
            color: #6366f1;
            transform: translateY(-2px);
        }

        .nav-link-modern.active {
            color: #6366f1;
        }

        .nav-link-modern::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 2px;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .nav-link-modern:hover::after,
        .nav-link-modern.active::after {
            width: 100%;
        }

        .logo-modern {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .logo-modern:hover {
            transform: scale(1.05);
        }

        .cart-badge {
            background: linear-gradient(135deg, #ef4444, #f97316);
            animation: pulse 2s infinite;
        }

        .mobile-menu {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dropdown-modern {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dropdown-item-modern {
            transition: all 0.2s ease;
        }

        .dropdown-item-modern:hover {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            transform: translateX(4px);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-modern.show {
            animation: slideDown 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .mobile-menu {
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .mobile-menu.show {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!--=============== MODERN HEADER ===============-->
    <header class="sticky top-0 z-50 p-4 bottom-8">
        <nav class="mx-auto modern-navbar rounded-2xl max-w-7xl" id="navbar">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Logo -->
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2 logo-modern hover:no-underline">
                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br rounded-xl">
                        <i class="text-xl text-white fas fa-store"></i>
                    </div>
                    <span class="logo-modern">Thrift.Store</span>
                </a>

                @if (Auth::check())
                    <!-- Desktop Navigation -->
                    <div class="items-center hidden space-x-8 lg:flex">
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('welcome') }}"
                               class="nav-link-modern {{ Route::is('welcome') ? 'active' : '' }} text-gray-700">
                                <i class="mr-2 fas fa-tachometer-alt"></i>Dashboard
                            </a>
                            <a href="{{ route('product.product_page') }}"
                               class="nav-link-modern {{ Route::is('product.product_page') ? 'active' : '' }} text-gray-700">
                                <i class="mr-2 fas fa-box"></i>Products
                            </a>
                            <a href="{{ route('karyawan.karyawan_page') }}"
                               class="nav-link-modern {{ Route::is('karyawan.karyawan_page') ? 'active' : '' }} text-gray-700">
                                <i class="mr-2 fas fa-users"></i>Karyawan
                            </a>
                        @endif

                        @if (Auth::user()->role == 'user')
                            <a href="{{ route('welcome') }}"
                               class="nav-link-modern {{ Route::is('welcome') ? 'active' : '' }} text-gray-700">
                                <i class="mr-2 fas fa-home"></i>Home
                            </a>
                            <a href="{{ route('payment.payment_page') }}"
                               class="nav-link-modern {{ Route::is('payment.payment_page') ? 'active' : '' }} text-gray-700">
                                <i class="mr-2 fas fa-shopping-bag"></i>Produk
                            </a>
                        @endif
                    </div>

                    <!-- User Actions -->
                    <div class="items-center hidden space-x-4 lg:flex">
                        @if (Auth::user()->role == 'user')
                            <a href="{{ route('payment.add_payment_page') }}"
                               class="relative p-3 text-white transition-all duration-300 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl hover:shadow-lg hover:scale-105">
                                <i class="fas fa-shopping-cart"></i>
                                @if (auth()->user()->orders && auth()->user()->orders->count() > 0)
                                    <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white rounded-full cart-badge -top-2 -right-2">
                                        {{ Auth::user()->orders->count() }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        <!-- User Dropdown -->
                        <div class="relative" id="userDropdown">
                            <button class="flex items-center p-2 space-x-2 transition-all duration-300 border bg-white/50 backdrop-blur-sm rounded-xl border-white/20 hover:bg-white/70"
                                    onclick="toggleDropdown()">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600">
                                    <i class="text-sm text-white fas fa-user"></i>
                                </div>
                                <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="text-xs text-gray-500 transition-transform duration-300 fas fa-chevron-down" id="dropdownIcon"></i>
                            </button>

                            <div class="absolute right-0 hidden w-56 mt-2 shadow-xl dropdown-modern rounded-2xl" id="dropdownMenu">
                                <div class="py-2">
                                    <a href="{{ route('profile') }}"
                                       class="flex items-center px-4 py-3 space-x-3 text-gray-700 dropdown-item-modern hover:text-blue-600">
                                        <i class="text-blue-500 fas fa-user-circle"></i>
                                        <span>Profile</span>
                                    </a>
                                    <hr class="mx-2 border-gray-200">
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center w-full px-4 py-3 space-x-3 text-gray-700 dropdown-item-modern hover:text-orange-600">
                                            <i class="text-orange-500 fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('delete_akun', Auth::user()->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                                class="flex items-center w-full px-4 py-3 space-x-3 text-red-600 dropdown-item-modern hover:text-red-700">
                                            <i class="text-red-500 fas fa-trash"></i>
                                            <span>Hapus Akun</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button class="p-2 text-gray-700 lg:hidden hover:text-blue-600" onclick="toggleMobileMenu()">
                        <i class="text-xl fas fa-bars" id="mobileMenuIcon"></i>
                    </button>

                    <!-- Mobile Menu -->
                    <div class="fixed shadow-xl mobile-menu top-20 right-4 w-80 rounded-2xl lg:hidden" id="mobileMenu">
                        <div class="p-6 space-y-4">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('welcome') }}"
                                   class="flex items-center space-x-3 p-3 rounded-xl {{ Route::is('welcome') ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                                <a href="{{ route('product.product_page') }}"
                                   class="flex items-center space-x-3 p-3 rounded-xl {{ Route::is('product.product_page') ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50' }}">
                                    <i class="fas fa-box"></i>
                                    <span>Products</span>
                                </a>
                                <a href="{{ route('karyawan.karyawan_page') }}"
                                   class="flex items-center space-x-3 p-3 rounded-xl {{ Route::is('karyawan.karyawan_page') ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50' }}">
                                    <i class="fas fa-users"></i>
                                    <span>Karyawan</span>
                                </a>
                            @endif

                            @if (Auth::user()->role == 'user')
                                <a href="{{ route('welcome') }}"
                                   class="flex items-center space-x-3 p-3 rounded-xl {{ Route::is('welcome') ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50' }}">
                                    <i class="fas fa-home"></i>
                                    <span>Home</span>
                                </a>
                                <a href="{{ route('payment.payment_page') }}"
                                   class="flex items-center space-x-3 p-3 rounded-xl {{ Route::is('payment.payment_page') ? 'bg-blue-50 text-blue-600' : 'hover:bg-gray-50' }}">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Produk</span>
                                </a>
                                <a href="{{ route('payment.add_payment_page') }}"
                                   class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Keranjang</span>
                                    </div>
                                    @if (auth()->user()->orders && auth()->user()->orders->count() > 0)
                                        <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-white rounded-full cart-badge">
                                            {{ Auth::user()->orders->count() }}
                                        </span>
                                    @endif
                                </a>
                            @endif

                            <hr class="border-gray-200">

                            <!-- Mobile User Actions -->
                            <a href="{{ route('profile') }}"
                               class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gray-50">
                                <i class="text-blue-500 fas fa-user-circle"></i>
                                <span>Profile</span>
                            </a>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full p-3 space-x-3 text-left rounded-xl hover:bg-gray-50">
                                    <i class="text-orange-500 fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
    </header>

    <!-- Content Wrapper with top padding -->
    <div>
        @yield('container-content')
    </div>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Dropdown functionality
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            const icon = document.getElementById('dropdownIcon');

            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
            icon.style.transform = dropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        // Mobile menu functionality
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const icon = document.getElementById('mobileMenuIcon');

            mobileMenu.classList.toggle('show');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdown');
            const dropdown = document.getElementById('dropdownMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            const icon = document.getElementById('dropdownIcon');
            const mobileIcon = document.getElementById('mobileMenuIcon');

            if (!userDropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('show');
                icon.style.transform = 'rotate(0deg)';
            }

            if (!event.target.closest('#mobileMenu') && !event.target.closest('button[onclick="toggleMobileMenu()"]')) {
                mobileMenu.classList.remove('show');
                mobileIcon.classList.add('fa-bars');
                mobileIcon.classList.remove('fa-times');
            }
        });
    </script>

    <!--=============== MAIN JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('script')

</body>

</html>
