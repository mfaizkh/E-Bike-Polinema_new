<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\UserExport;
use App\Exports\SewaExport;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('panduan');
    }

    public function panduan()
    {
        return view('panduan');
    }

    public function export_user()
    {

        $data = User::get();
        // dd($data);
        return Excel::download(
            new UserExport($data),
            'Data User ' . Carbon::now()->format(
                'd-m-Y H-i'
            ) . '.xlsx'
        );
    }
    public function export_sewa()
    {

        $data = Sewa::with('user')->get();
        // dd($data);
        return Excel::download(
            new SewaExport($data),
            'Data Riwayat Sewa ' . Carbon::now()->format(
                'd-m-Y H-i'
            ) . '.xlsx'
        );
    }

    public function forgot()
    {
        return view('auth.forgot');
    }
    public function simple_map()
    {
        return view('leaflet.simple-map');
    }

    public function marker()
    {
        return view('leaflet.marker');
    }

    public function circle()
    {
        return view('leaflet.circle');
    }

    public function polygon()
    {
        return view('leaflet.polygon');
    }

    public function polyline()
    {
        return view('leaflet.poyline');
    }

    public function rectangle()
    {
        return view('leaflet.rectangle');
    }

    public function layers()
    {
        return view('leaflet.layer');
    }

    public function layer_group()
    {
        return view('leaflet.layer_group');
    }

    public function geojson()
    {
        return view('leaflet.geojson');
    }
    public function maps()
    {
        return view('leaflet.maps');
    }

    public function getCoordinate()
    {
        return view('leaflet.get_coordinate');
    }

   
    
}
