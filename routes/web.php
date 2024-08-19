<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapsController;
Route::get('/',[\App\Http\Controllers\HomeController::class,'index']);
Route::get('/detail-spot/{slug}',[\App\Http\Controllers\HomeController::class,'detailSpot'])->name('detail-spot');
Route::get('/scan', [App\Http\Controllers\BarcodeController::class, 'showScanForm']);
Route::post('/scan', [App\Http\Controllers\BarcodeController::class, 'scanBarcode']);
Route::get('/forgot', [App\Http\Controllers\BarcodeController::class, 'forgot'])->name('forgot');
Route::post('/forgot', [App\Http\Controllers\BarcodeController::class, 'password'])->name('forgot');

Route::get('/sepeda1', [MapsController::class, 'sepeda1'])->name('sepeda1');
Route::get('/sepeda2', [MapsController::class, 'sepeda2'])->name('sepeda2');
Route::get('/sepeda3', [MapsController::class, 'sepeda3'])->name('sepeda3');
Route::get('/sepeda4', [MapsController::class, 'sepeda4'])->name('sepeda4');
Route::get('/sepeda5', [MapsController::class, 'sepeda5'])->name('sepeda5');
Route::get('/geojson-polyns', [App\Http\Controllers\Backend\PolygonController::class,'polyns'])->name('geojson-polyns');


/////////////////////////
Route::post('/create-polygon', [App\Http\Controllers\Backend\PolygonController::class, 'store'])->name('create-polygon');
Route::get('/edit-polygon/{id}', [App\Http\Controllers\Backend\PolygonController::class, 'edit'])->name('edit-polygon');
Route::put('/update-polygon/{id}', [App\Http\Controllers\Backend\PolygonController::class, 'update'])->name('update-polygon');
Route::delete('/delete-polygon/{id}', [App\Http\Controllers\Backend\PolygonController::class, 'destroy'])->name('delete-polygon');
Route::get('/geojson-polygons', [App\Http\Controllers\Backend\PolygonController::class, 'geojson'])->name('geojson-polygons');
Route::get('/geojson-polygon/{id}', [App\Http\Controllers\Backend\PolygonController::class, 'geojsonpolygon'])->name('geojson-polygon');

Route::post('/create-point', [App\Http\Controllers\Backend\PointController::class, 'store'])->name('create-point');
Route::get('/edit-point/{id}', [App\Http\Controllers\Backend\PointController::class, 'edit'])->name('edit-point');
Route::put('/update-point/{id}', [App\Http\Controllers\Backend\PointController::class, 'update'])->name('update-point');
Route::delete('/delete-point/{id}', [App\Http\Controllers\Backend\PointController::class, 'destroy'])->name('delete-point');
Route::get('/geojson-points', [App\Http\Controllers\Backend\PointController::class, 'geojson'])->name('geojson-points');
Route::get('/geojson-point/{id}', [App\Http\Controllers\Backend\PointController::class, 'geojsonpoint'])->name('geojson-point');

Route::post('/create-polyline', [App\Http\Controllers\Backend\PolylineController::class, 'store'])->name('create-polyline');
Route::get('/edit-polyline/{id}', [App\Http\Controllers\Backend\PolylineController::class, 'edit'])->name('edit-polyline');
Route::put('/update-polyline/{id}', [App\Http\Controllers\Backend\PolylineController::class, 'update'])->name('update-polyline');
Route::delete('/delete-polyline/{id}', [App\Http\Controllers\Backend\PolylineController::class, 'destroy'])->name('delete-polyline');
Route::get('/geojson-polylines', [App\Http\Controllers\Backend\PolylineController::class, 'geojson'])->name('geojson-polylines');
Route::get('/geojson-polyline/{id}', [App\Http\Controllers\Backend\PolylineController::class, 'geojsonpolyline'])->name('geojson-polyline');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/simple-map', [App\Http\Controllers\HomeController::class, 'simple_map'])->name('simple-map');
    Route::get('/markers', [App\Http\Controllers\HomeController::class, 'marker'])->name('markers');
    Route::get('/circle', [App\Http\Controllers\HomeController::class, 'circle'])->name('circle');
    Route::get('/polygon', [App\Http\Controllers\HomeController::class, 'polygon'])->name('polygon');
    Route::get('/polyline', [App\Http\Controllers\HomeController::class, 'polyline'])->name('polyline');
    Route::get('/rectangle', [App\Http\Controllers\HomeController::class, 'rectangle'])->name('rectangle');
    Route::get('/layer', [App\Http\Controllers\HomeController::class, 'layers'])->name('layer');
    Route::get('/layer-group', [App\Http\Controllers\HomeController::class, 'layer_group'])->name('layer-group');
    Route::get('/geojson', [App\Http\Controllers\HomeController::class, 'geojson'])->name('geojson');
    Route::get('/maps', [App\Http\Controllers\HomeController::class, 'maps'])->name('maps');
    Route::get('/get-coordinate', [App\Http\Controllers\HomeController::class, 'getCoordinate'])->name('getCoordinate');


    Route::get('/panduan', [App\Http\Controllers\HomeController::class, 'panduan'])->name('panduan');
    Route::get('/export_user', [App\Http\Controllers\HomeController::class, 'export_user'])->name('export_user');
    Route::get('/export_sewa', [App\Http\Controllers\HomeController::class, 'export_sewa'])->name('export_sewa');
    ## Route Datatable
    Route::get('/centre-point/data',[\App\Http\Controllers\Backend\DataController::class,'centrepoint'])->name('centre-point.data');
    Route::get('/spot/data',[\App\Http\Controllers\Backend\DataController::class,'spot'])->name('spot.data');
    Route::get('/pengguna/data',[\App\Http\Controllers\Backend\DataController::class,'pengguna'])->name('pengguna.data');
    Route::get('/bike/data',[\App\Http\Controllers\Backend\DataController::class,'bike'])->name('bike.data');
    

    Route::resource('spot',(\App\Http\Controllers\Backend\SpotController::class));
    Route::resource('sewa',(\App\Http\Controllers\Backend\SewaController::class));
    Route::resource('deposit',(\App\Http\Controllers\Backend\DepositController::class));
    Route::resource('profil',(\App\Http\Controllers\Backend\ProfilController::class));
    Route::resource('riwayat',(\App\Http\Controllers\Backend\RiwayatController::class));

    Route::resource('admin',(\App\Http\Controllers\Backend\AdminController::class));

    Route::get('/add', [App\Http\Controllers\Backend\SewaController::class, 'create'])->name('add');

    Route::get('/bike', [App\Http\Controllers\Backend\AdminController::class, 'bike'])->name('admin.bike');
    Route::get('/pengguna', [App\Http\Controllers\Backend\AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/create-bike', [App\Http\Controllers\Backend\AdminController::class, 'create'])->name('create-bike');
    Route::post('/store-bike', [App\Http\Controllers\Backend\AdminController::class, 'store'])->name('store-bike');
    Route::get('/minimum', [App\Http\Controllers\Backend\AdminController::class, 'minimum'])->name('admin.minimum');
    Route::post('/updateminimum', [App\Http\Controllers\Backend\AdminController::class, 'updateminimum'])->name('admin.updateminimum');
    Route::get('/mapss', [App\Http\Controllers\Backend\AdminController::class, 'maps'])->name('admin.maps');
    Route::get('/map', [App\Http\Controllers\Backend\AdminController::class, 'map'])->name('admin.map');
   

Route::get('/payment_success', [App\Http\Controllers\Backend\DepositController::class, 'success'])->name('payment.success');
Route::get('/engine', [App\Http\Controllers\Backend\SewaController::class, 'engine'])->name('engine');
Route::get('/lock/{id}', [App\Http\Controllers\Backend\SewaController::class, 'lock'])->name('lock');
Route::get('/open/{id}', [App\Http\Controllers\Backend\SewaController::class, 'open'])->name('open');
Route::get('/kembali/{id}', [App\Http\Controllers\Backend\SewaController::class, 'booking_kembali'])->name('kembali');
Route::post('/booking_done', [App\Http\Controllers\Backend\SewaController::class, 'booking_done'])->name('booking_done');
Route::get('/booking_sewa_lagi/{id}', [App\Http\Controllers\Backend\SewaController::class, 'booking_sewa_lagi'])->name('booking_sewa_lagi');
Route::post('/pengembalian/{id}', [App\Http\Controllers\Backend\SewaController::class, 'pengembalian'])->name('pengembalian');
Route::delete('/destroy/{id}', [App\Http\Controllers\Backend\AdminController::class, 'bike_destroy'])->name('bike.destroy');

Route::post('/update-database', [App\Http\Controllers\Backend\AdminController::class, 'updateDatabase'])->name('update-database');

});


Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');


    Artisan::call('view:cache');
    // Artisan::call('route:cache');
    Artisan::call('config:cache');
    // Artisan::call('optimize');

    echo 'optimize clear';
});
