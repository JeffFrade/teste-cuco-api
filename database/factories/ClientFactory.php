<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
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
        $phone = StringHelper::formatPhone($this->faker->phoneNumber);

        return [
            'name' => $this->faker->name,
            'document' => StringHelper::formatDocument($this->faker->cpf),
            'birth_date' => $this->faker->date(),
            'phone' => (rand(0, 1) ? null : $phone)
        ];
    }
}
