<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Mobil;
use App\Models\Kota;
use App\Models\Supir;
use App\Models\Promo;
use App\Models\MerekMobil;

use DataTables;
use Auth;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'dashboard';

        $data['admin'] = User::where('hak_akses', 'admin')->count();
        $data['kasir'] = User::where('hak_akses', 'kasir')->count();
        $data['mobil'] = Mobil::count();
        $data['kota'] = Kota::count();
        $data['supir'] = Supir::count();
        $data['promo'] = Promo::count();
        $data['merek'] = MerekMobil::count();
         
        return view('admin.dashboard.index', compact('active','data'));
    }
}
