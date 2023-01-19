<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurusan extends Model
{
    use HasFactory;

    protected $table = 'detail_jurusan';
    
    protected $fillable = [
        'jurusan_id',  
        'ke_kota_id',  
        'urutan',   
    ];

    protected $hidden = [];

    public function detail_jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id');
    } 
 
}
