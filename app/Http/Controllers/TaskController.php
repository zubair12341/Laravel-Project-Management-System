<?php

namespace App\Http\Controllers;

use App\Exports\TaskProgressExport;
use App\Models\Employee;
use App\Models\EmployeeNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->sale_id) && $request->sale_id !== null && isset($request->status) && $request->status !== null && isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('status', $request->status)->where('creater_id', $request->sale_id)->where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', auth()->user()->id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('title', 'like', '%' . $request->project_title . '%')->where('creater_id', $request->sale_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        } elseif (isset($request->sale_id) && $request->sale_id !== null && isset($request->status) && $request->status !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('status', $request->status)->where('creater_id', $request->sale_id)->where('lead_id', auth()->user()->id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('creater_id', $request->sale_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        } elseif (isset($request->sale_id) && $request->sale_id !== null && isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('creater_id', $request->sale_id)->where('title', 'like', '%' . $request->project_title . '%')->where('lead_id', auth()->user()->id)->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('title', 'like', '%' . $request->project_title . '%')->where('creater_id', $request->sale_id)->orderBy('created_at', 'desc')
                    ->get();
            }
        } elseif (isset($request->status) && $request->status !== null && isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('status', $request->status)->where('lead_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->where('title', 'like', '%' . $request->project_title . '%')->orderBy('created_at', 'desc')
                    ->get();
            }
        } elseif (isset($request->project_title) && $request->project_title !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('lead_id', auth()->user()->id)->where('title', 'like', '%' . $request->project_title . '%')->orderByRaw("CASE WHEN status = 'pending' THEN 1
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
        } elseif (isset($request->sale_id) && $request->sale_id !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('creater_id', $request->sale_id)->where('lead_id', auth()->user()->id)->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('creater_id', $request->sale_id)->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'process' THEN 2
                WHEN status = 'completed' THEN 3
                WHEN status = 'terminated' THEN 4
                ELSE 5
           END")
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } elseif (isset($request->status) && $request->status !== null) {
            if (auth()->user()->role_id == '3') {
                $projects = Project::where('lead_id', auth()->user()->id)->where('status', $request->status)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {

                $projects = Project::where('status', $request->status)->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {

            if (auth()->user()->role_id == '3') {
                $projects = Project::where('lead_id', auth()->user()->id)->orderByRaw("CASE WHEN status = 'pending' THEN 1
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

        // if (auth()->user()->role_id == '3') {
        //     $projects = Project::where('lead_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        // } else {

        //     $projects = Project::orderBy('created_at', 'desc')->get();
        // }

        $users = User::all();
        $sale = User::where('role_id', 4)->get();
        // dd($projects);
        if (count($projects) != 0) {

            foreach ($projects as $project) {

                foreach ($users as $user) {

                    $tasks = Task::where('employee_id', $user->id)->where('project_id', $project->id)->get();
                    // $tasksCount = Task::where('project_id', $project->id)->count();
                    $task = $project->task_attachment;

                    foreach ($task as $tsk) {
                        $a[] = $tsk->task_id;
                    }
                }
            }
        } else {

            $tasks = '';
        }
        // dd($a);

        // $tasks = Task::where('project_id', $projects->id);
        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->whereIn('employee_status', ['Permanent', 'Internee', 'Probation'])->get();

        return view('task.list', ['projects' => $projects, 'employees' => $employees, 'tasks' => $tasks, 'sale' => $sale]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role_id == '1') {
            $projects = DB::table('projects')->select('id', 'title')->get();
        } else {
            $projects = DB::table('projects')->where('creater_id', auth()->user()->id)->select('id', 'title')->get();
        }

        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->whereIn('employee_status', ['Permanent', 'Internee', 'Probation'])->get();

        $task = DB::table('tasks')->latest()->first();
        if (!$task) {
            $newTaskNo = "0000001";
            return view('task.create', compact('employees', 'projects', 'newTaskNo'));
        }

        $lastTaskNo = DB::table('tasks')->orderBy('id', 'desc')->pluck('task_no')->first();
        $task_no = preg_replace("/[^0-9\.]/", '', $lastTaskNo);
        $newTaskNo = sprintf('%07d', $task_no + 1);

        return view('task.create', compact('employees', 'projects', 'newTaskNo'));
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
            'project_id' => 'required',
            //'task_no' => 'required|unique:tasks',
            'priority' => 'required',
            'assign_date' => 'required',
        ]);

        $task = new Task;

        $task->project_id = $request->project_id;
        if (auth()->user()->role_id != '4') {
            $task->employee_id = $request->employee_id;
        }
        $task->priority = $request->priority;
        $task->assign_date = $request->assign_date;
        $task->deadline_date = $request->deadline_date;
        $task->status = $request->status;
        $task->task_no = $request->newtaskno;
        $task->progress = 0;
        $task->note = $request->note;

        $storeTask = $task->save();

        if ($storeTask) {

            foreach ($request->attachment ?: [] as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/storage/task_files');
                $filePath = $destinationPath . "/" . $filename;
                $file->move($destinationPath, $filename);
                $my_path = asset('/public/storage/task_files/' . $filename);
                DB::table('task_attachments')->insert([
                    'task_id' => $task->id,
                    'attachment' => $my_path,
                ]);
            }
        }

        $project = Project::find($request->project_id);
        if ($task->employee_id != null) {

            $message = 'New Task Assign in ' . $project->title . '';
            $notification = new EmployeeNotification;
            // $notification->sale_id = $request->creater_id;
            $notification->for = 'employee';
            $notification->employee_id = $request->employee_id;
            $notification->message = $message;
            $notification->link = url('task/' . $task->id . '/edit');
            $notification->save();
        }

        $message = 'New Task Added in ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'lead';
        $notification->employee_id = $project->lead_id;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        $message = 'New Task Added in ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'sale';
        $notification->employee_id = $project->creater_id;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        $message = 'New Task Added in ' . $project->title . '';
        $notification = new EmployeeNotification;
        $notification->for = 'admin';
        $notification->employee_id = 0000;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        return redirect('task-tracker/create')->with('success', 'Record has been submited');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $task = Task::find($id);

        $projects = DB::table('projects')->select('id', 'title')->get();
        if (auth()->user()->role_id == '3') {
            $employees = DB::table('employees')->where('employee_id', auth()->user()->id)->select('id', 'first_name', 'middle_name', 'last_name')->get();
        } else {

            $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->get();
        }

        $task_attachment = Task::find($id)->task_attachment;

        return view('task.edit', compact('task', 'projects', 'employees', 'task_attachment'));
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
            // 'project_id' => 'required',
            // 'employee_id' => 'required',
            // 'priority' => 'required',
            // 'assign_date' => 'required',
        ]);

        $task = Task::find($id);
        if (auth()->user()->role_id == '3') {
            $task->employee_id = $request->employee_id;
        } else {
            if (auth()->user()->role_id == '1') {
                $task->employee_id = $request->employee_id;
            }
            $task->project_id = $request->project_id;
            $task->priority = $request->priority;
            $task->progress = $request->progress;
            $task->assign_date = $request->assign_date;
            $task->deadline_date = $request->deadline_date;
            $task->status = $request->status;
            $task->note = $request->note;
        }

        if ($task->save()) {
            foreach ($request->attachment ?: [] as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/storage/task_files');
                $filePath = $destinationPath . "/" . $filename;
                $file->move($destinationPath, $filename);
                $my_path = asset('/public/storage/task_files/' . $filename);
                DB::table('task_attachments')->insert([
                    'task_id' => $task->id,
                    'attachment' => $my_path,
                ]);
                // Storage::disk('task-attachment')->delete($old_image);
            }
        }
        $user = User::find(auth()->user()->id);
        $project = Project::find($task->project_id);
        if ($task->status == 'completed') {
            if (auth()->user()->role_id == '1') {
                $message = 'Task status completed in ' . $project->title . ' by Admin';
            } else {
                $message = 'Task status completed in ' . $project->title . ' by ' . $user->employee->first_name;
            }

            if ($task->employee_id != null) {

                $notification = new EmployeeNotification;
                // $notification->sale_id = $request->creater_id;
                $notification->for = 'employee';
                $notification->employee_id = $task->employee_id;
                $notification->message = $message;
                $notification->link = url('task/' . $task->id . '/edit');
                $notification->save();
            }

            $notification = new EmployeeNotification;
            $notification->for = 'lead';
            $notification->employee_id = $project->lead_id;
            $notification->message = $message;
            $notification->link = url('task-taker/' . $task->id . '/view');
            $notification->save();

            $notification = new EmployeeNotification;
            $notification->for = 'sale';
            $notification->employee_id = $project->creater_id;
            $notification->message = $message;
            $notification->link = url('task-taker/' . $task->id . '/view');
            $notification->save();

            $notification = new EmployeeNotification;
            $notification->for = 'admin';
            $notification->employee_id = 0000;
            $notification->message = $message;
            $notification->link = url('task-taker/' . $task->id . '/view');
            $notification->save();

        } else {

            if ($request->employee_id != null) {
                $project = Project::find($task->project_id);
                $message = 'New Task Assign in ' . $project->title . '';
                $notification = new EmployeeNotification;
                $notification->for = 'employee';
                $notification->employee_id = $request->employee_id;
                $notification->link = url('task/' . $task->id . '/edit');
                $notification->message = $message;

                $notification->save();
            }
        }
        if (auth()->user()->role_id == '4') {
            return redirect('project')->with('update', 'Task updated successfully');
        }
        return redirect('task-tracker')->with('update', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id)->delete();
        // $task = Task::find($id)->task_attachment->delete();
        // Storage::disk('task-attachment')->delete($task->attachment);

        return redirect('/task-tracker')->with('success', 'Task deleted successfully');
    }

    public function viewTaskProgress($id)
    {
        $viewTaskProgress = DB::table('task_progress')
            ->join('tasks', 'tasks.id', '=', 'task_progress.task_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('employees', 'employees.id', '=', 'tasks.employee_id')
            ->select(
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
            ->where('tasks.id', $id)
            ->first();

        $viewWorkDetail = DB::table('task_progress')
            ->join('tasks', 'tasks.id', '=', 'task_progress.task_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->join('employees', 'employees.id', '=', 'tasks.employee_id')
            ->select(
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'projects.title',
                'clients.full_name',
                'task_progress.id',
                'task_progress.date',
                'task_progress.module',
                'task_progress.hours',
                'task_progress.work_detail',
                'tasks.status',
                'tasks.progress'
            )
            ->where('task_progress.task_id', $id)
            ->get();

        $modules = DB::table('task_modules')->select('module')->get();

        $projects = Project::select('title')->get();
        $employees = Employee::select('first_name', 'middle_name', 'last_name')->get();

        return view('task.task_progress', compact('viewWorkDetail', 'viewTaskProgress', 'modules', 'projects', 'employees'));
    }

    public function checkViewProgress($id)
    {
        $checkViewProgress = DB::table('task_progress')
            ->join('tasks', 'tasks.id', '=', 'task_progress.task_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('employees', 'employees.id', '=', 'tasks.employee_id')
            ->select(
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'projects.title',
                'tasks.task_no',
                'tasks.id',
                'tasks.priority',
                'tasks.assign_date',
                'tasks.deadline_date',
                'tasks.status',
                'tasks.progress',
            )
            ->where('tasks.id', $id)
            ->first();

        return response()->json($checkViewProgress);
    }

    public function taskEdit($id)
    {
        $editTask = Task::where('id', $id)->first();

        return response()->json($editTask);
    }

    public function taskProgressEdit($id)
    {
        $taskProgress = DB::table('task_progress')->where('id', $id)->first();

        return response()->json($taskProgress);
    }

    public function taskProgressUpdate(Request $request, $id)
    {
        $taskProgressUpdate = DB::table('task_progress')
            ->where('id', $id)
            ->update([
                'date' => $request->date,
                'module' => $request->module,
                'hours' => $request->hours,
                'work_detail' => $request->work_detail,
            ]);

        return response()->json('Task Progress Updated!');
    }

    public function taskReport()
    {
        $taskReport = DB::table('task_progress')
            ->join('tasks', 'tasks.id', '=', 'task_progress.task_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->join('employees', 'employees.id', '=', 'tasks.employee_id')
            ->select(
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'projects.title',
                'clients.full_name',
                'task_progress.date',
                'task_progress.module',
                'task_progress.hours',
                'task_progress.work_detail'
            )
            ->get();

        return view('task.report', compact('taskReport'));
    }

    public function getDownload(Request $request, $id)
    {
        try {
            $task = TaskAttachment::find($id);
            $file = public_path() . "/storage/task_files/" . $task->attachment;
            $headers = array(
                'Content-Type: application/*',
            );
            return response()->download($file, $task->attachment, $headers);
        } catch (\Exception $e) {
            return view('errors.file_not_found');
        }
    }

    public function deleteDownload($id)
    {
        DB::table('task_attachments')->where('id', $id)->delete();

        return response()->json([
            'message' => 'File deleted successfully!',
        ]);
    }

    public function taskModuleForm()
    {
        $taskModules = DB::table('task_modules')->get();

        return view('task.create_task_module', compact('taskModules'));
    }

    public function taskModuleStore(Request $request)
    {
        $this->validate($request, [
            'module' => 'required',
        ]);

        DB::table('task_modules')->insert([
            'module' => $request->module,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Record submitted successfully');
    }

    public function taskModuleEdit($id)
    {
        $taskModule = DB::table('task_modules')->where('id', $id)->first();

        return response()->json($taskModule);
    }

    public function taskModuleUpdate(Request $request, $id)
    {
        $taskModule = DB::table('task_modules')
            ->where('id', $id)
            ->update([
                'module' => $request->module,
            ]);

        return response()->json($taskModule);
    }

    public function taskModuleDestory($id)
    {
        DB::table('task_modules')->where('id', $id)->delete();

        return response()->json([
            'message' => 'Record deleted successfully!',
        ]);
    }

    public function taskExport()
    {
        return Excel::download(new TaskProgressExport, 'Project_Progress.xlsx');
    }

    public function view($id)
    {
        $taskStatus = DB::table('tasks')->select('id', 'status')->where('id', $id)->first();
        $task = Task::find($id);
        $task_attachment = Task::find($id)->task_attachment;
        $modules = DB::table('task_modules')->select('module')->get();
        $comments = TaskComment::where('task_id', $id)->orderBy('created_at', 'desc')->get();
        return view('task.view', compact('task', 'taskStatus', 'task_attachment', 'modules', 'comments'));

        // return response()->json([$task, $modules]);
    }

    public function progressUpdate(Request $request, $id)
    {
        $task = Task::find($id);

        $task->progress = $request->progress;

        $task->save();

        return response()->json($task);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $task = Task::find($id);

        $task->status = $request->status;

        $task->save();

        // return redirect('employee-task')->with('success', 'Record has been updated');
        return response()->json($task);
    }

    public function taskProgressStore(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'module' => 'required',
            'hours' => 'required',
            'work_detail' => 'required',
        ]);

        $task = Task::find($id);

        $data = [
            'task_id' => $task->id,
            'date' => $request->date,
            'module' => $request->module,
            'hours' => $request->hours,
            'work_detail' => $request->work_detail,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('task_progress')->insert([$data]);

        return redirect()->back()->with('success', 'Task progress submit successfully');
    }

    public function addComment(Request $request)
    {
//dd($request->all());
        $task = Task::find($request->task_id);
        $project = Project::find($task->project_id);
        $user = User::find(auth()->user()->id);
        $comment = new TaskComment();
        $comment->comment = $request->comment;
        $comment->task_id = $task->id;
        $comment->employee_id = $user->employee_id;
        $comment->save();

        if (auth()->user()->role_id == '1') {
            $message = 'New Comment Added in ' . $project->title . ' by Admin';
        } else {
            $message = 'New Comment Added in ' . $project->title . ' by ' . $user->employee->first_name;
        }

        if ($task->employee_id != null) {

            $notification = new EmployeeNotification;
            // $notification->sale_id = $request->creater_id;
            $notification->for = 'employee';
            $notification->employee_id = $task->employee_id;
            $notification->message = $message;
            $notification->link = url('task/' . $task->id . '/edit');
            $notification->save();
        }

        $notification = new EmployeeNotification;
        $notification->for = 'lead';
        $notification->employee_id = $project->lead_id;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        $notification = new EmployeeNotification;
        $notification->for = 'sale';
        $notification->employee_id = $project->creater_id;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        $notification = new EmployeeNotification;
        $notification->for = 'admin';
        $notification->employee_id = 0000;
        $notification->message = $message;
        $notification->link = url('task-taker/' . $task->id . '/view');
        $notification->save();

        foreach ($request->attachment ?: [] as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/storage/task_comments');
            $filePath = $destinationPath . "/" . $filename;
            $file->move($destinationPath, $filename);
            $my_path = asset('/public/storage/task_comments/' . $filename);
            DB::table('task_comment_files')->insert([
                'task_comment_id' => $comment->id,
                'file' => $my_path,
            ]);
            // Storage::disk('task-attachment')->delete($old_image);
        }

        return redirect()->back()->with('success', 'Comment add successfully');
    }
    public function commentDelete($id)
    {
        DB::table('task_comments')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Comment delete successfully');
    }
}
