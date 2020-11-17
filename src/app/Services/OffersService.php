<?php


namespace App\Services;

use App\Models\Repositories\OffersAPIRepo;
use App\Models\Repositories\OffersRepo;

class OffersService
{
    /**
     * @var OffersRepo
     */
    protected $offersRepo;
    protected $offersApi;

    /**
     * OffersService constructor.
     * @param OffersRepo $offersRepo
     */
    public function __construct(OffersRepo $offersRepo, OffersAPIRepo $offersApi)
    {
        $this->offersRepo = $offersRepo;
        $this->offersApi = $offersApi;
    }

    /**
     * get offers from APi and syn into database.
     */
    public function syncOffers(){

        $data = $this->offersApi->retrieveOffers();
        if($data){
            foreach($data['offers'] as $offer)
            {
                $this->offersRepo->createUpdateOffer($offer, $data['batch_id']);
            }
        }

    }

    /**
     * @return \App\Models\Eloquent\Offers[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getOffers($sortBy = null){

        $sortResults = $this->handleSort($sortBy);
        return $this->offersRepo->getOffers($sortResults['row'],$sortResults['direction']);
    }


    /**
     * @param $sortBy
     * @return string[]
     */
    private function handleSort($sortBy){

        // set row and direction (DESC or ASC) based on sort by value;
        switch ($sortBy){
            case "high-low":
                $sortResults = ['row' => 'cash_back', "direction" => 'DESC' ];
                break;
            case "low-high":
                $sortResults = ['row' => 'cash_back', 'direction' => 'ASC'];
                break;
            case "a-z":
                $sortResults = ['row' => 'name', 'direction' => 'ASC'];
                break;
            case 'z-a':
                $sortResults = ['row' => 'name', 'direction' => 'DESC'];
                break;
            default:
                $sortResults = ['row' => 'id', 'direction' => 'ASC'];
        }
        return $sortResults;
    }



}
