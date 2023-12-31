<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{BannerResource, NewsResource};
use App\Models\{News, Category, Country, User, Comment, Like};

class NewsAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allnews = NewsResource::collection(
            News::where('is_active', 1)
            ->where('is_valid', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allnews->nextPageUrl();
        $previouspage = $allnews->previousPageUrl();
        $page = $allnews->currentPage();
        $isfirstpage = $allnews->onFirstPage();
        $hasmorepage = $allnews->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allnews' => $allnews,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function one_news($id)
    {
        $news = News::where('id', $id)->first();
        $author = User::where('id', $news->author)->first();
        $category = Category::where('id', $news->category)->first();
        $country = Country::where('id', $news->country)->first();
        $comments = Comment::where('news', $news->id)->get();
        $connexes = News::where('category', $news->category)->get();
        $count_like = Like::where('news', $news->id)
            ->where('is_like', 1)
            ->count();
        $data = [
            'id' => $news->id,
            'title' => $news->title,
            'label' => $news->label,
            'description' => $news->description,
            'category' => $category->title,
            'categoryid' => $category->id,
            'country' => $country->name,
            'countryid' => $country->id,
            'author' => $author->name,
            'priority' => $news->priority,
            'created_at' => $news->created_at,
            'cover' => $news->cover,
            'video' => $news->video,
            'is_video' => $news->is_video,
            'is_active' => $news->is_active,
            'is_valid' => $news->is_valid,
            'comments' => $comments,
            'connexes' => $connexes,
            'count_like' => $count_like,
        ];
        $format_data = json_decode(json_encode($data), FALSE);

        return response([ 
            'status' => 200,
            'news_info' => $format_data,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function news_category($category)
    {
        $allnews = News::where('category', $category) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $newscategory = array();
        foreach ($allnews as $item) {
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
            array_push($newscategory, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allnews->nextPageUrl();
        $previouspage = $allnews->previousPageUrl();
        $page = $allnews->currentPage();
        $isfirstpage = $allnews->onFirstPage();
        $hasmorepage = $allnews->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'newscategory' => $newscategory,
            'message' => 'Opération réussi!',
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function news_country($country)
    {
        $allnews = News::where('country', $country)
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);
        $newscountry = array();
        foreach ($allnews as $item) {
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
            array_push($newscountry, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allnews->nextPageUrl();
        $previouspage = $allnews->previousPageUrl();
        $page = $allnews->currentPage();
        $isfirstpage = $allnews->onFirstPage();
        $hasmorepage = $allnews->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'newscountry' => $newscountry,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function news_priority($priority)
    {
        $allnews = News::where('priority', $priority)
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);
        $newspriority = array();
        foreach ($allnews as $item) {
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
            array_push($newspriority, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allnews->nextPageUrl();
        $previouspage = $allnews->previousPageUrl();
        $page = $allnews->currentPage();
        $isfirstpage = $allnews->onFirstPage();
        $hasmorepage = $allnews->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'newspriority' => $newspriority,
            'message' => 'Opération réussi!',
        ]);
    }

    
}
