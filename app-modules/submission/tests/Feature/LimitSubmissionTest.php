<?php

declare(strict_types=1);

use App\Models\User;
use He4rt\Submission\Filament\App\Resources\Submissions\Pages\CreateSubmission;
use He4rt\Submission\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('limits submissions to one per day', function (): void {
    $user = User::factory()->create();
    $approver = User::factory()->create();

    // Create a submission for today
    $submission = Submission::factory()->create([
        'user_id' => $user->id,
        'submitted_at' => now(),
        'approver_id' => $approver->id,
    ]);

    // Try to create another submission for today
    Livewire::actingAs($user)
        ->test(CreateSubmission::class)
        ->fillForm([
            'user_id' => $user->id,
            'approver_id' => $approver->id,
            'tweet_url' => 'https://twitter.com/test',
            'status' => 'pending',
            'submitted_at' => now(),
            'approved_at' => now(),
        ])
        ->call('create')
        ->assertNotified('You have already submitted your daily progress for this date.');

    // Assert no new submission created
    expect(Submission::query()->count())->toBe(1);
});
