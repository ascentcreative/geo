<?php
namespace AscentCreative\Geo\TraitForms;

use AscentCreative\Forms\Structure\Subform;

use AscentCreative\Forms\Fields\Input;
use AscentCreative\Forms\Fields\RelationAutocomplete;

class HasAddress extends Subform {

    public function __construct() {

        parent::__construct('geo_address');

        $this->children([
            Input::make('address[street1]', 'Street 1'),
            Input::make('address[street2]', 'Street 2'),
            Input::make('address[city]', 'City'),
            Input::make('address[state]', 'County/State'),
            Input::make('address[zip]', 'Postcode/Zip'),
            RelationAutocomplete::make('address[country_id]', 'Country')
                ->relationship('address.country')
                ->displayField('name')
                ->dataurl('/countries/autocomplete'),
        ]);


    }

}


// <x-cms-form-input type="text" label="Street 1" name="address[street1]" value="{!! old('address.street1', $addr->street1 ?? '') !!}"/>
// <x-cms-form-input type="text" label="Street 2" name="address[street2]" value="{!! old('address.street2', $addr->street2 ?? '') !!}"/>
// <x-cms-form-input type="text" label="City" name="address[city]" value="{!! old('address.city', $addr->city ?? '') !!}"/>
// <x-cms-form-input type="text" label="County/State" name="address[state]" value="{!! old('address.state', $addr->state ?? '') !!}"/>
// <x-cms-form-input type="text" label="Postcode/Zip" name="address[zip]" value="{!! old('address.zip', $addr->zip ?? '') !!}"/>
// {{-- <x-cms-form-input type="text" label="Country" name="address[country_id]" value="{!! old('_address.country_id', $addr->country_id ?? '') !!}"/>     --}}

// {{-- @dump($addr->country()->getRelated()); --}}
// <x-cms-form-relationautocomplete label="Country" :relationship="$addr->country()" displayField="name" name="address[country_id]" dataurl="/countries/autocomplete" />
