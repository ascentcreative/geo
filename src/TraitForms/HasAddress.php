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
