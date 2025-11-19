<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Visit::truncate();
        Patient::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call([
            PatientsSeeder::class,
            // VisitsSeeder::class,
        ]);
    }
}
