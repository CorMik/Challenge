<?php

namespace App\Models\Repositories;

use GuzzleHttp\Client as GuzzleClient;

class OffersAPIRepo
{

    /**
     *
     * Get offer from the  offers api.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveOffers(){
        try {
            $guzzleClient = new GuzzleClient(['base_uri'=>config('services.offers_api.uri')]);
            //get offers from web.
            $response = $guzzleClient->get('/b/5fb190ee5be6ec73e94edd2d',['headers'=>['secret-key'=>config('services.offers_api.key')]]);
            $data = json_decode($response->getBody()->getContents(),true);

            return $data;
        }catch (\Exception $ex){
            throw $ex;
        }
    }

}
