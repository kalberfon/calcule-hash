<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HashFullResource extends JsonResource
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
            "batch" => $this->batch,
            "block_number" => $this->block_number,
            "input" => $this->input,
            "output" => $this->output,
            "key" => $this->key,
            "tries" => $this->tries,
        ];
    }
}
