<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Race;

class RaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'race';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch today races';

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

     public function fetchTodayRacing()
     {
         $queryParams = [
             'date' => 'https://www.thedogs.com.au/racing/',
         ];
         $apiUrl = 'https://api.dogpower.dog/api/v1?' . http_build_query($queryParams);

         try {
            $response = Http::get($apiUrl);
            $data = $response->json();
            // dd($data);
            if($data["success"] == true) {
                foreach ($data["data"] as $key => $value) {
                    $venueName = $value["meetingName"];
                    $raceDate = '';
                    $raceArray = [];
                    foreach($value["races"] as $key => $item) {
                        $raceLink = $item["raceLink"];
                        $segments = explode('/', trim($raceLink, '/'));
                        $segment3 = isset($segments[2]) ? $segments[2] : null;
                        $segment4 = isset($segments[3]) ? $segments[3] : null;
                        $segment5 = isset($segments[4]) ? $segments[4] : null;
                        $raceDate = $segment3;
                        $raceArray[$key]["link"] = $raceLink;
                        $raceArray[$key]["raceID"] = $segment4;
                        $raceArray[$key]["date"] = $segment3;
                        $raceArray[$key]["meeting_name"] = $segment5;
                        $raceArray[$key]["status"] = "awaiting";
                    }

                    $race = new Race();
                    $race->venue = $venueName;
                    $race->import_url = $value['meetingLink'];
                    $race->race = json_encode($raceArray);
                    $race->date = $raceDate;
                    $race->time = json_encode($value["races"][0]['meetingTime']);
                    $race->save();
                }
            }
         } catch (\Exception $e) {
            $this->error($e->getMessage());
         }
        // Race::whereDate('date', Carbon::tomorrow())->delete();
     }     

    public function handle()
    {
        $this->fetchTodayRacing();
    }
}
