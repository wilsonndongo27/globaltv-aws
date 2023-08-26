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
use App\Models\{Country, City, User, State, Company, News, Replay, Program, Podcast};

class PodcastController extends Controller
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
            $podcasts = Podcast::all();
            $allpodcast = array();
            foreach ($podcasts as $item) {
                $author = User::where('id', $item->author)->first();
                $program = Program::where('id', $item->program)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'author' => $author->name,
                    'program' => $program->title,
                    'programid' => $program->id,
                    'is_sponsoring' => $item->is_sponsoring,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'audio' => $item->audio,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allpodcast, $format_data);
            }
            $data['allpodcast'] = $allpodcast;
            $data['allprogram'] = Program::where('is_active', 1)->get();
            return view('backend.podcast', $data);
        }else{
            return view('backend.403');
        }
    }

    /**Create Podcast */
    public function create(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'program' => 'required',
                'description' => 'required',
                'cover' => 'required',
                'author' => 'required',
                'audio' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $program = $request->input('program');
            $description = $request->input('description');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');
            $audio = $request->file('audio');

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                /**Enregistrement de la audio */
                $audioextension = strtolower($audio->getClientOriginalExtension());
                $audiofilename = $audio->getClientOriginalName();

                /**Sauvegarde des donnees */
                $podcast = new Podcast();
                $podcast->title = $title;
                $podcast->program = $program;
                $podcast->description = $description;
                $podcast->author = $author;
                $podcast->cover = $filename.'.'.$extension;
                Storage::disk('public')->put($filename.'.'.$extension, File::get($cover));
                $podcast->audio = $audiofilename.'.'.$audioextension;
                Storage::disk('public')->put($audiofilename.'.'.$audioextension,  File::get($audio));
                $podcast->created_at = $time;
                $podcast->updated_at = $time;
                $podcast->save();
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

    /**************************Mise a jour des Podcast **************************** */
    public function update(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            /**initialisation des variables */
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $program = $request->input('program');
            $description = $request->input('description');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');
            $audio = $request->file('audio');

            /**get the current object */
            $podcast = Podcast::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($podcast->cover);

                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                $podcast->cover = $filename.'.'.$extension;
                Storage::disk('public')->put($filename.'.'.$extension,  File::get($cover));
            }
            
            if($request->hasFile('audio')){
                $audioextension = strtolower($audio->getClientOriginalExtension());
                $audiofilename = $audio->getClientOriginalName();

                Storage::disk('public')->delete($podcast->audio);

                $podcast->audio = $audiofilename.'.'.$audioextension;
                Storage::disk('public')->put($audiofilename.'.'.$audioextension,  File::get($audio));
            }

            /**Sauvegarde des donnees */
            $podcast->title = $title;
            $podcast->label = $label;
            $podcast->program = $program;
            $podcast->description = $description;
            $podcast->created_at = $time;
            $podcast->updated_at = $time;
            $podcast->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /***************suppression des Podcast *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $podcast = podcast::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($podcast->cover);
            Storage::disk('public')->delete($podcast->audio);
            // delete object
            $podcast->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une Podcast (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $podcast = Podcast::where('id', $id)->first();
            if($podcast->is_active == 1){
                $podcast->is_active = 0;
            }else{
                $podcast->is_active = 1;
            }
            $podcast->save();
            $newstatus = $podcast->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

       
    /**************************Mise a jour des validations des podcast (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $podcast = Podcast::where('id', $id)->first();
            if($podcast->is_valid == 1){
                $podcast->is_valid = 0;
                $podcast->valid_by = null;
            }else{
                $podcast->is_valid = 1;
                $podcast->valid_by = Auth::user()->id;
            }
            $podcast->save();
            $newstatus = $podcast->is_valid;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

         
    /**************************Sponsoring  **************************** */
    public function sponsoring(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            $advertizing = $request->input('advertizing');
            /**get the current object */
            $podcast = Podcast::where('id', $id)->first();
            if($podcast->is_sponsoring == 1){
                $podcast->is_sponsoring = 0;
                $podcast->advertizing = null;
            }else{
                $podcast->is_sponsoring = 1;
                $podcast->advertizing = $advertizing;
            }
            $podcast->save();
            $newstatus = $podcast->is_sponsoring;
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
