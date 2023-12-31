<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{BannerResource};
use App\Models\{Banner};

class BannerAPI extends Controller
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
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allbanner->nextPageUrl();
        $previouspage = $allbanner->previousPageUrl();
        $page = $allbanner->currentPage();
        $isfirstpage = $allbanner->onFirstPage();
        $hasmorepage = $allbanner->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allbanner' => $allbanner,
            'message' => 'Opération réussi!'
        ]);
    }

}
