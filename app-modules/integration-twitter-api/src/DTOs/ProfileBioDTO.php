<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class ProfileBioDTO
{
    public function __construct(
        public string $description,
        public ?ProfileBioEntitiesDTO $entities,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] ?? '',
            entities: isset($data['entities']) ? ProfileBioEntitiesDTO::fromArray($data['entities']) : null,
        );
    }
}
