<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Básico',
            'url' => 'basic',
            'price' => 29.99,
            'price-details' => 'reais/mês + R$99,00 taxa de adesão',
            'description' => 'Inicie com as ferramentas básicas, limitado a 5 atletas',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Ilimitado Mensal',
            'url' => 'unlimited-month',
            'price' => 89.99,
            'price-details' => 'reais/mês + R$99,00 taxa de adesão',
            'description' => 'Ferramentas básicas e atletas ilimitados',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Ilimitado Anual',
            'url' => 'unlimited-year',
            'price' => 971.89,
            'price-details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Ferramentas básicas e atletas ilimitados',
            'discount' => '10%',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Especialista Mensal',
            'url' => 'expert-month',
            'price' => 149.99,
            'price-details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Todas as extensões inclusas e atletas ilimitados',
            'discount' => '5%',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Especialista Anual',
            'url' => 'expert-year',
            'price' => 199.99,
            'price-details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Todas as extensões inclusas e atletas ilimitados',
            'discount' => '20%',
            'active' => true,
        ]);
    }
}
