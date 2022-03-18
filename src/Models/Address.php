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

    public function addressable() {
        return $this->morphTo();
    }
   
    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getStringifyAttribute($sep=null) {

        if(!$sep) {
            $sep = '<br/>';
        }

        $ary = [
            $this->street1,
            $this->street2,
            $this->street3,
            $this->town,
            $this->city,
            $this->state,
            $this->zip,
            $this->country->name
        ];

        return join($sep, array_filter($ary));
    }

}

