<?php

declare(strict_types=1);

use He4rt\IntegrationTwitterApi\DTOs\TimelineResponse;

it('can parse twitter timeline response', function (): void {

    $json = <<<'JSON'
        {
          "tweets": [
            {
              "type": "tweet",
              "id": "1234567890",
              "url": "https://twitter.com/user/status/1234567890",
              "text": "Hello World",
              "source": "<a href=\"...\">Twitter for iPhone</a>",
              "retweetCount": 10,
              "replyCount": 5,
              "likeCount": 100,
              "quoteCount": 2,
              "viewCount": 500,
              "createdAt": "Fri Dec 06 12:00:00 +0000 2024",
              "lang": "en",
              "bookmarkCount": 1,
              "isReply": false,
              "inReplyToId": null,
              "conversationId": "1234567890",
              "displayTextRange": [
                0,
                11
              ],
              "inReplyToUserId": null,
              "inReplyToUsername": null,
              "author": {
                "type": "user",
                "userName": "testuser",
                "url": "https://twitter.com/testuser",
                "id": "987654321",
                "name": "Test User",
                "isBlueVerified": true,
                "verifiedType": "blue",
                "profilePicture": "https://pbs.twimg.com/profile_images/...",
                "coverPicture": "https://pbs.twimg.com/profile_banners/...",
                "description": "Just a test user",
                "location": "Internet",
                "followers": 1000,
                "following": 500,
                "canDm": true,
                "createdAt": "Fri Jan 01 12:00:00 +0000 2020",
                "favouritesCount": 200,
                "hasCustomTimelines": false,
                "isTranslator": false,
                "mediaCount": 50,
                "statusesCount": 1000,
                "withheldInCountries": [],
                "affiliatesHighlightedLabel": {},
                "possiblySensitive": false,
                "pinnedTweetIds": [],
                "isAutomated": false,
                "automatedBy": null,
                "unavailable": false,
                "message": null,
                "unavailableReason": null,
                "profile_bio": {
                  "description": "Just a test user",
                  "entities": {
                    "description": {
                      "urls": [
                        {
                          "display_url": "example.com",
                          "expanded_url": "https://example.com",
                          "indices": [
                            0,
                            23
                          ],
                          "url": "https://t.co/xyz"
                        }
                      ]
                    },
                    "url": {
                      "urls": [
                        {
                          "display_url": "example.com",
                          "expanded_url": "https://example.com",
                          "indices": [
                            0,
                            23
                          ],
                          "url": "https://t.co/xyz"
                        }
                      ]
                    }
                  }
                }
              },
              "entities": {
                "hashtags": [
                  {
                    "indices": [
                      0,
                      5
                    ],
                    "text": "hello"
                  }
                ],
                "urls": [
                  {
                    "display_url": "example.com",
                    "expanded_url": "https://example.com",
                    "indices": [
                      6,
                      29
                    ],
                    "url": "https://t.co/abc"
                  }
                ],
                "user_mentions": [
                  {
                    "id_str": "11111",
                    "name": "Mentioned User",
                    "screen_name": "mentioned"
                  }
                ]
              },
              "quoted_tweet": null,
              "retweeted_tweet": null,
              "isLimitedReply": false
            }
          ],
          "has_next_page": true,
          "next_cursor": "cursor123"
        }
        JSON;

    $data = json_decode($json, true);

    $timeline = TimelineResponse::fromArray($data);

    $this->assertInstanceOf(TimelineResponse::class, $timeline);
    $this->assertCount(1, $timeline->tweets);
    $this->assertTrue($timeline->hasNextPage);
    $this->assertEquals('cursor123', $timeline->nextCursor);

    $tweet = $timeline->tweets[0];
    $this->assertEquals('1234567890', $tweet->id);
    $this->assertEquals('Hello World', $tweet->text);
    $this->assertEquals('testuser', $tweet->author->userName);
    $this->assertCount(1, $tweet->entities->hashtags);
    $this->assertEquals('hello', $tweet->entities->hashtags[0]->text);
    $this->assertCount(1, $tweet->author->profileBio->entities->descriptionUrls);
    $this->assertEquals('https://t.co/xyz', $tweet->author->profileBio->entities->descriptionUrls[0]->url);
});
