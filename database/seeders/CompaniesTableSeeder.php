<?php
namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Company;
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
        $plan = Plan::find(1);
        $plan->companies()->create([
            'name' => 'Race Pace',
            'document_number' => '0123456789',
            'url' => 'race-pace',
            'email' => 'racepace@email.com'
        ]);

        $plan = Plan::find(2);
        $plan->companies()->create([
            'name' => 'Empresa Teste',
            'document_number' => '1234567890',
            'url' => 'empresa-teste',
            'email' => 'teste@email.com'
        ]);

        $plan = Plan::find(3);
        $plan->companies()->create([
            'name' => 'GK Sports',
            'document_number' => '9876543210',
            'url' => 'gk-sports',
            'email' => 'gk@email.com'
        ]);
    }
}
