<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use geoPHP;

class UpdateBikeLocation extends Command
{
    protected $signature = 'update:bike-location';
    protected $description = 'Update bike location and check if it is within any predefined polygons';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            // Fetch the bike GPS data
            Log::info("Fetching bike GPS data...");
            $response = Http::get(route('sepeda'));

            if ($response->successful()) {
                $bikeData = $response->json();
                
                if (!isset($bikeData['latitude']) || !isset($bikeData['longitude'])) {
                    $this->error("Bike data does not contain 'latitude' or 'longitude' keys.");
                    return;
                }

                $bikeLat = $bikeData['latitude'];
                $bikeLng = $bikeData['longitude'];
            } else {
                $this->error("Failed to fetch bike data. Status code: " . $response->status());
                return;
            }

            // Fetch the polygon data
            $polygonResponse = Http::get(route('geojson-polygons'));
            
            if ($polygonResponse->successful()) {
                $geoData = $polygonResponse->json();
                
                if (!isset($geoData['features'])) {
                    $this->error("Geo data does not contain 'features' key.");
                    return;
                }
            } else {
                $this->error("Failed to fetch polygon data. Status code: " . $polygonResponse->status());
                return;
            }

            // Mapping of building names to their corresponding numbers
            $buildingNumbers = [
                "AA" => 1, "AE" => 2, "AI" => 3, "AM" => 4, "AR" => 5,
                "AW" => 6, "GRAHA POLINEMA" => 7, "AB" => 8, "AF" => 9,
                "AJ" => 10, "AO" => 11, "AS" => 12, "AX" => 13, "TI & TS" => 14,
                "AC" => 15, "AG" => 16, "AK" => 17, "AU" => 18, "Teknik Mesin" => 19,
                "AD" => 20, "AH" => 21, "AL" => 22, "AQ" => 23, "AV" => 24
            ];
            
            foreach ($geoData['features'] as $feature) {
                if (!isset($feature['geometry']['coordinates'][0])) {
                    $this->error("Feature does not contain expected 'geometry.coordinates[0]' structure.");
                    continue;
                }
                
                // Create polygon from coordinates
                $polygonWKT = $this->geoJsonToWKT($feature['geometry']);
                Log::info("Polygon WKT: " . $polygonWKT);
                
                try {
                    $polygon = geoPHP::load($polygonWKT, 'wkt');
                } catch (\Exception $e) {
                    Log::error("Failed to load polygon WKT: " . $e->getMessage());
                    continue;
                }
                
                if (is_null($polygon)) {
                    Log::error("Polygon object is null.");
                    continue;
                }

                // Create point from bike coordinates
                $pointWKT = "POINT($bikeLng $bikeLat)";
                Log::info("Point WKT: " . $pointWKT);
                
                try {
                    $point = geoPHP::load($pointWKT, 'wkt');
                } catch (\Exception $e) {
                    Log::error("Failed to load point WKT: " . $e->getMessage());
                    continue;
                }
                
                if (is_null($point)) {
                    Log::error("Point object is null.");
                    continue;
                }
                dd($polygon->contains($point));
                // Check if point is within polygon
                if ($polygon->contains($point)) {
                    $locationName = $feature['properties']['name'] ?? null;
                    if (!$locationName) {
                        $this->error("Feature does not contain 'name' property.");
                        continue;
                    }

                    $buildingNumber = $buildingNumbers[$locationName] ?? null;

                    if ($buildingNumber) {
                        DB::table('dataa')->where('id', 1)->update([
                            'musik' => $buildingNumber,
                            'baterai' => 1
                        ]);
                        $this->info("Database updated with building number: $buildingNumber");
                    } else {
                        $this->error("No building number found for location: $locationName");
                    }
                    break;
                } else {
                    Log::info("Point is not within the polygon.");
                }
            }
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error($e);
        }
    }

    private function geoJsonToWKT($geometry)
    {
        $type = strtoupper($geometry['type']);
        $coordinates = $geometry['coordinates'];
        
        if ($type === 'POLYGON') {
            $coordinates = $coordinates[0]; // In case of multipolygon, take the first one
            $coords = array_map(function($coord) {
                return implode(' ', $coord);
            }, $coordinates);
            $wkt = $type . '((' . implode(',', $coords) . '))';
        } else {
            $wkt = '';
        }

        return $wkt;
    }
}
