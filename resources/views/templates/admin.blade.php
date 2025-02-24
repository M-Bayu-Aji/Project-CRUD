<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('style')
    <title>{{ $title }}</title>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Top Bar -->
        <div class="md:hidden bg-gradient-to-br from-indigo-700 to-purple-600 p-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-store text-2xl mr-3 text-white"></i>
                <h1 class="text-xl font-bold text-white">ThriftPro</h1>
            </div>
            <button id="mobile-menu-toggle" class="text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <aside id="mobile-sidebar"
            class="hidden md:block w-full md:w-72 bg-gradient-to-br from-indigo-700 to-purple-600 text-white shadow-2xl md:relative fixed inset-y-0 left-0 transform md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="p-6 relative h-full flex flex-col">
                <!-- Close Button for Mobile -->
                <button id="mobile-sidebar-close"
                    class="absolute top-4 right-4 md:hidden text-white hover:text-gray-200 transition-colors duration-200">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <!-- Header Section -->
                <div class="text-center border-b border-indigo-500/30 pb-6">
                    <div class="flex items-center justify-center mb-4 space-x-3">
                        <i class="fas fa-store text-4xl text-white opacity-90"></i>
                        <h1 class="text-3xl font-extrabold tracking-tight">ThriftPro</h1>
                    </div>
                    <p class="text-sm text-indigo-200 font-medium">Admin Control Center</p>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-8 flex-1">
                    <ul class="space-y-3 px-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5' }}">
                                <i
                                    class="fas fa-chart-pie text-lg w-8 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-indigo-200' }}"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.product_page') }}"
                                class="flex items-center p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('product.product_page') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5' }}">
                                <i
                                    class="fas fa-tags text-lg w-8 {{ request()->routeIs('product.product_page') ? 'text-white' : 'text-indigo-200' }}"></i>
                                <span class="font-medium">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order.order_page') }}"
                                class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-white/5 {{ $title === 'Orders' ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5' }}">
                                <i
                                    class="fas fa-shopping-cart text-lg w-8 text-indigo-200 {{ request()->routeIs('order.order_page') ? 'text-white' : 'text-indigo-200' }}"></i>
                                <span class="font-medium">Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-white/5">
                                <span class="font-medium"><i class="fa-solid fa-user-gear"></i> Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Logout Button -->
                <div class="border-t border-indigo-500/30 pt-4 mt-6">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-3 rounded-xl text-indigo-100 hover:bg-white/10 transition-colors duration-200 flex items-center">
                            <i class="fas fa-sign-out-alt text-lg w-8 text-indigo-200"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 p-4 md:p-10 overflow-x-auto">
            <div class="mb-6 flex justify-between items-center space-x-4">
                <div class="rounded-xl shadow-md p-4">
                    <div class="flex items-center space-x-4">
                        <div id="date" class="text-lg text-gray-600"></div>
                        <span>-</span>
                        <div id="clock" class="text-xl font-bold text-indigo-600 font-mono">
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-4 flex items-center">
                    <i class="fas fa-user text-xl text-indigo-600 mr-3"></i>
                    <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                </div>
            </div>

            <script>
                function updateDateTime() {
                    const now = new Date();
                    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ];

                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');

                    const day = days[now.getDay()];
                    const date = now.getDate();
                    const month = months[now.getMonth()];
                    const year = now.getFullYear();

                    document.getElementById('clock').innerHTML = `${hours}:${minutes}:${seconds}`;
                    document.getElementById('date').innerHTML = `${day}, ${date} ${month} ${year}`;
                }

                setInterval(updateDateTime, 1000);
                updateDateTime();

                function updateClock() {
                    const now = new Date();
                    let hours = now.getHours();
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    document.getElementById('clock').innerHTML = `${String(hours).padStart(2, '0')}:${minutes}:${seconds} ${ampm}`;
                }

                setInterval(updateClock, 1000);
                updateClock();
            </script>
            @yield('content')
        </main>
    </div>

    @stack('script')
</body>

</html>
