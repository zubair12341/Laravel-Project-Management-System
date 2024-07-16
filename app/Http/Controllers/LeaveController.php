<?php

namespace App\Http\Controllers;
use App\Models\EmployeeNotification;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Leave;


class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::all();

        return view('leave.list', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $leave = Leave::find($id);
        
        $employee = Employee::find($id);
        

        return view('leave.edit', compact('leave'));
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
        // $this->validate($request, [
        //     'leave_type' => 'required',
        //     'from_date' => 'required',
        //     'to_date' => 'required',
        // ]);

        $leave = Leave::find($id);
    
      
       
    
     if($leave->status = $request->status){
        
        $message = 'Your Leave Status Have Been Changed';
        $notification = new EmployeeNotification;
        $notification->message = $message;
        $notification->employee_id = $id;

        $notification->save();
     }
        

        $leave->save();

        $request->session()->flash('update', 'Record has been updated');

        return redirect('leave-list');
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
