<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\Jurusan as JurusanModels;
use App\Models\DetailJurusan as DetailJurusanModels;
use App\Models\Kota as KotaModels;
use App\Models\Mobil as MobilModels;
use App\Models\Promo as PromoModels;

use DataTables;
use Validator,Redirect,Response,File;
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
        return view('admin.jurusan.index', compact('active'));
    }

    public function dt(Request $request)
    {
        $data = DB::table('jurusan')
            ->select([
                'jurusan.id',
                'jurusan.created_at', 
                'jurusan.mobil_id',
                'mobil.jumlah_kapasitas',
                'merek_mobil.nama as nama_mobil',
                'supir.nama as nama_supir',
            ])
            ->leftjoin('mobil', 'mobil.id', '=', 'jurusan.mobil_id')
            ->leftjoin('merek_mobil', 'merek_mobil.id', '=', 'mobil.merek_mobil_id')
            ->leftjoin('supir', 'supir.id','=', 'mobil.supir_id')
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
        $validated = $request->only([
            'kota_id',
            'kota_tujuan_id',
            'mobil_id',
            'promo_id',
            'harga',
            'photo',
            'description',
        ]); 

        DB::beginTransaction();
        try {
            if ($validated['photo']) {  
                $file = $request->file('photo');  
                $filename = time()."_".$file->getClientOriginalName();

                $tujuan_upload = 'img';
                $file->move($tujuan_upload,$filename); 
            } 

            $data = [
                'dari_kota_id' => $validated['kota_id'],  
                'mobil_id' => $validated['mobil_id'],  
                'harga' => $validated['harga'],
                'gambar' => $filename, 
                'harga' => $validated['harga'],
                'description' => $validated['description'],
            ];

            $jurusan = JurusanModels::create($data);  

            $kota_tujuan = collect($validated)->only(['kota_tujuan_id'])->all();
             
            $kota_tujuan = explode(",",$kota_tujuan['kota_tujuan_id']);

            // insert detail_jurusan
            for ($i=0; $i < count($kota_tujuan); $i++) { 
                $data_kota_tujuan = collect($kota_tujuan)
                    ->merge([ 
                        'jurusan_id' => $jurusan->id,  
                        'ke_kota_id' => $kota_tujuan[$i],  
                        'urutan' => $no = $i+1,  
                    ])
                    ->all();

                //query create 
                $kota_tujuan_create = DetailJurusanModels::create($data_kota_tujuan);
                $jurusan->detail_jurusan()->save($kota_tujuan_create);
            }  
 
            DB::commit();
        } catch (Exception $e) {
            $properties = [$e->getMessage(), $e->getTraceAsString()];
            $log->new()->properties($properties)->save('error');
            DB::rollBack();
            return response(['message' => 'Server busy, please try again later!', 500]);
        }
        return response(['message' => 'Successfully added']);
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
                $result = JurusanModels::find($id)->update([
                    'name' => $request->name, 
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

            $result = JurusanModels::find($id);

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

    public function select2_kota(Request $request)
    { 
        $kota = KotaModels::orderBy('id', 'ASC')->get(['id AS id', 'nama AS text']);
        
        return response(['kota' => $kota]);
    } 
    
    public function get_kota()
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = KotaModels::orderBy('id', 'ASC')->get(['id AS id', 'nama AS text']);

            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Terkirim'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }



    public function select2_mobil(Request $request)
    { 
        $mobil = MobilModels::orderBy('mobil.id', 'ASC')
                ->leftjoin('merek_mobil as merek', 'merek.id','=','mobil.merek_mobil_id')
                ->leftjoin('supir', 'supir.id','=','mobil.supir_id')
                ->get([
                    'mobil.id AS id', 
                    DB::raw("concat(merek.nama,' - ',supir.nama) AS text")
                ]);
        
        return response(['mobil' => $mobil]);
    }

    public function select2_promo(Request $request)
    { 
        $promo = PromoModels::orderBy('id', 'ASC')->get(['id AS id', 'name AS text']);
        
        return response(['promo' => $promo]);
    }

    public function validate_kota(Request $request)
    { 
        $kota = KotaModels::find($request->kota_id);
  
        return response([
            'kota_data' => $kota,
        ]);
    }
}
