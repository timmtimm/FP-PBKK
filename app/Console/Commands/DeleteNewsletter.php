<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all user subscribe on newsletter';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('newsletter')->delete();
        $this->info("Newsletter deleted successfully");
    }
}
