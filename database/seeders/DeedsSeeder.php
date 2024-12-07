<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $deeds = [
            [
                'title' => 'Donate Books',
                'description' => 'Donated 10 books to the local library to support education.',
                'prize'=>100000,
                'status' => 'Requested',
                'owner_user_id' => 1, // Owner user ID
                'taker_user_id' => 0, // Taker user ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Volunteer at Shelter',
                'description' => 'Spent 5 hours volunteering at the homeless shelter, helping with food distribution.',
                'prize'=>0,
                'status' => 'Requested',
                'owner_user_id' => 2,
                'taker_user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Blood Donation',
                'prize'=>50000,
                'description' => 'Donated blood at the local Red Cross office to save lives.',
                'status' => 'Requested',
                'owner_user_id' => 3,
                'taker_user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Recycling Initiative',
                'description' => 'Recycle 100kg of plastic and metal waste to help reduce pollution.',
                'prize'=>0,
                'status' => 'Requested',
                'owner_user_id' => 1,
                'taker_user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Support Local Farmers',
                'description' => 'Purchase vegetables from local farmers to support sustainable agriculture.',
                'prize'=>0,
                'status' => 'Requested',
                'owner_user_id' => 2,
                'taker_user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Plant a Tree',
                'description' => 'Plant 10 trees in the local park to help combat climate change.',
                'prize'=>200000,
                'status' => 'Completed',
                'owner_user_id' => 3,
                'taker_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('ms_deeds')->insert($deeds);
    }
}
