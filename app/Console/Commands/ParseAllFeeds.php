<?php

namespace App\Console\Commands;

use App\Jobs\ParseFeed;
use App\Models\Feed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseAllFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:parse-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all RSS feeds in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Loop through each feed and queue it for parsing.
        foreach (Feed::all() as $feed) {
            Log::info("Queuing feed for parsing: {$feed->id} - {$feed->url}");
            ParseFeed::dispatch($feed);
        }

        // Display a success message.
        $this->info('All feeds have been queued for parsing.');
    }
}
