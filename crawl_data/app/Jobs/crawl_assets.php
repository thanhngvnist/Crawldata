<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class crawl_assets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected int $product_id;
    // private const $url = "https://www.cvedetails.com/api/v1/vulnerability/search";

    public function __construct(int $product_id)
    {
        $this->onConnection('redis');
        $this->product_id = $product_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Storage::put('assets.json', "ananan");
        try {
            // Your job logic goes here
            Log::info('Job processed successfully.');
        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
            throw $e; // Re-throw the exception to mark the job as failed
        }
    }
}
