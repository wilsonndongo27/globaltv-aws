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
use App\Models\{Country, City, User, State, Company, Stream};

class StreamController extends Controller
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
            $streams = Stream::all();
            $allstream = array();
            foreach ($streams as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'link' => $item->link,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allstream, $format_data);
            }
            return view('backend.stream', compact('allstream'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Flux */
    public function create(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'description' => 'required',
                'link' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $description = $request->input('description');
            $link = $request->input('link');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Sauvegarde des donnees */
                $qtream = new Stream();
                $qtream->title = $title;
                $qtream->link = $link;
                $qtream->description = $description;
                $qtream->author = $author;
                $qtream->created_at = $time;
                $qtream->updated_at = $time;
                $qtream->save();
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

    /**************************Mise a jour des Flux **************************** */
    public function update(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $link = $request->input('link');
            $description = $request->input('description');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current stream object */
            $stream = Stream::where('id', $id)->first();
            $stream->title = $title;
            $stream->link = $link;
            $stream->description = $description;
            $stream->updated_at = $time;
            $stream->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des flux *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $stream = Stream::where('id', $id)->first();
            // delete object
            $stream->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une flux (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current stream object */
            $stream = Stream::where('id', $id)->first();
            if($stream->is_active == 1){
                $stream->is_active = 0;
            }else{
                $stream->is_active = 1;
            }
            $stream->save();
            $newstatus = $stream->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour des validations des flux (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current stream object */
            $stream = Stream::where('id', $id)->first();
            if($stream->is_valid == 1){
                $stream->is_valid = 0;
                $stream->valid_by = null;
            }else{
                $stream->is_valid = 1;
                $stream->valid_by = Auth::user()->id;
            }
            $stream->save();
            $newstatus = $stream->is_valid;
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
