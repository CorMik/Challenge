<?php

namespace Tests\Unit\Services;

use App\Models\Eloquent\Offers;
use App\Models\Repositories\OffersAPIRepo;
use App\Services\OffersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\NeedsOfferData;

class OffersTest extends NeedsOfferData
{
    use RefreshDatabase;
    private $offersService;

    public function setUp(): void
    {
        parent::setUp();

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSyncOffers()
    {
        $this->mockAPIRepo();
        $this->offersService = app(OffersService::class);
        $this->offersService->syncOffers();
        $offer = Offers::find($this->offersData['offers'][0]['offer_id']);
        $this->assertEquals($offer->id, $this->offersData['offers'][0]['offer_id']);
        $this->assertEquals($offer->name, $this->offersData['offers'][0]['name']);
        $this->assertEquals($offer->cash_back, $this->offersData['offers'][0]['cash_back']);
        $this->assertEquals($offer->image_url, $this->offersData['offers'][0]['image_url']);
    }

    public function testGetOffers(){
        $this->insertOffers();
        $this->offersService = app(OffersService::class);

        $offers = $this->offersService->getOffers();

        $this->assertEquals(1,$offers->first()->id);
        $this->assertEquals(2,$offers->last()->id);

        $offers = $this->offersService->getOffers('a-z');
        $this->assertEquals('a product',$offers->first()->name);
        $this->assertEquals('z product',$offers->last()->name);

        $offers = $this->offersService->getOffers('z-a');
        $this->assertEquals('z product',$offers->first()->name);
        $this->assertEquals('a product',$offers->last()->name);

        $offers = $this->offersService->getOffers('high-low');
        $this->assertEquals(4.5,$offers->first()->cash_back);
        $this->assertEquals(0.25,$offers->last()->cash_back);

        $offers = $this->offersService->getOffers('low-high');
        $this->assertEquals(0.25,$offers->first()->cash_back);
        $this->assertEquals(4.5,$offers->last()->cash_back);
    }

    private function mockAPIRepo(){
        $this->mock(OffersAPIRepo::class, function ($mock) {
            $mock->shouldReceive('retrieveOffers')->once()->andReturn($this->offersData);
        });
    }
}
