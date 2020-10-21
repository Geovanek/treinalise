<?php

namespace Database\Factories;

use App\Models\ExtensionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExtensionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExtensionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(5),
            'icon' => $this->faker->randomElement([
                'Medal-3', 'Idea-2', 'Firewall', 'Pulse', 'Key', 'Map2', 'Big-Data', 'Bar-Chart', 'Pie-Chart-3', 'File-Horizontal-Text', 'Speach-Bubble-Asking'
                ]),
            'state_color' => $this->faker->randomElement([
                'primary', 'secondary', 'success', 'danger', 'warning', 'info'
                ]),
        ];
    }
}
