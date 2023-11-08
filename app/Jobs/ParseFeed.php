<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Feed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        Log::info("Parsing feed: {$this->feed->id} - {$this->feed->url}");

        $feed_url = $this->feed->url;

        // Parse the RSS feed
        try {
            $xml = simplexml_load_file($feed_url);
        } catch (\Exception $e) {
            Log::error("Failed to parse feed: {$this->feed->id} - {$this->feed->url}");
            return;
        }

        // Retrieve the title and description
        $this->feed->title = (string) $xml->channel->title;
        $this->feed->description = (string) $xml->channel->description;

        // Save the feed
        $this->feed->save();

        // Loop through each item and save as an Article
        // If a matching guid already exists, update attributes instead.
        foreach ($xml->channel->item as $item) {
            $article = Article::firstOrCreate([
                'guid' => $item->guid,
                'feed_id' => $this->feed->id,
            ]);
            $article->title = (string) $item->title;
            $article->description = (string) $item->description;
            $article->link = (string) $item->link;
            $article->pub_date = (string) $item->pubDate;
            $article->save();
        }
    }
}
