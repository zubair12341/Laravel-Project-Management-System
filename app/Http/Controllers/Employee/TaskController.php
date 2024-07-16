<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Response;

class TaskController extends Controller
{
    public function index()
    {
        $employee_id = Auth::user()->employee_id;

        $tasks = Task::where(['employee_id' => $employee_id])->orderByRaw("CASE WHEN status = 'pending' THEN 1
        WHEN status = 'in progress' THEN 2
        WHEN status = 'completed' THEN 3
        ELSE 4
   END")->orderByRaw("CASE WHEN priority = 'high' THEN 1
   WHEN priority = 'medium' THEN 2
   WHEN priority = 'normal' THEN 3
   ELSE 4
END")->orderBy('created_at', 'desc')->get();

        $modules = DB::table('task_modules')->select('module')->get();

        return view('user_account.task.list', compact('tasks', 'modules'));
    }

    public function edit($id)
    {
        $taskStatus = DB::table('tasks')->select('id', 'status')->where('id', $id)->first();

        $task = Task::find($id);

        $task_attachment = Task::find($id)->task_attachment;

        $modules = DB::table('task_modules')->select('module')->get();
        $comments = TaskComment::where('task_id', $id)->orderBy('created_at', 'desc')->get();
        return view('user_account.task.edit', compact('task', 'taskStatus', 'task_attachment', 'modules', 'comments'));

        // return response()->json([$task, $modules]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $user = User::find(auth()->user()->id);
        $task = Task::find($id);

        $task->status = $request->status;

        $task->save();
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
        }
        // return redirect('employee-task')->with('success', 'Record has been updated');
        return response()->json($task);
    }

    public function progressUpdate(Request $request, $id)
    {
        $task = Task::find($id);

        $task->progress = $request->progress;

        $task->save();

        return response()->json($task);
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
        // return response()->json('Record has been sent');

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

        if (auth()->user()->role_id == '1') {
            $message = 'New Comment Added in ' . $project->title . ' by Admin';
        } else {
            $message = 'New Comment Added in ' . $project->title . ' by ' . $user->employee->first_name;
        }

        if ($task->employee_id != null) {

            $notification = new EmployeeNotification;
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

        return redirect()->back()->with('success', 'Comment add successfully');
    }
    public function commentDelete($id)
    {
        DB::table('task_comments')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Comment delete successfully');
    }
}
