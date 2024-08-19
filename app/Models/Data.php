<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data extends Model
{
    use HasFactory;

    protected $table = 'dataa'; // Sesuaikan dengan nama tabel yang sesuai

    protected $guarded = [];

    public function getDatas()
    {
        return DB::table($this->table)
           ->get();
    }
   
}

