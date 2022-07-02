<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable 'title','date','lieu',
     */
    public function toArray($request)
    {

       return [
           
             "id" => (string) $this->id,
             "type" =>"Post",
             "attributes"=>[
                            
                           // "user" => UserResource::make($this->user),
                            "user" => $this->user,
                            "message"=>$this->message,
                            "image" => $this->image,
                            "video" => $this->video,
                            "title" => $this->title,
                            "date" => $this->date,
                            "lieu" => $this->lieu,
                            "status" => $this->status,
                            "menu"=> $this->menu,
                            "likes" => $this->likes,
                            "comments" => CommentaireResource::collection($this->comments),
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
