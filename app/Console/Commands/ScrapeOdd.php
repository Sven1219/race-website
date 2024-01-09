<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Betting;
use App\Models\ScrapedLink;
use App\Models\Race;
use Carbon\Carbon;

class ScrapeOdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:odds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape odds data';

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
        $scrapedLinks = ScrapedLink::pluck('links')->toArray();

        $race = Race::whereDate('date', '=', Carbon::today())
            ->get();

        try {
            $scrapedLinks = ScrapedLink::pluck('links')->toArray();
            $links = [];
            foreach ($race as $key => $value) {
                $raceData = json_decode($value->race);
                foreach ($raceData as $data) {
                    $links[] = $data->link;
                }
            }

            // $links = array_diff($links, $scrapedLinks);
            //dd(count($links));
            foreach ($links as $key => $link) {
                $raceLink = "https://www.thedogs.com.au".$link;

                $queryParams = [
                    'date' => $raceLink,
                ];
                $apiUrl = 'https://api.dogpower.dog/api/get/odds?' . http_build_query($queryParams);

                $response = Http::get($apiUrl);
                $result = $response->json();
                if($result["success"] == true) {
                    $dogLink = $link;
                    $segments = explode('/', trim($dogLink, '/'));
                    $segment1 = isset($segments[3]) ? $segments[3] : null;
                    $segment3 = isset($segments[1]) ? $segments[1] : null;
                    $segment4 = isset($segments[2]) ? $segments[2] : null;
                    foreach ($result["data"] as $key => $value) {
                        $datag = explode('/', trim($value['dogLink'], '/'));
                        $dogID = isset($datag[1]) ? $datag[1] : '';
                        if (!empty($value["startingPrice"])) {
                            $betting = new Betting();
                            $betting->position = $value['position'];
                            $betting->venue = $segment3;
                            $betting->race_id = $segment1;
                            $betting->date = $segment4;
                            $betting->name = $value['dogName'];
                            $betting->trainer = $value['trainer'];
                            $betting->time = $value['time'];
                            $betting->sp = str_replace('$', '', $value['startingPrice']);
                            $betting->dog_id = $dogID;
                            $betting->save();
                        }
                    }
                    $scraped = new ScrapedLink();
                    $scraped->links = $dogLink;
                    $scraped->save();
                    sleep(1);
                }
            }
        } catch (\Exception $e) {
            $this->error($e);
        }
    }
}
