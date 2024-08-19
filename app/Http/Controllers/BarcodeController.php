<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class BarcodeController extends Controller
{
    public function showScanForm()
    {
        return view('booking.scan');
    }

    public function scanBarcode(Request $request)
    {
        // Logika scanning barcode disini
        $result = $request->input('barcode_result');
        return response()->json(['result' => $result]);
    }
    public function forgot()
    {
        return view('auth.forgot');
    }
  
    public function password(Request $request) {
        // dd($request->all());
      $email =  $request->input('email');
        
      $user = User::where('email', $email)->first();
      
       if ($user) {
        $password_new = rand(100000,999999);
        $user->update(['password' => Hash::make($password_new)]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.fonnte.com/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
        'target' => ''.$user->telepon.'',
'message' => '*_[Reset Password]_*
        
Berikut password baru Anda : '.$password_new.'

_E-Bike Polinema_
_©Copyright 2024_',
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: 5TyK7!wRKTqB_m2VvxAN'
          ),
        ));
        
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
          $error_msg = curl_error($curl);
        }
        curl_close($curl);

        return redirect()->route('login')->with('success', 'Password baru telah dikirim');
       } else {
       return redirect()->route('forgot')->with('error', 'Email Tidak Ditemukan');
       }
       

       
    }
}
