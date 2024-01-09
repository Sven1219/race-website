<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dog;
use Carbon\Carbon;

class MemoryUsage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mem:usage';

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
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        
        $forms = Dog::where('imported', 0)
            // ->where(function($query) use ($today, $yesterday) {
            //     $query->whereDate('created_at', $today)
            //           ->orWhereDate('created_at', $yesterday);
            // })
            ->count();

        for ($i = 1; $i <= $forms; $i++) {
            // Run the export command
            $output = shell_exec('php artisan form:export');

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
