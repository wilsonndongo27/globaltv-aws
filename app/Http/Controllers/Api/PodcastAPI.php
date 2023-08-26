<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{PodcastResource};
use App\Models\{Podcast, Program, User};

class PodcastAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allpodcast = PodcastResource::collection(
            Podcast::where('is_active', 1)
            ->where('is_valid', 1)
            ->where('is_sponsoring', 0) 
            ->OrderBy('created_at', 'DESC')
            ->paginate(10)
        );

        
        /**Manage Pagination */
        $nextpage = $allpodcast->nextPageUrl();
        $previouspage = $allpodcast->previousPageUrl();
        $page = $allpodcast->currentPage();
        $isfirstpage = $allpodcast->onFirstPage();
        $hasmorepage = $allpodcast->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allpodcast' => $allpodcast,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function podcast_program($program)
    {
        $allpodcast = Podcast::where('program', $program) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $podcastprogram = array();
        foreach ($allpodcast as $item) {
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
                'audio' => $item->audio,
                'is_active' => $item->is_active,
                'is_valid' => $item->is_valid
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($podcastprogram, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allpodcast->nextPageUrl();
        $previouspage = $allpodcast->previousPageUrl();
        $page = $allpodcast->currentPage();
        $isfirstpage = $allpodcast->onFirstPage();
        $hasmorepage = $allpodcast->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'podcastprogram' => $podcastprogram,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function podcast_sponsoring()
    {
        $allpodcast = Podcast::where('is_sponsoring', 1) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $podcastsponsoring = array();
        foreach ($allpodcast as $item) {
            $author = User::where('id', $item->author)->first();
            $currentprogram = Program::where('id', $item->program)->first();
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
                'audio' => $item->audio,
                'is_active' => $item->is_active,
                'is_valid' => $item->is_valid
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($podcastsponsoring, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allpodcast->nextPageUrl();
        $previouspage = $allpodcast->previousPageUrl();
        $page = $allpodcast->currentPage();
        $isfirstpage = $allpodcast->onFirstPage();
        $hasmorepage = $allpodcast->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'podcastsponsoring' => $podcastsponsoring,
            'message' => 'Opération réussi!',
        ]);
    }
}
