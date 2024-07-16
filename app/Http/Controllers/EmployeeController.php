<?php

namespace App\Http\Controllers;

use App\Mail\Crediential;
use App\Mail\LinkSend;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeDocuments;
use App\Models\User;
use App\Models\EmployeeNotification;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $permanentEmployees = Employee::where(['employee_status' => 'Permanent'])->get();
        $probationEmployees = Employee::where(['employee_status' => 'Probation'])->get();

        $interneeEmployees = Employee::where(['employee_status' => 'Internee'])->get();
        $terminatedEmployees = Employee::where(['employee_status' => 'Terminated'])->get();
        $xEmployees = Employee::where(['employee_status' => 'X-Employee'])->get();
        $roles = DB::table('roles')->select('id', 'role_type')->get();
        return view('employee.list', compact('employees', 'permanentEmployees', 'probationEmployees', 'interneeEmployees', 'terminatedEmployees', 'xEmployees', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = DB::table('employees')->latest()->first();
        if (!$employee) {
            $newEmployeeNo = "EMP-000001";
            return view('employee.create', compact('newEmployeeNo'));
        }

        $lastEmployeeNo = DB::table('employees')->orderBy('id', 'desc')->pluck('employee_no')->first();
        $prefix = "EMP-";
        $employee_no = preg_replace("/[^0-9\.]/", '', $lastEmployeeNo);
        $newEmployeeNo = $prefix . sprintf('%06d', intval($employee_no) + 1);

        $employees = User::where('role_id', '3')->get();
        $designations = Designation::select('id', 'title')->get();

        return view('employee.create', compact('newEmployeeNo', 'employees', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function userCreate(Request $request)
    {
        $emp = Employee::find($request->emp_id);

        $user = new User();
        $user->employee_id = $emp->id;
        $user->role_id = $request->role_id;
        $user->email = $emp->email;
        $password = $emp->first_name . '@11223344';
        $user->password = Hash::make($password);
        $user->status = 1;
        $user->save();
        $emp->is_user = 'true';
        $emp->save();
        \Mail::to($user->email)->send(new Crediential($password, $user->email));
        return redirect('employee')->with('success', 'User has been created');
    }

    public function linkGenerate()
    {
        $employee = DB::table('employees')->latest()->first();
        if (!$employee) {
            $newEmployeeNo = "EMP-000001";
            return view('employee.link', compact('newEmployeeNo'));
        }

        $lastEmployeeNo = DB::table('employees')->orderBy('id', 'desc')->pluck('employee_no')->first();
        $prefix = "EMP-";
        $employee_no = preg_replace("/[^0-9\.]/", '', $lastEmployeeNo);
        $newEmployeeNo = $prefix . sprintf('%06d', intval($employee_no) + 1);

        $employees = User::where('role_id', '3')->get();
        $designations = Designation::select('id', 'title')->get();

        return view('employee.link', compact('newEmployeeNo', 'employees', 'designations'));
    }

    public function empLinkGenerate(Request $request)
    {

        $employee = new Employee;

        $employee->employee_no = $request->employee_no;
        $employee->email = $request->other_email;
        $employee->other_email = $request->other_email;

        $employee->designation_id = $request->designation_id;
        $employee->joining_date = $request->joining_date;
        $employee->ending_date = $request->ending_date;
        $employee->employee_id = $request->employee_id;
        $employee->working_time_start = $request->working_time_start;
        $employee->working_time_end = $request->working_time_end;
        $employee->termination_date = $request->termination_date;
        $employee->job_status = $request->job_status;
        $employee->probation_period_start = $request->probation_period_start;
        $employee->probation_period_end = $request->probation_period_end;
        $employee->internship_period_start = $request->internship_period_start;
        $employee->internship_period_end = $request->internship_period_end;
        $employee->save();
        $url = route('emp.fill-data', $employee->id);
        \Mail::to($employee->email)->send(new LinkSend($url));
        return redirect('employee')->with('success', 'Link has been created');
    }

    public function fillData($id)
    {
        $employee = Employee::find($id);

        return view('employee.create_acc', compact('employee'));
    }

    public function compAcc(Request $request)
    {

        $employee = Employee::find($request->emp_id);

        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->qualification = $request->qualification;
        $employee->cnic = $request->cnic;
        $employee->mobile_no = $request->mobile_no;
        $employee->home_phone = $request->home_phone;
        $employee->emergency_contact = $request->emergency_contact;
        $employee->email = $request->other_email;
        $employee->other_email = $request->other_email;
        $employee->country = $request->country;
        $employee->province_state = $request->province_state;
        $employee->city = $request->city;
        $employee->nationality = $request->nationality;
        $employee->postal_code = $request->postal_code;
        $employee->address = $request->address;
        $employee->notes = $request->notes;

        $employee->source = $request->source;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/storage/profile_images');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $my_path = asset('/public/storage/profile_images/' . $name);
            $employee->profile_image = $my_path;
        }

        if ($employee->save()) {
            foreach ($request->file ?: [] as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/storage/employee_documents');
                $filePath = $destinationPath . "/" . $filename;
                $file->move($destinationPath, $filename);
                $my_path = asset('/public/storage/employee_documents/' . $filename);
                EmployeeDocuments::create([
                    'employee_id' => $employee->id,
                    'file' => $my_path,
                ]);
            }
        }

        $message = '' . $employee->first_name . ' has complete his profile.';
        $notification = new EmployeeNotification;
        $notification->for = 'admin';
        $notification->employee_id = 0000;
        $notification->message = $message;
        $notification->link = url('/employee');
        $notification->save();

        return redirect()->route('success.page', $employee->id);
    }

    public function success($id)
    {
        $employee = Employee::find($id);

        return view('success', compact('employee'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'employee_no' => 'required|unique:employees',
            'first_name' => 'required',
            // 'last_name' => 'required',
            // 'gender' => 'required',
            // 'cnic' => 'unique:employees',
            // 'mobile_no' => 'required|unique:employees',
            // 'email' => 'required|unique:employees',
            // 'profile_image' => 'image|mimes:jpeg,png,jpg',
            // 'designation_id' => 'required',

            // 'job_status' => 'required',
            // 'salary' => 'nullable|numeric',
            // 'file.*' => 'mimes:jpeg, png, jpg, pdf, docx, doc'
        ],
            [
                // 'profile_image.mimes'=> 'Image must be in jpeg, png, jpg',
                // 'designation_id.required' => 'Designation is required',
                // 'employee_id.required' => 'Supervisor is required',
                // 'file.mimes' => 'File must be jpeg, png, jpg, pdf, docx, doc'
            ]
        );

        $employee = new Employee;

        $employee->employee_no = $request->employee_no;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->qualification = $request->qualification;
        $employee->cnic = $request->cnic;
        $employee->mobile_no = $request->mobile_no;
        $employee->home_phone = $request->home_phone;
        $employee->emergency_contact = $request->emergency_contact;
        $employee->email = $request->other_email;
        $employee->other_email = $request->other_email;
        $employee->country = $request->country;
        $employee->province_state = $request->province_state;
        $employee->city = $request->city;
        $employee->nationality = $request->nationality;
        $employee->postal_code = $request->postal_code;
        $employee->address = $request->address;
        $employee->notes = $request->notes;
        $employee->designation_id = $request->designation_id;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;
        $employee->ending_date = $request->ending_date;
        $employee->employee_id = $request->employee_id;
        $employee->working_time_start = $request->working_time_start;
        $employee->working_time_end = $request->working_time_end;
        $employee->termination_date = $request->termination_date;
        $employee->job_status = $request->job_status;
        $employee->probation_period_start = $request->probation_period_start;
        $employee->probation_period_end = $request->probation_period_end;
        $employee->internship_period_start = $request->internship_period_start;
        $employee->internship_period_end = $request->internship_period_end;
        $employee->source = $request->source;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/storage/profile_images');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $my_path = asset('/public/storage/profile_images/' . $name);
            $employee->profile_image = $my_path;
        }

        if ($employee->save()) {
            foreach ($request->file ?: [] as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/storage/employee_documents');
                $filePath = $destinationPath . "/" . $filename;
                $file->move($destinationPath, $filename);
                $my_path = asset('/public/storage/employee_documents/' . $filename);
                EmployeeDocuments::create([
                    'employee_id' => $employee->id,
                    'file' => $my_path,
                ]);
            }
        }

        // $employee = Employee::get($employee->id);
        // $daysLeft = $employee->date_of_birth->diffInDays(Carbon::now());
        // $admin = auth()->user()->role_id == 1;

        // $employee->notify( new AdminNotification($daysLeft,$employee));
        // Notification::send($admin, new AdminNotificationtion($employee, $daysLeft));

        return redirect('employee')->with('success', 'Record has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $employeeDocs = Employee::find($id)->documents;

        return view('employee.show', compact('employee', 'employeeDocs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $employeeDocs = Employee::find($id)->documents;

        $emps = User::where('role_id', '3')->get();
        $designations = Designation::select('id', 'title')->get();

        return view('employee.edit', compact('employee', 'employeeDocs', 'emps', 'designations'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'mobile_no' => "required|unique:employees,mobile_no,$id",
            'email' => "required|unique:employees,email,$id",
            'profile_image' => 'image|mimes:jpeg,png,jpg',
            'designation_id' => 'required',
            // 'employee_id' => 'required',
            'job_status' => 'required',
            'salary' => 'nullable|numeric',
            // 'file.*' => 'mimes:jpeg, png, jpg, pdf, docx, doc'
        ],
            [
                'profile_image.mimes' => 'Image must be in jpeg, png, jpg',
                'designation_id.required' => 'Designation is required',
                'employee_id.required' => 'Supervisor is required',
            ]);

        $employee = Employee::find($id);

        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->qualification = $request->qualification;
        $employee->cnic = $request->cnic;
        $employee->mobile_no = $request->mobile_no;
        $employee->home_phone = $request->home_phone;
        $employee->emergency_contact = $request->emergency_contact;
        $employee->email = $request->email;
        $employee->other_email = $request->email;
        $employee->country = $request->country;
        $employee->province_state = $request->province_state;
        $employee->city = $request->city;
        $employee->nationality = $request->nationality;
        $employee->postal_code = $request->postal_code;
        $employee->address = $request->address;
        $employee->notes = $request->notes;
        $employee->designation_id = $request->designation_id;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;
        $employee->ending_date = $request->ending_date;
        $employee->employee_id = $request->employee_id;
        $employee->working_time_start = $request->working_time_start;
        $employee->working_time_end = $request->working_time_end;
        $employee->termination_date = $request->termination_date;
        $employee->job_status = $request->job_status;

        $employee->probation_period_start = $request->probation_period_start;
        $employee->probation_period_end = $request->probation_period_end;
        $employee->internship_period_start = $request->internship_period_start;
        $employee->internship_period_end = $request->internship_period_end;
        $employee->source = $request->source;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/storage/profile_images');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $old_image = $employee->profile_image;
            $my_path = asset('/public/storage/profile_images/' . $name);

            $employee->profile_image = $my_path;

            Storage::disk('profile-image')->delete($old_image);
        }

        if ($employee->save()) {
            foreach ($request->file ?: [] as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/storage/employee_documents');
                $filePath = $destinationPath . "/" . $filename;
                $file->move($destinationPath, $filename);
                $my_path = asset('/public/storage/employee_documents/' . $filename);
                EmployeeDocuments::create([
                    'employee_id' => $employee->id,
                    'file' => $my_path,
                ]);
            }
        }
        // $message = 'Your Status Have Been Changed';
        // $notification = new EmployeeNotification;

        // $notification->employee_id = $request->employee_id;
        // $notification->employee_status = $request->status;
        // $notification->message = $message;

        // $notification->save();
        // if($employee->employee_status = $request->status){

        // }

        return redirect('employee')->with('update', 'Record has been updated');

        $request->session()->flash('update', 'Record has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        // "profile-image" is a custom disk name in config/filesystems.php
        Storage::disk('profile-image')->delete($employee->profile_image);

        return redirect('/employee')->with('delete', 'Record has been deleted');
    }

    public function viewDocs($id)
    {
        $employeeDoc = EmployeeDocuments::find($id);

        return view('backend.employee.file_view', compact('employeeDoc'));
    }

    public function deleteDocs($id)
    {
        DB::table('employee_documents')->where('id', $id)->delete();

        // $emp = Employee::find($id);
        // $doc = DB::table('employee_documents')->where('employee_id');

        // $file = public_path()."/storage/employee_documents/".$doc->file;

        // Storage::disk('employee-documents')->delete($file);

        return response()->json([
            'message' => 'Record delete successfully!',
        ]);
    }

    public function docDownload(Request $request, $id)
    {
        try {
            $doc = EmployeeDocuments::find($id);
            $file = public_path() . "/storage/employee_documents/" . $doc->file;
            $headers = array(
                'Content-Type: application/*',
            );
            return response()->download($file, $doc->file, $headers);
        } catch (\Exception $e) {
            return view('errors.file_not_found');
        }
    }
    public function updateNotification($id)
    {

    }

    public function updateType(Request $request)
    {
        $emp = Employee::find($request->emp_id);
        if (isset($request->status)) {
            $emp->employee_status = $request->status;
        }

        if (isset($request->job_status)) {
            $emp->job_status = $request->job_status;
        }
        $emp->save();
        return redirect()->back()->with('update', 'Record has been updated');
    }

}
