<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\RaceForm;
use Carbon\Carbon;
use App\Models\Dog;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dogs = Dog::orderBy('dog_name', 'ASC')
            ->distinct('dog_name')
            ->limit(2)
            ->get();


        $distance = RaceForm::limit(50000)->pluck('distance')
            ->unique()
            ->sort()
            ->values()
            ->toArray();


        return view('race.show', compact('dogs', 'distance'));
    }

    public function racing_dog(Request $request)
    {
        $distance = RaceForm::where('dog_id', '=', $request->dog_id)
            ->pluck('distance')
            ->unique()
            ->sort()
            ->values()
            ->toArray();
        $dog_name = $request->short_code;
        return view('dog', compact('distance', 'dog_name'));
    }

    public function show($venue, Request $request)
    {
        $dogs = RaceForm::select('race_forms.*', 'dogs.dog_name')
            ->join('dogs', 'race_forms.dog_id', '=', 'dogs.dog_id')
            ->where('dogs.venue_code', $venue)
            ->where('dogs.race_id', $request->get('raceID'))
            ->whereDate('dogs.date', $request->get('date'))
            ->orderBy('dogs.dog_name', 'ASC')
            ->get();

        $distance = RaceForm::select('race_forms.*', 'dogs.dog_name')
            ->join('dogs', 'race_forms.dog_id', '=', 'dogs.dog_id')
            ->where('dogs.venue_code', $venue)
            ->where('dogs.race_id', $request->get('raceID'))
            ->whereDate('dogs.date', $request->get('date'))
            ->pluck('race_forms.distance')
            ->unique()
            ->sort()
            ->values()
            ->toArray();
        return view('race.index', compact('dogs', 'distance', 'venue'));
    }

    public function replaceSpaceWithHyphen($str)
    {
        // Check if the string contains a space
        if (strpos($str, ' ') !== false) {
            // Replace spaces with hyphens and return the modified string
            return str_replace(' ', '-', $str);
        } else {
            // If no space is found, return the original string
            return $str;
        }
    }

    public function dog_datatables(Request $request)
    {


        $dateString = $request->get('date_code');
        $originalDate = strtotime($dateString);
        $oneDayBefore = date("Y-m-d", strtotime("-1 day", $originalDate));


        $dogsArray = Dog::where('venue_code', $request->get('venue'))
            ->where('race_id', $request->get('raceID'))
            ->whereDate('date', $request->get('date_code'))
            ->pluck('dog_id')
            ->toArray();



        if ($request->get('unique_dog') == "on") {
            $racing = RaceForm::selectRaw(
                'race_forms.*, (race_forms.Time + (race_forms.Time - race_forms.Bon)) AS time_ratio'
            );


            $searchValue = $request->input('search.value');

            if (!empty($request->get('distance'))) {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE distance = ? AND Time != \'0.00\' AND Time != \'\' AND Time != \'\' AND date < \'' . $oneDayBefore . '\' ' . ($searchValue ? "AND dist LIKE '%$searchValue%'" : '') . ' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                             ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                    }
                );
                
                $racing->groupBy('race_forms.dog_id');
                $racing->setBindings([$request->get('distance')]);
            } else {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\' AND date < \'' . $oneDayBefore . '\' ' . ($searchValue ? "AND dist LIKE '%$searchValue%'" : '') . ' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                             ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                    }
                )->groupBy('race_forms.dog_id');
            }

            if (!empty($request->get('plc'))) {
                $racing->orderBy('plc', $request->get('plc'));
            }

            $racing->orderBy('race_forms.time2', $request->get('time_order'))
                ->whereIn('race_forms.dog_id', $dogsArray)
                ->latest();



            return Datatables::of($racing)
                ->editColumn('dpg_name', function (RaceForm $race) {
                    $dog = Dog::find($race->dog_id);
                    return $dog->dog_name;
                })
                ->addColumn('latest', function (RaceForm $race) {
                    $last = [];
                    $startDate = now()->subDays(10)->startOfDay();
                    $endDate = now()->endOfDay(); // End date is the current date

                    $racing = RaceForm::where('dog_id', $race->dog_id)
                        // ->whereBetween('date', [$startDate, $endDate])
                        ->orderBy('date', 'DESC')
                        ->limit(10)
                        ->get();

                    foreach ($racing as $data) {
                        $last[] = substr($data->plc, 0, 1);
                    }

                    $formattedLast = '<center>' . implode("", $last) . '</center>';
                    return $formattedLast;
                })
                ->editColumn('time_ratio', function (RaceForm $race) {
                    return number_format($race->time_ratio, 2);
                })
                ->filterColumn('time_ratio', function ($instance, $request) {
                    if (!empty($request->get('time_ratio'))) {
                        $instance->orderBy(\DB::raw('CAST(time_ratio AS DECIMAL(10, 2))'), $request->get('time_ratio'));
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('dogs'))) {
                        $instance->whereIn('race_forms.dog_id', explode(",", $request->get('dogs')));
                    }

                    if (!empty($request->get('datepicker'))) {
                        switch ($request->get('datepicker')) {
                            case 'all':
                                break;

                            default:
                                $date = explode(" - ", $request->get('datepicker'));
                                $startDate = Carbon::parse($date[0])->format('Y-m-d');
                                $endDate = Carbon::parse($date[1])->format('Y-m-d');
                                $instance->whereBetween("date", [$startDate, $endDate]);
                                break;
                        }
                    }

                    if (!empty($request->get('time_order'))) {
                    }

                    if ($keyword = $request->input('search.value')) {
                        $instance->where('dist', 'LIKE', '%' . $keyword . '%');
                    }

                    if (!empty($request->get('orderA'))) {
                        switch ($request->get('orderA')) {
                            case 'ASC':
                                $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                break;

                            default:
                                $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                break;
                        }
                    }
                })
                ->rawColumns(['dpg_name', 'time_ratio', 'latest'])
                ->toJson();
        } else {
            $racing = RaceForm::selectRaw(
                '*, (Time + (Time - Bon)) AS time_ratio'
            )->whereIn('dog_id', $dogsArray)
                ->whereDate('date', '<', $oneDayBefore);

            if (!empty($request->get('plc'))) {
                $racing->orderBy('plc', $request->get('plc'));
            }

            if (!empty($request->get('time_ratio'))) {
                $racing->orderBy(\DB::raw('CAST(time_ratio AS DECIMAL(10, 2))'), $request->get('time_ratio'));
            }

            $racing = $racing->orderBy(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), $request->get('time_order'))
                ->latest();

            return Datatables::of($racing)
                ->editColumn('dpg_name', function (RaceForm $race) {
                    $dog = Dog::find($race->dog_id);
                    return $dog->dog_name;
                })
                ->addColumn('latest', function (RaceForm $race) {
                    $last = [];
                    $startDate = now()->subDays(10)->startOfDay();
                    $endDate = now()->endOfDay(); // End date is the current date

                    $racing = RaceForm::where('dog_id', $race->dog_id)
                        // ->whereBetween('date', [$startDate, $endDate])
                        ->orderBy('date', 'DESC')
                        ->limit(10)
                        ->get();

                    foreach ($racing as $data) {
                        $last[] = substr($data->plc, 0, 1);
                    }

                    $formattedLast = '<center>' . implode("", $last) . '</center>';
                    return $formattedLast;
                })
                ->editColumn('time_ratio', function (RaceForm $race) {
                    return number_format($race->time_ratio, 2);
                })
                // ->addColumn('time_ratio', function (RaceForm $race) {
                //     if (!empty($race->Time) && !empty($race->Bon)) {
                //         $result = floatval($race->Time) + (floatval($race->Time) - floatval($race->Bon));
                //         return number_format($result, 2);
                //     } else {
                //         return '';
                //     }
                // })
                // ->filterColumn('time_ratio', function ($instance, $request) {
                //     if(!empty($request->get('time_ratio'))) {
                //         $instance->orderBy(\DB::raw('CAST(time_ratio AS DECIMAL(10, 2))'), $request->get('time_ratio'));
                //     }
                // })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('dogs'))) {
                        $instance->whereIn('dog_id', explode(",", $request->get('dogs')));
                    }

                    if (!empty($request->get('distance'))) {
                        $instance->where('distance', '=', $request->get('distance'));
                    }

                    if ($keyword = $request->input('search.value')) {
                        $instance->where('dist', 'LIKE', '%' . $keyword . '%');
                    }

                    if (!empty($request->get('datepicker'))) {
                        switch ($request->get('datepicker')) {
                            case 'all':
                                break;

                            default:
                                $date = explode(" - ", $request->get('datepicker'));
                                $startDate = Carbon::parse($date[0])->format('Y-m-d');
                                $endDate = Carbon::parse($date[1])->format('Y-m-d');
                                $instance->whereBetween("date", [$startDate, $endDate]);
                                break;
                        }
                    }

                    if (!empty($request->get('orderA'))) {
                        switch ($request->get('orderA')) {
                            case 'ASC':
                                $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                break;

                            default:
                                $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                break;
                        }
                    }
                })
                ->rawColumns(['dpg_name', 'time_ratio', 'latest'])
                ->toJson();
        }
    }





    public function show_rank_per_race(Request $request)
    {
        // $request->merge(['venue' => 'dapto']);
        // $request->merge(['raceID' => 1]);
        // $request->merge(['date_code' => '2023-11-09']);
        
        $request->merge(['datepicker' => 'all']);
        $request->merge(['unique_dog' => 'on']);
        $request->merge(['time_order' => 'ASC']);

        $request->merge(['distance' => 300]);
        $return_data1 = $this->dog_datatables($request);

        $request->merge(['distance' => 350]);
        $return_data2 = $this->dog_datatables($request);

        $request->merge(['distance' => 400]);
        $return_data3 = $this->dog_datatables($request);

        $request->merge(['distance' => 450]);
        $return_data4 = $this->dog_datatables($request);

        $request->merge(['distance' => 500]);
        $return_data5 = $this->dog_datatables($request);


        $data1 = $return_data1->getData()->data;
        $data2 = $return_data2->getData()->data;
        $data3 = $return_data3->getData()->data;
        $data4 = $return_data4->getData()->data;
        $data5 = $return_data5->getData()->data;
        $return_data1_length = count($data1);
        $return_data2_length = count($data2);
        $return_data3_length = count($data3);
        $return_data4_length = count($data4);
        $return_data5_length = count($data5);


        $target2 = floatval(@$data2[0]->time2) + 0.15;
        $target1 = floatval(@$data1[0]->time2) + 0.15;
        $target3 = floatval(@$data3[0]->time2) + 0.15;
        $target4 = floatval(@$data4[0]->time2) + 0.15;
        $target5 = floatval(@$data5[0]->time2) + 0.15;

        if ($return_data1_length < 3)
            $data1 = [];
        else {
            for ($i = 0; $i < $return_data1_length; $i++) {
                if ($target1 < floatval($data1[$i]->time2)) {
                    unset($data1[$i]);
                }
            }

            $temp = $data1;
            $data1 = [];
            $data1[0] = $temp[0];
            for($i = 1; $i < count($temp); $i++){
                if($data1[count($data1) - 1]->dog_id === $temp[$i]->dog_id){ 
                    continue;
                }else{
                    array_push($data1, $temp[$i]);
                }
            }
            
        
        }

        if ($return_data2_length < 3)
            $data2 = [];
        else {
            for ($i = 0; $i < $return_data2_length; $i++) {
                if ($target2 < floatval($data2[$i]->time2)) {
                    unset($data2[$i]);
                }
            }

            $temp = $data2;
            $data2 = [];
            $data2[0] = $temp[0];
            for($i = 1; $i < count($temp); $i++){
                if($data2[count($data2) - 1]->dog_id === $temp[$i]->dog_id){ 
                    continue;
                }else{
                    array_push($data2, $temp[$i]);
                }
            }
        }
        if ($return_data3_length < 3)
            $data3 = [];
        else {
            for ($i = 0; $i < $return_data3_length; $i++) {
                if ($target3 < floatval($data3[$i]->time2)) {
                    unset($data3[$i]);
                }
            }

            $temp = $data3;
            $data3 = [];
            $data3[0] = $temp[0];
            for($i = 1; $i < count($temp); $i++){
                if($data3[count($data3) - 1]->dog_id === $temp[$i]->dog_id){ 
                    continue;
                }else{
                    array_push($data3, $temp[$i]);
                }
            }
        }
        if ($return_data4_length < 3)
            $data4 = [];
        else {
            for ($i = 0; $i < $return_data4_length; $i++) {
                if ($target4 < floatval($data4[$i]->time2)) {
                    unset($data4[$i]);
                }
            }

            $temp = $data4;
            $data4 = [];
            $data4[0] = $temp[0];
            for($i = 1; $i < count($temp); $i++){
                if($data4[count($data4) - 1]->dog_id === $temp[$i]->dog_id){ 
                    continue;
                }else{
                    array_push($data4, $temp[$i]);
                }
            }
        }
        if ($return_data5_length < 3)
            $data5 = [];
        else {
            for ($i = 0; $i < $return_data5_length; $i++) {
                if ($target5 < floatval($data5[$i]->time2)) {
                    unset($data5[$i]);
                }
            }

            $temp = $data5;
            $data5 = [];
            $data5[0] = $temp[0];
            for($i = 1; $i < count($temp); $i++){
                if($data5[count($data5) - 1]->dog_id === $temp[$i]->dog_id){ 
                    continue;
                }else{
                    array_push($data5, $temp[$i]);
                }
            }
        }

        $mergedData = (object)['data' => array_merge($data1, $data2, $data3, $data4, $data5)];
        $return_data1->setData($mergedData);
        $return_data = $return_data1;
        
        return $return_data;
        
    }





    public function form_datatables(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->get('unique_dog')) && $request->get('unique_dog') == "on") {
                $racing = RaceForm::selectRaw(
                    'race_forms.*, (race_forms.Time + (race_forms.Time - race_forms.Bon)) AS time_ratio'
                );

                $searchValue = $request->input('search.value');
                if (!empty($request->get('distance'))) {
                    $racing->join(
                        \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE distance = \'' . $request->get('distance') . '\' AND Time != \'0.00\' AND Time != \'\' ' . ($searchValue ? "AND dist LIKE '%$searchValue%'" : '') . ' GROUP BY dog_id) as subq'),
                        function ($join) {
                            $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                                ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                        }
                    );
                } else {
                    $racing->join(
                        \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\' ' . ($searchValue ? "AND dist LIKE '%$searchValue%'" : '') . ' GROUP BY dog_id) as subq'),
                        function ($join) {
                            $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                                ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                        }
                    );
                }

                if (!empty($request->get('plc'))) {
                    $racing->orderBy('plc', $request->get('plc'));
                }

                $racing->orderBy('race_forms.time2', $request->get('time_order'))
                    ->where('race_forms.Time', '!=', '0.00')
                    ->where('race_forms.Time', '!=', NULL)
                    ->where('race_forms.Time', '!=', '')
                    ->latest();

                return Datatables::of($racing)
                    ->editColumn('dpg_name', function (RaceForm $race) {
                        $dog = Dog::find($race->dog_id);
                        if (!empty($dog)) {
                            return $dog->dog_name;
                        } else {
                            return '';
                        }
                    })
                    ->addColumn('latest', function (RaceForm $race) {
                        $last = [];
                        $startDate = now()->subDays(10)->startOfDay();
                        $endDate = now()->endOfDay(); // End date is the current date

                        $racing = RaceForm::where('dog_id', $race->dog_id)
                            // ->whereBetween('date', [$startDate, $endDate])
                            ->orderBy('date', 'DESC')
                            ->limit(10)
                            ->get();

                        foreach ($racing as $data) {
                            $last[] = substr($data->plc, 0, 1);
                        }

                        $formattedLast = '<center>' . implode("", $last) . '</center>';
                        return $formattedLast;
                    })
                    ->editColumn('time_ratio', function (RaceForm $race) {
                        return number_format($race->time_ratio, 2);
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('dogs'))) {
                            $instance->whereIn('race_forms.dog_id', explode(",", $request->get('dogs')));
                        }

                        if (!empty($request->get('distance'))) {
                            $instance->where('distance', '=', $request->get('distance'));
                        }

                        if (!empty($request->get('raceID'))) {
                            $instance->where('race_id', '=', $request->get('raceID'));
                        }

                        if (!empty($request->get('venux'))) {
                            $instance->where('venue', '=', $request->get('venux'));
                        }

                        if ($keyword = $request->input('search.value')) {
                            $instance->where('dist', 'LIKE', '%' . $keyword . '%');
                        }

                        if (!empty($request->get('datepicker'))) {
                            switch ($request->get('datepicker')) {
                                case 'all':
                                    break;

                                default:
                                    $date = explode(" - ", $request->get('datepicker'));
                                    $startDate = Carbon::parse($date[0])->format('Y-m-d');
                                    $endDate = Carbon::parse($date[1])->format('Y-m-d');
                                    $instance->whereBetween("date", [$startDate, $endDate]);
                                    break;
                            }
                        }

                        if (!empty($request->get('orderA'))) {
                            switch ($request->get('orderA')) {
                                case 'ASC':
                                    $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                    break;

                                default:
                                    $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                    break;
                            }
                        }
                    })
                    ->rawColumns(['dpg_name', 'latest'])
                    ->toJson();
            } else {
                $racing = RaceForm::selectRaw(
                    '*, (Time + (Time - Bon)) AS time_ratio'
                );
                if (!empty($request->get('plc'))) {
                    $racing->orderBy('plc', $request->get('plc'));
                }
                $racing =  $racing->orderBy(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), $request->get('time_order'))->latest();
                return Datatables::of($racing)
                    ->editColumn('dpg_name', function (RaceForm $race) {
                        $dog = Dog::find($race->dog_id);
                        if (!empty($dog)) {
                            return $dog->dog_name;
                        } else {
                            return '';
                        }
                    })
                    ->addColumn('latest', function (RaceForm $race) {
                        $last = [];
                        $startDate = now()->subDays(10)->startOfDay();
                        $endDate = now()->endOfDay(); // End date is the current date

                        $racing = RaceForm::where('dog_id', $race->dog_id)
                            // ->whereBetween('date', [$startDate, $endDate])
                            ->orderBy('date', 'DESC')
                            ->limit(10)
                            ->get();

                        foreach ($racing as $data) {
                            $last[] = substr($data->plc, 0, 1);
                        }

                        $formattedLast = '<center>' . implode("", $last) . '</center>';
                        return $formattedLast;
                    })
                    ->editColumn('time_ratio', function (RaceForm $race) {
                        return number_format($race->time_ratio, 2);
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('dogs'))) {
                            $instance->whereIn('dog_id', explode(",", $request->get('dogs')));
                        }

                        if (!empty($request->get('distance'))) {
                            $instance->where('distance', '=', $request->get('distance'));
                        }

                        if (!empty($request->get('raceID'))) {
                            $instance->where('race_id', '=', $request->get('raceID'));
                        }

                        if (!empty($request->get('venux'))) {
                            $instance->where('venue', '=', $request->get('venux'));
                        }

                        if ($keyword = $request->input('search.value')) {
                            $instance->where('dist', 'LIKE', '%' . $keyword . '%');
                        }

                        if (!empty($request->get('datepicker'))) {
                            switch ($request->get('datepicker')) {
                                case 'all':
                                    break;

                                default:
                                    $date = explode(" - ", $request->get('datepicker'));
                                    $startDate = Carbon::parse($date[0])->format('Y-m-d');
                                    $endDate = Carbon::parse($date[1])->format('Y-m-d');
                                    $instance->whereBetween("date", [$startDate, $endDate]);
                                    break;
                            }
                        }

                        if (!empty($request->get('orderA'))) {
                            switch ($request->get('orderA')) {
                                case 'ASC':
                                    $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                    break;

                                default:
                                    $instance->orderBy(\DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), 'ASC');
                                    break;
                            }
                        }
                    })
                    ->rawColumns(['dpg_name', 'time_ratio', 'latest'])
                    ->toJson();
            }
        }
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $racing = Race::orderBy('id', 'ASC')->latest();
            return Datatables::of($racing)
                ->addColumn('new', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        $raceItem = $data[0]; // Get the first element of the $data array

                        $segment = explode("/", $raceItem->link);
                        $timestamp = json_decode($race->time)[0];
                        if (Carbon::hasFormat($timestamp, 'H:i')) {
                            $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                            $carbonTimestamp->setTimezone($request->get('zone_time'));
                            $formattedTime = $carbonTimestamp->format('H.i');
                        } else {
                            $formattedTime = $timestamp;
                        }

                        $output .= '<a target="_blank" href="' . url('new?venue=' . strtolower($segment[2]) . '&date=' . $raceItem->date . '&short_code=' . $race->venue) . '" class="btn btn-success btn-sm text-center"> New </a>';
                    }
                    return $output;
                })
                ->addColumn('race', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        $raceItem = $data[0]; // Get the first element of the $data array

                        $segment = explode("/", $raceItem->link);
                        $timestamp = json_decode($race->time)[0];
                        if (Carbon::hasFormat($timestamp, 'H:i')) {
                            $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                            $carbonTimestamp->setTimezone($request->get('zone_time'));
                            $formattedTime = $carbonTimestamp->format('H.i');
                        } else {
                            $formattedTime = $timestamp;
                        }

                        $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                    }
                    return $output;
                })
                ->addColumn('race_two', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[1])) {
                            $raceItem = $data[1];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[1];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_three', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[2])) {
                            $raceItem = $data[2];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[2];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_four', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[3])) {
                            $raceItem = $data[3];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[3];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_five', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[4])) {
                            $raceItem = $data[4];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[4];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_six', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[5])) {
                            $raceItem = $data[5];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[5];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_seven', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[6])) {
                            $raceItem = $data[6];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[6];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_eight', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[7])) {
                            $raceItem = $data[7];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[7];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_nine', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[8])) {
                            $raceItem = $data[8];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[8];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_ten', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[9])) {
                            $raceItem = $data[9];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[9];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_eleven', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[10])) {
                            $raceItem = $data[10];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[10];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="' . url('racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue) . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->addColumn('race_twelve', function (Race $race) use ($request) {
                    $data = json_decode($race->race);
                    $output = '';
                    if (is_array($data) && count($data) > 0) {
                        if (isset($data[11])) {
                            $raceItem = $data[11];
                            $segment = explode("/", $raceItem->link);
                            $timestamp = json_decode($race->time)[11];
                            if (Carbon::hasFormat($timestamp, 'H:i')) {
                                $carbonTimestamp = Carbon::parse($timestamp, 'UTC');
                                $carbonTimestamp->setTimezone($request->get('zone_time'));
                                $formattedTime = $carbonTimestamp->format('H.i');
                            } else {
                                $formattedTime = $timestamp;
                            }

                            $output .= '<a target="_blank" href="https://dogpower.dog/racing/' . strtolower($segment[2]) . '?date=' . $raceItem->date . '&raceID=' . $raceItem->raceID . '&short_code=' . $race->venue . '" class="btn btn-primary btn-sm text-center">' . $formattedTime . '</a>';
                        } else {
                            $output .= '';
                        }
                    }
                    return $output;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('datepicker'))) {
                        $instance->whereDate("date", '=', Carbon::parse($request->get('datepicker')));
                    }

                    if ($keyword = $request->input('search.value')) {
                        $instance->where('venue', 'LIKE', '%' . $keyword . '%');
                    }
                })
                ->rawColumns(['new', 'race', 'race_two', 'race_three', 'race_four', 'race_five', 'race_six', 'race_seven', 'race_eight', 'race_nine', 'race_ten', 'race_eleven', 'race_twelve'])
                ->toJson();
        }
    }

    public function new(Request $request)
    {
        $replaced = str_replace('-', ' ', $request->venue);
        $venue_display = ucwords($replaced);
        $venue = $request->venue;
        $date = $request->date;
        $distance = RaceForm::where('dog_id', '=', $request->dog_id)
            ->pluck('distance')
            ->unique()
            ->sort()
            ->values()
            ->toArray();
        $dog_name = $request->short_code;
        return view('new', compact('venue_display', 'venue', 'date'));
    }
}
