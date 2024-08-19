@extends('layouts.dashboard-admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                                   <div class="row">
                            <div class="col">
                                <h4 class="card-title">Data Riwayat Penyewaan</h4>
                            </div>
                            <div class="col" style="text-align: end">
                                <a href="{{ route('export_sewa') }}" class="btn btn-success text-white btn-sm"
                                    >
                                    <i class="fa fa-download"></i><span class="ms-3">Export</span>
                                </a>
                            </div>

                        </div>
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
                        <div class="table-responsive">
                            <table class="table" id="dataSpot">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">
                                            <center>NO
                                        </th>
                                        <th class="border-top-0">
                                            <center>NAMA
                                        </th>
                                        <th class="border-top-0">
                                            <center>TELEPON
                                        </th>
                                        <th class="border-top-0">
                                            <center>BIKE
                                        </th>
                                        <th class="border-top-0">
                                            <center>DURASI
                                        </th>
                                        <th class="border-top-0">
                                            <center>BIAYA
                                        </th>
                                        <th class="border-top-0">
                                            <center>MULAI
                                        </th>
                                        <th class="border-top-0">
                                            <center>PENGEMBALIAN
                                        </th>
                                        <th class="border-top-0">
                                            <center>FOTO PENGEMBALIAN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            $('#dataSpot').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ajax: '{{ route('spot.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.telepon'
                    },
                    {
                        data: 'ebike.kode'
                    },
                    {
                        data: 'durasi'
                    },
                    {
                        data: 'tagihan'
                    },
                    {
                        data: 'datetime'
                    },
                    {
                        data: 'datetime_kembali'
                    },
                    {
                        data: 'foto_kembali',
                        render: function(data, type, row) {
                            // Tampilkan gambar jika ada
                            if (data) {
                                return '<a href="uploads/' + data +
                                    '" target="_blank"><img src="uploads/' + data +
                                    '" class="img-thumbnail" style="width:100px;height:auto"></a>';
                            } else {
                                return ''; // Jika tidak ada gambar, kosongkan
                            }
                        }
                    }
                ]
            });
        });
    </script>
@endpush
