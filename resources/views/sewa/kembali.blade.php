@extends('layouts.dashboard-volt')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pengembalian</div>
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
                       
                            <div class="preview">
                                <form action="{{ route('pengembalian',$id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                              
                                <div class="mt">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">Unit E-Bike</label>
                                        <input  type="text" class="form-control"  value="{{ $sewa->ebike->merk }} | {{ $sewa->ebike->warna }}" readonly required>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Pilih Tempat</label>
                                 <select class="form-control" name="id_park" id="">
                                    @forelse ($parkir as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @empty
                                        
                                    @endforelse
                                    
                                 </select>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Upload Foto</label>
                                    <input type="file" name="foto_kembali" id="foto_kembali" accept="image/*"class="btn btn-secondary w-full" required>
                                </div>
                                </div>
                                <div class="intro-x mt-3 text-center xl:text-left"> Pastikan posisi E-Bike telah benar dan terkunci.</div>
                                <button type="submit" name="submit" class="btn btn-primary w-20 mt-3">Konfirmasi</button>
                                </form>
                            </div> 
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

