<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return [
           
             "type" =>"Verset-du-jour",
             "attributes"=>[
                            "id"  =>$this->id,
                            "book"=>$this->book,
                            "chapter" => $this->chapter,
                            "verse" => $this->verse,
                            "text" => $this->text,
                            "display_at"=> $this->display_at,
                         ]

        ];
    }
}
