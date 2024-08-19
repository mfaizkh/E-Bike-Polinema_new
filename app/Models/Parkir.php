<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parkir extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
 
   
    public function ebike(): BelongsTo
    {
        return $this->belongsTo(Ebike::class, 'id_bike', 'id');
    }
   

  
}
