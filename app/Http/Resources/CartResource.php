<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'session_id' => $this->session_id,
            'items_count' => $this->items_count,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Inclure les éléments du panier avec leur produit associé
            'items' => CartItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
