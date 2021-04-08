<?php

namespace Database\Factories;

use App\Models\Transporter;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransporterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transporter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->regexify('[A-Z]{2,3}[0-9]{2,3}'),
            'name' => $this->faker->company,
        ];
    }
}
