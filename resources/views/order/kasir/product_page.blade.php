@extends('templates.app')

@section('container-content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
        <!-- Header Section -->
        <div class="px-4 py-8 mx-auto max-w-7xl">
            <div class="mb-8 text-center">
                <h1 class="mb-4 text-4xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text">
                    <i class="mr-3 text-blue-600 fas fa-store"></i>ThriftStore
                </h1>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Temukan produk berkualitas dengan harga terjangkau
                </p>
                <div class="w-24 h-1 mx-auto mt-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
            </div>

            @if (Session::get('success'))
                <div class="relative flex items-center justify-between px-6 py-4 mb-6 text-green-700 border border-green-200 shadow-lg bg-green-50 rounded-2xl backdrop-blur-sm bg-white/80 alert animate-slideIn"
                    role="alert">
                    <div class="flex items-center">
                        <i class="mr-3 text-xl text-green-500 fas fa-check-circle"></i>
                        <span class="font-medium">{{ Session::get('success') }}</span>
                    </div>
                    <button type="button" class="ml-4 text-green-700 transition-colors hover:text-green-900 btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="text-lg fas fa-times"></i>
                    </button>
                </div>
            @endif
            <!-- Products Section -->
            @if ($product->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[500px] py-16 px-4">
                    <div class="w-full max-w-lg space-y-8 text-center">
                        <!-- Empty Products Animation -->
                        <div class="relative animate-float">
                            <div class="flex items-center justify-center w-32 h-32 mx-auto rounded-full shadow-xl bg-gradient-to-br from-blue-100 to-purple-100">
                                <i class="text-6xl text-gray-400 fas fa-box-open"></i>
                            </div>
                            <div class="absolute flex items-center justify-center w-8 h-8 bg-red-500 rounded-full -top-2 -right-2 animate-pulse">
                                <i class="text-sm text-white fas fa-exclamation"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h1 class="text-3xl font-bold text-gray-800">
                                Produk Tidak Tersedia
                            </h1>
                            <p class="max-w-sm mx-auto text-lg leading-relaxed text-gray-600">
                                Maaf, saat ini tidak ada produk yang tersedia. Silakan kembali lagi nanti!
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Products Grid -->
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($product as $index => $item)
                        <div class="relative overflow-hidden transition-all duration-300 border shadow-lg group bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 hover:shadow-2xl hover:-translate-y-2 animate-fadeIn"
                             style="animation-delay: {{ $index * 0.1 }}s">
                            <!-- Product Image -->
                            <div class="relative overflow-hidden">
                                <div class="overflow-hidden aspect-square bg-gradient-to-br from-gray-100 to-gray-200">
                                    <img src="{{ asset($item->image) }}"
                                         alt="{{ $item['name'] }}"
                                         class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                </div>
                                <!-- Overlay Effects -->
                                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/20 via-transparent to-transparent group-hover:opacity-100"></div>
                                <div class="absolute top-4 right-4">
                                    <div class="flex items-center gap-2">
                                        <span class="px-3 py-1 text-xs font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-blue-500 to-purple-500">
                                            <i class="mr-1 fas fa-star"></i>Premium
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="mb-2 text-xl font-bold text-gray-800 transition-colors duration-300 line-clamp-2 group-hover:text-blue-600">
                                        {{ $item['name'] }}
                                    </h3>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-2xl font-bold text-green-600">
                                            Rp {{ number_format($item['price'], 0, '.', '.') }}
                                        </span>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="mr-1 fas fa-shopping-cart"></i>
                                            {{ $totalSold[$item->id] ?? 0 }} terjual
                                        </div>
                                    </div>
                                </div>

                                <!-- Stock Status -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-500 fas fa-boxes"></i>
                                        <span class="text-sm font-medium text-gray-600">Stok:</span>
                                        @php
                                            $stockClass = $item['stock'] > 10 ? 'bg-green-100 text-green-800' : ($item['stock'] > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                        @endphp
                                        <span class="ml-1 px-2 py-1 text-xs font-semibold rounded-full {{ $stockClass }}">
                                            {{ $item['stock'] }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('payment.add_payment', $item['id']) }}"
                                   class="flex items-center justify-center w-full gap-2 px-6 py-3 font-semibold text-white transition-all duration-300 shadow-lg group/btn bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl hover:shadow-xl hover:scale-105 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                                    <i class="fas fa-cart-plus group-hover/btn:animate-bounce"></i>
                                    <span>Tambah ke Keranjang</span>
                                    <i class="transition-transform duration-300 fas fa-arrow-right group-hover/btn:translate-x-1"></i>
                                </a>
                            </div>

                            <!-- Hover Effect Border -->
                            <div class="absolute inset-0 transition-opacity duration-300 opacity-0 pointer-events-none rounded-3xl bg-gradient-to-r from-blue-500/20 to-purple-500/20 group-hover:opacity-100"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-12">
                    <div class="p-4 border shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl border-white/20">
                        {{ $product->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Auto-close alerts with animation
            window.setTimeout(function() {
                $(".alert").addClass('opacity-0 transform -translate-y-2').delay(300).queue(function() {
                    $(this).remove();
                });
            }, 5000);

            // Enhanced card hover effects
            $('.group').hover(
                function() {
                    $(this).addClass('transform -translate-y-2 shadow-2xl');
                },
                function() {
                    $(this).removeClass('transform -translate-y-2 shadow-2xl');
                }
            );

            // Smooth scroll animations for cards
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

            // Observe product cards for scroll animations
            document.querySelectorAll('.animate-fadeIn').forEach((card) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease-out';
                observer.observe(card);
            });

            // Add click animation to buttons
            $('.group\\/btn').on('click', function() {
                $(this).addClass('animate-pulse');
                setTimeout(() => {
                    $(this).removeClass('animate-pulse');
                }, 300);
            });
        });
    </script>
@endpush

@push('style')
    <style>
        /* Custom animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
        }
    </style>
@endpush
