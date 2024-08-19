<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points'; // Sesuaikan dengan nama tabel yang sesuai

    protected $guarded = [];

    // Mengambil semua poligon
    public function getPoints()
    {
        return DB::table($this->table)
            ->select('id', 'name', DB::raw('ST_AsGeoJSON(geom) as geom'))
            ->get();
    }

    // Mengambil satu poligon berdasarkan ID
    public function getPoint($id)
    {
        return DB::table($this->table)
            ->select('id', 'name', DB::raw('ST_AsGeoJSON(geom) as geom'))
            ->where('id', $id)
            ->first();
    }
}

