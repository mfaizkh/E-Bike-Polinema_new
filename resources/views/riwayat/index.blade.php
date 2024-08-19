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
                        
                        <h4 class="card-title">Daftar Riwayat</h4>
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

                        <table class="table" id="dataSpot">
                            <thead>
                                <tr>
                                    <th class="border-top-0"><center>NO</th>
                                        <th class="border-top-0"><center>BIKE</th>
                                        <th class="border-top-0"><center>DURASI</th>
                                        <th class="border-top-0"><center>BIAYA</th>
                                        <th class="border-top-0"><center>MULAI</th>
                                        <th class="border-top-0"><center>PENGEMBALIAN</th>
                                        <th class="border-top-0"><center>FOTO PENGEMBALIAN</th>
                                </tr>
                            </thead>
                            @forelse ($riwayat as $id => $item)
                            <tbody>

                                <td>{{++$id}}</td>
                                <td>{{$item->ebike->kode}}</td>
                                <td>{{$item->durasi}}</td>
                                <td>{{$item->tagihan}}</td>
                                <td>{{$item->datetime}}</td>
                                <td>{{$item->datetime_kembali}}</td>
                                <td><a target="_blank" href="uploads/{{ $item->foto_kembali }}"><img class="img-thumbnail" width="10%" src="uploads/{{ $item->foto_kembali }}"></a></td>
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
