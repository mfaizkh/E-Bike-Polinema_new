@extends('layouts.dashboard-admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Minimum Saldo</h4>

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
                               
                                <form action="{{route ('admin.updateminimum')}}" method="post" enctype="multipart/form-data">
                               @csrf
                               <div class="mt-3">
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Jumlah (Rp)</label>
                                    <input  type="number" min="10" class="form-control" name="saldo"id="jumlah" value="{{$minimum->saldo}}"required>
                                </div>
                               </div>
                                
                                <button type="submit" name="submit" class="btn btn-primary w-20 mt-3">Ubah</button>
                                </form>
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
