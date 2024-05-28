<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserSubscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->create([
                'email' => 'user@example.com',
                'password' => Hash::make("user"),
            ]);

        $subscription = Subscription::factory()->create();

        $users = User::factory(5, [
            'password' => Hash::make("password"),
        ])
            ->has(
                UserSubscription::factory()
                    ->has(Payment::factory(), "payment")
                    ->for($subscription, "subscription"),
                "subscriptions",
            )->create();
    }
}
