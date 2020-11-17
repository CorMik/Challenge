<?php

namespace App\Models\Repositories;

use App\Models\Eloquent\Offers;

class OffersRepo
{

    /**
     * @param string $row
     * @param string $direction
     * @return mixed
     */
    public function getOffers($row ='id', $direction = 'ASC')
    {
        return Offers::orderBy($row,$direction)->get();
    }

    /**
     * @param $offer
     * @param $batch_id
     * @return mixed
     */
    public function createUpdateOffer($offer, $batch_id)
    {
       $offer = Offers::updateOrCreate(
            ['id'=>$offer['offer_id']],
            ['name'=>$offer['name'],'image_url'=>$offer['image_url'],'cash_back'=> $offer['cash_back'],'batch_id'=>$batch_id]
        );

       return $offer;
    }

}
