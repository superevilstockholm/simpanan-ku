<?php

namespace Database\Factories\MasterData;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\MasterData\DataStudent;
use App\Models\MasterData\DataClasses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\DataStudent>
 */
class DataStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = DataStudent::class;

    public function definition(): array
    {
        return [
            'nisn' => $this->faker->unique()->numerify('00########'),
            'fullname' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'dob' => $this->faker->dateTimeBetween('2005-01-01', '2009-12-31'), // 2005 - 2009
            'class_id' => DataClasses::query()->inRandomOrder()->value('id')
        ];
    }
}
