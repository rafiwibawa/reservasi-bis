<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    
    protected $fillable = [
        'user_id',  
        'grand_total',  
        'midtrans_id',  
    ];

    protected $hidden = [];

    public function detail_reservasi()
    {
        return $this->hasMany(DetailReservasi::class,'reservasi_id');
    } 
 
}
