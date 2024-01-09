<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Dog as Dogs;
use App\Models\Race;
use Carbon\Carbon;

class MemDog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mem:dog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $race = Race::where('imported', '=', '0')
                // ->whereDate('date', '=', Carbon::today())
                ->count();

        for ($i = 1; $i <= $race; $i++) {
            // Run the export command
            $output = shell_exec('php artisan scrape:dog');

            // Check if the command was successful
            if ($output !== null) {
                $this->info("Export iteration $i completed successfully");
            } else {
                $this->error("Export iteration $i failed");
            }
            sleep(2);
        }
    }
}
