<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\ReceiveOption;
use App\Http\Resources\BoxResource;

class BoxController extends Controller
{
    public function __construct() {
        BoxResource::withoutWrapping();
    }

    public function index()
    {
        $boxes = Box::with(['benefits', 'products'])->get();
        return BoxResource::collection($boxes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'boxId' => 'required|numeric',
            'benefitIds' => 'required|array',
            'products' => 'required|array',
            'resubscribePeriod' => 'required|string',
        ]);

        $boxOrigin = Box::find($request->boxId);
        $periodId = ReceiveOption::where('period', $request->resubscribePeriod)->pluck('id')->first();

        $box = new Box();
        $box->name = $boxOrigin->name;
        $box->description = $boxOrigin->description;
        $box->img = $boxOrigin->img;
        $box->is_custom = 1;
        $box->resubscribe_period = $periodId;
        $box->user_id = auth()->id();
        $box->free_shipping_from = $boxOrigin->free_shipping_from;
        $box->save();

        $box->benefits()->sync($request->benefitIds);

        foreach($request->products as $product) {
            $box->products()->attach([$product['id'] => ['count' => $product['count']]]);
        }

        return new BoxResource($box);
    }

    public function custom(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'benefitIds' => 'required|array',
            'products' => 'required|array',
            'resubscribePeriod' => 'required|string',
        ]);

        $periodId = ReceiveOption::where('period', $request->resubscribePeriod)->pluck('id')->first();

        $box = new Box();
        $box->name = $request->name;
        $box->description = $request->description;
        $box->is_custom = 1;
        $box->img = '0.svg';
        $box->resubscribe_period = $periodId;
        $box->user_id = auth()->id();
        $box->free_shipping_from = 900;
        $box->save();

        $box->benefits()->sync($request->benefitIds);

        foreach($request->products as $product) {
            $box->products()->attach([$product['id'] => ['count' => $product['count']]]);
        }

        return new BoxResource($box);
    }
}
