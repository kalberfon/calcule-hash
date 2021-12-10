<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HashCollection extends ResourceCollection
{
    public $collects = HashFullResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'result' => $this->collection,
            "pagination" => [
                "total" => $this->total(),
                "page" => $this->currentPage(),
                "last_page" => $this->lastPage()
            ]
        ];
    }
}
