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
use App\Models\{Country, City, User, State, Company, Program};

class ProgramController extends Controller
{
    /**Verificateur d'accès superadmin  */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1  &&  Auth::user()->is_active == 1 ){
            return true;
        }else{
            return false;
        }
    }

    /**Verificateur d'accès admins  */
    public function can_access_admin(){
        if(Auth::check() && Auth::user()->is_admin == 1  &&  Auth::user()->is_active == 1 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $programs = Program::orderBy('created_at', 'DESC')->get();
            $allprogram = array();
            foreach ($programs as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'day' => $item->day,
                    'date' => $item->date,
                    'time_start' => $item->time_start,
                    'time_end' => $item->time_end,
                    'description' => $item->description,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allprogram, $format_data);
            }
            $data['allprogram'] = $allprogram;
            return view('backend.program', $data);
        }else{
            return view('backend.403');
        }
    }

    /**Create Actualités */
    public function create(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'description' => 'required',
                'date' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
                'day' => 'required',
                'cover' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $description = $request->input('description');
            $author = $request->input('author');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');
            $date = $request->input('date');
            $day = $request->input('day');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');

            $day_string = '';

            foreach($day as $item){
                $day_string .= $item.', ';
            }
            $day_data = substr($day_string,0,-1);

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();
                Storage::disk('public')->put($filename.'.'.$extension, File::get($cover));

                /**Sauvegarde des donnees */
                $program = new Program();
                $program->title = $title;
                $program->description = $description;
                $program->author = $author;
                $program->date = $date;
                $program->time_start = $time_start;
                $program->time_end = $time_end;
                $program->day = $day_data;
                $program->cover = $filename.'.'.$extension;
                $program->created_at = $time;
                $program->updated_at = $time;
                $program->save();
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

    /**************************Mise a jour des actualités **************************** */
    public function update(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);

            /**initialisation des variables */
            $id = $request->input('id');
            $title = $request->input('title');
            $description = $request->input('description');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');
            $date = $request->input('date');
            $day = $request->input('day');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');

            /**get the current program object */
            $program = Program::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($program->cover);

                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($cover));
                
                $program->cover = $filename.'.'.$extension;
            }
            
            if($request->input('day')){

                $day_string = '';

                foreach($day as $item){
                    $day_string .= $item.', ';
                }
                $day_data = substr($day_string,0,-1);

                $program->day = $day_data;
            }

            $program->title = $title;
            $program->description = $description;
            $program->date = $date;
            $program->time_start = $time_start;
            $program->time_end = $time_end;
            $program->created_at = $time;
            $program->updated_at = $time;
            $program->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des programmes *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $program = Program::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($program->cover);
            // delete object
            $program->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un programme (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $program = Program::where('id', $id)->first();
            if($program->is_active == 1){
                $program->is_active = 0;
            }else{
                $program->is_active = 1;
            }
            $program->save();
            $newstatus = $program->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    
    /**************************Mise a jour des validations des programmes (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $program = Program::where('id', $id)->first();
            if($program->is_valid == 1){
                $program->is_valid = 0;
                $program->valid_by = null;
            }else{
                $program->is_valid = 1;
                $program->valid_by = Auth::user()->id;
            }
            $program->save();
            $newstatus = $program->is_valid;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }
}
