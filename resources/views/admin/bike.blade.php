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
                        <div class="row justify-content-between">
                            <div class="col-6 col-md-3">
                                <h4>Data E-Bike</h4>
                            </div>
                            <div class="col-4 col-md-2">
                                <a class="btn btn-primary btn-sm w-20 mt-3 " href="{{ route('create-bike') }}"><i
                                        class="fa fa-plus"></i> Tambah</a>
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
                        <table class="table table-bordered table-striped " id="dataSpot">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        <center>NO
                                    </th>
                                    <th class="border-top-0">
                                        <center>KODE SEPEDA
                                    </th>
                                    <th class="border-top-0">
                                        <center>MERK
                                    </th>
                                    <th class="border-top-0">
                                        <center>WARNA
                                    </th>
                                    <th class="border-top-0">
                                        <center>GPS
                                    </th>
                                    <th class="border-top-0">
                                        <center>V LOCK
                                    </th>
                                    <th class="border-top-0">
                                        <center>V ENGINE
                                    </th>
                                    <th class="border-top-0">
                                        <center>STATUS
                                    </th>
                                    <th class="border-top-0">
                                        <center>BARCODE
                                    </th>
                                    <th class="border-top-0">
                                        <center>FOTO
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
                ajax: '{{ route('bike.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'warna'
                    },
                    {
                        data: 'gps'
                    },
                    {
                        data: 'v_lock'
                    },
                    {
                        data: 'v_engine'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'barcode',
                        render: function(data, type, row) {
                            // Tampilkan gambar jika ada
                            if (data) {
                                return '<a href="' + "{{ url('uploads/') }}/" + data +
                                    '" target="_blank"><img src="' + "{{ url('uploads/') }}/" +
                                    data +
                                    '" class="img-fluid" ></a>';
                            } else {
                                return ''; // Jika tidak ada gambar, kosongkan
                            }
                        }
                    },
                    {
                        data: 'foto',
                        render: function(data, type, row) {
                            // Tampilkan gambar jika ada
                            if (data) {
                                return '<a href="' + "{{ url('uploads/') }}/" + data +
                                    '" target="_blank"><img src="' + "{{ url('uploads/') }}/" +
                                    data +
                                    '" class="img-fluid" ></a>';
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
