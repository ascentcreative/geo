@php

    $addr = $model->address;
    if(!$addr) {
        $addr = new AscentCreative\Geo\Models\Address();
    }
  
@endphp

{{-- <div class="w-50"> --}}
    {{-- <h4>Address:</h4> --}}
    <x-cms-form-input type="text" label="Street 1" name="address[street1]" value="{!! old('address.street1', $addr->street1 ?? '') !!}"/>
    <x-cms-form-input type="text" label="Street 2" name="address[street2]" value="{!! old('address.street2', $addr->street2 ?? '') !!}"/>
    <x-cms-form-input type="text" label="City" name="address[city]" value="{!! old('address.city', $addr->city ?? '') !!}"/>
    <x-cms-form-input type="text" label="County/State" name="address[state]" value="{!! old('address.state', $addr->state ?? '') !!}"/>
    <x-cms-form-input type="text" label="Postcode/Zip" name="address[zip]" value="{!! old('address.zip', $addr->zip ?? '') !!}"/>
    {{-- <x-cms-form-input type="text" label="Country" name="address[country_id]" value="{!! old('_address.country_id', $addr->country_id ?? '') !!}"/>     --}}

    {{-- @dump($addr->country()->getRelated()); --}}
    <x-cms-form-relationautocomplete label="Country" :relationship="$addr->country()" displayField="name" name="address[country_id]" dataurl="/countries/autocomplete" />

{{-- </div> --}}

