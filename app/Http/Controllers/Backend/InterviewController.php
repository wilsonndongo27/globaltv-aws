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
use App\Models\{Country, City, User, State, Company, News, Category, Interview, Program};

class InterviewController extends Controller
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
            $interviews = Interview::orderBy('created_at', 'DESC')->get();
            $allinterview = array();
            foreach ($interviews as $item) {
                $author = User::where('id', $item->author)->first();
                $category = Category::where('id', $item->category)->first();
                $country = Country::where('id', $item->country)->first();
                $program = Program::where('id', $item->program)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'category' => $category->title,
                    'categoryid' => $category->id,
                    'country' => $country->name,
                    'countryid' => $country->id,
                    'program' => $program->title,
                    'programid' => $program->id,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'video' => $item->video,
                    'is_video' => $item->is_video,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid,
                    'priority' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allinterview, $format_data);
            }
            $data['allinterview'] = $allinterview;
            $data['allcountry'] = Country::all();
            $data['allcategory'] = Category::where('is_active', 1)->get();
            $data['allprogram'] = Program::where('is_active', 1)->get();
            return view('backend.interview', $data);
        }else{
            return view('backend.403');
        }
    }

    /**Create Interview */
    public function create(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'label' => 'required',
                'description' => 'required',
                'category' => 'required',
                'country' => 'required',
                'program' => 'required',
                'cover' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $author = $request->input('author');
            $category = $request->input('category');
            $country = $request->input('country');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $cover = $request->file('cover');
            $video = $request->file('video');
            $priority = $request->input('priority');
            $program = $request->input('program');

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                /**Sauvegarde des donnees */
                $interview = new Interview();
                $interview->title = $title;
                $interview->label = $label;
                $interview->description = $description;
                $interview->author = $author;
                $interview->category = $category;
                $interview->country = $country;
                $interview->program = $program;
                $interview->priority = $priority;
                $interview->cover = $filename.'.'.$extension;
                Storage::disk('public')->put($filename.'.'.$extension, File::get($cover));
                if($request->hasFile('video')){
                    $videoextension = strtolower($video->getClientOriginalExtension());
                    $videofilename = $video->getClientOriginalName();

                    Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                    
                    $interview->video = $videofilename.'.'.$videoextension;
                    $interview->is_video = 1;
                }
                $interview->created_at = $time;
                $interview->updated_at = $time;
                $interview->save();
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

    /**************************Mise a jour des Interviews **************************** */
    public function update(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $category = $request->input('category');
            $country = $request->input('country');
            $cover = $request->file('cover');
            $video = $request->file('video');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $priority = $request->input('priority');
            $program = $request->input('program');

            /**get the current news object */
            $interview = interview::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($interview->cover);

                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($cover));
                
                $interview->cover = $filename.'.'.$extension;
            }
            
            if($request->hasFile('video')){
                $videoextension = strtolower($video->getClientOriginalExtension());
                $videofilename = $video->getClientOriginalName();

                if( $interview->video ){
                    //code for remove old file
                    Storage::disk('public')->delete($interview->video);
                }

                Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                
                $interview->video = $videofilename.'.'.$videoextension;
                $interview->is_video = 1;
            }

            $interview->title = $title;
            $interview->label = $label;
            $interview->description = $description;
            $interview->category = $category;
            $interview->country = $country;
            $interview->program = $program;
            $interview->priority = $priority;
            $interview->updated_at = $time;
            $interview->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des Interviews *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $interview = Interview::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($interview->cover);
            if( $interview->video ){
                Storage::disk('public')->delete($interview->video);
            }
            // delete object
            $interview->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une INterview (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $interview = Interview::where('id', $id)->first();
            if($interview->is_active == 1){
                $interview->is_active = 0;
            }else{
                $interview->is_active = 1;
            }
            $interview->save();
            $newstatus = $interview->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

       
    /**************************Mise a jour des validations des Interviews (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $interview = Interview::where('id', $id)->first();
            if($interview->is_valid == 1){
                $interview->is_valid = 0;
                $interview->valid_by = null;
            }else{
                $interview->is_valid = 1;
                $interview->valid_by = Auth::user()->id;
            }
            $interview->save();
            $newstatus = $interview->is_valid;
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
