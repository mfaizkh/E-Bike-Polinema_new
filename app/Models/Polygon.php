<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Polygon extends Model
{
    use HasFactory;

    protected $table = 'polygons'; // Sesuaikan dengan nama tabel yang sesuai

    protected $guarded = [];

    // Mengambil semua poligon
    public function getPolygons()
    {
        return DB::table($this->table)
            ->select('id', 'name', DB::raw('ST_AsGeoJSON(geom) as geom'))
            ->get();
    }

    // Mengambil satu poligon berdasarkan ID
    public function getPolygon($id)
    {
        return DB::table($this->table)
            ->select('id', 'name', DB::raw('ST_AsGeoJSON(geom) as geom'))
            ->where('id', $id)
            ->first();
    }
}

