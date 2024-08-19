<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use App\Models\User;
use App\Models\Ebike;
use App\Models\Minimum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function updateDatabase(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'nomor' => 'required|integer'
        ]);

        try {
            $updated = DB::table('dataa')
            ->where('id', $request->input('id'))
            ->update(['musik' => $request->input('nomor')]);
        } catch (\Throwable $th) {
            dd($th);
        }
        // Update the database
      

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Database updated successfully.']);
        } else {
            return response()->json(['error' => false, 'message' => 'Failed to update the database.'], 500);
        }
    }
    public function index()
    {
        $riwayat = Sewa::all();
      
        return view('admin.index', compact('riwayat'));
    }
    public function maps()
    {
        return view('admin.maps');
    }
    public function map()
    {
        return view('leaflet.map');
    }
    public function bike()
    {
        $bike = Ebike::all();
      
        return view('admin.bike', compact('bike'));
    }
    public function minimum()
    {
        $minimum = Minimum::first();
      
        return view('admin.minimum', compact('minimum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-bike');
    }
    public function pengguna()
    {
        $pengguna = User::all();
        return view('admin.pengguna', compact('pengguna'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'kode' => 'required',
            'merk' => 'required',
            'warna' => 'required',
            'gps' => 'required',
            'v_lock' => 'required',
            'v_engine' => 'required',
            'status' => 'required',
            'foto' => 'file|image|mimes:png,jpg,jpeg',
            'barcode' => 'file|image|mimes:png,jpg,jpeg',
        ]);
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            $uploadFile = $file->hashName();
            $file->move('uploads/', $uploadFile);
            $data['foto'] = $uploadFile;
        }

        if ($request->hasFile('barcode')) {

            $file = $request->file('barcode');
            $uploadFile = $file->hashName();
            $file->move('uploads/', $uploadFile);
            $data['barcode'] = $uploadFile;
        }

        $res = Ebike::create($data);
        if ($res) {
            return to_route('admin.bike')->with('success','Data berhasil disimpan');
        } else {
            return to_route('admin.bike')->with('error','Data gagal disimpan');
        }
    }
    public function updateminimum(Request $request)
    {
       
        $data = $request->validate([
            'saldo' => 'required',
           
        ]);
      
        $centerPoint = Minimum::find(1);
        $res= $centerPoint->update($data);
        if ($res) {
            return to_route('admin.minimum')->with('success','Data berhasil diubah');
        } else {
            return to_route('admin.minimum')->with('error','Data gagal diubah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spot = User::findOrFail($id);
     
        //Storage::disk('local')->delete('public/ImageSpots/' . ($spot->image));
        $spot->delete();
        return redirect()->back();
    }
    public function bike_destroy($id)
    {
        $spot = Ebike::findOrFail($id);
     
        //Storage::disk('local')->delete('public/ImageSpots/' . ($spot->image));
        $spot->delete();
        return redirect()->back();
    }
}
