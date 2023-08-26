<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\{Country, City, User, State};

class UserController extends Controller
{
   /**Controlleur d'acces super administrateur */
   public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1  &&  Auth::user()->is_active == 1 ){
            return true;
        }else{
            return false;
        }
    }

    /**Verification si l'email existe dans le system ou pas */
    public function Check_email_exist($data){
        $user = User::where('email', $data)->first();
        if($user === null){
            return false;
        }else{
            return true;
        }
    }

    /**Verification le mot de passe est confirmer */
    public function Check_Password_Validation($password1, $password2){
        if($password1 === $password2){
            return true;
        }else{
            return false;
        }
    }

    /**Verification du numéro de téléphone */
    public function Check_PhoneNumber_Existe($phone){
        $user = User::where('phone', $phone)->first();
        if($user === null){
            return false;
        }else{
            return true;
        }
    }

    /*********************Gestion des administrateurs ************************** */
    /**Home admins */
    public function index(){
        if($this->can_access() == true){
            $countries = Country::get(["name","id"]);
            $users = User::all();
            $allusers = array();
            foreach ($users as $item) {
                $country = Country::where('id', $item->country)->first();
                $city = City::where('id', $item->city)->first();
                $state = State::where('id', $item->state)->first();
                if($item->is_staff == 1){
                    $type = 1;
                }else if($item->is_agent == 1){
                    $type = 2;
                }else if($item->is_admin == 1){
                    $type = 3;
                }else if($item->is_superadmin == 1){
                    $type = 4;
                }else if($item->is_api == 1){
                    $type = 5;
                }
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'country' => $country->name,
                    'countryid' => $country->id,
                    'state' => $state->name,
                    'stateid' => $state->id,
                    'city' => $city->name,
                    'cityid' => $city->id,
                    'address' => $item->address,
                    'type' => $type,
                    'pp' => $item->pp,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allusers, $format_data);
            }
            return view('backend.users', compact('allusers', 'countries'));
            return view('dashboard.users', compact('allusers'));
        }else{
            return view('dashboard.401');
        }  
    }

    /**Create User */
    public function create(Request $request){
        if($this->can_access() == true){

            /**Controle de validation des inputs */
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'password' => 'required',
                'type' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            error_log($validator->fails());
            
            /**initialisation des variables */
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $type = $request->input('type');
            $password = $request->input('password');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $file = $request->file('photo');

            if( $request->hasFile('photo')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();
            }else{
                $extension = '';
                $filename = '';
            }

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else if($this->Check_email_exist($request->input('email')) == true){
                return response()->json([
                    'message' => 'Cette adresse email existe déjà.',
                    'status' => 403
                ]);
            }else if($this->Check_PhoneNumber_Existe($request->input('phone')) == true){
                return response()->json([
                    'message' => 'Un Utilisateur avec ce numéro de téléphone existe déjà.',
                    'status' => 403
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filename.'.'.$extension, File::get($file));

                /**Sauvegarde des donnees */
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->country = $country;
                $user->state = $state;
                $user->city = $city;
                $user->address = $address;
                $user->password = Hash::make($password);
                $user->pp = $filename.'.'.$extension;
                if($type == 1){
                    $user->is_staff = 1;
                }else if($type == 2){
                    $user->is_agent = 1;
                }else if($type == 3){
                    $user->is_admin = 1;
                }else if($type == 4){
                    $user->is_superadmin = 1;
                }else if($type == 5){
                    $user->is_api = 1;
                }
                $user->created_at = $time;
                $user->save();
            }
            return response()->json([
                'message' => 'L\'opération a réussi!',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Une erreur est survenue contacter l\'useristrateur',
                'status' => 500
            ]);
        }
    }

    /**************************Mise a jour des utilisateurs **************************** */
    public function update(Request $request){
        if($this->can_access() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $file = $request->file('photo');
            $type = $request->input('type');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current user object */
            $user = User::where('id', $id)->first();

            if( $request->hasFile('photo')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->delete($user->pp);

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $user->pp = $filename.'.'.$extension;
            }
            if($type == 1){
                $user->is_staff = 1;
            }else if($type == 2){
                $user->is_agent = 1;
            }else if($type == 3){
                $user->is_admin = 1;
            }else if($type == 4){
                $user->is_superadmin = 1;
            }else if($type == 5){
                $user->is_api = 1;
            }
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->country = $country;
            $user->state = $state;
            $user->city = $city;
            $user->address = $address;
            $user->updated_at = $time;
            $user->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des utilisateurs *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $user = User::where('id', $id)->first();
            Storage::disk('public')->delete($user->pp);
            $user->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un utilisateur (Bloquer ou Débloquer) **************************** */
    public function update_status(Request $request){
        if($this->can_access() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $user = User::where('id', $id)->first();
            if($user->is_active == 1){
                $user->is_active = 0;
            }else{
                $user->is_active = 1;
            }
            $user->save();
            $newstatus = $user->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  mot de passe **************************** */
    public function update_password(Request $request){
        if($this->can_access() == true){
            $id = $request->input('id');

            /**get the current admin object */
            $user = User::where('id', $id)->first();
            $password1 = $request->input('password1');
            $password2 = $request->input('password2');
            if($password1 == $password2){
                $user->password = Hash::make($password1);
                $user->save();
                return response()->json([
                    'message' => 'L\opération a réussi!',
                    'status' => 200
                ]);
            }else{
                return response()->json(['message'=>'Les mots de passe sont différents vérifier!', 'status'=> 403]);
            }
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

}
