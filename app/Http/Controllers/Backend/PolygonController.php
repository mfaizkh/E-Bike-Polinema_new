<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Centre_Point;
use App\Models\Polygon;
use App\Models\Polyn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PolygonController extends Controller
{

    public function __construct()
    {
     
      $this->polygons = new Polygon();
      $this->polyns = new Polyn();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Spot.index');
    }

    public function geojsonpolygon($id)
    {
      $points = $this->polygons->getPolygon($id);
  
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
        $points = $this->polygons->getPolygons(); // Menggunakan model Polygon

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
    public function polyns(Request $request)
    {
        $points = $this->polyns->getPolygons(); // Menggunakan model Polygon

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

        $geometry = request('geometry-polygon');
        $name = request('name');
        $now = now();

        // Lakukan insert ke database
        DB::beginTransaction();

        try {
            DB::table('polygons')->insert([
                'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            DB::commit();

            return redirect('/mapss')->with('success', 'Polygon added successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to add polygon');
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
        $data = Polygon::find($id);
          return view('admin.edit-polygon', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $geometry = request('geometry-edit-polygon');
        $name = request('name-edit-polygon');
        $updated_at = now();

        // Lakukan update ke database
        DB::beginTransaction();

        try {
            DB::table('polygons')
                ->where('id', $id)
                ->update([
                    'geom' => DB::raw("ST_GeomFromText('$geometry')"),
                    'name' => $name,
                    'updated_at' => $updated_at
                ]);
            
            DB::commit();

            return redirect('/mapss')->with('success', 'Polygon updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/mapss')->with('error', 'Failed to update polygon');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spot = Polygon::findOrFail($id);
     
        $spot->delete();
        return redirect('/mapss')->with('success', 'Polygon updated successfully');
    }
}
