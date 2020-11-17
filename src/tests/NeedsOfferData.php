<?php
namespace Tests;

use App\Models\Eloquent\Offers;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class NeedsOfferData extends TestCase
{
    use DatabaseMigrations;

    protected $offersData = [
        'batch_id'=>12,
        'offers'=>[
            [
                'offer_id' => '2',
                'name' => 'a product',
                'image_url' => 'http://testurl.com',
                'cash_back' => 4.5
            ],
            [
                'offer_id' => '1',
                'name' => 'z product',
                'image_url' => 'http://testurl.com',
                'cash_back' => 0.25
            ]
        ]
    ];

    public function setUp() :void
    {
        parent::setUp();
    }

    protected function insertOffers(){

        foreach($this->offersData['offers'] as $offer){
            Offers::create(
                [
                    'id' => $offer['offer_id'],
                    'name'=>$offer['name'],
                    'image_url' => $offer['image_url'],
                    'cash_back' => $offer['cash_back'],
                    'batch_id' => $this->offersData['batch_id']
                ]);
        }
    }
}
