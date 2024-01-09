<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Dog as Dogs;
use App\Models\Race;
use Carbon\Carbon;

class Dog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:dog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape dogs data';

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

    public function formatReindeerName($name) {
        if (strpos($name, '-') !== false) {
            $parts = explode('-', $name);
            if (count($parts) == 2) {
                return ucfirst($parts[0]) . ' ' . ucfirst($parts[1]);
            } else {
                return ucwords(str_replace('-', ' ', $name));
            }
        } else {
            return ucfirst($name);
        }
    }

    public function fetchDogData()
    {
        $race = Race::where('imported', '=', '0')
                // ->whereDate('date', '=', Carbon::today())
                ->limit(5)
                ->get();

        try {
            foreach($race as $key => $value) {
                $raceData = json_decode($value->race);
                $updateID = $value->id;
                $raceLink = "https://www.thedogs.com.au".$value->import_url;

                $queryParams = [
                    'raceLink' => $raceLink,
                ];
                $apiUrl = 'https://api.dogpower.dog/api/dog/race?' . http_build_query($queryParams);

                $response = Http::get($apiUrl);
                $result = $response->json();
                if($result["success"] == true) {
                    foreach ($result["data"] as $key => $value) {
                        $raceHeaderLink = explode("/", $value["raceHeaderLink"]);
                        // dd($raceHeaderLink);
                        foreach ($value['runnersSummary'] as $key => $value) {
                            if(isset($value['link'])) {
                                $dogLink = $value['link'];
                                $segments = explode('/', trim($dogLink, '/'));
                                $segment3 = isset($segments[1]) ? $segments[1] : null;
                                $segment4 = isset($segments[2]) ? $segments[2] : null;
                                $raceIDS =  isset($raceHeaderLink[4]) ? $raceHeaderLink[4] : null;

                                $checkIfDogExists = Dogs::where('dog_id', '=', $segment3)
                                                    ->whereDate('date', '=', Carbon::createFromFormat("Y-m-d", $raceHeaderLink[3]))
                                                    ->where('race_id', "=", $raceIDS)
                                                    ->where('venue_code', '=', $raceHeaderLink[2])
                                                    ->exists();

                                switch ($checkIfDogExists) {
                                    case TRUE:
                                        $this->comment("race exists");
                                        break;
                                    
                                    default:
                                        // make the insert
                                        $newDog = new Dogs();
                                        $newDog->dog_id = $segment3;
                                        $newDog->dog_name = $this->formatReindeerName($segment4);
                                        $newDog->short_code = $segment4;
                                        $newDog->link = $dogLink;
                                        $newDog->trainer = $value['trainer'];
                                        $newDog->last_4 = $value['lastFour'];
                                        $newDog->best = $value['bestTime'];
                                        $newDog->race_id = $raceIDS;
                                        $newDog->venue_code = $raceHeaderLink[2];
                                        $newDog->date = Carbon::createFromFormat("Y-m-d", $raceHeaderLink[3]);
                                        $newDog->save();
                                        $this->comment("inserted");
                                        break;
                                }
                            }
                        }
                    }
                }
    
                if(count($result["data"]) != 0) {
                    Race::where('id', $updateID)
                    ->update([
                        'imported' => 1,
                    ]);
                }
            }
        } catch (\Exception $e) {
            $this->error($e);
        }
    }

    public function handle()
    {
        $this->fetchDogData();
    }
}
