<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProjectsFactory extends Factory
{
    protected $model = \App\Models\CrmProject::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->numerify('CUST-####'),
            'customer_name' => $this->faker->company(),
            'user_rep_id' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),
            'project_number' => $this->faker->numerify('PROJ-####'),
            'project_name' => $this->faker->name(),
            'branch' => $this->faker->city(),
            'period_year' => '2023',
            'labor' => $this->faker->randomFloat(2, 0, 1000),
            'labor_margin' => $this->faker->randomFloat(2, 0, 100),
            'sales' => $this->faker->randomFloat(2, 0, 10000),
            'sales_margin' => $this->faker->randomFloat(2, 0, 100),
            'other' => $this->faker->randomFloat(2, 0, 10000),
            'other_margin' => $this->faker->randomFloat(2, 0, 100),
            'gross_revenue' => $this->faker->randomFloat(2, 0, 100000),
            'expected_revenue' => $this->faker->randomFloat(2, 0, 100000),
            'net_revenue' => $this->faker->randomFloat(2, 0, 100000),
        ];
    }
}
