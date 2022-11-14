<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hall_ids = Hall::pluck('id');

        foreach ($hall_ids as $id) {
            for ($i = 1; $i < 11; $i++) {
                Table::create([
                    'hall_id' => $id,
                    'number' => $i,
                    'status' => 'empty',
                ]);
            }
        }
    }
}
