@extends('templates.app')

@section('container-content')
    <section class="welcome rounded lg:p-20 bg-white">
        <div class="m-2.5 p-4">
            @if (Session::get('success'))
                <div class="alert font-sans mt-2 alert-success flex justify-between">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-1/2 lg:text-left">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4 lg:mb-6">Selamat datang di Thrift Store kami!</h1>
                    <p class="text-lg text-gray-600 mb-6 text-justify">
                        Temukan koleksi produk thrift berkualitas dengan harga terjangkau, mulai dari baju, celana, sepatu,
                        hingga berbagai aksesoris unik. Kami menyediakan berbagai pilihan produk dengan kondisi terbaik
                        untuk memenuhi gaya kamu.
                    </p>
                    <a href="{{ route('payment.payment_page') }}"
                        class="inline-block bg-blue-600 text-white py-2 px-6 rounded-full shadow-lg transition-transform duration-300 hover:bg-blue-700">
                        Belanja Sekarang
                    </a>
                </div>
                <div class="lg:w-1/2 mt-8 lg:mt-0">
                    <img src="{{ asset('img/image.png') }}" alt="Thrift Store"
                        class="w-full lg:w-3/5 object-cover m-auto rounded shadow-lg hover:shadow-2xl transition-shadow duration-300">
                </div>
            </div>
        </div>
    </section>

    <section class="rounded mt-2.5 bg-white lg:p-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-800 text-center mb-12">Our Services</h2>
            <div
                class="flex flex-col lg:flex-row justify-between items-center lg:items-stretch space-y-8 lg:space-y-0 lg:space-x-8">

                <!-- Service 1 -->
                <div class="service shadow bg-white hover:bg-gray-700 p-6 rounded text-center w-full lg:w-1/3">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-blue-600 mx-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 0 .86 2.355a8 8 0 0 0 14.28 11.29A7.984 7.984 0 0 0 16 8zm-9.5-.5V5.707l2.5 2.5-2.5 2.5V8.5H2.5V8h4.5zm8-1.207v2.413l-2.5-2.5 2.5-2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Kualitas Terjamin</h3>
                    <p class="text-gray-600">
                        Kami memastikan setiap produk dalam kondisi terbaik, sehingga kamu dapat berbelanja dengan nyaman
                        dan percaya diri.
                    </p>
                </div>


                <!-- Service 2 -->
                <div class="service shadow bg-white p-6 rounded text-center w-full lg:w-1/3"">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-blue-600 mx-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm3.5 7.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5zm-2 2.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 .5.5zm2-5.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600">
                        Kami menawarkan produk berkualitas dengan harga yang ramah di kantong.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="service shadow bg-white p-6 rounded text-center w-full lg:w-1/3"">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-blue-600 mx-auto"
                            viewBox="0 0 16 16">
                            <path d="M2.5 3.5v8l6-4-6-4z" />
                            <path
                                d="M.5 2.5a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 0 1H1v11h14v-7a.5.5 0 0 1 1 0v7a.5.5 0 0 1-.5.5h-14a.5.5 0 0 1-.5-.5v-12z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengiriman Cepat dan Aman</h3>
                    <p class="text-gray-600">
                        Kami menyediakan pengiriman yang cepat dan aman, memastikan produk tiba di tanganmu dengan baik dan
                        tepat waktu.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white my-2.5 rounded py-16">
        <div class="container mx-auto px-4">
            <!-- Heading -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600">Kami senang mendengar dari Anda! Silakan kirim pesan atau hubungi kami
                    melalui detail di bawah ini.</p>
            </div>

            <!-- Contact Form and Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Info -->
                <div class="bg-white p-8 rounded-lg shadow">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Detail Kontak</h3>
                    <p class="text-gray-600 mb-4"><i class="fas fa-phone text-blue-500"></i> Telepon: +62 123-456-789</p>
                    <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-blue-500"></i> Email:
                        support@thriftstore.com</p>
                    <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-blue-500"></i> Alamat: Jl. Merdeka
                        No. 123, Jakarta</p>
                    <div class="flex space-x-4 mt-6">
                        <!-- Social Icons -->
                        <a href="#" class="text-blue-600 hover:text-blue-800"><i
                                class="ri-facebook-circle-fill"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800"><i class="ri-whatsapp-fill"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800"><i class="ri-instagram-fill"></i></a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-lg shadow">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Kirim Pesan</h3>
                    <form action="#" method="POST">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Kirim
                            Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            function showModalDelete(id, name) {
                // memasukkan teks dari parameter ke html bagian id = 'nama_karyawan'
                $('#nama_karyawan').text(name);
                // memanggil route hapus
                let url = "{{ route('karyawan.delete_karyawan', ':id') }}";
                // isi path dinamis : id dari data parameter id
                url = url.replace(':id', id);
                // action="" di form diisi dengan url diatas
                $('form').attr('action', url);
                // memunculkan modal dengan id='exampleModal'
                $('#exampleModal').modal('show');
            }

            // Tambahkan script untuk alert auto-close
            $(document).ready(function() {
                // Otomatis close alert setelah 5 detik
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });
        </script>
    @endpush
@endsection
