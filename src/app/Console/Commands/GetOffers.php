<?php

namespace App\Console\Commands;

use App\Services\OffersService;
use Illuminate\Console\Command;

class GetOffers extends Command
{
    protected $signature = "offers:get";

    protected $description = "Get the most recent offers";

    /**
     * GetOffers constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(OffersService $offersService)
    {
        $this->info("Getting Offers");

        $offersService->syncOffers();

        $this->info("Offers received");
    }
}
