<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\{InterviewResource};
use App\Models\{News, Category, Country, User, Interview};

class InterviewAPI extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allinterview = InterviewResource::collection(
            News::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allinterview->nextPageUrl();
        $previouspage = $allinterview->previousPageUrl();
        $page = $allinterview->currentPage();
        $isfirstpage = $allinterview->onFirstPage();
        $hasmorepage = $allinterview->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allinterview' => $allinterview,
            'message' => 'Opération réussi!',
        ]);
    }
}
