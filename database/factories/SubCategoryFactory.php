<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'is_active' => $this->faker->boolean(),
            'parent_id' =>  \App\Models\Category::whereNull('parent_id')->inRandomOrder()->first(),

        ];
    }
}
