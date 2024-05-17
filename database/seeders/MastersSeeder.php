<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Clas;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Location;
use App\Models\PoliceStation;
use App\Models\Shift;
use App\Models\Ward;
use App\Models\WeekDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MastersSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ward Seeder
        $wards = [
            [
                'id' => 1,
                'name' => 'Ward 1',
                'initial' => 'W1',
            ],
            [
                'id' => 2,
                'name' => 'Ward 2',
                'initial' => 'W2',
            ],
        ];

        foreach ($wards as $ward) {
            Ward::updateOrCreate([
                'id' => $ward['id']
            ], [
                'id' => $ward['id'],
                'name' => $ward['name'],
                'initial' => $ward['initial'],
            ]);
        }


        // Police Seeder
        $polices = [
            [
                'id' => 1,
                'ward_id' => 1,
                'police_station' => 'Police 1',
                'description' => 'lorem ipsum doror sit amet',
            ],
            [
                'id' => 2,
                'ward_id' => 2,
                'police_station' => 'Police 2',
                'description' => 'lorem ipsum doror sit amet',
            ],
        ];

        foreach ($polices as $police) {
            PoliceStation::updateOrCreate([
                'id' => $police['id']
            ], [
                'id' => $police['id'],
                'ward_id' => $police['ward_id'],
                'police_station' => $police['police_station'],
                'description' => $police['description']
            ]);
        }



        // Location Seeder
        $locations = [
            [
                'id' => 1,
                'ward_id' => 1,
                'location' => 'lorem ipsum dolor sit amet',
                'description' => 'lorem ipsum doror sit amet',
            ],
            [
                'id' => 2,
                'ward_id' => 2,
                'location' => 'lorem ipsum doror sit amet',
                'description' => 'lorem ipsum doror sit amet',
            ],
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate([
                'id' => $location['id']
            ], [
                'id' => $location['id'],
                'ward_id' => $location['ward_id'],
                'location' => $location['location'],
                'description' => $location['description']
            ]);
        }




        // Documents Seeder
        $documents = [
            [
                'id' => 1,
                'name' => 'Aadhaar Card',
                'initial' => 'ADC',
                'is_required' => '1',
            ],
        ];

        foreach ($documents as $document) {
            Document::updateOrCreate([
                'id' => $document['id']
            ], [
                'id' => $document['id'],
                'name' => $document['name'],
                'initial' => $document['initial'],
                'is_required' => $document['is_required']
            ]);
        }





        // Banner Size Seeder
        $banners = [
            [
                'id' => 1,
                'banner_size' => '100 X 100',
                'amount' => '100',
            ],
            [
                'id' => 2,
                'banner_size' => '150 X 150',
                'amount' => '150',
            ],
            [
                'id' => 3,
                'banner_size' => '200 X 200',
                'amount' => '200',
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate([
                'id' => $banner['id']
            ], [
                'id' => $banner['id'],
                'banner_size' => $banner['banner_size'],
                'amount' => $banner['amount'],
            ]);
        }

    }
}
