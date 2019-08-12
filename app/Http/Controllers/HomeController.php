<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Score_table;
use DB;

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
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->get();
        return view('home')->with(array('result_data'=>$result_data));
    }
    public function view()
    {
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("rank")
                        ->get();
        return $result_data;
    }
    public function view_week()
    {
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("week_rank")
                        ->get();
        return $result_data;
    }
    public function view_month()
    {
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("month_rank")
                        ->get();
        return $result_data;
    }
    public function week()
    {
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("week_rank")
                        ->get();
        return view('week_home')->with(array('result_data'=>$result_data));
    }
    public function month()
    {
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("month_rank")
                        ->get();
        return view('month_home')->with(array('result_data'=>$result_data));
    }
}
