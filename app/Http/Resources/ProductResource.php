<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => (float) $this->price,
            'category'    => [
                'id'   => $this->whenLoaded('category', fn() => $this->category->id),
                'name' => $this->whenLoaded('category', fn() => $this->category->name),
            ],
            'owner'       => [
                'id'   => $this->whenLoaded('user', fn() => $this->user->id),
                'name' => $this->whenLoaded('user', fn() => $this->user->name),
            ],
            'created_at'  => $this->created_at?->toISOString(),
            'updated_at'  => $this->updated_at?->toISOString(),
        ];
    }
}
