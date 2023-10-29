<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\{InterviewResource};
use App\Models\{News, Category, Country, User, Interview, Comment, Like, Program};

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
            Interview::where('is_active', 1)
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

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function one_interview($id)
    {
        $interview = Interview::where('id', $id)->first();
        $author = User::where('id', $interview->author)->first();
        $category = Category::where('id', $interview->category)->first();
        $country = Country::where('id', $interview->country)->first();
        $program = Program::where('id', $interview->program)->first();
        $comments = Comment::where('interview', $interview->id)->get();
        $connexes = Interview::where('category', $interview->category)->get();
        $count_like = Like::where('interview', $interview->id)
            ->where('is_like', 1)
            ->count();
        $data = [
            'id' => $interview->id,
            'title' => $interview->title,
            'label' => $interview->label,
            'description' => $interview->description,
            'category' => $category->title,
            'categoryid' => $category->id,
            'country' => $country->name,
            'countryid' => $country->id,
            'program' => $program->title,
            'programid' => $program->id,
            'author' => $author->name,
            'created_at' => $interview->created_at,
            'cover' => $interview->cover,
            'video' => $interview->video,
            'is_video' => $interview->is_video,
            'is_active' => $interview->is_active,
            'created_at' => $interview->created_at,
            'updated_at' => $interview->updated_at,
            'comments' => $comments,
            'connexes' => $connexes,
            'count_like' => $count_like,
        ];
        $format_data = json_decode(json_encode($data), FALSE);

        return response([ 
            'status' => 200,
            'interview_info' => $format_data,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function interview_category($category)
    {
        $allinterview = Interview::where('category', $category) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $interviewcategory = array();
        foreach ($allinterview as $item) {
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
                'program' => $program->title,
                'programid' => $program->id,
                'author' => $author->name,
                'created_at' => $item->created_at,
                'cover' => $item->cover,
                'video' => $item->video,
                'is_video' => $item->is_video,
                'is_active' => $item->is_active,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($interviewcategory, $format_data);
        }

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
            'interviewcategory' => $interviewcategory,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function interview_country($country)
    {
        $allinterview = Interview::where('country', $country) 
        ->where('is_active', 1)
        ->where('is_valid', 1)
        ->OrderBy('created_at', 'DESC')
        ->paginate(10);

        $interviewcountry = array();
        foreach ($allinterview as $item) {
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
                'program' => $program->title,
                'programid' => $program->id,
                'author' => $author->name,
                'created_at' => $item->created_at,
                'cover' => $item->cover,
                'video' => $item->video,
                'is_video' => $item->is_video,
                'is_active' => $item->is_active,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($interviewcountry, $format_data);
        }

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
            'interviewcountry' => $interviewcountry,
            'message' => 'Opération réussi!',
        ]);
    }
}
