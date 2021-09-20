<?php

namespace AscentCreative\Geo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kalnoy\Nestedset\NestedSet;
use Kalnoy\Nestedset\NodeTrait;
use AscentCreative\CMS\Traits\HasSlug;

use AscentCreative\CMS\Models\Base;

class Country extends Base
{
    use HasFactory, NodeTrait, HasSlug;

    public $table = "geo_countries";
    public $slug_source = 'name';

    //public $fillable = ['addressable_type', 'addressable_id', 'address_type', 'street1', 'street2', 'street3', 'town', 'city', 'state', 'zip', 'country_id'];

   
}

