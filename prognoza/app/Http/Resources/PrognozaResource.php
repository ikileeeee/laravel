<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrognozaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='prognoza';
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'datum'=>$this->resource->dan,
            'temperatura'=>$this->resource->temperatura,
            'pojava'=>$this->resource->pojava,
            'za region'=>new RegionResource($this->resource->region),
            'meteorolog'=> new UserResource($this->resource->user)
            
        ];
    }
}
