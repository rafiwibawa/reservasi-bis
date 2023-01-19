<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Crypt;
use App\Models\Gejala;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('users')->insert([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'umur' => '24',
            'password' => Hash::make('1234qwer'),
            'kunci' => Crypt::encryptString('1234qwer'),
        ]);

        // $name_barang = [
        //     'Belut',
        //     'Ayam',
        //     'Lele',
        //     'Bebek', 
        //     'Burung',
        //     'Beras',
        //     'Jeruk',
        //     'Listrik',
        //     'Teh Poci',
        //     'Gula Pasir',
        //     'Es Kristal',
        //     'Air Galon',
        //     'Lalapan Timun',
        //     'Lalapan Tauge',
        //     'Lalapan Kemangi',
        //     'Tempe',
        //     'Tahu',
        //     'Minyak Goreng',
        //     'Bumbu Dapur',
        // ];

        // collect($name_barang)->each(function ($name_barang) {  
        //     KategoriBarang::updateOrCreate(
        //         ['name' => $name_barang], 
        //     ); 
        // });

        // $name_produk = [
        //     'Makan',
        //     'Minuman',
        //     'Malas Makan', 
        // ];

        // collect($name_produk)->each(function ($name_produk) {  
        //     KategoriProduk::updateOrCreate(
        //         ['name' => $name_produk], 
        //     ); 
        // });
    }
}
