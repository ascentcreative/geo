<?php

namespace AscentCreative\Geo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use AscentCreative\Geo\Events\AddressSaved;

class AddressSavedListener implements ShouldQueue {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
   
     * @param  object  $event
     * @return void
     */
    public function handle(AddressSaved $event) {

        // Geocode the address
        // - Is Geocodiging enabled in the config?
        // - Do we have a Google API Key?
        if(config('geo.geocode_addresses') && $key = config('geo.google_apikey')) {
	        
            $address = urlencode($event->address->stringify(', '));
         
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$key}";
            
            // get the json response
            $resp_json = file_get_contents($url);
         
            // decode the json
            $resp = json_decode($resp_json, true);

            // dump($resp);

            if($resp['status']=='OK'){
	    
                // myultiple results might be returned
                // at least get one in the right country!
                
                $iso = $event->address->country->iso;
                
                foreach($resp['results'] as $result) {
                    
                    foreach($result['address_components'] as $comp) {
                        
                        if ($comp['types'][0] == 'country' && $comp['short_name'] == $iso) {
                            
                            // get the important data
                            $event->address->lat = isset($result['geometry']['location']['lat']) ? $result['geometry']['location']['lat'] : "";
                            $event->address->lng = isset($result['geometry']['location']['lng']) ? $result['geometry']['location']['lng'] : "";
                            
                            // save without events or we'll trigger a loop.
                            $event->address->saveQuietly();

                        }
                        
                    }
                    
                }
             
            } 


        } else {
            dump("Geocode not configured");
        }

        return 0;


    }
}
