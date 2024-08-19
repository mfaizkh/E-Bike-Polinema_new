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
                                <h4 class="card-title">Data Pengguna</h4>
                            </div>
                            <div class="col" style="text-align: end">
                                <a href="{{ route('export_user') }}" class="btn btn-success text-white btn-sm"
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
                                            <center>NIK
                                        </th>
                                        <th class="border-top-0">
                                            <center>NAMA
                                        </th>
                                        <th class="border-top-0">
                                            <center>EMAIL
                                        </th>
                                        <th class="border-top-0">
                                            <center>TELEPON
                                        </th>
                                        <th class="border-top-0">
                                            <center>SALDO
                                        </th>
                                        <th class="border-top-0">
                                            <center>FOTO KTM
                                        </th>
                                        <th class="border-top-0">
                                            <center>FOTO WAJAH
                                        </th>
                                        <th class="border-top-0">
                                            <center>OPSI
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <form action="" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Hapus" style="display:none">
                            </form>
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
                ajax: '{{ route('pengguna.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'saldo'
                    },
                    {
                        data: 'ktm',
                        render: function(data, type, row) {
                            // Tampilkan gambar jika ada
                            if (data) {
                                return '<a href="' + "{{ url('uploads/') }}/" + data +
                                    '" target="_blank"><img src="' + "{{ url('uploads/') }}/" +
                                    data + '" class="img-fluid" ></a>';
                            } else {
                                return ''; // Jika tidak ada gambar, kosongkan
                            }
                        }
                    },
                    {
                        data: 'wajah',
                        render: function(data, type, row) {
                            // Tampilkan gambar jika ada
                            if (data) {
                                return '<a href="' + "{{ url('uploads/') }}/" + data +
                                    '" target="_blank"><img src="' + "{{ url('uploads/') }}/" +
                                    data + '" class="img-fluid" ></a>';
                            } else {
                                return ''; // Jika tidak ada gambar, kosongkan
                            }
                        }
                    },
                    {
                        data: 'action'
                    }
                ]
            });
        });
    </script>
@endpush
