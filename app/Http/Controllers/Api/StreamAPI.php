<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{StreamResource};
use App\Models\{News, Category, Country, User, Stream};

class StreamAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $alllive = StreamResource::collection(
            Stream::where('is_active', 1)
            ->where('is_valid', 1)
            ->paginate(10)
        );
        return response([ 
            'status' => 200,
            'alllive' => $alllive,
            'message' => 'Opération réussi!',
        ]);
    }
}
