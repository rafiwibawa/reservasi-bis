<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Reservasi;
use App\Models\DetailReservasi;

use DataTables;
use Auth;

class KeranjangController extends Controller
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
        $active = 'keranjang';
        
        $data = DB::table('cart')->select([
            'cart.*',
            'jurusan.harga',
            'kota.nama as kota_asal'
            ])
            ->where('user_id', Auth::user()->id)
            ->leftjoin('jurusan', 'jurusan.id', '=', 'cart.jurusan_id')
            ->leftjoin('kota', 'kota.id', '=', 'jurusan.dari_kota_id')
            ->get();

        return view('app.keranjang.index', compact('active', 'data'));
    } 

    public function delete($id)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Cart::find($id);
 
            DB::transaction(function () use($result){
                $result->delete();
            });

            return redirect()->back()->with('message','Deleted sucessfuly');
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }
 
    public function store(Request $request) 
    {      
        $cart = DB::table('cart')->select([
            'cart.*',
            'jurusan.harga',

            ])
            ->leftjoin('jurusan', 'jurusan.id', '=', 'cart.jurusan_id')
            ->where('user_id', Auth::user()->id);
            
        $grand_total = $cart->sum('jurusan.harga');
        
        $cart = $cart->get();
           
        $date = date('ym', strtotime(now()));
 
        $data_reservasi = [
            'kode' => ''.$date, 
            'grand_total' => $grand_total,
            'user_id' => Auth::user()->id, 
            'midtrans_id' => $request->midtrans_id,
        ];
  
        $data_detail_reservasi = [];
        foreach ($cart as $item) { 
            array_push($data_detail_reservasi,[ 
                'jurusan_id' => $item->jurusan_id,
                'nik' => $item->nik,
                'name' => $item->nama,
                'harga' => $item->harga, 
            ]);
        }  

        DB::beginTransaction();
        try {
            $create_reservasi = Reservasi::create($data_reservasi); 

            $create_reservasi->detail_reservasi()->createMany($data_detail_reservasi);

            $result = Cart::where('user_id', Auth::user()->id)->delete(); 

            DB::commit();

        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
 
        return redirect()->back()->with('message', 'Secessfuly');
    }

    public function bayar() 
    {     
        $cart = DB::table('cart')->select([
            'cart.*',
            'jurusan.harga',

            ])
            ->leftjoin('jurusan', 'jurusan.id', '=', 'cart.jurusan_id')
            ->where('user_id', Auth::user()->id);
            
        $grand_total = $cart->sum('jurusan.harga');
        
        $cart = $cart->get();
          
        $midtrans_id = uniqid();
        $date = date('ym', strtotime(now()));
 
        $data_reservasi = [
            'kode' => ''.$date, 
            'grand_total' => $grand_total,
            'user_id' => Auth::user()->id, 
            'midtrans_id' => $midtrans_id,
        ];

        $items = [];
        foreach ($cart as $item) { 
            array_push($items,[ 
                'id' => $item->jurusan_id,
                'price' => $item->harga, 
                'quantity'  => 1,
                'name' => $item->nama,
            ]);
        } 


        $transaction_details = array(
            'order_id'          => $midtrans_id,
            'gross_amount'  => $grand_total,
        );
        
        
        DB::beginTransaction();
        try {

            // Populate customer's billing address
            $billing_address = array(
                'first_name'        => Auth::user()->nama,
                'address'           => '-',  
                'phone'                 => Auth::user()->nomor_ponsel,
                'country_code'  => 'IDN'
                );

            // Populate customer's shipping address
            $shipping_address = array(
                'first_name'    => Auth::user()->nama, 
                'address'       => '-',    
                'phone'             => Auth::user()->nomor_ponsel,
                'country_code'=> 'IDN'
                );
            // Populate customer's Info
            $customer_details = array(
                'first_name'        => Auth::user()->nama,
                'address'           => '-',  
                'phone'                 => Auth::user()->nomor_ponsel,
                'email'            => Auth::user()->email,
                'billing_address' => $billing_address,
                'shipping_address'=> $shipping_address
                );
            // Data yang akan dikirim untuk request redirect_url.
            $transaction_data = array(
                'transaction_details'=> $transaction_details,
                'item_details'           => $items,
                'customer_details'   => $customer_details
            );
        
        
            $snap_token = \Midtrans\Snap::createTransaction($transaction_data)->token;
            //return redirect($vtweb_url);
            $data = [
                'midtrans_id' => $midtrans_id,
                'token' => $snap_token,
            ];

            DB::commit();

        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }

        try
        {
            $snap_token = \Midtrans\Snap::createTransaction($transaction_data)->token;
            //return redirect($vtweb_url);
            $data = [
                'midtrans_id' => $midtrans_id,
                'token' => $snap_token,
            ];

            return $data;
        } 
        catch (Exception $e) 
        {   
            return $e->getMessage;
        }
    }
}
