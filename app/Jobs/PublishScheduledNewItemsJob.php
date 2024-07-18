<?php

namespace App\Jobs;

use App\Models\NewItem;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PublishScheduledNewItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('PublishScheduledNewItemsJob started.');
        $newsItems = NewItem::whereNotNull('publish_at')
            ->where('published', 0)
            ->where('publish_at', '<=', Carbon::now())
            ->get();

        foreach ($newsItems as $newsItem) {

            $newsItem->update([
                'published' => true,
                'published_at' => Carbon::now(),
            ]);
        }
        Log::info('PublishScheduledNewItemsJob completed.');
    }
}
