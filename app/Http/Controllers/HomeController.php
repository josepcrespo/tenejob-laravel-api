<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Matching;
use App\Models\Shift;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Initialize the DB tables for
     * `days`, `shifts`, `workers` and, `matchings`.
     */
    public function truncateTable() {
        Day::truncate();
        Shift::truncate();
        Worker::truncate();
        Matching::truncate();

        Flash::success('The tables for the `Days`, `Shifts`, `Workers` and, `Matchings` have been reset successfully.');

        return view('home');
    }
}
