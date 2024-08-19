@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('profil.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profil</h4>

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


                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">NIK</label>
                                <input min="16" id="nik" name="nik"type="number"
                                    class="form-control @error('nik') is-invalid @enderror" value="{{ $pengguna->nik }}"  required>
                                    @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">Fullname</label>
                                <input id="full_name" name="name" type="text" class="form-control"
                                    value="{{ $pengguna->name }}"required>
                            </div>
                            
                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">No
                                    What'sApp</label>
                                <input min="11" id="nowa" name="telepon" type="number" class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ $pengguna->telepon }}"
                                    required>
                                    @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">Email</label>
                                <input id="email" name="email" type="text" class="form-control"
                                    value="{{ $pengguna->email }}" >
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">Current Password</label>
                                <input id="password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">New Password</label>
                                <input id="password" name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">Foto Wajah</label>
                                <div
                                    class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        @if (empty($pengguna->wajah))
                                            <img class="rounded-md" alt=""
                                                src="{{ asset('uploads/wajah-null.jpg') }}">
                                        @else
                                            <img id="gambarClick" width="60%" 
                                                onclick="window.open('{{ asset('uploads/' . $pengguna->wajah) }}', '_blank')"
                                                class="rounded-md" alt="" src="uploads/{{ $pengguna->wajah }}">
                                        @endif

                                    </div>
                                    <div
                                        class="mx-auto
                                                    cursor-pointer relative mt-5">
                                        
                                            <input type="file" style="width: 90%" name="wajah" id="selfie"
                                                class="btn btn-primary w-full" >
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="update-profile-form-1" class="form-label">Foto KTM</label>
                                <div
                                    class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        @if (empty($pengguna->ktm))
                                            <img class="rounded-md" alt=""
                                                src="{{ asset('uploads/ktm-null.jpg') }}">
                                        @else
                                            <img id="gambarClick" width="60%" 
                                                onclick="window.open('{{ asset('uploads/' . $pengguna->ktm) }}', '_blank')"
                                                class="rounded-md" alt="" src="uploads/{{ $pengguna->ktm }}">
                                        @endif
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                       
                                            <input type="file" style="width: 90%"  name="ktm" id="selfie2"
                                                class="btn btn-primary w-full" >
                                       
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="col-6">
                            <button type="submit"  name="submit" class="text-right btn btn-primary w-5 mt-3" >Simpan</button>
                        </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('javascript')
@endpush
