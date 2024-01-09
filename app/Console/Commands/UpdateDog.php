<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Betting;
use App\Models\ScrapedLink;
use App\Models\Dog;
use Carbon\Carbon;

class UpdateDog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:dog';

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
        $betting = Betting::whereNull('dog_id')->get();

        foreach ($betting as $key => $value) {
            $dog = Dog::where('dog_name', 'like', '%' . str_replace("'", ' ', $this->removeChar($value->name)) . '%')
                ->first();

            // $this->comment($dog->dog_id);
            if(!empty($dog)) {
                Betting::find($value->id)->update([
                    'dog_id' => $dog->dog_id
                ]);
                $this->comment($dog->dog_id);
            }
        }
    }

    public function removeChar($string)
    {
        $position = strpos($string, 'T:');

        if ($position !== false) {
            // Remove text starting from 'T:'
            $result = substr($string, 0, $position);
            return $result;
        } else {
            return $string;
        }
    }
}
