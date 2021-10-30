<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,

            'description'   => $this->faker->text(200),
            'image'    => $this->faker->imageUrl(), //->default('https://picsum.photos/200/200'),
            'price' => $this->faker->numberBetween(1, 100000),
            'old_price' => $this->faker->numberBetween(1, 100000),

            'category_id'   => $this->faker->numberBetween(1, 15),
        ];
    }
}
