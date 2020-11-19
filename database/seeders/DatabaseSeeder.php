<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlansTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ExtensionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
