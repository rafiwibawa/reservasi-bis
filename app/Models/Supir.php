<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory; 

    protected $table = 'supir';

    protected $fillable = [
        'nama',
        'umur',
        'status_vaksin', 
        'sim',
    ];

    protected $hidden = [];

    // public function kategori()
    // {
    //     return $this->HasMany(KategoriProduk::class);
    // } 
}
