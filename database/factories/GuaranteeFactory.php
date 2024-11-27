<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guarantee>
 */
class GuaranteeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corporate_reference_number' => $this->faker->unique()->uuid,
            'guarantee_type' => $this->faker->randomElement(['Bank', 'Bid Bond', 'Insurance', 'Surety']),
            'nominal_amount' => $this->faker->randomFloat(2, 10000, 1000000), // Amount between 10,000 and 1,000,000
            'nominal_amount_currency' => $this->faker->currencyCode,
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years'), // Expiry date up to 2 years in the future
            'applicant_name' => $this->faker->name,
            'applicant_address' => $this->faker->address,
            'beneficiary_name' => $this->faker->name,
            'beneficiary_address' => $this->faker->address,
        ];
    }
}
