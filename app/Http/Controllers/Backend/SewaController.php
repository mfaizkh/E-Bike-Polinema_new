<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ebike;
use App\Models\Sewa;
use App\Models\Parkir;
use App\Models\User;
use App\Models\Data;
use App\Models\Minimum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        $pengguna = User::where('id', $id_user)->latest()->first();

        if (empty($pengguna->telepon) || empty($pengguna->ktm) || empty($pengguna->wajah)) {
            return redirect()->route('profil.index')->with('alert', 'Isi Profil Dahulu');
        }
        $booking = Sewa::where('id_user', $id_user)
            ->where('status', '!=', 0)
            // ->where('status', '!=', 2)
            ->latest()
            ->first();

        if ($booking !== null) {

            $data = DB::table('dataa')
                ->where('id', 1)
                ->first();

            $id_booking = $booking->id;
            $alert = 'booked';
            $id_bike = $booking->id_bike;
            $durasi = $booking->durasi;
            $waktu = $booking->waktu;
            $datetime = $booking->datetime;
            $status = $booking->status;

            list($jam, $menit, $detik) = explode(':', $waktu);
            $waktuDetik = ($jam * 3600) + ($menit * 60) + $detik;
            $total = $waktuDetik + ($durasi * 60);
            $hasilWaktu = gmdate('H:i:s', $total);
            list($jam2, $menit2, $detik2) = explode(':', $hasilWaktu);
            //Ambil data ebike
            $ebike = Ebike::where('id', $id_bike)->latest()->first();

            $foto = $ebike->foto;
            $merk = $ebike->merk;
            $warna = $ebike->warna;
            $lock = $data->relay1;
            $engine = $ebike->v_engine;

            if ($lock == 0) {
                $lock_color = "success";
                $lock_status = "1";
                $lock_detail = "<i class='fas fa-lock'></i>";
            } else if ($lock == 1) {
                $lock_color = "danger";
                $lock_status = "0";
                $lock_detail = "<i data-feather='lock'></i>";
            }

            if ($engine == 1) {
                $engine_color = "success";
                $engine_status = "0";
                $engine_detail =  "<i data-feather='play'></i> ";
            } else if ($engine == 0) {
                $engine_color = "danger";
                if ($ebike->status == 3) {
                    $engine_status = "0";
                } else {
                    $engine_status = "1";
                }
                $engine_detail = "<i data-feather='play'></i> ";
            }
            return view('sewa.scan', compact('ebike', 'alert', 'booking'))->with([
                'data' => $data,
                'alert' => $alert,
                'status' => $status, // Jika diperlukan
                'foto' => $foto,
                'jam2' => $jam2,
                'menit2' => $menit2,
                'detik2' => $detik2,
                'lock_color' => $lock_color,
                'lock_detail' => $lock_detail,
                'lock_status' => $lock_status,
                'engine_color' => $engine_color,
                'engine_detail' => $engine_detail,
                'engine_status' => $engine_status,
                'merk' => $merk,
                'warna' => $warna,
                'id_bike' => $id_bike,
                'id_booking' => $id_booking,
                'lock_status' => $lock_status, // Jika diperlukan
                'engine_status' => $engine_status, // Jika diperlukan
            ]);
        } else {
            $alert = '';
            return view('sewa.scan', compact('alert'));
        }
    }

    public function booking_done(Request $request)
    {
        $id_booking = $request->input('id_booking');
        $id_bike = $request->input('id_bike');

        // Cek booking
        $booking = Sewa::where('id_bike', $id_bike)
            ->where('status', '!=', '0')
            ->orderByDesc('id')
            ->first();

        if ($booking && $booking->status != 3) {
            // Update status booking
            Sewa::where('id', $id_booking)
                ->update(['status' => '2']);

            // Update status ebike
            Ebike::where('kode', $id_bike)
                ->update(['v_lock' => '0', 'v_engine' => '0']);
        }

        // Response JSON jika perlu
        return response()->json(['message' => 'Booking updated successfully']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kode = $request->kode;
        $harga = 500;
        $pengguna = User::where('id', Auth::id())->first();
        $minimum = Minimum::first();
        if ($pengguna->saldo < $minimum->saldo) {
            return redirect()->route('deposit.index')->with('error', 'Saldo anda kurang');
        } else {
            $ebike = Ebike::where('kode', $kode)->first();
            return view('sewa.create', compact('ebike', 'harga', 'pengguna'));
        }
    }
    public function booking_sewa_lagi($id)
    {

        $harga = 500;
        $pengguna = User::where('id', Auth::id())->first();
        $minimum = Minimum::first();
        if ($pengguna->saldo < $minimum->saldo) {
            return redirect()->route('deposit.index')->with('error', 'Saldo anda kurang');
        } else {
            $ebike = Ebike::where('id', $id)->first();
            return view('sewa.create', compact('ebike', 'harga', 'pengguna'));
        }
    }
    public function booking_kembali($id)
    {
        $sewa = Sewa::where('id', $id)->first();
        $parkir = Parkir::all();
        return view('sewa.kembali', compact('sewa', 'parkir', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        DB::table('dataa')
            ->where('id', 1)
            ->update([
                'relay1' => 0,
                'relay2' => 0,
            ]);
        DB::commit();
        // dd('$data');
        $durasi = $request->input('durasi');
        $id_bike = $request->input('id_bike');
        $tagihan = $request->input('harga') * $durasi;
        $pengguna = User::find(Auth::id());
        $saldo_akhir = $pengguna->saldo - $tagihan;
        $a = $pengguna->update(['saldo' => $saldo_akhir]);


        $bikes = Ebike::find($id_bike);
        $bikes->update(['status' => 1]);

        Parkir::where('id_bike', $id_bike)->update(['id_bike' => null]);

        $sewa = Sewa::create([
            'tagihan' => $tagihan,
            'durasi' => $durasi,
            'id_bike' => $id_bike,
            'id_user' => Auth::id(),
            'status' => 1,
        ]);

        if ($sewa) {
            return to_route('sewa.index')->with('success', 'Berhasil Sewa Sepeda');
        } else {
            return to_route('sewa.index')->with('error', 'Gagal Sewa');
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
     * Update the specified resource in storage.
     */
    public function pengembalian(Request $request, $id)
    {

        // Ambil data booking
        $booking = Sewa::where('id', $id)->first();
        $id_booking = $booking->id;

        // Update status ebike
        Ebike::where('id', $booking->id_bike)
            ->update(['v_engine' => '0', 'v_lock' => '1', 'status' => '0']);

        // Update park
        Parkir::where('id', $request->input('id_park'))
            ->update(['id_bike' => $booking->id_bike]);

        // Mengelola gambar
        if ($request->hasFile('foto_kembali') && $request->file('foto_kembali')->isValid()) {
            $file = $request->file('foto_kembali');
            $uploadFile = $file->hashName();
            $file->move('uploads/', $uploadFile);
            $foto_kembali = $uploadFile;
        } else {
            return "Maaf, terjadi kesalahan saat mengunggah gambar.";
        }
        DB::beginTransaction();
        DB::table('dataa')
            ->where('id', 1)
            ->update([
                'relay1' => 1,
                'relay2' => 1,
            ]);
        DB::commit();

        // Mengupdate booking
        $booking->update([
            'datetime_kembali' => now()->setTimezone('Asia/Jakarta')->toDateTimeString(),
            'status' => '0',
            'foto_kembali' => $foto_kembali
        ]);
        if ($booking) {
            return to_route('sewa.index')->with('success', 'Sepeda Berhasil Dikembalikan');
        } else {
            return to_route('sewa.index')->with('error', 'Gagal Dikembalikan');
        }
    }

    public function open($id)
    {

        if ($id == 1) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 1);
            $data1->update([
                'relay1' => 0,
                // 'musik' => 27,
            ]);
            $get1 = $data1->first();
            DB::commit();
        } else if ($id == 2) {
            DB::beginTransaction();
            DB::table('dataa')
                ->where('id', 2)
                ->update([
                    'relay1' => 0,
                    // 'musik' => 27,
                ]);
            DB::commit();
        } else if ($id == 3) {
            DB::beginTransaction();
            DB::table('dataa')
                ->where('id', 3)
                ->update([
                    'relay1' => 0,
                    // 'musik' => 27,
                ]);
            DB::commit();
        } else if ($id == 4) {
            DB::beginTransaction();
            DB::table('dataa')
                ->where('id', 4)
                ->update([
                    'relay1' => 0,
                    // 'musik' => 27,
                ]);
            DB::commit();
        } else if ($id == 5) {
            DB::beginTransaction();
            DB::table('dataa')
                ->where('id', 5)
                ->update([
                    'relay1' => 0,
                    // 'musik' => 27,
                ]);
            DB::commit();
        }



        return redirect()->back();
    }
    public function lock($id)
    {

        if ($id == 1) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 1);
            $data1->update([
                'relay1' => 1,
                'musik' => 25,
                'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
            ]);
            $get1 = $data1->first();
            DB::commit();
            $latitude = number_format($get1->lattitude, 6);
            $longitude = number_format($get1->longitude, 6);


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
                    'target' => '082232971546',
                    'message' => 'E-Bike Pink (94354) Keluar dari area Batas Lokasi dengan koordinat'
                        . $latitude . ', ' . $longitude . ' pada ' . $get1->updated_at . '',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dqKXT-#gHb6kkUw5+C3G'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);
        } else if ($id == 2) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 2);
            $data1->update([
                'relay1' => 1,
                'musik' => 25,
                'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
            ]);
            $get1 = $data1->first();
            DB::commit();
            $latitude = number_format($get1->lattitude, 6);
            $longitude = number_format($get1->longitude, 6);
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
                    'target' => '082232971546',
                    'message' => 'E-Bike Merah (13457) Keluar dari area Batas Lokasi dengan koordinat'
                        . $latitude . ', ' . $longitude . ' pada ' . $get1->updated_at . '',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dqKXT-#gHb6kkUw5+C3G'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);
        } else if ($id == 3) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 3);
            $data1->update([
                'relay1' => 1,
                'musik' => 25,
                'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
            ]);
            $get1 = $data1->first();
            DB::commit();
            $latitude = number_format($get1->lattitude, 6);
            $longitude = number_format($get1->longitude, 6);
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
                    'target' => '082232971546',
                    'message' => 'E-Bike Biru (43136) Keluar dari area Batas Lokasi dengan koordinat'
                        . $latitude . ', ' . $longitude . ' pada ' . $get1->updated_at . '',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dqKXT-#gHb6kkUw5+C3G'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);
        } else if ($id == 4) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 4);
            $data1->update([
                'relay1' => 1,
                'musik' => 25,
                'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
            ]);
            $get1 = $data1->first();
            DB::commit();
            $latitude = number_format($get1->lattitude, 6);
            $longitude = number_format($get1->longitude, 6);
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
                    'target' => '082232971546',
                    'message' => 'E-Bike Purple (54123) Keluar dari area Batas Lokasi dengan koordinat'
                        . $latitude . ', ' . $longitude . ' pada ' . $get1->updated_at . '',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dqKXT-#gHb6kkUw5+C3G'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);
        } else if ($id == 5) {
            DB::beginTransaction();
            $data1 = DB::table('dataa')
                ->where('id', 5);
            $data1->update([
                'relay1' => 1,
                'musik' => 25,
                'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
            ]);
            $get1 = $data1->first();
            DB::commit();
            $latitude = number_format($get1->lattitude, 6);
            $longitude = number_format($get1->longitude, 6);
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
                    'target' => '082232971546',
                    'message' => 'E-Bike Green (11747) Keluar dari area Batas Lokasi dengan koordinat'
                        . $latitude . ', ' . $longitude . ' pada ' . $get1->updated_at . '',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dqKXT-#gHb6kkUw5+C3G'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);
        }
        // sleep(5);
        //  DB::table('dataa')
        //  ->where('id', 1)
        //  ->update([
        //  'relay1' => 1,
        //  'musik' => 26,
        //  ]);
        //  DB::commit();
        return redirect()->back();
    }

    public function engine(Request $request)
    {
        $v_engine = $request->input('v_engine');
        $id_bike = $request->input('v_bike');

        // Update status ebike
        Ebike::where('id', $id_bike)
            ->update(['v_engine' => $v_engine]);

        return redirect()->back();
    }
}
