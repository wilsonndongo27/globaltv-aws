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
use App\Models\{Country, City, User, State, Company, News, Category};

class NewsController extends Controller
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
            $news = News::all();
            $allnews = array();
            foreach ($news as $item) {
                $author = User::where('id', $item->author)->first();
                $category = Category::where('id', $item->category)->first();
                $country = Country::where('id', $item->country)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'category' => $category->title,
                    'categoryid' => $category->id,
                    'country' => $country->name,
                    'countryid' => $country->id,
                    'author' => $author->name,
                    'priority' => $item->priority,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'video' => $item->video,
                    'is_video' => $item->is_video,
                    'is_active' => $item->is_active,
                    'is_valid' => $item->is_valid
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allnews, $format_data);
            }
            $data['allnews'] = $allnews;
            $data['allcountry'] = Country::all();
            $data['allcategory'] = Category::all();
            return view('backend.news', $data);
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
                'label' => 'required',
                'description' => 'required',
                'category' => 'required',
                'country' => 'required',
                'cover' => 'required',
                'author' => 'required',
                'priority' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $author = $request->input('author');
            $category = $request->input('category');
            $country = $request->input('country');
            $priority = $request->input('priority');
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
                Storage::disk('public')->put($filename.'.'.$extension, File::get($cover));

                /**Sauvegarde des donnees */
                $news = new News();
                $news->title = $title;
                $news->label = $label;
                $news->description = $description;
                $news->author = $author;
                $news->category = $category;
                $news->country = $country;
                $news->priority = $priority;
                $news->cover = $filename.'.'.$extension;
                if($request->hasFile('video')){
                    $videoextension = strtolower($video->getClientOriginalExtension());
                    $videofilename = $video->getClientOriginalName();

                    Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                    
                    $news->video = $videofilename.'.'.$videoextension;
                    $news->is_video = 1;
                }
                $news->created_at = $time;
                $news->updated_at = $time;
                $news->save();
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

            /**get the current news object */
            $news = News::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($news->cover);

                $extension = strtolower($cover->getClientOriginalExtension());
                $filename = $cover->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($cover));
                
                $news->cover = $filename.'.'.$extension;
            }
            
            if($request->hasFile('video')){
                $videoextension = strtolower($video->getClientOriginalExtension());
                $videofilename = $video->getClientOriginalName();

                if( $news->video ){
                    //code for remove old file
                    Storage::disk('public')->delete($news->video);
                }

                Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                
                $news->video = $videofilename.'.'.$videoextension;
                $news->is_video = 1;
            }

            $news->title = $title;
            $news->label = $label;
            $news->description = $description;
            $news->category = $category;
            $news->country = $country;
            $news->priority = $priority;
            $news->updated_at = $time;
            $news->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des actualités *************** */
    public function delete(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $news = News::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($news->cover);
            if( $news->video ){
                Storage::disk('public')->delete($news->video);
            }
            // delete object
            $news->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une Actualités (Bloquer ou Débloquer) **************************** */
    public function status(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $news = News::where('id', $id)->first();
            if($news->is_active == 1){
                $news->is_active = 0;
            }else{
                $news->is_active = 1;
            }
            $news->save();
            $newstatus = $news->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

       
    /**************************Mise a jour des validations des actualités (valider ou bloquer) **************************** */
    public function validation(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current object */
            $news = News::where('id', $id)->first();
            if($news->is_valid == 1){
                $news->is_valid = 0;
                $news->valid_by = null;
            }else{
                $news->is_valid = 1;
                $news->valid_by = Auth::user()->id;
            }
            $news->save();
            $newstatus = $news->is_valid;
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
