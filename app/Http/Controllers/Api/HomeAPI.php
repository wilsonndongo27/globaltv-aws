<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\{ReplayResource, NewsResource, BannerResource, ProgramResource, PodcastResource, StreamResource, InterviewResource};
use App\Models\{Replay, Program, Banner, Podcast, Stream, News, Category, Interview};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allbanner = BannerResource::collection(
            Banner::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allnews = NewsResource::collection(
            News::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allprogram = ProgramResource::collection(
            Program::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allreplay = ReplayResource::collection(
            Replay::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allpodcast = PodcastResource::collection(
            Podcast::where('is_active', 1)
            ->where('is_sponsoring', 0) 
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allstream = StreamResource::collection(
            Stream::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allinterview = InterviewResource::collection(
            Interview::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $alltopnews = NewsResource::collection(
            News::where('is_active', 1)
            ->where('is_valid', 1)
            ->where('priority', 3)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        return response([ 
            'status' => 200,
            'allbanner' => $allbanner,
            'allprogram' => $allprogram,
            'allreplay' => $allreplay,
            'allpodcast' => $allpodcast,
            'allstream' => $allstream,
            'allnews' => $allnews,
            'alltopnews' => $alltopnews,
            'allinterview' => $allinterview,
            'message' => 'Opération réussi!',
        ]);
    }
}
