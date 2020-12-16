<?php

namespace Database\Factories;

use App\Repositories\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date(),
            'phone' => (rand(0, 1) ? null : $this->faker->phoneNumber)
        ];
    }
}
