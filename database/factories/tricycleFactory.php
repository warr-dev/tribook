<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tricycle;

class tricycleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tricycle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name'=>$this->faker->name,
            'license' =>$this->faker->bothify('???####'),
            'plate_no' =>$this->faker->bothify('???###'),
            'cpnum' =>'09321465987',
        ];
    }
}
