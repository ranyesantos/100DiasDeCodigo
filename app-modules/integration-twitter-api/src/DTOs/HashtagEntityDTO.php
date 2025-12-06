<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class HashtagEntityDTO
{
    public function __construct(
        public string $text,
        public array $indices,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            text: $data['text'],
            indices: $data['indices'],
        );
    }
}
