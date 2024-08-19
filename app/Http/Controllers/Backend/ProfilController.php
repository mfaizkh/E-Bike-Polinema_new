<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $id_user = Auth::id();
        $pengguna = User::where('id', $id_user)->latest()->first();
        return view('profil.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
       // Validasi untuk data lain
      // Validate the basic user data
        $data = $request->validate([
            'nik' => 'required|min:16',
            'email' => 'required|email',
            'telepon' => 'required|min:11',
            'name' => 'required',
        ]);

        // Initialize the user object
        $user = Auth::user();

        // Validate and update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            $passwordData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
            ]);

            // Check if the current password is correct
            if (!Hash::check($passwordData['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }

            // Update the password if new password is provided
            if (!empty($passwordData['new_password'])) {
                $user->password = Hash::make($passwordData['new_password']);
            }
        }

        // Update the user data
        $user->nik = $data['nik'];
        $user->email = $data['email'];
        $user->telepon = $data['telepon'];
        $user->name = $data['name'];

        // Handle file uploads for 'wajah'
        if ($request->hasFile('wajah')) {
            $file = $request->file('wajah');
            $uploadFile = $file->hashName();
            $file->move('uploads/', $uploadFile);
            $user->wajah = $uploadFile; // Assuming 'wajah' is the correct column in your database
        }

        // Handle file uploads for 'ktm'
        if ($request->hasFile('ktm')) {
            $file = $request->file('ktm');
            $uploadFile = $file->hashName();
            $file->move('uploads/', $uploadFile);
            $user->ktm = $uploadFile; // Assuming 'ktm' is the correct column in your database
        }

        // Save the user data
        if ($user->save()) {
            return to_route('profil.index')->with('success', 'Data berhasil disimpan');
        } else {
            return to_route('profil.index')->with('error', 'Data gagal disimpan');
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
