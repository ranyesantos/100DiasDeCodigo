<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class UrlEntityDTO
{
    public function __construct(
        public string $url,
        public string $displayUrl,
        public string $expandedUrl,
        public array $indices,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['url'],
            displayUrl: $data['display_url'],
            expandedUrl: $data['expanded_url'],
            indices: $data['indices'],
        );
    }
}
