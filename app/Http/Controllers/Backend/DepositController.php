<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        $pengguna = User::where('id', $id_user)->latest()->first();
        $harga=500;
        $saldo=Saldo::where('id_user', $id_user)->orderBy('id','desc')->get();
        return view('deposit.index', compact('pengguna','harga','saldo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_user = Auth::id();
        $pengguna = User::where('id', $id_user)->latest()->first();
        $jumlah = $request->input('jumlah');
       
        return view('deposit.payment',compact('pengguna','jumlah'));

    }
    public function success(Request $request)
    {
        $id_user = Auth::id();
        $pengguna = User::where('id', $id_user)->latest()->first();
        $nominal =$request->get('amp;nominal');
      
        $jumlah = $pengguna->saldo+$nominal;
        $data= [
            'saldo' =>$jumlah,
        ];

        $centerPoint = User::find($id_user);
        $res= $centerPoint->update($data);
         Saldo::create([
            'id_user' => $id_user,
            'saldo' => $jumlah,
            'topup' => $nominal
        ]);
      

        return redirect()->route('deposit.index')->with('success','Saldo berhasil bertambah');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Centre_Point $centrePoint)
    {
        $centrePoint = Centre_Point::findOrFail($centrePoint->id);
        return view('backend.CentrePoint.edit',['centrePoint' => $centrePoint]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Centre_Point $centrePoint)
    {
        $centrePoint = Centre_Point::findOrFail($centrePoint->id);
        $centrePoint->coordinates = $request->input('coordinate');
        $centrePoint->update();

        if ($centrePoint) {
            return to_route('centre-point.index')->with('success','Data berhasil diupdate');
        } else {
            return to_route('centre-point.index')->with('error','Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $centrePoint = Centre_Point::findOrFail($id);
        $centrePoint->delete();
        return redirect()->back();
    }
}
