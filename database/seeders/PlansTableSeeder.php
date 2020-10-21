<?php
namespace Database\Seeders;

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
            'name' => 'Cortesia',
            'url' => 'cortesia',
            'price' => 0.00,
            'price_details' => 'Cortesia de uso para empresas selecionadas',
            'description' => '',
            'icon' => 'i-Gift-Box',
            'state_color' => 'secondary',
            'active' => false,
        ]);

        Plan::create([
            'name' => 'Básico',
            'url' => 'basic',
            'price' => 29.99,
            'price_details' => 'reais/mês + R$99,00 taxa de adesão',
            'description' => 'Inicie com as ferramentas básicas, limitado a 5 atletas',
            'icon' => 'i-Pie-Chart-2',
            'state_color' => 'danger',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Ilimitado Mensal',
            'url' => 'unlimited-month',
            'price' => 89.99,
            'price_details' => 'reais/mês + R$99,00 taxa de adesão',
            'description' => 'Ferramentas básicas e atletas ilimitados',
            'icon' => 'i-Coins',
            'state_color' => 'primary',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Ilimitado Anual',
            'url' => 'unlimited-year',
            'price' => 971.89,
            'price_details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Ferramentas básicas e atletas ilimitados',
            'icon' => 'i-Bar-Chart-2',
            'state_color' => 'warning',
            'discount' => '10%',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Especialista Mensal',
            'url' => 'expert-month',
            'price' => 149.99,
            'price_details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Todas as extensões inclusas e atletas ilimitados',
            'icon' => 'i-Bar-Chart',
            'state_color' => 'info',
            'discount' => '5%',
            'active' => true,
        ]);

        Plan::create([
            'name' => 'Especialista Anual',
            'url' => 'expert-year',
            'price' => 199.99,
            'price_details' => 'reais/ano + R$99,00 taxa de adesão',
            'description' => 'Todas as extensões inclusas e atletas ilimitados',
            'icon' => 'i-Medal-3',
            'state_color' => 'success',
            'discount' => '20%',
            'active' => true,
        ]);
    }
}
