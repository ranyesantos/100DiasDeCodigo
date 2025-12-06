<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class UserDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $userName,
        public string $profilePicture,
        public ?string $coverPicture,
        public string $description,
        public string $location,
        public int $followers,
        public int $following,
        public bool $isBlueVerified,
        public string $verifiedType,
        public bool $canDm,
        public string $createdAt,
        public int $favouritesCount,
        public int $mediaCount,
        public int $statusesCount,
        public ?ProfileBioDTO $profileBio,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            userName: $data['userName'],
            profilePicture: $data['profilePicture'],
            coverPicture: $data['coverPicture'] ?? null,
            description: $data['description'] ?? '',
            location: $data['location'] ?? '',
            followers: $data['followers'],
            following: $data['following'],
            isBlueVerified: $data['isBlueVerified'],
            verifiedType: $data['verifiedType'] ?? '',
            canDm: $data['canDm'],
            createdAt: $data['createdAt'],
            favouritesCount: $data['favouritesCount'],
            mediaCount: $data['mediaCount'],
            statusesCount: $data['statusesCount'],
            profileBio: isset($data['profile_bio']) ? ProfileBioDTO::fromArray($data['profile_bio']) : null,
        );
    }
}
