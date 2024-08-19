<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Polyline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PolylineController extends Controller
{

    public function __construct()
    {
     
      $this->polylines = new Polyline();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Spot.index');
    }

    public function geojsonpolyline($id)
    {
      $polylines = $this->polylines->getPolyline($id);
  
      $geojson = [
        'type' => 'FeatureCollection',
        'features' => [],
      ];
   
        $feature = [
            'type' => 'Feature',
            'properties' => [
                'id' => $polylines->id,
                'name' => $polylines->name
            ],
            'geometry' => json_decode($polylines->geom),
        ];
        unset($feature['properties']->geom);
  
        array_push($geojson['features'], $feature);
 
      return response()->json($geojson, 200, [], JSON_PRETTY_PRINT);
    }

    public function geojson(Request $request)
    {
        $polylines = $this->polylines->getPolylines(); // Menggunakan model Polyline

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $row) {
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'id' => $row->id,
                    'name' => $row->name
                ],
                'geometry' => json_decode($row->geom),
            ];

            unset($feature['properties']->geom); // Menghapus properti 'geom'

            array_push($geojson['features'], $feature);
        }

        return response()->json($geojson, 200, [], JSON_PRETTY_PRINT); // Mengirimkan respons JSON
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centerPolyline = Centre_Polyline::get()->first();
        return view('backend.Spot.create', ['centerPolyline' => $centerPolyline]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $geometry = request('geometry-polyline');
        $name = request('name');
        $now = now();

        // Lakukan insert ke database
        DB::beginTransaction();

        try {
            DB::table('polylines')->insert([
                'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            DB::commit();

            return redirect('/mapss')->with('success', 'Polyline added successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to add polyline');
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
    public function edit( $id)
    {
        $data = Polyline::find($id);
          return view('admin.edit-polyline', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $geometry = request('geometry-edit-polyline');
        $name = request('name-edit-polyline');
        $updated_at = now();

        // Lakukan update ke database
        DB::beginTransaction();

        try {
            DB::table('polylines')
                ->where('id', $id)
                ->update([
                    'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                    'name' => $name,
                    'updated_at' => $updated_at
                ]);
            
            DB::commit();

            return redirect('/mapss')->with('success', 'Polyline updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to update polyline');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spot = Polyline::findOrFail($id);
     
        $spot->delete();
        return redirect('/mapss')->with('success', 'Polyline updated successfully');
    }
}
