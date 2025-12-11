<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use He4rt\Submission\Models\Submission;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->isLocal()) {
            User::factory()->admin()->create([
                'name' => 'Linus Torvalds',
                'username' => 'torvalds',
            ]);

            $users = User::factory()
                ->count(10)
                ->create();

            $users->each(function ($user): void {
                Submission::factory()
                    ->count(random_int(5, 8))
                    ->for($user)
                    ->create();
            });

        }

    }
}
