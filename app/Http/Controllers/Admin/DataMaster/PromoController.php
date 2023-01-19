<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\Promo as PromoModels;

use DataTables;
use Auth;

class PromoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'promo';
        return view('admin.data_master.promo.index', compact('active'));
    }

    public function dt(Request $request)
    {
        $data = DB::table('promo')
            ->select([
                'id',
                'name', 
                'jumlah',
                'active', 
            ])
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
                $result = PromoModels::create([
                    'name' => $request->name,  
                    'jumlah' => $request->jumlah,  
                    'active' => $request->active,     
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
                $result = PromoModels::find($id)->update([
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

            $result = PromoModels::find($id);

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
}
