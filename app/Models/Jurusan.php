<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    
    protected $fillable = [
        'promo_id',  
        'mobil_id',  
        'dari_kota_id',  
        'harga',  
        'gambar',  
        'description',
    ];

    protected $hidden = [];

    public function detail_jurusan()
    {
        return $this->hasMany(DetailJurusan::class,'jurusan_id');
    } 
 
}
