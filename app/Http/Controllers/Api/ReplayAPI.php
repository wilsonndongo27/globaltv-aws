<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{ReplayResource};
use App\Models\{Replay, User, Comment, Like, Program};

class ReplayAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allreplay = ReplayResource::collection(
            Replay::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        /**Manage Pagination */
        $nextpage = $allreplay->nextPageUrl();
        $previouspage = $allreplay->previousPageUrl();
        $page = $allreplay->currentPage();
        $isfirstpage = $allreplay->onFirstPage();
        $hasmorepage = $allreplay->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allreplay' => $allreplay,
            'message' => 'Opération réussi!',
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function one_replay($id)
    {
        $replay = Replay::where('id', $id)->first();
        $author = User::where('id', $replay->author)->first();
        $currentprogram = Program::where('id', $replay->program)->first();
        $comments = Comment::where('replay', $replay->id)->get();
        $connexes = Replay::where('program', $replay->program)->get();
        $count_like = Like::where('replay', $replay->id)
            ->where('is_like', 1)
            ->count();
        $data = [
            'id' => $replay->id,
            'title' => $replay->title,
            'description' => $replay->description,
            'program' => $currentprogram->title,
            'programid' => $currentprogram->id,
            'author' => $author->name,
            'created_at' => $replay->created_at,
            'cover' => $replay->cover,
            'video' => $replay->video,
            'is_active' => $replay->is_active,
            'is_valid' => $replay->is_valid,
            'comments' => $comments,
            'connexes' => $connexes,
            'count_like' => $count_like,
        ];
        $format_data = json_decode(json_encode($data), FALSE);

        return response([ 
            'status' => 200,
            'replay_info' => $format_data,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function replay_program($program)
    {
        $allreplay = Replay::where('program', $program) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $replayprogram = array();
        foreach ($allreplay as $item) {
            $author = User::where('id', $item->author)->first();
            $currentprogram = Program::where('id', $program)->first();
            $data = [
                'id' => $item->id,
                'title' => $item->title,
                'label' => $item->label,
                'description' => $item->description,
                'program' => $currentprogram->title,
                'programid' => $currentprogram->id,
                'author' => $author->name,
                'created_at' => $item->created_at,
                'cover' => $item->cover,
                'video' => $item->video,
                'is_active' => $item->is_active,
                'is_valid' => $item->is_valid
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($replayprogram, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allreplay->nextPageUrl();
        $previouspage = $allreplay->previousPageUrl();
        $page = $allreplay->currentPage();
        $isfirstpage = $allreplay->onFirstPage();
        $hasmorepage = $allreplay->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'replayprogram' => $replayprogram,
            'message' => 'Opération réussi!',
        ]);
    }
}
