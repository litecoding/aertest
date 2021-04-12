<?php

namespace Database\Seeders;

use App\Models\Transporter;
use Illuminate\Database\Seeder;

class TransporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transporter::factory(20)->create();
    }
}
