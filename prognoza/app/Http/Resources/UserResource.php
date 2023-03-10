<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
    public static $wrap='meteorolog';


    public function toArray($request)
    {
       
        return [
            'id'=>$this->resource->id,
            'ime'=>$this->resource->name,
            'prezime'=>$this->resource->prezime,
            'email'=>$this->resource->email
        ];
    }
    
}
