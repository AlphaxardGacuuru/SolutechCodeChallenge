<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statii = ["Pending", "Ongoing", "Done"];

        foreach ($statii as $status) {
            Status::factory()->create(["name" => $status]);
        }
    }
}
