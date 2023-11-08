<?php

namespace App\Jobs;

use App\Models\Feed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The feed instance.
     */
    protected Feed $feed;

    /**
     * Create a new job instance.
     */
    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $feed_url = $this->feed->url;

        // Parse the RSS feed
        $xml = simplexml_load_file($feed_url);

        // Retrieve the title and description
        $this->feed->title = (string) $xml->channel->title;
        $this->feed->description = (string) $xml->channel->description;

        // Save the feed
        $this->feed->save();
    }
}
