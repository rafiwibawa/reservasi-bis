<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\Mobil as MobilModels;
use App\Models\Supir as SupirModels;
use App\Models\MerekMobil as MerekModels;

use DataTables;
use Auth;

class MobilController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'mobil';
        return view('admin.data_master.mobil.index', compact('active'));
    }

    public function dt(Request $request)
    {
        $data = DB::table('mobil')
            ->select([
                'mobil.*',  
                'supir.nama as supir_nama', 
                'merek.nama as merek_nama', 
            ])
            ->leftjoin('supir', 'supir.id','=','mobil.supir_id')
            ->leftjoin('merek_mobil as merek', 'merek.id','=','mobil.merek_mobil_id')
            ->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        try {
            date_default_timezone_set("Asia/Jakarta");
 
            $result = DB::transaction(function () use($request){
                $result = MobilModels::create([
                    'supir_id' => $request->supir_id,  
                    'merek_mobil_id' => $request->merek_mobil_id,  
                    'cc' => $request->cc,      
                    'jumlah_kapasitas' => $request->jumlah_kapasitas,     
                ]);

                return $result;
            });

            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Tersimpan'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = DB::transaction(function () use($request, $id){
                $result = MobilModels::find($id)->update([
                    'name' => $request->name,  
                    'jumlah' => $request->jumlah,  
                    'active' => $request->active,  
                ]);

                return $result;
            });

            return response([
                "status"    => 200,
                "data"      => $request->rule,
                "message"   => 'Data Terubah'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = MobilModels::find($id);

            DB::transaction(function () use($result){
                $result->delete();
            });

            // if ($result->trashed()) {
                return response([
                    "status"=> 200,
                    "message"   => 'Data Terhapus'
                ], 200);
            // }
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    public function select2_supir(Request $request)
    { 
        $supir = SupirModels::orderBy('id', 'ASC') 
                ->get(['id AS id', 'nama AS text']);
        
        return response(['supir' => $supir]);
    }

    public function select2_merek(Request $request)
    { 
        $merek = MerekModels::orderBy('id', 'ASC') 
                ->get(['id AS id', 'nama AS text']);
        
        return response(['merek' => $merek]);
    }
}
