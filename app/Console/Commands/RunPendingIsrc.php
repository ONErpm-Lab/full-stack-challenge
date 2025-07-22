<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PendingIsrcService;

class RunPendingIsrc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-pending-isrc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run pending isrc';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('Do you want to start the processing?')) {
            return 0;
        }

        /** @var PendingIsrcService $service */
        $service = app(PendingIsrcService::class);
        $service->process();

        $this->info('Processing started!');
        return 0;
    }
}
