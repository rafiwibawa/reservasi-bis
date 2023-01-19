<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

use App\Models\User;

use DataTables;
use Auth;

class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'home';
        
        return view('app.home.index', compact('active'));
    }
}
