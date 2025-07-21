<?php


namespace Jazer\Pasakay\Http\Controllers\Utility;

use App\Http\Controllers\Controller;

class GoogleMapMatrix extends Controller
{
   public static function getDistance($origin, $destination) {
        
        $key            = config('jtpasakayconfig.google_map_api_key');
        $url            = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origin . "&destinations=" . $destination . "&key=" . $key;
        $decoded        = json_decode(file_get_contents($url), true);
        $rows           = $decoded['rows'];

        if(count($rows)) {
            $element = $rows[0]['elements'];
            if(count($element) > 0) {
                return [
                    "distance_text"     => $element[0]['distance']['text'],
                    "distance_value"    => $element[0]['distance']['value'],
                    "duration_text"     => $element[0]['duration']['text'],
                    "duration_value"    => $element[0]['duration']['value']
                ];
            }
            else {
                return [
                    "distance_text"     => "0 km",
                    "distance_value"    => 0,
                    "duration_text"     => "0 hour 0 mins",
                    "duration_value"    => 0
                ];
            }
        }
        else {
            return [
                "distance_text"     => "0 km",
                "distance_value"    => 0,
                "duration_text"     => "0 hour 0 mins",
                "duration_value"    => 0
            ];
        }
    }   
}



