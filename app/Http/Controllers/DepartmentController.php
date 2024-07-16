<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
    

        return view('department.create', compact('departments'));
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
            'name' => 'required',
       
        ]);

        $department = Department::create([
            'name' => $request->name,
        ]);

        if($department)
        {
            foreach($request->title as $key => $value){

                $designation = new Designation;
                $designation->department_id = $department->id;
                $designation->title = $request->title[$key];
                $designation->save();
            }
        }

        return redirect()->back()->with('success', 'Record has been Submitted!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        $designations = Department::find($id)->designation;
        return response()->json([
            'status' => 200,
            'departments' => $department,
             'designation'=> $designations
        ]);

        // return view('department.create', compact('department', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $department = Department::where('id', $id)->update([
            'name' => $request->name,
        ]);

        
        if($department)
        {
            foreach($request->title as $key => $value){
                // $department_id = $department->id;
                // $designation_id = $request->id[$key];
                // $data = [
                //     'title' => $request->title[$key],
                // ];

                // DB::table('designations')->where('id', $designation_id)->updateOrCreate($data);

                    // $designation = Designation::where('id', $designation_id);

                    // $designation->title = $request->title[$key];

                    // $designation->save();

                Designation::updateOrCreate([
                    'id' => $request->id[$key],
                ],
                [
                    'title' => $request->title[$key],
                ]);
            }

        }

        return redirect()->back()->with('success', 'Record has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect('/department/create');
    }
}
