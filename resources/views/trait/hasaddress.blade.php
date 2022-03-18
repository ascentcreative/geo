@php

    $addr = $model->address;
    if(!$addr) {
        $addr = new AscentCreative\Geo\Models\Address();
    }
  
@endphp

{{-- <div class="w-50"> --}}
    {{-- <h4>Address:</h4> --}}
    <x-cms-form-input type="text" label="Street 1" name="_address[street1]" value="{!! old('_address.street1', $addr->street1 ?? '') !!}"/>
    <x-cms-form-input type="text" label="Street 2" name="_address[street2]" value="{!! old('_address.street2', $addr->street2 ?? '') !!}"/>
    <x-cms-form-input type="text" label="City" name="_address[city]" value="{!! old('_address.city', $addr->city ?? '') !!}"/>
    <x-cms-form-input type="text" label="County/State" name="_address[state]" value="{!! old('_address.state', $addr->state ?? '') !!}"/>
    <x-cms-form-input type="text" label="Postcode/Zip" name="_address[zip]" value="{!! old('_address.zip', $addr->zip ?? '') !!}"/>
    {{-- <x-cms-form-input type="text" label="Country" name="_address[country_id]" value="{!! old('_address.country_id', $addr->country_id ?? '') !!}"/>     --}}

    {{-- @dump($addr->country()->getRelated()); --}}
    <x-cms-form-relationautocomplete label="Country" :relationship="$addr->country()" displayField="name" name="_address[country_id]" dataurl="/countries/autocomplete" />

{{-- </div> --}}

