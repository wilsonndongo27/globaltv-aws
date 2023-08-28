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
use App\Models\{Country, City, User, State, Company, News, Replay, Program};

class ReplayController extends Controller
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
            $replays = Replay::orderBy('created_at', 'DESC')->get();
            $allreplay = array();
            foreach ($replays as $item) {
                $author = User::where('id', $item->author)->first();
                $program = Program::where('id', $item->program)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'author' => $author->name,
                    'program' => $program->title,
                    'programid' => $program->id,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'video' => $item->video,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allreplay, $format_data);
            }
            $data['allreplay'] = $allreplay;
            $data['allprogram'] = Program::where('is_active', 1)->get();
            return view('backend.replay', $data);
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
                'program' => 'required',
                'description' => 'required',
                'cover' => 'required',
                'author' => 'required',
                'video' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $program = $request->input('program');
            $description = $request->input('description');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');
            $video = $request->file('video');

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                /**Enregistrement de la video */
                $videoextension = strtolower($video->getClientOriginalExtension());
                $videofilename = $video->getClientOriginalName();

                /**Sauvegarde des donnees */
                $replay = new Replay();
                $replay->title = $title;
                $replay->program = $program;
                $replay->description = $description;
                $replay->author = $author;
                $replay->cover = $filename.'.'.$extension;
                Storage::disk('public')->put($filename.'.'.$extension, File::get($cover));
                $replay->video = $videofilename.'.'.$videoextension;
                Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                $replay->created_at = $time;
                $replay->updated_at = $time;
                $replay->save();
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

    /**************************Mise a jour des Replay **************************** */
    public function update(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            /**initialisation des variables */
            $id = $request->input('id');
            $title = $request->input('title');
            $program = $request->input('program');
            $description = $request->input('description');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');
            $video = $request->file('video');

            /**get the current news object */
            $replay = Replay::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($replay->cover);

                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                $replay->cover = $filename.'.'.$extension;
                Storage::disk('public')->put($filename.'.'.$extension,  File::get($cover));
            }
            
            if($request->hasFile('video')){
                $videoextension = strtolower($video->getClientOriginalExtension());
                $videofilename = $video->getClientOriginalName();

                Storage::disk('public')->delete($replay->video);

                $replay->video = $videofilename.'.'.$videoextension;
                Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
            }

            /**Sauvegarde des donnees */
            $replay->title = $title;
            $replay->program = $program;
            $replay->description = $description;
            $replay->created_at = $time;
            $replay->updated_at = $time;
            $replay->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des Replay *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $replay = Replay::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($replay->cover);
            Storage::disk('public')->delete($replay->video);
            // delete object
            $replay->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une Replay (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $replay = Replay::where('id', $id)->first();
            if($replay->is_active == 1){
                $replay->is_active = 0;
            }else{
                $replay->is_active = 1;
            }
            $replay->save();
            $newstatus = $replay->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

       
    /**************************Mise a jour des validations des replay (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $replay = Replay::where('id', $id)->first();
            if($replay->is_valid == 1){
                $replay->is_valid = 0;
                $replay->valid_by = null;
            }else{
                $replay->is_valid = 1;
                $replay->valid_by = Auth::user()->id;
            }
            $replay->save();
            $newstatus = $replay->is_valid;
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
