<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
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
            'isActivePlan' => false,
            'freeShippingFrom' => $this->free_shipping_from,
            'planCardImage' => "",
            'img' => $this->img,
            'name' => $this->name,
            'description' => $this->description,
            'resubscribePeriod' => optional($this->period)->period,
            'cost' => self::getBenefitsCost($this->benefits),
            'benefits' => BenefitResource::collection($this->benefits),
            'products' => ProductResource::collection($this->products)
        ];
    }

    public static function getBenefitsCost($benfits){
        return $benfits->sum('cost');
    }
}
