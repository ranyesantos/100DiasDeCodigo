<?php

declare(strict_types=1);

namespace He4rt\Submission\Filament\App\Resources\Submissions\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use He4rt\Submission\Enums\SubmissionStatus;
use He4rt\Submission\Filament\App\Resources\Submissions\SubmissionResource;
use He4rt\Submission\Models\Submission;

class CreateSubmission extends CreateRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['submitted_at'] = now();
        $data['status'] = SubmissionStatus::Pending;

        return $data;
    }

    protected function beforeCreate(): void
    {
        $userId = $this->data['user_id'];
        $submittedAt = $this->data['submitted_at'];

        $exists = Submission::query()
            ->where('user_id', $userId)
            ->whereDate('submitted_at', $submittedAt)
            ->exists();

        if ($exists) {
            Notification::make()
                ->danger()
                ->title('You have already submitted your daily progress for this date.')
                ->send();

            $this->halt();
        }
    }
}
