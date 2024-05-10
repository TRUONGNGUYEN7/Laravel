<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
class DownloadImageFromFTP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $imageHashList;
    /**
     * Create a new job instance.
     */
    public function __construct($imageHashList)
    {
        $this->imageHashList = $imageHashList;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Thực hiện tải và lưu hình ảnh từ FTP xuống local
        $imageData = Storage::disk('ftp')->get($this->imageHashList);
        if ($imageData) {
            Storage::disk('ntg_storage')->put($this->imageHashList, $imageData);
        }
    }
}
