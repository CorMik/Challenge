<?php
namespace Tests\Unit\Repositories;

use App\Models\Repositories\OffersRepo;
use Tests\NeedsOfferData;
use App\Models\Eloquent\Offers;

class OffersRepoTest extends NeedsOfferData
{

    private $offersRepo;


    public function setUp() :void
    {
        parent::setUp();
        $this->offersRepo = app(OffersRepo::class);
    }

    public function testGetOffers(){
      $this->insertOffers();
      $offers = $this->offersRepo->getOffers();

      $this->assertNotNull($offers);
      $this->assertCount(count($this->offersData['offers']), $offers);
    }

    public function testCreateOrUpdate(){
        $offer = $this->offersRepo->createUpdateOffer($this->offersData['offers'][0],$this->offersData['batch_id']);

        $this->assertNotNull($this->offersData);

        $offer = Offers::find($this->offersData['offers'][0]['offer_id']);

        $this->assertEquals($this->offersData['offers'][0]['offer_id'],$offer->id);

        $offer = $this->offersRepo->createUpdateOffer(['offer_id' => $this->offersData['offers'][0]['offer_id'],'name' => "this is new name", "cash_back" => 3.33,"image_url" => "https://notsameimage"],14);

        $this->assertNotEquals($this->offersData['offers'][0]['name'], $offer->name);
        $this->assertNotEquals($this->offersData['offers'][0]['cash_back'], $offer->cash_back);
        $this->assertNotEquals($this->offersData['offers'][0]['image_url'], $offer->image_url);
        $this->assertNotEquals($this->offersData['batch_id'], $offer->batch_id);


    }
}
