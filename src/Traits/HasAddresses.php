<?php

namespace AscentCreative\Geo\Traits;

use AscentCreative\CMS\Traits\BaseTrait;
use AscentCreative\CMS\Traits\Extender;
use AscentCreative\Geo\Models\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait HasAddresses {

    use Extender;

    public static function bootHasAddresses() {
  
      static::deleted(function ($model) {
        $model->deleteAddresses();
      });

      static::saving(function($model) { 
            if(request()->has('_addresses')) {
                $model->captureAddresses();
            }
      });

      static::saved(function($model) { 
        if(request()->has('_addresses')) {
            $model->saveAddresses();
          }
      });

    }

    public function initializeHasAddresses() {
        $this->fillable[] = '_addresses';
    }

    /* define the relationship */
    public function address($type=null) {
        $q = $this->morphMany(\AscentCreative\Geo\Models\Address::class, 'addressable');

        if($type) {
            $q = $q->where('address_type', $type);
        }

        return $q;
     }


    public function captureAddresses() {

        session(['extenders._addresses' => $this->_addresses]);
        unset($this->attributes['_addresses']);     
       
    }

    

    public function saveAddresses() {
     
        $data = session()->pull('extenders._addresses');

        $ids = array();
        if( !is_null($data) ) {
            $ids = Arr::pluck($data, 'id'); 
        }
        // - delete files for this model which aren't in the incoming data
        $this->addresses()->whereNotIn('id', $ids)->delete(); 
        // - save files which are (will consolidate existing and add new)
        $this->addresses()->saveMany(\AscentCreative\Geo\Models\Address::whereIn('id', $ids)->get());

    }


    protected function deleteAddresses() {
        
        $item = $this->addresses;

        if (!is_null($item)) {
            $item->delete();
        }
        
    }



 
    
    

}
