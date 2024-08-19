<?php

namespace App\Http\Controllers;

use App\Models\Centre_Point;
use App\Models\Data;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function sepeda1()
    {
        $points = Data::find(1);
        $latitude = $points->lattitude;
        $longitude = $points->longitude;
        $img = $points->img;

        return response()->json([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'img' => $img,
        ], 200, [], JSON_PRETTY_PRINT);
    }
    public function sepeda2()
    {
        $points = Data::find(2);
        $latitude = $points->lattitude;
        $longitude = $points->longitude;
        $img = $points->img;

        return response()->json([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'img' => $img,
        ], 200, [], JSON_PRETTY_PRINT);
    }
    public function sepeda3()
    {
        $points = Data::find(3);
        $latitude = $points->lattitude;
        $longitude = $points->longitude;
        $img = $points->img;

        return response()->json([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'img' => $img,
        ], 200, [], JSON_PRETTY_PRINT);
    }
    public function sepeda4()
    {
        $points = Data::find(4);
        $latitude = $points->lattitude;
        $longitude = $points->longitude;
        $img = $points->img;

        return response()->json([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'img' => $img,
        ], 200, [], JSON_PRETTY_PRINT);
    }
    public function sepeda5()
    {
        $points = Data::find(5);
        $latitude = $points->lattitude;
        $longitude = $points->longitude;
        $img = $points->img;
        // dd($points);
        return response()->json([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'img' => $img,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function index()
    {
        return view('home');
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
