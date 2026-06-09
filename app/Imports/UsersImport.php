<?php

namespace App\Imports;

use App\State;
use App\County;
use App\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Repositories\Repository;

class UsersImport implements ToModel, WithChunkReading
{
    public function model(array $row)
    {
        
        if(strtoupper($row[0]) != 'STATE' && strtoupper($row[0]) != 'STATES')
        {
            $state = State::where('code', preg_replace("/[^a-zA-Z]/", "",  $row[4]))->first();

            if(!empty($state))
            {
                $county = County::where('county_name', $row[2])->first();

                if(!empty($county))
                {
                    return new City([
                        'state_id' => $state->id,
                        'county_id' => $county->id,
                        'state_code' => preg_replace("/[^a-zA-Z]/", "",  $state->code),
                        'city_name' => $row[1],
                        'zip' => $row[5]
                    ]);
                    
                }
                else
                {
                    $countyDetails  = County::create([
                        'state_id' => $state->id,
                        'county_name' => $row[2]
                    ]);
                    
                    return new City([
                        'state_id' => $state->id,
                        'county_id' => $countyDetails->id,
                        'state_code' => preg_replace("/[^a-zA-Z]/", "",$state->code),
                        'city_name' => $row[1],
                        'zip' => $row[5]
                    ]);
                }
            }
            else
            {
                $stateDetails = State::create([
                    'name' => $row[0],
                    'code' => preg_replace("/[^a-zA-Z]/", "", $row[4])
                ]);

                $county = County::where('county_name', $row[3])->first();

                if(!empty($county))
                {
                    return new City([
                        'state_id' => $stateDetails->id,
                        'county_id' => $county->id,
                        'state_code' => preg_replace("/[^a-zA-Z]/", "", $stateDetails->code),
                        'city_name' => $row[1],
                        'zip' => $row[5]
                    ]);
                }
                else
                {
                    $countyDetails =  County::create([
                        'state_id' => $stateDetails->id,
                        'county_name' => $row[2]
                    ]);

                    return new City([
                        'state_id' => $stateDetails->id,
                        'county_id' => $countyDetails->id,
                        'state_code' => preg_replace("/[^a-zA-Z]/", "", $stateDetails->code),
                        'city_name' => $row[2],
                        'zip' => $row[5]
                    ]);
                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
