@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Panduan Penggunaan</h4>
                    </div>
                    <div class="card-body">
                        
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <ol>
                            <li>Lengkapi profil terlebih dahulu sebelum melakukan peminjaman, untuk pertama kali daftar.</li>
                            <li>Pastikan anda memiliki saldo minimal Rp10.000 sebelum melakukan peminjaman. Jika saldo anda kurang dari Rp10.000 maka bisa ke halaman deposit terlebih dahulu untuk melakukan top up saldo dengan metode pembayaran online.</li>
                            <li>Buka halaman sewa untuk melakukan peminjaman.</li>
                            <li>Arahkan scan QR ke barcode yang menempel pada e-bike.</li>
                            <li>Pilih opsi durasi perjalanan sesuai yang anda inginkan, dengan harga per menit Rp500.</li>
                            <li>Selama perjalanan anda dapat melihat informasi durasi perjalanan, maps, kecepatan, dan sisa baterai.</li>
                            <li>Jika waktu habis di tengah perjalanan, anda dapat memilih opsi sewa lagi dengan memilih durasi seperti awal tadi. Jika saldo habis anda dapat melakukan top up saldo lagi atau jika tidak ingin top up anda dapat mengayuh e-bike sampai parkiran yang ditentukan untuk melakukan pengembalian.</li>
                            <li>Kembalikan e-bike ke stasiun yang ditentukan dan ambil foto e-bike yang telah terparkir dengan benar.</li>
                            <li>Ketika selesai melakukan peminjaman anda dapat melihat riwayat peminjaman di halaman riwayat.</li>
                            <li>Anda dapat masuk ke menu profil jika ingin memperbarui profil anda.</li>
                        </ol>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
