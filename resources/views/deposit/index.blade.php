@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    @php
        $durasi_maks = number_format($pengguna->saldo / $harga, 0);

        //Rp
        function Rupiah($angka)
        {
            $rupiah = number_format($angka, 0, ',', '.');
            return 'Rp ' . $rupiah;
        }
    @endphp
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deposit Baru</h4>
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
                    <div class="row">

                        <div class="preview">
                            <div class="mt">
                                <div style="float: right;"><?= rupiah($pengguna->saldo) ?> (<?= $durasi_maks ?> menit)</div>
                            </div>
                            <form action="{{ route('deposit.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">Jumlah (Rp)</label>
                                        <input type="number" class="form-control" name="jumlah"id="jumlah"
                                            placeholder="Ex : 10000"required>
                                    </div>
                                </div>
                                <div class="intro-x mt-3 text-center xl:text-left"> Deposit yang berhasil tidak dapat
                                    diuangkan kembali.</div>
                                <button type="submit" name="submit" class="btn btn-primary w-20 mt-3">Deposit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Deposit </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="dataSpot">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        NO
                                    </th>
                                    <th class="border-top-0">
                                        JUMLAH
                                    </th>
                                    <th class="border-top-0">
                                        WAKTU
                                    </th>
                                </tr>
                            </thead>
                            @forelse ($saldo as $id => $item)
                                <tbody>
                                    <td>{{ ++$id }}</td>
                                    <td>{{ rupiah($item->topup) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tbody>
                            @empty
                            @endforelse
                        </table>
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
