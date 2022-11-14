<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $halls = [
            [
                'name' => [
                    'en' => '1.etaz',
                    'ru' => '1.etazr',
                    'tm' => '1.etazt',
                ],
            ],
            [
                'name' => [
                    'en' => '2.etaz',
                    'ru' => '2.etazr',
                    'tm' => '2.etazt',
                ],
            ],
            [
                'name' => [
                    'en' => 'terrace',
                    'ru' => 'terrace',
                    'tm' => 'terrace',
                ],
            ]
        ];

        foreach ($halls as $hall) {
            Hall::create($hall);
        }
    }
}
