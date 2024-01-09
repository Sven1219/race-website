<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\RaceForm;
use App\Models\Betting;
use Carbon\Carbon;
use App\Models\Dog;

class BettingController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date');
        $to = $request->get('to');
        $odd_start = $request->get('odd_start');
        $odd_end = $request->get('odd_end');
        
        $query = Race::orderBy('id', 'ASC');
        
        if (!empty($date) && !empty($to)) {
            // Ensure correct date range comparison
            $query->whereDate("date", '>=', Carbon::parse($date))
                ->whereDate("date", '<=', Carbon::parse($to));
        } elseif (!empty($date)) {
            // Filter by specific date
            $query->whereDate("date", '=', Carbon::parse($date)->toDateString());
        } elseif (!empty($to)) {
            // Filter by specific 'to' date
            $query->whereDate("date", '=', Carbon::parse($to)->toDateString());
        } else {
            // If neither 'date' nor 'to' are provided, default to today's date
            $query->whereDate("date", '=', Carbon::today());
        }
        
        // Execute the query to get the results
        $racing = $query->get();
        $racing = collect($racing);
        return view('betting', compact('racing', 'date', 'to', 'odd_start', 'odd_end'));
// Execute the query to get the results
        $racings = $query->get();
        $response = [];
        $sum_range = 0;
        foreach ($racings as $racing) {
            $sum = 0;
            $sum_per_race = [];
            $ids = []; 
            foreach (collect(json_decode($racing->race))->pluck('raceID')->toArray() as $id) {
                $ids[] = $id;
            }
            $data_url =  explode('/', trim($racing->import_url, '/'));
            $data = [
                'raceID' => $ids,
                'start' => 0,
                'odd_start' => $odd_start ?? 4,
                'odd_end' => $odd_end ?? 100,
                'venue' => isset($data_url[1]) ? $data_url[1] : null,
                'date_code' => $date,
                'datepicker' => 'all',
                'unique_dog' => 'on',
                'time_order' => 'ASC',
            ];
            $data_sum = $this->show_rank_per_race_all($data);
            $sum += $data_sum['sum'];
            $response[] = array_merge(
                $racing->toArray(),
                [
                    'sum' => $sum
                ]
            );
            $sum_range += $sum;
	break;
        }
        $racing = collect($response);
        return view('betting', compact('racing', 'date', 'to', 'odd_start', 'odd_end', 'sum_range'));
    }
    public function getTotalRange(Request $request)
    {
        $date = $request->get('date');
        $to = $request->get('to');
        $odd_start = $request->get('odd_start');
        $odd_end = $request->get('odd_end');
        
        $query = Race::orderBy('id', 'ASC');
        
        if (!empty($date) && !empty($to)) {
            // Ensure correct date range comparison
            $query->whereDate("date", '>=', Carbon::parse($date))
                ->whereDate("date", '<=', Carbon::parse($to));
        } elseif (!empty($date)) {
            // Filter by specific date
            $query->whereDate("date", '=', Carbon::parse($date)->toDateString());
        } elseif (!empty($to)) {
            // Filter by specific 'to' date
            $query->whereDate("date", '=', Carbon::parse($to)->toDateString());
        } else {
            // If neither 'date' nor 'to' are provided, default to today's date
            $query->whereDate("date", '=', Carbon::today());
        }
        
        // Execute the query to get the results
        $racings = $query->get();
        $response = [];
        $sum_range = 0;
        foreach ($racings as $racing) {
            $sum = 0;
            $sum_per_race = [];
            $ids = []; 
            foreach (collect(json_decode($racing->race))->pluck('raceID')->toArray() as $id) {
                $ids[] = $id;
            }
            $data_url =  explode('/', trim($racing->import_url, '/'));
            $data = [
                'raceID' => $ids,
                'start' => 0,
                'odd_start' => $odd_start ?? 4,
                'odd_end' => $odd_end ?? 100,
                'venue' => isset($data_url[1]) ? $data_url[1] : null,
                'date_code' => $date,
                'datepicker' => 'all',
                'unique_dog' => 'on',
                'time_order' => 'ASC',
            ];
            $data_sum = $this->show_rank_per_race_all($data);
            $sum += $data_sum['sum'];
            $response[] = array_merge(
                [
                    'id' => $racing->id,
                    'sum' => $sum
                ]
            );
            $sum_range += $sum;
        }
        $racing = collect($response);
        return [
            'racing' => $racing,
            'sum_range' => $sum_range,
        ];
    }


    public function getTotalRange1(Request $request)
    {
        $date = $request->get('date');
        $to = $request->get('to');
        $odd_start = $request->get('odd_start');
        $odd_end = $request->get('odd_end');
        
        $query = Race::orderBy('id', 'ASC');
        
        if (!empty($date) && !empty($to)) {
            // Ensure correct date range comparison
            $query->whereDate("date", '>=', Carbon::parse($date))
                ->whereDate("date", '<=', Carbon::parse($to));
        } elseif (!empty($date)) {
            // Filter by specific date
            $query->whereDate("date", '=', Carbon::parse($date)->toDateString());
        } elseif (!empty($to)) {
            // Filter by specific 'to' date
            $query->whereDate("date", '=', Carbon::parse($to)->toDateString());
        } else {
            // If neither 'date' nor 'to' are provided, default to today's date
            $query->whereDate("date", '=', Carbon::today());
        }
        
        // Execute the query to get the results
        $racings = $query->get();
        $response = [];
        $sum_range = 0;
        foreach ($racings as $racing) {
            $sum = 0;
            $sum_per_race = [];
            foreach (collect(json_decode($racing->race))->pluck('raceID')->toArray() as $id) {
                $data_url =  explode('/', trim($racing->import_url, '/'));
                $data = [
                    'raceID' => $id,
                    'start' => 0,
                    'odd_start' => $odd_start ?? 4,
                    'odd_end' => $odd_end ?? 100,
                    'venue' => isset($data_url[1]) ? $data_url[1] : null,
                    'date_code' => $date,
                    'datepicker' => 'all',
                    'unique_dog' => 'on',
                    'time_order' => 'ASC',
                ];
                $data_sum = $this->show_rank_per_race_all($data);
                $sum += $data_sum['sum'];
            }
            $response[] = array_merge(
                $racing->toArray(),
                [
                    'sum' => $sum
                ]
            );
            $sum_range += $sum;
        }
        $racing = collect($response);
        return [
            'racing' => $racing,
            'sum_range' => $sum_range,
        ];
    }

    public function getTotalamount($request)
    {
        $date = $request->get('date');
        $to = $request->get('to');
        $query = Race::orderBy('id', 'ASC');
        if (!empty($date) && !empty($to)) {
            $query->whereDate("date", '>=', Carbon::parse($date))
                ->whereDate("date", '<=', Carbon::parse($to));
        } elseif (!empty($date)) {
            $query->whereDate("date", '=', Carbon::parse($date)->toDateString());
        } elseif (!empty($to)) {
            $query->whereDate("date", '=', Carbon::parse($to)->toDateString());
        } else {
            $query->whereDate("date", '=', Carbon::today());
        }
        $racing = $query->get();

        $totalData = [];
        foreach($racing as $key => $race) {
            foreach(range(1, 2) as $keyz) {
                $data =  explode('/', trim($race->import_url, '/'));
                $venue = isset($data[1]) ? $data[1] : null;
                $raceID = $keyz;
                $date = $race->date;
                $totalData[$venue] = $this->otherData($venue, $raceID, $date, $request);
            }
        }
        return $totalData;
    }

    public function otherData($venue, $raceID, $date, $request)
    {
        $stake = 10;
        $dateString = $date;
        $originalDate = strtotime($dateString);
        $oneDayBefore = date("Y-m-d", strtotime("-1 day", $originalDate));


        $dogsArray = Dog::where('venue_code', $venue)
            ->where('race_id', $raceID)
            ->whereDate('date', $date)
            ->pluck('dog_id')
            ->toArray();

            $racing = RaceForm::select('race_forms.*', 'bettings.*', 'bettings.sp as odd')
            ->join('bettings', function ($join) use ($request, $dogsArray, $raceID, $date, $venue) {
                $join->on('race_forms.dog_id', '=', 'bettings.dog_id')
                ->where('bettings.race_id', '=', $raceID)
                ->where('bettings.date', '=', $date)
                ->where('bettings.venue', '=', $venue)
                ->whereIn('race_forms.dog_id', $dogsArray);
            });

            $racing->join(
                \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\'AND Time != \'\' AND date < \'' . $oneDayBefore . '\' GROUP BY dog_id) as subq'),
                function ($join) {
                    $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                        ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                }
            );


            $queryRacing = $racing->orderBy('race_forms.time2', 'asc')
                        ->get('sp');

            $picks = [];
            foreach($queryRacing as $value) {
                $picks[$raceID] = $value;
            }
            return $picks;
    }

    public function getWinLoss($position)
    {
        switch ($position) {
            case '1st':
                return 'W';
                break;
            
            default:
                return 'L';
                break;
        }
    }

    public function calculateProfit($pos, $odds, $stake)
    {
        switch ($pos) {
            case 'W':
                return ($stake * $odds) - $stake;
                break;
            
            default:
                return number_format(-$stake, 2);
                break;
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
        $return_data1 = $this->datatables($request);

        $request->merge(['distance' => 350]);
        $return_data2 = $this->datatables($request);

        $request->merge(['distance' => 400]);
        $return_data3 = $this->datatables($request);

        $request->merge(['distance' => 450]);
        $return_data4 = $this->datatables($request);

        $request->merge(['distance' => 500]);
        $return_data5 = $this->datatables($request);

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

        if ($return_data1_length < 1)
            $data1 = [];
        else {
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

        if ($return_data2_length < 1)
            $data2 = [];
        else {
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
        if ($return_data3_length < 1)
            $data3 = [];
        else {
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
        if ($return_data4_length < 1)
            $data4 = [];
        else {
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
        if ($return_data5_length < 1)
            $data5 = [];
        else {
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

        $data_all = array_unique(array_merge($data1, $data2, $data3, $data4, $data5), SORT_REGULAR);
        $final = [];
        foreach ($data_all as $item) {
            $final_1 = collect($final)->where('id', $item->id)->first();
            if (empty($final_1)) {
                $final[] = $item;
            }
        }

        $mergedData = (object)[
            'data' => $final,
        ];
        $return_data1->setData($mergedData);
        $return_data = $return_data1;
        
        return $return_data;
        
    }
    public function show_rank_per_race1(Request $request)
    {
        // $request->merge(['venue' => 'dapto']);
        // $request->merge(['raceID' => 1]);
        // $request->merge(['date_code' => '2023-11-09']);
        
        $request->merge(['datepicker' => 'all']);
        $request->merge(['unique_dog' => 'on']);
        $request->merge(['time_order' => 'ASC']);

        $request->merge(['distance' => 300]);
        $return_data1 = $this->datatables($request);

        $request->merge(['distance' => 350]);
        $return_data2 = $this->datatables($request);

        $request->merge(['distance' => 400]);
        $return_data3 = $this->datatables($request);

        $request->merge(['distance' => 450]);
        $return_data4 = $this->datatables($request);

        $request->merge(['distance' => 500]);
        $return_data5 = $this->datatables($request);

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

        if ($return_data1_length < 1)
            $data1 = [];
        else {
         //   for ($i = 0; $i < $return_data1_length; $i++) {
           //     if ($target1 < floatval($data1[$i]->time2)) {
            //        unset($data1[$i]);
             //   }
           // }

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

        $data_all = array_unique(array_merge($data1, $data2, $data3, $data4, $data5), SORT_REGULAR);
	$final = [];
        foreach ($data_all as $item) {
            $final_1 = collect($final)->where('id', $item->id)->first();
            if (empty($final_1)) {
                $final[] = $item;
            }
        }

        $mergedData = (object)[
            'data' => $final,
        ];
        $return_data1->setData($mergedData);
        $return_data = $return_data1;
        
        return $return_data;
        
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

    public function retrieveBetting($race_id, $venue, $date, $dog_id)
    {
        return Betting::where('race_id', '=', $race_id)
                ->where('date', '=', $date)
                ->where('venue', '=', $venue)
                ->where('dog_id', '=', $dog_id)
                ->first();
    }

    public function datatables(Request $request)
    {
        $stake = 10;
        $dateString = $request->get('date_code');
        $originalDate = strtotime($dateString);
        $oneDayBefore = date("Y-m-d", strtotime("-1 day", $originalDate));

        $dogsArray = Dog::where('venue_code', $request->get('venue'))
            ->where('race_id', $request->get('raceID'))
            ->whereDate('date', $request->get('date_code'))
            ->pluck('dog_id')
            ->toArray();
            $racing = RaceForm::select('race_forms.*', 'bettings.*', 'bettings.sp as odd')
            ->join('bettings', function ($join) use ($request, $dogsArray) {
                $join->on('race_forms.dog_id', '=', 'bettings.dog_id')
                ->where('bettings.race_id', '=', $request->get('raceID'))
                ->where('bettings.sp', '>=', $request->get('odd_start'))
                ->where('bettings.sp', '<=', $request->get('odd_end'))
                ->where('bettings.date', '=', $request->get('date_code'))
                ->where('bettings.venue', '=', $request->get('venue'))
                ->whereIn('race_forms.dog_id', $dogsArray);
            });

            if (!empty($request->get('distance'))) {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE distance = ? AND Time != \'0.00\' AND Time != \'\'AND Time != \'\' AND date < \'' . $oneDayBefore . '\' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                            ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                    }
                )->setBindings([$request->get('distance')]);
            } else {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\' AND date < \'' . $oneDayBefore . '\' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                            ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                    }
                );
            }

            
            // $racing->where(\DB::raw('CAST(race_forms.SP AS DOUBLE)'), '=', 41.00);
            
            $queryRacing = $racing->orderBy('race_forms.time2', $request->get('time_order'))
                            // ->where('bettings.position', '=', '1st')
                            ->get();
            return Datatables::of($queryRacing)
                ->editColumn('dog_name', function (RaceForm $race) {
                    $dog = Dog::find($race->dog_id);
                    return $dog->dog_name;
                })
                ->addColumn('profit_loss', function(RaceForm $betting) use ($stake, $request) {
                    $win_loss = $this->getWinLoss($betting->position);
                    $profit_loss = $this->calculateProfit($win_loss, $betting->sp, $stake);
                    return '<center>'. $profit_loss .'</center>';
                })
                ->addColumn('profit_loss_int', function(RaceForm $betting) use ($stake, $request) {
                    $win_loss = $this->getWinLoss($betting->position);
                    $profit_loss = $this->calculateProfit($win_loss, $betting->sp, $stake);
                    return (int)$profit_loss;
                })
                ->addColumn('stake', function(RaceForm $betting) use ($stake) {
                    return '<center>'. $stake .'</center>';
                })
                ->addColumn('odds', function(RaceForm $betting) use ($request) {
                    return '<center class="total-amount">'. $betting->odd .'</center>';
                })
                ->addColumn('result', function(RaceForm $betting) use ($request) {
                    return '<center class="total-amount">'. $this->getWinLoss($betting->position) .'</center>';
                })
                ->filter(function ($query) use ($request) {
                })
                ->rawColumns(['profit_loss', 'profit_loss_int', 'odds', 'stake', 'result', 'dog_name', 'time_ratio', 'latest'])
                ->toJson();
    }

public function show_rank_per_race_all(mixed $request)
    {
        // $request->merge(['venue' => 'dapto']);
        // $request->merge(['raceID' => 1]);
        // $request->merge(['date_code' => '2023-11-09']);
        
        $request = array_merge($request, ['distance' => 300]);
        $return_data1 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 350]);
        $return_data2 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 400]);
        $return_data3 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 450]);
        $return_data4 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 500]);
        $return_data5 = $this->datatables_race($request);

        // dd($return_data1->getData()->data, $return_data2->getData()->data, $return_data3->getData()->data, $return_data4->getData()->data, $return_data5->getData()->data );

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

        if ($return_data1_length < 1)
            $data1 = [];
        else {
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

        if ($return_data2_length < 1)
            $data2 = [];
        else {
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
        
        if ($return_data3_length < 1)
            $data3 = [];
        else {
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
        if ($return_data4_length < 1)
            $data4 = [];
        else {
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
        if ($return_data5_length < 1)
            $data5 = [];
        else {
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
        $data_all = array_unique(array_merge($data1, $data2, $data3, $data4, $data5), SORT_REGULAR);
        $sum = 0;

        $final = [];
        foreach ($data_all as $item) {
            $final_1 = collect($final)->where('id', $item->id)->first();
            if (empty($final_1)) {
                $final[] = $item;
                $sum += $item->profit_loss_int;
            }
        }

        return [
            'sum' => $sum,
            'length' => count($final)
        ];
    }
    public function show_rank_per_race_all1(mixed $request)
    {
        // $request->merge(['venue' => 'dapto']);
        // $request->merge(['raceID' => 1]);
        // $request->merge(['date_code' => '2023-11-09']);
        
        $request = array_merge($request, ['distance' => 300]);
        $return_data1 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 350]);
        $return_data2 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 400]);
        $return_data3 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 450]);
        $return_data4 = $this->datatables_race($request);

        $request = array_merge($request, ['distance' => 500]);
        $return_data5 = $this->datatables_race($request);

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
        $data_all = array_unique(array_merge($data1, $data2, $data3, $data4, $data5), SORT_REGULAR);
        
        $final = [];
        foreach ($data_all as $item) {
            $final_1 = collect($final)->where('id', $item->id)->first();
            if (empty($final_1)) {
                $final[] = $item;
            }
        }

	$sum = 0;
        foreach($final as $data) {
            $sum += $data->profit_loss_int;
        }

        return [
            'sum' => $sum,
            'length' => count($final)
        ];
    }

    public function datatables_race(mixed $request)
    {
        $stake = 10;
        $dateString = $request['date_code'];
        $originalDate = strtotime($dateString);
        $oneDayBefore = date("Y-m-d", strtotime("-1 day", $originalDate));
        $dogsArray = Dog::where('venue_code', $request['venue'])
            ->whereIn('race_id', $request['raceID'])
            ->whereDate('date', $request['date_code'])
            ->pluck('dog_id')
            ->toArray();
//dd(json_encode($dogsArray));
            $racing = RaceForm::select('race_forms.*', 'bettings.*', 'bettings.sp as odd')
            ->join('bettings', function ($join) use ($request, $dogsArray) {
                $join->on('race_forms.dog_id', '=', 'bettings.dog_id')
                ->whereIn('bettings.race_id', $request['raceID'])
                ->where('bettings.sp', '>=', $request['odd_start'])
                ->where('bettings.sp', '<=', $request['odd_end'])
                ->where('bettings.date', '=', $request['date_code'])
                ->where('bettings.venue', '=', $request['venue'])
                ->whereIn('race_forms.dog_id', $dogsArray);
            });

            if (!empty($request['distance'])) {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE distance = ? AND Time != \'0.00\' AND Time != \'\'AND Time != \'\' AND date < \'' . $oneDayBefore . '\' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                            ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                   }
                )->setBindings([$request['distance']]);
            } else {
                $racing->join(
                    \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\' AND date < \'' . $oneDayBefore . '\' GROUP BY dog_id) as subq'),
                    function ($join) {
                        $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                            ->on(\DB::raw('CAST(race_forms.time2 AS DECIMAL(10, 2))'), '=', 'subq.highest_time');
                    }
                );
            }

            
            // $racing->where(\DB::raw('CAST(race_forms.SP AS DOUBLE)'), '=', 41.00);

            $queryRacing = $racing->orderBy('race_forms.time2', $request['time_order'])
                            // ->where('bettings.position', '=', '1st')
                            ->get();
            return Datatables::of($queryRacing)
                ->addColumn('profit_loss_int', function(RaceForm $betting) use ($stake, $request) {
                    $win_loss = $this->getWinLoss($betting->position);
                    $profit_loss = $this->calculateProfit($win_loss, $betting->sp, $stake);
                    return (int)$profit_loss;
                })
                ->rawColumns(['profit_loss', 'profit_loss_int', 'odds', 'stake', 'result', 'dog_name', 'time_ratio', 'latest'])
                ->toJson();
    }
    

    public function datatables_old(Request $request)
    {
        if($request->ajax())
        {
            $stake = $request->get('stake') ?? 10;
            $query = Betting::select(
                'bettings.dog_id as betting_dog_id',
                'bettings.date as betting_date',
                'bettings.race_id as betting_race_id',
                'bettings.position', 
                'bettings.name', 
                'bettings.created_at as betting_created_at',
                'bettings.updated_at as betting_updated_at', 
                'bettings.sp',
                'race_forms.Bon',
                'race_forms.Time',
                'race_forms.dog_id',
                'race_forms.time2',
                'race_forms.race_id',
                'race_forms.venue',
                \DB::raw('(race_forms.Time + (race_forms.Time - race_forms.Bon)) AS time_ratio'),
                'bettings.venue as betting_venue',
                'race_forms.venue as race_forms_venue',
                'race_forms.race_id as race_forms_race_id'
            )
            ->join('race_forms', function ($q) {
                $q->on('bettings.dog_id', '=', 'race_forms.dog_id');
            });
            
            if($venue = $request->get('venue')) {
                $query->where('bettings.venue', '=', $venue);
            }
            
            if($raceID = $request->get('raceID')) {
                $query->where('bettings.race_id', '=', $raceID);
            }
            
            if($raceDate = $request->get('race_date')) {
                $query->where('bettings.date', '=', date('Y-m-d', strtotime($raceDate)));
            }
            
            $query->join(
                \DB::raw('(SELECT dog_id, MIN(CAST(time2 AS DECIMAL(10, 2))) AS highest_time FROM race_forms WHERE Time != \'0.00\' AND Time != \'\' GROUP BY dog_id) as subq'),
                function ($join) {
                    $join->on('race_forms.dog_id', '=', 'subq.dog_id')
                        ->whereRaw('CAST(race_forms.time2 AS DECIMAL(10, 2)) = subq.highest_time');
                }
            );
            
            $betting = $query->orderBy('race_forms.time2', 'ASC')
                ->latest(
                    'bettings.dog_id',
                    'bettings.date',
                    'bettings.race_id',
                    'bettings.position', 
                    'bettings.name'
                );
                   
            return Datatables::of($betting)
                ->addColumn('profit_loss', function(RaceForm $betting) use ($stake) {
                    $win_loss = $this->getWinLoss($betting->position);
                    $profit_loss = $this->calculateProfit($win_loss, $betting->sp, $stake);
                    return '<center>'. $profit_loss .'</center>';
                })
                ->addColumn('stake', function(RaceForm $betting) use ($stake) {
                    return '<center>'. $stake .'</center>';
                })
                ->addColumn('odds', function(RaceForm $betting) {
                    return '<center>$'. $betting->sp .'</center>';
                })
                ->addColumn('result', function(RaceForm $betting) {
                    return '<center class="total-amount">'. $this->getWinLoss($betting->position) .'</center>';
                })
                ->addColumn('name', function(RaceForm $betting) {
                    return $this->removeChar($betting->name);
                })
                ->filter(function ($instance) use ($request) {
                    // if (!empty($request->get('dogs'))) {
                    //     $instance->whereIn('race_forms.dog_id', explode(",", $request->get('dogs')));
                    // }

                    // if (!empty($request->get('distance'))) {
                    //     $instance->where('distance', '=', $request->get('distance'));
                    // }

                    // if ($raceDate = $request->get('race_date')) {
                    //     $instance->whereDate('bettings.date', '=', date('Y-m-d', strtotime($raceDate)));
                    // }
                })
                ->rawColumns(['profit_loss', 'odds', 'stake', 'result', 'name'])
                ->toJson();
        }
    }
}
