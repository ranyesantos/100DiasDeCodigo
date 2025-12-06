<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class EntitiesDTO
{
    /**
     * @param  HashtagEntityDTO[]  $hashtags
     * @param  UrlEntityDTO[]  $urls
     * @param  UserMentionEntityDTO[]  $userMentions
     */
    public function __construct(
        public array $hashtags,
        public array $urls,
        public array $userMentions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            hashtags: array_map(
                HashtagEntityDTO::fromArray(...),
                $data['hashtags'] ?? []
            ),
            urls: array_map(
                UrlEntityDTO::fromArray(...),
                $data['urls'] ?? []
            ),
            userMentions: array_map(
                UserMentionEntityDTO::fromArray(...),
                $data['user_mentions'] ?? []
            ),
        );
    }
}
