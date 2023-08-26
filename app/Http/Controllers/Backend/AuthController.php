<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\{User};

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.auth.login');
    }

   
    /**
     * Authenticate the admin user
     */
    public function authenticate(Request $request)
    {   
        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)){
            if(Auth::user()->is_active == 1){
                Auth::login(Auth::user());
                $datauser = Auth::user();
                return response()->json([
                    'message'=>'Connexion réussi!',
                    'status'=>200]);
            }else{
                return response()->json([
                    'message'=>'Votre compte a été desactivé veuillez contacter l\'administrateur!',
                    'status'=>200]);
            }
        }else {
            return response()->json(['message'=>'Mot de passe ou Email incorrect!', 'status'=>403]);
        }


    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('admin-login');
    }

    /**
     * Where to redirect admin after login.
     *
     * @var string
    */

    protected $redirectTo = RouteServiceProvider::ANALYTICS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
