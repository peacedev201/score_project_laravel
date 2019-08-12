<?php

namespace App\Http\Controllers;
use App\User;
use App\Score_table;
use DB;

use Illuminate\Http\Request;

class Score_tableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $score = Score_table::all();
        // echo($score); exit;
        return $score;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {   
        $user_id = $data['id'];
        $score_data = Score_table::where('user_id', '=', $user_id)->get();

        if(($score_data->count()<>0)){
            // $today_score = $score_data->points;
            Score_table::where('user_id', '=', $user_id)->update(['points' => $data['score'] + $score_data[0]["points"],'week_points' => $data['score'] + $score_data[0]["week_points"],'month_points' => $data['score'] + $score_data[0]["month_points"]]);
        }
        
        else{
            
            Score_table::create([
                'user_id' => $data['id'],
                'points' => $data['score'],
                'week_points' => $data['score'],
                'month_points' => $data['score'],
            ]);
        }

        $results = Score_table::orderBy('points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['pre_rank' => $result->rank]);
            $i = $i - 1;
        }
        $results = Score_table::orderBy('week_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['week_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['week_pre_rank' => $result->week_rank]);
            $i = $i - 1;
        }
        $results = Score_table::orderBy('month_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['month_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['month_pre_rank' => $result->month_rank]);
            $i = $i - 1;
        }

        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("rank")
                        ->get();
        return view('home')->with(array('result_data'=>$result_data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Score_table::where('user_id', '=', $request->id)->update(['points' => $request->points]);
        User::where('id', '=', $request->id)->update(['name' => $request->name, 'team' => $request->team]);
        $results = Score_table::orderBy('points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['pre_rank' => $result->rank]);
            $i = $i - 1;
        }
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("rank")
                        ->get();
        // return view('home')->with(array('result_data'=>$result_data));
        return $result_data;

    }

    public function week_update(Request $request)
    {
        Score_table::where('user_id', '=', $request->id)->update(['week_points' => $request->points]);
        User::where('id', '=', $request->id)->update(['name' => $request->name, 'team' => $request->team]);
        $results = Score_table::orderBy('week_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['week_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['week_pre_rank' => $result->rank]);
            $i = $i - 1;
        }
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("week_rank")
                        ->get();
        // return view('home')->with(array('result_data'=>$result_data));
        return $result_data;

    }

    public function month_update(Request $request)
    {
        Score_table::where('user_id', '=', $request->id)->update(['month_points' => $request->points]);
        User::where('id', '=', $request->id)->update(['name' => $request->name, 'team' => $request->team]);
        $results = Score_table::orderBy('month_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['month_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['month_pre_rank' => $result->rank]);
            $i = $i - 1;
        }
        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("month_rank")
                        ->get();
        // return view('home')->with(array('result_data'=>$result_data));
        return $result_data;

    }

    public function delete(Request $request)
    {
        Score_table::where('user_id', '=', $request->id)->delete();
        User::where('id', '=', $request->id)->delete();
        
        $results = Score_table::orderBy('points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['pre_rank' => $result->rank]);
            $i = $i - 1;
        }
        $results = Score_table::orderBy('week_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['week_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['week_pre_rank' => $result->week_rank]);
            $i = $i - 1;
        }
        $results = Score_table::orderBy('month_points')->get();
        $i = $results->count();    
        foreach($results as $result){
            Score_table::where('user_id', '=', $result->user_id)->update(['month_rank' => $i]);
            Score_table::where('user_id', '=', $result->user_id)->update(['month_pre_rank' => $result->month_rank]);
            $i = $i - 1;
        }

        $result_data = DB::table('score_tables')
                        ->join('users', 'score_tables.user_id', '=', 'users.id')
                        ->orderby("rank")
                        ->get();
        return $result_data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
