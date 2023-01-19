<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cart;

use DataTables;
use Auth;

class JurusanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'jurusan';
        
        $data = DB::table('jurusan')
            ->select([
                'jurusan.id',
                'jurusan.created_at', 
                'jurusan.mobil_id',
                'jurusan.gambar',
                'jurusan.harga',
                'mobil.jumlah_kapasitas', 
                DB::raw("concat(supir.nama ,' - ',merek_mobil.nama) AS nama_supir")
            ])
            ->leftjoin('kota', 'kota.id', '=', 'jurusan.dari_kota_id')
            ->leftjoin('mobil', 'mobil.id', '=', 'jurusan.mobil_id')
            ->leftjoin('merek_mobil', 'merek_mobil.id', '=', 'mobil.merek_mobil_id')
            ->leftjoin('supir', 'supir.id','=', 'mobil.supir_id')
            ->get();

        return view('app.jurusan.index', compact('active', 'data'));
    }

    public function add(Request $request)
    {  
        $data = [
            'jurusan_id' => $request->jurusan_id,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect('/app/jurusan');
    }
}
