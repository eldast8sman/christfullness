<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'filepath' => $this->filepath,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created,
            'updated_at' => $this->updated,
            'messages' => MessageResorce::collection($this->messages)
        ];
    }
}
