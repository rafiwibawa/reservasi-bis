<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\Reservasi as ReservasiModels;

use DataTables;
use Auth;

class ReservasiController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;  
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'reservasi';
        return view('admin.reservasi.index', compact('active'));
    }

    public function dt(Request $request)
    {
        $data = ReservasiModels::select([
                    'reservasi.id', 
                    'reservasi.midtrans_id', 
                    'reservasi.grand_total', 
                    'users.nama',
                ])
                ->leftjoin('users','users.id','=','reservasi.user_id')
                ->get();

        $data = collect($data)->each(function($item){ 
            
            $midtrans =  \Midtrans\Transaction::status($item->midtrans_id);
             
            $item->payment_code = $midtrans->payment_code ; 
            // $item->store = $midtrans->store; 
            $item->transaction_status = $midtrans->transaction_status; 
        });
 
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
                $result = ReservasiModels::create([
                    'nama' => $request->nama,  
                    'umur' => $request->umur,  
                    'status_vaksin' => $request->status_vaksin,   
                    'sim' => $request->sim,  
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
                $result = ReservasiModels::find($id)->update([
                    'nama' => $request->nama, 
                    'umur' => $request->umur,  
                    'status_vaksin' => $request->status_vaksin,   
                    'sim' => $request->sim,  
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

            $result = ReservasiModels::find($id);

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
