<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\{Program, User};

class PodcastResource extends JsonResource
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
        $currentprogram = Program::where('id', $this->program)->first();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'label' => $this->label,
            'description' => $this->description,
            'program' => $currentprogram->title,
            'programid' => $currentprogram->id,
            'author' => $author->name,
            'created_at' => $this->created_at,
            'cover' => $this->cover,
            'audio' => $this->audio,
            'is_active' => $this->is_active,
            'is_valid' => $this->is_valid,
            'is_sponsoring' => $this->is_sponsoring
        ];
    }
}