<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::create([
            'name' => 'Race Pace'
        ]);

        \App\Models\Company::create([
            'name' => 'Empresa Teste'
        ]);
    }
}
