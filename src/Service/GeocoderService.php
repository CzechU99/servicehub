<?php

namespace App\Service;

use Geocoder\Provider\Nominatim\Nominatim;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Symfony\Component\HttpClient\HttpClient;

class GeocoderService
{
    private $geocoder;

    public function __construct()
    {
        $httpClient = GuzzleAdapter::createWithConfig([]);
        $this->geocoder = new Nominatim($httpClient, 'https://nominatim.openstreetmap.org', 'servicehub-app'); 
    }

    /**
     * Geokodowanie adresu na współrzędne.
     *
     * @param string $address
     * @return array|null
     */
    public function geocode(string $address): ?array
    {
        try {
            $results = $this->geocoder->geocodeQuery(\Geocoder\Query\GeocodeQuery::create($address));
            
            if ($results->isEmpty()) {
                return null;
            }

            $location = $results->first();
            return [
                'latitude' => $location->getCoordinates()->getLatitude(),
                'longitude' => $location->getCoordinates()->getLongitude(),
            ];

        } catch (\Exception $e) {
            return null;
        }
    }
}
