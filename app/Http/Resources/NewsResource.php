<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\{User, News, Country, Category, Comment, Like};

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $author = User::where('id', $this->author)->first();
        $category = Category::where('id', $this->category)->first();
        $country = Country::where('id', $this->country)->first(); 
        $comments = Comment::where('news', $this->id)->get();
        $connexes = News::where('category', $this->category)->get();
        $count_like = Like::where('news', $this->id)
            ->where('is_like', 1)
            ->count();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'label' => $this->label,
            'description' => $this->description,
            'category' => $category->title,
            'categoryid' => $category->id,
            'country' => $country->name,
            'countryid' => $country->id,
            'author' => $author->name,
            'created_at' => $this->created_at,
            'cover' => $this->cover,
            'video' => $this->video,
            'is_video' => $this->is_video,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments' => $comments,
            'connexes' => $connexes,
            'count_like' => $count_like,
        ];
    }
}
