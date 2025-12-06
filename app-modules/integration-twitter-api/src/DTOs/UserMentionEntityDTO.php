<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class UserMentionEntityDTO
{
    public function __construct(
        public string $idStr,
        public string $name,
        public string $screenName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            idStr: $data['id_str'],
            name: $data['name'],
            screenName: $data['screen_name'],
        );
    }
}
