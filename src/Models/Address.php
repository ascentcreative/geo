<?php

namespace AscentCreative\Geo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Models\Base;

class Address extends Base
{
    use HasFactory;

    public $table = "geo_addresses";
    public $fillable = ['addressable_type', 'addressable_id', 'address_type', 'street1', 'street2', 'street3', 'town', 'city', 'state', 'zip', 'country_id'];

   
}

