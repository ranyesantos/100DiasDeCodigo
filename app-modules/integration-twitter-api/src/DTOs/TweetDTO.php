<?php

declare(strict_types=1);

namespace He4rt\IntegrationTwitterApi\DTOs;

readonly class TweetDTO
{
    public function __construct(
        public string $id,
        public string $text,
        public string $createdAt,
        public UserDTO $author,
        public ?EntitiesDTO $entities,
        public int $retweetCount,
        public int $replyCount,
        public int $likeCount,
        public int $quoteCount,
        public int $viewCount,
        public string $lang,
        public bool $isReply,
        public ?string $inReplyToId,
        public ?string $conversationId,
        public ?string $inReplyToUserId,
        public ?string $inReplyToUsername,
        public mixed $quotedTweet,
        public mixed $retweetedTweet,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            text: $data['text'],
            createdAt: $data['createdAt'],
            author: UserDTO::fromArray($data['author']),
            entities: isset($data['entities']) ? EntitiesDTO::fromArray($data['entities']) : null,
            retweetCount: $data['retweetCount'],
            replyCount: $data['replyCount'],
            likeCount: $data['likeCount'],
            quoteCount: $data['quoteCount'],
            viewCount: $data['viewCount'],
            lang: $data['lang'],
            isReply: $data['isReply'],
            inReplyToId: $data['inReplyToId'] ?? null,
            conversationId: $data['conversationId'] ?? null,
            inReplyToUserId: $data['inReplyToUserId'] ?? null,
            inReplyToUsername: $data['inReplyToUsername'] ?? null,
            quotedTweet: $data['quoted_tweet'] ?? null,
            retweetedTweet: $data['retweeted_tweet'] ?? null,
        );
    }
}
