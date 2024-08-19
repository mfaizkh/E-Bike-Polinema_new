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
                            <div class="col-12">
                                <h3>Tambah Sepeda</h3>
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
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <form action="{{ route('store-bike') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="update-profile-form-1" class="form-label">KODE
                                        BIKE</label>
                                    <input min="16" id="nik" name="kode" type="number" class="form-control"
                                        required>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">MERK</label>
                                    <input id="full_name" name="merk" type="text" class="form-control" required>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">WARNA</label>
                                    <input id="full_name" name="warna" type="text" class="form-control" required>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">GPS</label>
                                    <input id="full_name" name="gps" type="number" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="mt-3">
                                <label for="update-profile-form-1" class="form-label">V
                                    LOCK</label>
                                <input id="full_name" name="v_lock" type="number" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-1" class="form-label">V
                                    ENGINE</label>
                                <input id="full_name" name="v_engine" type="number" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-1" class="form-label">STATUS</label>
                                <input id="full_name" name="status" type="number" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-1" class="form-label">FOTO</label>
                                <input id="full_name" name="foto" type="file" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-1" class="form-label">BARCODE</label>
                                <input id="full_name" name="barcode" type="file" class="form-control" required>
                            </div>
                        </div>
                        </br>
                        <button type="submit" name="submit" class="btn btn-primary w-20 mt-3">Simpan</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
