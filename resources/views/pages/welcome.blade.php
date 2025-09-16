@extends('templates.app')

@section('container-content')
    <!-- Hero Section -->
    <section class="relative flex items-center min-h-screen overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 rounded-3xl lg:p-20">
        <!-- Background Decorations -->
        <div class="absolute w-20 h-20 bg-blue-200 rounded-full top-10 left-10 opacity-60 animate-pulse"></div>
        <div class="absolute w-32 h-32 bg-purple-200 rounded-full bottom-20 right-20 opacity-40 animate-bounce"></div>
        <div class="absolute w-16 h-16 bg-indigo-200 rounded-full opacity-50 top-1/2 left-20 animate-ping"></div>

        <div class="relative z-10 m-2.5 p-4 w-full">
            @if (Session::get('success'))
                <div class="flex justify-between p-4 mt-2 mb-6 font-sans text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg alert animate-slideIn">
                    <span class="flex items-center">
                        <i class="mr-2 fas fa-check-circle"></i>
                        {{ Session::get('success') }}
                    </span>
                    <button type="button" class="transition-colors btn-close hover:text-green-900" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="flex flex-col items-center justify-between gap-12 lg:flex-row">
                <!-- Left Content -->
                <div class="space-y-8 lg:w-1/2 lg:text-left animate-fadeInLeft">
                    <div class="space-y-4">
                        <h1 class="text-5xl font-extrabold leading-tight text-transparent lg:text-6xl bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text">
                            Selamat datang di
                            <span class="block">Thrift Store</span>
                            <span class="text-3xl font-medium text-gray-700 lg:text-4xl">kami!</span>
                        </h1>
                        <div class="w-32 h-1 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
                    </div>

                    <p class="text-xl leading-relaxed text-gray-600">
                        Temukan koleksi produk thrift berkualitas dengan harga terjangkau. Dari baju, celana, sepatu,
                        hingga berbagai aksesoris unik yang akan membuat gaya kamu semakin <span class="font-semibold text-blue-600">istimewa</span>.
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('payment.payment_page') }}"
                            class="relative inline-flex items-center justify-center px-8 py-4 text-white transition-all duration-300 rounded-full shadow-2xl group bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-blue-500/25 hover:scale-105 hover:-translate-y-1">
                            <span class="mr-2">Belanja Sekarang</span>
                            <i class="fas fa-shopping-bag group-hover:animate-bounce"></i>
                            <div class="absolute inset-0 transition-opacity duration-300 rounded-full opacity-0 bg-gradient-to-r from-purple-600 to-blue-600 group-hover:opacity-100"></div>
                        </a>

                        <a href="#services"
                            class="inline-flex items-center justify-center px-8 py-4 text-blue-600 transition-all duration-300 border-2 border-blue-600 rounded-full hover:bg-blue-600 hover:text-white hover:shadow-lg">
                            <span class="mr-2">Pelajari Lebih Lanjut</span>
                            <i class="fas fa-arrow-down animate-bounce"></i>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">1000+</div>
                            <div class="text-sm text-gray-600">Produk</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">500+</div>
                            <div class="text-sm text-gray-600">Pelanggan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-indigo-600">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="mt-8 lg:w-1/2 lg:mt-0 animate-fadeInRight">
                    <div class="relative group">
                        <div class="absolute inset-0 transition-opacity duration-300 bg-gradient-to-r from-blue-400 to-purple-400 rounded-3xl blur-xl opacity-30 group-hover:opacity-50"></div>
                        <img src="{{ asset('img/image.png') }}" alt="Thrift Store"
                            class="relative object-cover w-full m-auto transition-transform duration-500 border-4 border-white shadow-2xl lg:w-4/5 rounded-3xl group-hover:scale-105">

                        <!-- Floating Elements -->
                        <div class="absolute p-4 bg-white shadow-xl -top-4 -right-4 rounded-2xl animate-float">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                <span class="text-sm font-medium">Kualitas Terjamin</span>
                            </div>
                        </div>

                        <div class="absolute p-4 bg-white shadow-xl -bottom-4 -left-4 rounded-2xl animate-float" style="animation-delay: 0.5s;">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                <span class="text-sm font-medium">Harga Terjangkau</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="relative py-20 mt-8 overflow-hidden bg-white rounded-3xl">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, #6366f1 2px, transparent 0), radial-gradient(circle at 75px 75px, #8b5cf6 2px, transparent 0); background-size: 100px 100px;"></div>
        </div>

        <div class="container relative z-10 px-4 mx-auto">
            <div class="mb-16 text-center animate-fadeInUp">
                <h2 class="mb-6 text-5xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text">
                    Layanan Kami
                </h2>
                <div class="w-24 h-1 mx-auto mb-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
                <p class="max-w-2xl mx-auto text-xl text-gray-600">
                    Kami berkomitmen memberikan pengalaman berbelanja terbaik dengan layanan berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service 1 -->
                <div class="p-8 transition-all duration-500 bg-white border border-gray-100 shadow-lg group rounded-3xl hover:shadow-2xl hover:-translate-y-2 animate-fadeInUp" style="animation-delay: 0.1s;">
                    <div class="relative mb-6">
                        <div class="flex items-center justify-center w-16 h-16 transition-transform duration-300 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl group-hover:scale-110">
                            <i class="text-2xl text-white fas fa-shield-alt"></i>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 bg-blue-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30"></div>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-800 transition-colors group-hover:text-blue-600">
                        Kualitas Terjamin
                    </h3>
                    <p class="leading-relaxed text-gray-600">
                        Setiap produk melalui proses seleksi ketat untuk memastikan kualitas terbaik, sehingga kamu dapat berbelanja dengan nyaman dan percaya diri.
                    </p>
                    <div class="flex items-center mt-6 text-blue-600 transition-colors group-hover:text-blue-700">
                        <span class="text-sm font-medium">Selengkapnya</span>
                        <i class="ml-2 transition-transform fas fa-arrow-right group-hover:translate-x-1"></i>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="p-8 transition-all duration-500 bg-white border border-gray-100 shadow-lg group rounded-3xl hover:shadow-2xl hover:-translate-y-2 animate-fadeInUp" style="animation-delay: 0.2s;">
                    <div class="relative mb-6">
                        <div class="flex items-center justify-center w-16 h-16 transition-transform duration-300 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl group-hover:scale-110">
                            <i class="text-2xl text-white fas fa-tags"></i>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 bg-green-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30"></div>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-800 transition-colors group-hover:text-green-600">
                        Harga Terjangkau
                    </h3>
                    <p class="leading-relaxed text-gray-600">
                        Nikmati produk berkualitas tinggi dengan harga yang ramah di kantong. Kami percaya fashion berkualitas harus dapat dijangkau semua orang.
                    </p>
                    <div class="flex items-center mt-6 text-green-600 transition-colors group-hover:text-green-700">
                        <span class="text-sm font-medium">Selengkapnya</span>
                        <i class="ml-2 transition-transform fas fa-arrow-right group-hover:translate-x-1"></i>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="p-8 transition-all duration-500 bg-white border border-gray-100 shadow-lg group rounded-3xl hover:shadow-2xl hover:-translate-y-2 animate-fadeInUp" style="animation-delay: 0.3s;">
                    <div class="relative mb-6">
                        <div class="flex items-center justify-center w-16 h-16 transition-transform duration-300 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl group-hover:scale-110">
                            <i class="text-2xl text-white fas fa-shipping-fast"></i>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 bg-purple-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30"></div>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-800 transition-colors group-hover:text-purple-600">
                        Pengiriman Cepat
                    </h3>
                    <p class="leading-relaxed text-gray-600">
                        Sistem pengiriman yang cepat dan aman memastikan produk tiba di tanganmu dengan kondisi prima dan tepat waktu.
                    </p>
                    <div class="flex items-center mt-6 text-purple-600 transition-colors group-hover:text-purple-700">
                        <span class="text-sm font-medium">Selengkapnya</span>
                        <i class="ml-2 transition-transform fas fa-arrow-right group-hover:translate-x-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="relative py-20 mt-8 overflow-hidden bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute w-40 h-40 bg-blue-300 rounded-full top-20 left-20 blur-3xl"></div>
            <div class="absolute bg-purple-300 rounded-full bottom-20 right-20 w-60 h-60 blur-3xl"></div>
        </div>

        <div class="container relative z-10 px-4 mx-auto">
            <!-- Heading -->
            <div class="mb-16 text-center animate-fadeInUp">
                <h2 class="mb-6 text-5xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text">
                    Hubungi Kami
                </h2>
                <div class="w-24 h-1 mx-auto mb-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
                <p class="max-w-2xl mx-auto text-xl text-gray-600">
                    Kami senang mendengar dari Anda! Silakan kirim pesan atau hubungi kami melalui detail di bawah ini.
                </p>
            </div>

            <!-- Contact Info and Map -->
            <div class="grid grid-cols-1 gap-12 xl:grid-cols-3">
                <!-- Contact Info -->
                <div class="p-10 border shadow-2xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 animate-fadeInLeft">
                    <h3 class="mb-8 text-3xl font-bold text-gray-800">Detail Kontak</h3>

                    <div class="space-y-6">
                        <div class="flex items-center group">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 transition-transform duration-300 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl group-hover:scale-110">
                                <i class="text-white fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Telepon</p>
                                <p class="font-semibold text-blue-600">+62 123-456-789</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 transition-transform duration-300 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl group-hover:scale-110">
                                <i class="text-white fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Email</p>
                                <p class="font-semibold text-green-600">support@thriftstore.com</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 transition-transform duration-300 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl group-hover:scale-110">
                                <i class="text-white fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat</p>
                                <p class="font-semibold text-purple-600">Mall Boxies 123, Jakarta</p>
                            </div>
                        </div>

                        <div class="flex items-center group">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 transition-transform duration-300 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl group-hover:scale-110">
                                <i class="text-white fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Jam Operasional</p>
                                <p class="font-semibold text-orange-600">09:00 - 21:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="mb-4 text-lg font-semibold text-gray-800">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 group bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl hover:scale-110 hover:shadow-lg">
                                <i class="text-xl text-white fab fa-facebook-f group-hover:animate-bounce"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 group bg-gradient-to-br from-green-500 to-green-600 rounded-2xl hover:scale-110 hover:shadow-lg">
                                <i class="text-xl text-white fab fa-whatsapp group-hover:animate-bounce"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 group bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl hover:scale-110 hover:shadow-lg">
                                <i class="text-xl text-white fab fa-instagram group-hover:animate-bounce"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Interactive Map -->
                <div class="border shadow-2xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 animate-fadeInUp xl:col-span-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Lokasi Kami</h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <i class="text-blue-500 fas fa-map-marked-alt"></i>
                                <span>Mall Boxies 123, Jakarta</span>
                            </div>
                        </div>

                        <!-- Map Container with Modern Design -->
                        <div class="relative overflow-hidden shadow-lg rounded-2xl group">
                            <!-- Map Overlay with Loading Effect -->
                            <div class="absolute inset-0 z-20 flex items-center justify-center transition-opacity duration-500 opacity-100 bg-gradient-to-br from-blue-50 to-purple-50 map-loading">
                                <div class="text-center">
                                    <div class="w-12 h-12 mx-auto mb-4 border-4 border-blue-500 rounded-full border-t-transparent animate-spin"></div>
                                    <p class="text-sm font-medium text-gray-600">Memuat peta...</p>
                                </div>
                            </div>

                            <!-- Google Maps Embed -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30691.00858110298!2d106.82437328932387!3d-6.635782539423036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8a96ff1b717%3A0x6edc8f0e91b1eebe!2sMall%20Boxies%20123!5e0!3m2!1sen!2sid!4v1757945530733!5m2!1sen!2sid"
                                width="100%"
                                height="400"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="transition-transform duration-300 group-hover:scale-105"
                                onload="hideMapLoading()">
                            </iframe>

                            <!-- Map Controls Overlay -->
                            <div class="absolute z-30 bottom-4 right-4">
                                <div class="flex space-x-2">
                                    <button onclick="openInGoogleMaps()"
                                            class="flex items-center px-3 py-2 text-xs font-medium text-white transition-all duration-300 bg-blue-600 shadow-lg hover:bg-blue-700 rounded-xl hover:scale-105">
                                        <i class="mr-1 fas fa-external-link-alt"></i>
                                        Buka di Google Maps
                                    </button>
                                    <button onclick="getDirections()"
                                            class="flex items-center px-3 py-2 text-xs font-medium text-white transition-all duration-300 bg-green-600 shadow-lg hover:bg-green-700 rounded-xl hover:scale-105">
                                        <i class="mr-1 fas fa-directions"></i>
                                        Petunjuk Arah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Map Info Cards -->
                        <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2">
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-xl">
                                        <i class="text-white fas fa-car"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-blue-800">Parkir Tersedia</p>
                                        <p class="text-xs text-blue-600">Gratis untuk customer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-green-500 rounded-xl">
                                        <i class="text-white fas fa-bus"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-green-800">Transportasi Umum</p>
                                        <p class="text-xs text-green-600">Dekat halte TransJakarta</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="mt-12">
                <div class="max-w-4xl mx-auto">
                    <div class="p-10 border shadow-2xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 animate-fadeInUp">
                        <div class="mb-8 text-center">
                            <h3 class="mb-4 text-3xl font-bold text-gray-800">Kirim Pesan</h3>
                            <p class="max-w-2xl mx-auto text-gray-600">
                                Punya pertanyaan atau ingin berkonsultasi? Jangan ragu untuk menghubungi kami. Tim customer service kami siap membantu Anda.
                            </p>
                        </div>

                        <form action="#" method="POST" class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div class="group">
                                <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-3 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 shadow-sm rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 group-hover:border-blue-300">
                            </div>

                            <div class="group">
                                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email Address</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-3 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 shadow-sm rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 group-hover:border-blue-300">
                            </div>

                            <div class="group lg:col-span-2">
                                <label for="subject" class="block mb-2 text-sm font-semibold text-gray-700">Subjek</label>
                                <input type="text" id="subject" name="subject"
                                    class="w-full px-4 py-3 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 shadow-sm rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 group-hover:border-blue-300">
                            </div>

                            <div class="group lg:col-span-2">
                                <label for="message" class="block mb-2 text-sm font-semibold text-gray-700">Pesan Anda</label>
                                <textarea id="message" name="message" rows="6"
                                    class="w-full px-4 py-3 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 shadow-sm resize-none rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 group-hover:border-blue-300"></textarea>
                            </div>

                            <div class="lg:col-span-2">
                                <button type="submit"
                                    class="relative w-full py-4 overflow-hidden font-semibold text-white transition-all duration-300 shadow-xl group bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                                    <span class="relative z-10 flex items-center justify-center">
                                        Kirim Pesan
                                        <i class="ml-2 transition-transform duration-300 fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                                    </span>
                                    <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-purple-600 to-blue-600 group-hover:opacity-100"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInLeft {
            animation: fadeInLeft 0.8s ease-out;
        }

        .animate-fadeInRight {
            animation: fadeInRight 0.8s ease-out;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
        }
    </style>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            // Auto-close alerts
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.animate-fadeInUp, .animate-fadeInLeft, .animate-fadeInRight').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                observer.observe(el);
            });

            // Google Maps Integration Functions
            function hideMapLoading() {
                const loadingElement = document.querySelector('.map-loading');
                if (loadingElement) {
                    setTimeout(() => {
                        loadingElement.style.opacity = '0';
                        setTimeout(() => {
                            loadingElement.style.display = 'none';
                        }, 300);
                    }, 1000);
                }
            }

            function openInGoogleMaps() {
                const url = 'https://www.google.com/maps/search/?api=1&query=Mall+Boxies+123+Jakarta';
                window.open(url, '_blank');
            }

            function getDirections() {
                const url = 'https://www.google.com/maps/dir/?api=1&destination=Mall+Boxies+123+Jakarta';
                window.open(url, '_blank');
            }

            // Enhanced form validation
            const contactForm = document.querySelector('form[method="POST"]');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Get form data
                    const formData = new FormData(this);
                    const name = formData.get('name');
                    const email = formData.get('email');
                    const message = formData.get('message');

                    // Simple validation
                    if (!name || !email || !message) {
                        showNotification('Mohon lengkapi semua field yang diperlukan!', 'error');
                        return;
                    }

                    if (!isValidEmail(email)) {
                        showNotification('Format email tidak valid!', 'error');
                        return;
                    }

                    // Show success message (in real implementation, you would send to server)
                    showNotification('Pesan berhasil dikirim! Kami akan segera menghubungi Anda.', 'success');
                    this.reset();
                });
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-2xl shadow-lg transform translate-x-full transition-transform duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                        <span>${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 hover:opacity-70">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                document.body.appendChild(notification);

                // Show notification
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                // Auto hide after 5 seconds
                setTimeout(() => {
                    notification.style.transform = 'translateX(full)';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            }

            // Map hover effects
            document.querySelector('iframe').addEventListener('mouseenter', function() {
                this.style.filter = 'brightness(1.1) contrast(1.1)';
            });

            document.querySelector('iframe').addEventListener('mouseleave', function() {
                this.style.filter = 'brightness(1) contrast(1)';
            });

            // Parallax effect for background elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const backgrounds = document.querySelectorAll('.fixed');

                backgrounds.forEach((element, index) => {
                    const speed = 0.5 + (index * 0.1);
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });
        </script>
    @endpush
@endsection
