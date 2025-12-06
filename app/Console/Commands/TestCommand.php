<?php

declare(strict_types=1);

namespace App\Console\Commands;

use He4rt\IntegrationTwitterApi\TwitterApiClient;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(TwitterApiClient $client): int
    {

        return self::SUCCESS;
    }
}
