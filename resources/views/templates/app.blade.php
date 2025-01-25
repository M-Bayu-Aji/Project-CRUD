<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="m-2.5">
    <!--=============== HEADER ===============-->
    <header class="header shadow-md rounded">
        <nav class="nav container1">
            <div class="nav__data1">
                <a href="#" class="nav__logo text-xl">
                    <i class="ri-store-3-line"></i> Thrift.Store
                </a>
                @if (Auth::check())
                    <div class="nav__toggle1" id="nav-toggle">
                        <i class="ri-menu-line nav__burger text-black"></i>
                        <i class="ri-close-line nav__close text-black"></i>
                    </div>
                    <div class="nav__menu" id="nav-menu">
                        <ul class="nav__list">
                            @if (Auth::user()->role == 'admin')
                                <li><a href="{{ route('welcome') }}"
                                        class="uhui {{ Route::is('welcome') ? 'active' : '' }} nav__link">Dashboard</a>
                                </li>
                                <li><a href="{{ route('product.product_page') }}"
                                        class="uhui nav__link {{ Route::is('product.product_page') ? 'active' : '' }}">Products</a>
                                </li>
                                <li><a href="{{ route('karyawan.karyawan_page') }}"
                                        class="uhui {{ Route::is('karyawan.karyawan_page') ? 'active' : '' }} nav__link">Karyawan</a>
                                </li>
                            @else
                                <li><a href="{{ route('welcome') }}"
                                        class="uhui {{ Route::is('welcome') ? 'active' : '' }} nav__link">Home</a></li>
                                <li><a href="{{ route('payment.payment_page') }}"
                                        class="uhui {{ Route::is('payment.payment_page') ? 'active' : '' }} nav__link">Produk</a>
                                </li>
                                <li><a href="{{ route('payment.add_payment_page') }}"
                                        class="uhui {{ Route::is('payment.add_payment_page') ? 'active' : '' }} nav__link"><i
                                            class="bi bi-cart"></i>Keranjang</a>
                                </li>
                            @endif
                            <li class="relative">
                                <a data-bs-toggle="dropdown"
                                    class="uhui nav__link cursor-pointer flex items-center text-black hover:text-gray-600">
                                    <i class="bi bi-person-circle"></i>
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="bi bi-chevron-down"></i>
                                </a>
                                <ul
                                    class="dropdown-menu absolute hidden mt-2 w-48 bg-white rounded-md shadow ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <li>
                                        <form action="/logout" method="post" class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center space-x-2">
                                                <i class="bi bi-box-arrow-right"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('delete_akun', Auth::user()->id) }}" method="post"
                                            class="w-full">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="dropdown-item w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-100 hover:text-red-600 flex items-center space-x-2">
                                                <i class="bi bi-trash"></i>
                                                <span>Hapus Akun</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                @endif
            </div>
            </div>

            <!--=============== NAV MENU ===============-->
        </nav>
    </header>

    @yield('container-content')

    {{-- <footer class="bg-white py-6 w-full mt-2.5 ">
        <div class="container mx-auto px-4">
            <div class=" text-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2024 <a href="#" class="text-blue-500 hover:underline">MuhammadBayuAji</a>
                </p>
            </div>
        </div>
        </div>
    </footer> --}}

    <!--=============== MAIN JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('script')

</body>

</html>
