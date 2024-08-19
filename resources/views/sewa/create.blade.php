@extends('layouts.dashboard-volt')


@section('content')
@php
    $durasi_maks = number_format($pengguna->saldo/$harga,0);

    if (!function_exists('Rupiah')) {
        function Rupiah($angka) {
            $rupiah = number_format($angka, 0, ',', '.');
            return 'Rp ' . $rupiah;
        }
    }
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sewa Baru</div>
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
                        <div id="input" class="p-5">
                            <div class="preview">
                                <center>
                                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                        <div
                                            class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                <img id="gambarClick" class="rounded-md" alt=""
                                                    src="{{ asset('uploads/' . $ebike->foto) }}">
                                            </div>
                                        </div>
                                    </div>
                                </center></br>
                                <div class="mt">
                                    <div style="float: right;">{{ rupiah($pengguna->saldo); }} ({{ $durasi_maks; }} menit)</div>
                                    </div>
                                </div>
                                <form action="{{ route('sewa.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id_bike" id="id_bike" value="{{ $ebike->id }}" hidden>
                                    <input type="text" name="saldo" id="saldo" value="{{ $pengguna->saldo }}" hidden>
                                    <input type="text" name="harga" id="harga" value="{{ $harga }}" hidden>
                                    <input type="text" id="konstanta" name="konstanta" value="{{ $harga }}"
                                        oninput="hitungPerkalian()" hidden>
                                    <div class="mt-3">
                                        <div>
                                            <label for="update-profile-form-1" class="form-label">Unit E-Bike</label>
                                            <input type="text" class="form-control"
                                                value="{{ $ebike->merk }} | {{ $ebike->warna }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-1" class="form-label">Pilih Durasi</label>
                                        <select class="form-control" id="durasi"
                                            name="durasi"onchange="hitungPerkalian()" required>
                                            <!-- Menghasilkan opsi dari 0 hingga 1000 dengan kelipatan 10 -->

                                            <option value="">Pilih Salah Satu</option>;
                                            @php

                                                for ($i = 5; $i <= $durasi_maks; $i += 10) {
                                                    echo "<option value=\"$i\">$i menit</option>";
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <div>
                                            <label for="update-profile-form-1" class="form-label">Total Pembayaran</label>
                                            <input type="text" class="form-control" id="hasil" name="hasil"
                                                value="0"readonly>
                                        </div>
                                    </div>
                            </div>
                            {{-- <div class="intro-x mt-3 text-center xl:text-left"> Dengan melakukan pemesanan Anda setuju dengan <a class="text-primary dark:text-slate-200" href="#">Kebijakan dan Ketentuan</a></div> --}}
                            <button type="submit" name="submit" class="btn btn-primary w-20 mt-3">Sewa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('javascript')
    <script>
        function formatRupiah(angka) {
            var bilangan = String(angka);
            var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        function hitungPerkalian() {
            // Mendapatkan nilai yang dipilih dari select
            var selectedValue = document.getElementById('durasi').value;

            // Mendapatkan konstanta dari input
            var konstanta = document.getElementById('konstanta').value;

            // Melakukan perkalian
            var hasilPerkalian = selectedValue * konstanta;

            // Menyimpan hasil perkalian ke dalam input hasil
            document.getElementById('hasil').value = formatRupiah(hasilPerkalian);
        }
    </script>
@endpush
