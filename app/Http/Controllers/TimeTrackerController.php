<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeTracker;
use App\Models\TimeBreaker;
use App\Models\Employee;
use DB;
use Carbon\Carbon;

class TimeTrackerController extends Controller
{
    public function index()
    {
        
        $time_trackers = TimeTracker::orderby('id', 'desc')->get();
        $id = TimeTracker::select('employee_id')->orderby('employee_id', 'asc')->groupby('employee_id')->get();
        // $employee_id = Employee::select('id')->orderby('id', 'asc')->groupby('id')->get();
        

        return view('time_tracker.list', compact('time_trackers'));
        // return response()->json([
        //     'time_tracker_id' => $id,
        //     'employee_id'     => $employee_id
        //     ]);
        // return $time_trackers;
    }

    public function edit($id)
    {
        $timeTracker = TimeTracker::find($id);

        return response()->json($timeTracker);
    }

    public function update(Request $request, $id)
    {
        $time_tracker = TimeTracker::where('id', $id)
        ->update([
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ]);

        $ifCheckout = TimeTracker::whereNull('checkout')->where('id', $id)->first();

        if(!$ifCheckout)
        {

        $totalTime = TimeTracker::select('checkin', 'checkout')->where('id', $id)->first();

        // -------------total time between two Date time with Carbon object
        $start_time = new Carbon($totalTime->checkin);
        $end_time = new Carbon($totalTime->checkout);
        $start_time->format('g:i a');
        $end_time->format('g:i a');
        $total_time = $start_time->diffInHours($end_time). ':' .$start_time->diff($end_time)->format('%I:%S');

        $sum_total_hours = TimeBreaker::where(['time_tracker_id' => $id])
        ->sum(DB::raw("TIME_TO_SEC(total_hours)"));
        $sumBreakTime = gmdate("H:i:s", $sum_total_hours);

        $total_time = new Carbon($total_time);
        $sumBreakTime = new Carbon($sumBreakTime);
        $total_time->format('h:i:s');
        $sumBreakTime->format('h:i:s');

        $workingHours = $total_time->diffInHours($sumBreakTime). ':' .$total_time->diff($sumBreakTime)->format('%I:%S');
        $checkout=0;

        TimeTracker::where('id', $id)
        ->update([
            'total_hours' => $total_time,
            'break_hours' => $sumBreakTime,
            'working_hours' => $workingHours,
            'is_checkin' =>$checkout
            ]);

            return response()->json($time_tracker);
        }

        return response()->json($time_tracker);
    }

    // delete record ---
    public function destory($id)
    {
        // TimeTracker::find($id)->delete();
        $time_tracker = TimeTracker::find($id);
        $time_tracker->delete();

        return redirect('time-tracker')->with('delete', 'Record has been deleted');
    }

    public function editBreakTime($id)
    {
        $timeBreaker = TimeTracker::find($id)->timebreaks;

        return response()->json($timeBreaker);
    }

    public function updateBreakTimeold(Request $request, $id)
    {
        foreach($request->breakin as $key => $value)
        {
            $timebreaker = TimeBreaker::find($request->id[$key]); 
           $start = $timebreaker->breakin = $request->breakin[$key];
           $off   = $timebreaker->breakout = $request->breakout[$key];
              $timebreaker->total_hours = $request->total_hours[$key];

             
            $timebreaker->save();
        }
        
    
         return response()->json('Record has been updated!');
    }
    
    public function updateBreakTime(Request $request, $id)
    {
        
        foreach($request->breakin as $key => $value)
        {
            $timebreaker = TimeBreaker::find($request->id[$key]); 
            $start = $timebreaker->breakin = new Carbon($request->breakin[$key]);
            $off   = $timebreaker->breakout = new Carbon($request->breakout[$key]);
            $total_time = $start->diffInHours($off). ':' .$start->diff($off)->format('%I:%S');

            $sum_total_hours = TimeBreaker::where([
                'time_tracker_id' => $timebreaker->time_tracker_id,
                'employee_id' => $timebreaker->employee_id
                ])
               ->sum(DB::raw("TIME_TO_SEC(total_hours)"));
               $sumTime = gmdate("H:i:s", $sum_total_hours);
             
            $timebreaker->update([
                'total_hours' => $total_time
            ]);
        }
        
         return response()->json($total_time);
    }

}
