<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $table = 'detail_reservasi';
    
    protected $fillable = [
        'reservasi_id',  
        'jurusan_id',  
        'name',  
        'nik',   
        'harga',  
    ];

    protected $hidden = [];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    } 
 
}
