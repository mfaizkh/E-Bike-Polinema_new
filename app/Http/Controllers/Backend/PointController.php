<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Centre_Point;
use App\Models\Point;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{

    public function __construct()
    {
     
      $this->points = new Point();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Spot.index');
    }

    public function geojsonpoint($id)
    {
      $points = $this->points->getPoint($id);
  
      $geojson = [
        'type' => 'FeatureCollection',
        'features' => [],
      ];
    //   foreach ($points as $row) {
        // dd($row)->name;
        $feature = [
            'type' => 'Feature',
            'properties' => [
                'id' => $points->id,
                'name' => $points->name
            ],
            'geometry' => json_decode($points->geom),
        ];
        unset($feature['properties']->geom);
  
        array_push($geojson['features'], $feature);
    //   }
      return response()->json($geojson, 200, [], JSON_PRETTY_PRINT);
    }

    public function geojson(Request $request)
    {
        $points = $this->points->getPoints(); // Menggunakan model Point

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $row) {
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
        $centerPoint = Centre_Point::get()->first();
        return view('backend.Spot.create', ['centerPoint' => $centerPoint]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $geometry = request('geometry-point');
        $name = request('name');
        $now = now();

        // Lakukan insert ke database
        DB::beginTransaction();

        try {
            DB::table('points')->insert([
                'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            DB::commit();

            return redirect('/mapss')->with('success', 'Point added successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to add point');
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
        $data = Point::find($id);
          return view('admin.edit-point', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $geometry = request('geometry-edit-point');
        $name = request('name-edit-point');
        $updated_at = now();

        // Lakukan update ke database
        DB::beginTransaction();

        try {
            DB::table('points')
                ->where('id', $id)
                ->update([
                    'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                    'name' => $name,
                    'updated_at' => $updated_at
                ]);
            
            DB::commit();

            return redirect('/mapss')->with('success', 'Point updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to update point');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spot = Point::findOrFail($id);
     
        $spot->delete();
        return redirect('/mapss')->with('success', 'Point updated successfully');
    }
}
