<?php

namespace App\Http\Controllers;

use App\Models\EmployeeNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // with() function with client model
        // $projects = Project::with('client')->get();
        if (isset($request->lead_id) && $request->lead_id !== null&&isset($request->status) && $request->status !== null &&isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('status', $request->status)->where('creater_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        else if (isset($request->lead_id) && $request->lead_id !== null&&isset($request->status) && $request->status !== null ) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('status', $request->status)->where('creater_id', auth()->user()->id)->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        elseif (isset($request->lead_id) && $request->lead_id !== null &&isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('creater_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', $request->lead_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        elseif (isset($request->status) && $request->status !== null &&isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('status', $request->status)->where('creater_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('title', 'like', '%' . $request->project_title . '%')->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        elseif (isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('creater_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('title', 'like', '%' . $request->project_title . '%')->orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        elseif (isset($request->lead_id) && $request->lead_id !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('creater_id', auth()->user()->id)->where('lead_id', $request->lead_id)->orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('lead_id', $request->lead_id)->orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        elseif (isset($request->status) && $request->status !== null) {
            if (auth()->user()->role_id == '4') {
                $projects = Project::where('creater_id', auth()->user()->id)->where('status', $request->status)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {

            if (auth()->user()->role_id == '4') {
                $projects = Project::where('creater_id', auth()->user()->id)->orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::orderByRaw("CASE WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        $users = User::where('role_id', 3)->get();

        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->whereIn('employee_status', ['Permanent', 'Internee', 'Probation'])->get();
        return view('project.list', compact('projects', 'users', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_id', 3)->get();

        return view('project.create', compact('users'));
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
            'lead_id' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'service' => 'required',
            'project_type' => 'required',
        ]);

        $project = new Project;

        $project->lead_id = $request->lead_id;
        $project->creater_id = auth()->user()->id;
        $project->title = $request->title;
        $project->project_type = $request->project_type;
        $project->status = $request->status;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->technology = $request->technology;
        $project->website = $request->website;
        $project->service = $request->service;
        $project->note = $request->note;

        $project->save();

        $message = 'New Project Added ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'lead';
        $notification->employee_id = $project->lead_id;
        $notification->message = $message;
        $notification->link = url('project/' . $project->id . '/task');
        $notification->save();

        $message = 'New Project Added ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'sale';
        $notification->employee_id = $project->creater_id;
        $notification->message = $message;
        $notification->link = url('project/' . $project->id . '/task');
        $notification->save();

        $message = 'New Project Added ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'admin';
        $notification->employee_id = 0000;
        $notification->message = $message;
        $notification->link = url('project/' . $project->id . '/task');
        $notification->save();

        return redirect('project')->with('success', 'Record has been saved');
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
        $users = User::where('role_id', 3)->get();
        $project = Project::find($id);
        return response()->json([
            'status' => 200,
            'users' => $users,
            'project' => $project,
        ]);
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
        //dd($request->all());
        $this->validate($request, [
            //  'lead_id' => 'required',
            //     'title' => 'required',
            //     'start_date' => 'required',
            //    // 'status' => 'required',
            //     'service' => 'required',
        ]);

        $project = Project::find($id);

        $project->lead_id = $request->lead_id;
        $project->title = $request->title;
        $project->project_type = $request->project_type;
        $project->status = $request->status;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->technology = $request->technology;
        $project->website = $request->website;
        $project->service = $request->service;
        $project->note = $request->note;

        $project->save();

        return redirect()->back()->with('update', 'Record has been updated');
    }

    public function dataUpdate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            //  'lead_id' => 'required',
            //     'title' => 'required',
            //     'start_date' => 'required',
            //    // 'status' => 'required',
            //     'service' => 'required',
        ]);

        $project = Project::find($request->project_id);
        if (isset($request->lead_id) && $request->lead_id != null) {

            $project->lead_id = $request->lead_id;
        }
        $project->title = $request->title;
        if (isset($request->project_type) && $request->project_type != null) {
            $project->project_type = $request->project_type;
        }
        if (isset($request->status) && $request->status != null) {
            $project->status = $request->status;
        }
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->technology = $request->technology;
        $project->website = $request->website;
        if (isset($request->service) && $request->service != null) {
            $project->service = $request->service;
        }
        $project->note = $request->note;

        $project->save();

        return redirect()->back()->with('update', 'Record has been updated');
    }
    public function projectTasks($id)
    {

        $project = Project::find($id);
        $projectTasks = DB::table('tasks')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('employees', 'employees.id', '=', 'tasks.employee_id')
            ->select(
                'employees.id',
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'projects.title',
                'tasks.id',
                'tasks.task_no',
                'tasks.priority',
                'tasks.assign_date',
                'tasks.deadline_date',
                'tasks.status',
                'tasks.progress',
                'tasks.note'
            )
            ->where('project_id', $id)
            ->get();
        $completeTasks = $projectTasks->where('status', 'complete');
        $ongoingTasks = $projectTasks->where('status', 'ongoing');

        $workingTasks = $projectTasks->where('status', 'working on it');
        $stuckTasks = $projectTasks->where('status', 'stuck');
        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->whereIn('employee_status', ['Permanent', 'Internee', 'Probation'])->get();
        $projects = Project::all();
        return view('project.task', compact('project', 'projectTasks', 'employees', 'completeTasks', 'ongoingTasks', 'workingTasks', 'stuckTasks', 'projects'));
    }

    public function delete($id)
    {
        $project = Project::find($id);
        $task = Task::where('project_id', $project->id)->get();

        foreach ($task as $value) {
            $value->delete();
        }
        $project->delete();
        return redirect()->back()->with('delete', 'Record has been deleted');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $task = Task::where('project_id', $project->id)->get();

        foreach ($task as $value) {
            $value->delete();
        }
        $project->delete();

        return redirect('project');
    }
}
