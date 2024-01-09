<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\RaceForm;
use Carbon\Carbon;
use App\Models\Dog;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $dogImported = Dog::where("imported", "=", 1)->count();
        $dogTo = Dog::where("imported", "=", 0)->count();
        return view('home', compact('dogImported', 'dogTo'));
    }
}
