<?php

namespace Database\Seeders;

use App\Models\Extension;
use App\Models\ExtensionDetail;
use Illuminate\Database\Seeder;

class ExtensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extension::create([
            'name' => 'Potência',
            'url' => 'potencia',
            'price' => 9.99,
            'active' => true,
            'icon' => 'i-Bicycle',
        ]);

        Extension::create([
            'name' => 'Sintomas de Stress',
            'url' => 'sintomas-de-stress',
            'price' => 5.99,
            'active' => true,
            'icon' => 'i-Depression',
        ]);

        Extension::create([
            'name' => 'Cargas de Treinamento',
            'url' => 'cargas-de-treinamento',
            'price' => 7.99,
            'active' => true,
            'icon' => 'i-Bar-Chart-2',
        ])->each(function ($extension) {
            $extension->details()->saveMany(ExtensionDetail::factory(3)->make());
        });
    }
}
