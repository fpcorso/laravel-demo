<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:add {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new RSS feed and queues it for parsing.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feed_url = $this->argument('url');

        // Create a new feed instance or retrieve it if it already exists.
        $feed = \App\Models\Feed::firstOrCreate([
            'url' => $feed_url,
        ]);

        // Queue the feed for parsing.
        \App\Jobs\ParseFeed::dispatch($feed);

        // Display a success message.
        $this->info('The feed has been added and queued for parsing.');
    }
}
