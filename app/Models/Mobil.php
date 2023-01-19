<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    
    protected $fillable = [
        'supir_id',
        'merek_mobil_id',
        'cc',  
        'jumlah_kapasitas',
    ];

    protected $hidden = [];
 
}
