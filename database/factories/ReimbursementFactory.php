<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reimbursement>
 */
class ReimbursementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => date('Y-m-d'),
            'name' => 'TEST'.$this->faker->randomNumber(1, true),
            'nomor' => '1',
            'doc_no' => 'RE-1-'.date('Y'),
            'user_created' => 3,
            'description' => 'DATA TEST',
        ];
    }
}