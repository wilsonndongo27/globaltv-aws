<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{ProgramResource};
use App\Models\{News, Category, Country, Program};

class ProgramAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allprogram = ProgramResource::collection(
            Program::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allprogram->nextPageUrl();
        $previouspage = $allprogram->previousPageUrl();
        $page = $allprogram->currentPage();
        $isfirstpage = $allprogram->onFirstPage();
        $hasmorepage = $allprogram->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allprogram' => $allprogram,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function one_program($id)
    {
        $program = Program::where('id', $id)->first();
        $author = User::where('id', $replay->author)->first();
        $data = [
            'id' => $program->id,
            'title' => $program->title,
            'description' => $program->description,
            'time_start' => $program->time_start,
            'time_end' => $program->time_end,
            'day' => $program->day,
            'date' => $program->date,
            'cover' => $program->cover,
            'author' => $author->name,
            'created_at' => $program->created_at,
            'is_active' => $program->is_active,
            'is_valid' => $program->is_valid,
        ];
        $format_data = json_decode(json_encode($data), FALSE);

        return response([ 
            'status' => 200,
            'program_info' => $format_data,
            'message' => 'Opération réussi!',
        ]);
    }
    
}
