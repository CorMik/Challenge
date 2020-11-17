<?php

namespace App\Http\Controllers;

use App\Services\OffersService;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    protected $offersService;

    public function __construct(OffersService $offersService)
    {
        $this->offersService = $offersService;
    }

    public function getOffers(Request $request)
    {
        $sortBy = $request->get('sortBy');
        $offers = $this->offersService->getOffers($sortBy);

        if($offers){
            return response()->json(['success'=>true,'offers'=>$offers]);
        }

        return response()->json(['success'=>false,"message"=>'Could not fine offers']);

    }
}
