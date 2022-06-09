<?php

namespace AscentCreative\Geo\Traits;

use AscentCreative\CMS\Traits\BaseTrait;
use AscentCreative\CMS\Traits\Extender;
use AscentCreative\Geo\Models\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/* Use when a model has one address only */
/* The HasAddresses Trait will (eventually) allow for multiple addresses to be associated, but this trait is a shortcut in the meantime */

trait HasAddress {

    use Extender;

    public static function bootHasAddress() {
  
      static::deleted(function ($model) {
        $model->deleteAddress();
      });

      static::saving(function($model) { 
            if(request()->has('address')) {
                $model->captureAddress();
            }
      });

      static::saved(function($model) { 
        if(request()->has('address')) {
            $model->saveAddress();
          }
      });

    }

    public function initializeHasAddress() {
        $this->fillable[] = 'address';
    }

    /* define the relationship */
    public function address() {
        $q = $this->morphOne(\AscentCreative\Geo\Models\Address::class, 'addressable');

        // if($type) {
        //     $q = $q->where('address_type', $type);
        // }

        return $q;
     }


    public function captureAddress() {

        session(['extenders.address' => $this->address]);
        unset($this->attributes['address']);     
       
    }

    

    public function saveAddress() {
     
        $data = session()->pull('extenders.address');

        $this->address()->save(Address::updateOrCreate(
            ['addressable_type' => get_class($this), 'addressable_id' => $this->id],
            $data
        ));

    }


    protected function deleteAddress() {
        
        $item = $this->address;

        if (!is_null($item)) {
            $item->delete();
        }
        
    }



 
    
    

}
