<?php

namespace Database\Factories\MasterData;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\MasterData\DataTeacher;
use App\Models\MasterData\DataClasses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterData\DataTeacher>
 */
class DataTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = DataTeacher::class;

    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'fullname' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'dob' => $this->faker->dateTimeBetween('1975-01-01', '1995-12-31'), // 1975 - 1995
            'class_id' => DataClasses::query()->inRandomOrder()->value('id')
        ];
    }
}
