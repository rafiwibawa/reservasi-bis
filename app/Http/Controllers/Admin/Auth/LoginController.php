<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User; 

class LoginController extends Controller
{
    public function index()
    {
        return \view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try { 
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email',$request->email)->first();
            
            if(!$user){
               return back()->withErrors([
                    'email' => 'Email pengguna tidak ditemukan.',
                ]);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('dashboard');
            }
            
            return back()->withErrors([
                'Password' => 'Password anda Salah, coba ulangi.',
            ]);

        } catch (\Throwable $th) {
            return response([
                "status" => 400,
                "message"=> $th->getMessage(),
            ]);
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function sosmed($param)
    {        
        return Socialite::driver($param) 
            ->redirect();   
    }  
 
    public function facebook_callback(Request $request)
    {      
        try { 
            $facebook = Socialite::driver('facebook')->stateless()->user();  
 
            date_default_timezone_set("Asia/Jakarta");

            $user = User::where('email', $facebook->user['email'])->first();
            
            if(!$user){
                $user = User::updateOrCreate([
                    'facebook_id' => $facebook->id,
                    'nama' => $facebook->user['name'],
                    'email' => $facebook->user['email'],
                    'hak_akses' => 'kasir'
                ]); 
            } 
            Auth::login($user);

            $request->session()->regenerate();
 
            return redirect()->route('dashboard'); 
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }

    } 

    public function google_callback(Request $request)
    {    
        try { 
            $google = Socialite::driver('google')->stateless()->user(); 
              
            date_default_timezone_set("Asia/Jakarta");

            $user = User::where('email', $google->user['email'])->first();
            
            if(!$user){
                $user = User::updateOrCreate([
                    'google_id' => $google->id,
                    'nama' => $google->user['name'],
                    'email' => $google->user['email'],
                    'hak_akses' => 'kasir'
                ]); 
            } 
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('dashboard'); 
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        } 
    }  
} 
