@extends('templates.app')

@section('container-content')
    <div class="container p-6 bg-white">
        <h2 class="text-center mb-5">Dashboard Admin</h2>

        <!-- Statistik -->
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text fs-3">{{ count($product) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.total_pesanan') }}">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Pesanan</h5>
                            <p class="card-text fs-3">{{ count($pesanan) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Karyawan</h5>
                        <p class="card-text fs-3">{{ count($karyawan) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card mt-5 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0 text-center">Daftar Pembeli</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary hover:underline" href="{{ route('admin.detail_payment', $user->id) }}"><i class="ri-eye-line"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
