<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'due_date' => $this->faker->date(),
            'body' =>collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn($p) => "$p")->implode(''),
            'price' => $this->faker->numberBetween($min = 20000000, $max = 60000000000),
            'user_id' => mt_rand(1, 1),
            'category_id' => mt_rand(1, 2),
        ];
    }
}
