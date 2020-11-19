<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BenefitResource;
use App\Models\Benefit;

class BenefitController extends Controller
{
    public function __construct() {
        BenefitResource::withoutWrapping();
    }

    public function index() 
    {
        $benefits = Benefit::all();
        return BenefitResource::collection($benefits);
    }
}
