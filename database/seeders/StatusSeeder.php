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
        $stati = ["Pending", "Ongoing", "Done"];

        foreach ($stati as $status) {
            Status::factory()->create(["name" => $status]);
        }
    }
}
