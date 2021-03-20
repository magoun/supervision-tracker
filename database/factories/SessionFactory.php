<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'duration' => $this->faker->numberBetween(30, 75),
            'isGroup' => $this->faker->boolean(),
            'notes' => $this->faker->text(),
            'tags' => function() {
                $tags = $this->faker->randomElements([
                    '#tagOne',
                    '#tagTwo',
                    '#tagThree'
                ], 2);
                
                return implode(',', $tags);
            },
            'user_id' => User::factory()
        ];
    }
}
