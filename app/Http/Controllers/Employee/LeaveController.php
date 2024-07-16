<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeId = Auth::user()->employee_id;
        $leaves = Leave::where('employee_id', $employeeId)->get();

        return view('user_account.leave.list', compact('leaves'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_account.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'days' => 'required',
        ]);

        $employeeId = Auth::user()->employee_id;

        $data = [
            'employee_id' => $employeeId,
            'leave_type' => $request->leave_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'days' => $request->days,
            'reason' => $request->reason,
            'status' => "pending",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];

        Leave::insert([$data]);

        return redirect('leave/create')->with('success', 'Record has been submited');
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
        $leave = Leave::find($id);

        return view('user_account.leave.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'days' => 'required'
        ]);

        $leave = Leave::find($id);

        $leave->leave_type = $request->leave_type;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->days = $request->days;
        $leave->reason = $request->reason;

        $leave->save();

        return redirect()->back()->with('update', 'Record has been updated');
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
