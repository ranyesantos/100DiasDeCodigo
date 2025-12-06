<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class ProfileBioEntitiesDTO
{
    /**
     * @param  UrlEntityDTO[]|null  $descriptionUrls
     * @param  UrlEntityDTO[]|null  $urlUrls
     */
    public function __construct(
        public ?array $descriptionUrls,
        public ?array $urlUrls,
    ) {}

    public static function fromArray(array $data): self
    {
        $descriptionUrls = isset($data['description']['urls'])
            ? array_map(UrlEntityDTO::fromArray(...), $data['description']['urls'])
            : null;

        $urlUrls = isset($data['url']['urls'])
            ? array_map(UrlEntityDTO::fromArray(...), $data['url']['urls'])
            : null;

        return new self(
            descriptionUrls: $descriptionUrls,
            urlUrls: $urlUrls,
        );
    }
}
