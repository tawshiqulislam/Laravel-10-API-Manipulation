<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "Color" => $this->getPropertyValues("Color"),
            "Size" => $this->getPropertyValues("Size"),
            "Product Category" => $this->getPropertyValues("Product Category"),
            "Depth" => $this->getPropertyValues("Depth"),
            "Applicable age" => $this->getPropertyValues("Applicable age"),
            "Appropriate season" => $this->getPropertyValues("Appropriate season"),
            "Popular elements" => $this->getPropertyValues("Popular elements"),
            "Place of origin" => $this->getPropertyValues("Place of origin"),
            "Style" => $this->getPropertyValues("Style"),
        ];
    }

    private function getPropertyValues($propertyName)
    {
        return collect($this->resource)->where("PropertyName", $propertyName)->pluck("Value")->toArray();
    }
}
