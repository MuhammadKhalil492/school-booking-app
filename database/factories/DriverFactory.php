<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Team;
use Laravel\Jetstream\Features;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drvier>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Driver::class;
    protected static ?string $password;
    public function definition(): array
    {
        $part1 = str_pad($this->faker->randomNumber(4, true), 4, '0', STR_PAD_LEFT); // 4 digits
        $part2 = str_pad($this->faker->randomNumber(7, true), 7, '0', STR_PAD_LEFT); // 7 digits
        $part3 = str_pad($this->faker->randomNumber(1, true), 1, '0', STR_PAD_LEFT); // 1 digit
        // Combine into the desired format
        $formattedNumber = "{$part1}-{$part2}-{$part3}";
        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);
        $user->assignRole('Driver');

        return [
            'user_id' => $user->id, // Automatically creates a User entry
            'vehicle_type' => $this->faker->randomElement(['Sedan', 'Van', 'SUV']),
            'id_card_number' => $formattedNumber,
            'vehicle_number' => strtoupper($this->faker->bothify('???###')),
            'license_number' => strtoupper($this->faker->bothify('D######')),
            'license_expiry' => $this->faker->dateTimeBetween('+1 year', '+5 years')->format('Y-m-d'),
            'is_verified' => $this->faker->boolean(80),
            'is_active' =>$this->faker->boolean(80),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
