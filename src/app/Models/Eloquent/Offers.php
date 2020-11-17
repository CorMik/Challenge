<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{

    /** @var string */
    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'image_url',
        'cash_back',
        'batch_id',
    ];


}
