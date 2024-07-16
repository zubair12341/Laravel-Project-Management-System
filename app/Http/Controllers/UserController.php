<?php

namespace App\Http\Controllers;

use App\Mail\Crediential;
use App\Models\Employee;
use App\Models\User;
use App\Models\ManagePermission;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        // $users = User::with('employee')->get();

        $users = DB::table('users')
            ->join('employees', 'employees.id', '=', 'users.employee_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select(
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'employees.employee_no',
                'users.id as id',
                'users.email',
                'users.status',
                'users.employee_id',
                'users.role_id',
                'users.password',
                'roles.role_type'
            )
            ->get();
$admin=User::where('role_id','1')->get();
        $roles = DB::table('roles')->select('id', 'role_type')->get();
        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->get();

        return view('user.list', compact('users', 'roles', 'employees','admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name', 'middle_name', 'last_name')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.employee_id = employees.id');
            })
            ->get();

        $roles = DB::table('roles')->select('id', 'role_type')->get();

        return view('user.create', compact('employees', 'roles'));
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
            'employee_id' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required',
            'status' => 'required',
        ]);

        $loginPassword = $request->password;

        $user = new User;

        $user->employee_id = $request->employee_id;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->password = Hash::make($loginPassword);
        $user->status = $request->status;
        $user->save();
if(isset($request->permission))
{
    $permission= new ManagePermission();
    $permission->user_id=$user->id;
    if($request->permission=='1')
    {
        $permission->domain_show='Yes';
        $permission->domain_show_edit='No';
    }
    elseif($request->permission=='2')
    {
       
        $permission->domain_show_edit='Yes';
        $permission->domain_show='No';
    }
    else
    {
        $permission->domain_show_edit='No';
        $permission->domain_show='No';
    }
    $permission->save();
}
        $employeeData = DB::table('employees')
            ->select('first_name', 'middle_name', 'last_name', 'email')
            ->where('id', $request->employee_id)
            ->first();

        $loginData = [
            'first_name' => $employeeData->first_name,
            'middle_name' => $employeeData->middle_name,
            'last_name' => $employeeData->last_name,
            'loginEmail' => $request->email,
            'loginPassword' => $loginPassword,
        ];

        // Mail::to($employeeData->email)->send(new LoginMail($loginData));

        return redirect('user/create')->with('success', 'Record has been saved. Login mail has been sent');

        // $roleId = $request->role_id;

        // $user_role = [
        //     'user_id' => $user->id,
        //     'role_id' => $roleId,
        // ];

        // DB::table('role_user')->insert([$user_role]);
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
        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->get();
        $roles = DB::table('roles')->select('id', 'role_type')->get();

        $user = User::find($id);

        return view('user.edit', compact('user', 'employees', 'roles'));
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
           // 'employee_id' => "required|unique:users,employee_id,$id",
            'email' => "required|unique:users,email,$id",
           // 'role_id' => 'required',
          //  'status' => 'required',
        ]);

        $user = User::find($id);
        if (isset($request->employee_id)) {
        $user->employee_id = $request->employee_id;
        }
        $user->email = $request->email;
        if (isset($request->role_id)) {
        $user->role_id = $request->role_id;
        }
        if (isset($request->password)) {

            $loginPassword = $request->password;
            $user->password = Hash::make($loginPassword);
        }
        if (isset($request->status)) {
      $user->status = $request->status;
        }
        $user->save();
       // dd($user);
        if(isset($request->permission))
        {
            $permission=ManagePermission::where('user_id',$user->id)->first();
          
            if(!$permission)
            {

                $permission= new ManagePermission();
                $permission->user_id=$user->id;
                if($request->permission=='1')
                {
                    $permission->domain_show='Yes';
                    $permission->domain_show_edit='No';
                }
                elseif($request->permission=='2')
                {
                   
                    $permission->domain_show_edit='Yes';
                    $permission->domain_show='No';
                }
                else
                {
                    $permission->domain_show_edit='No';
                    $permission->domain_show='No';
                }
                $permission->save();
            }
            else{
                if($request->permission=='1')
                {
                    $permission->domain_show='Yes';
                    $permission->domain_show_edit='No';
                }
                elseif($request->permission=='2')
                {
                   
                    $permission->domain_show_edit='Yes';
                    $permission->domain_show='No';
                }
                else
                {
                    $permission->domain_show_edit='No';
                    $permission->domain_show='No';
                }
                $permission->save();
            }
        }
        

        if (isset($request->password)) {
            \Mail::to($user->email)->send(new Crediential($loginPassword, $user->email));
        }
        return redirect()->back()->with('update', 'Record has been updated');
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->userid);

        $user->status = $request->status;

        $user->save();
        return response()->json([
            'message' => 'Record has been updated',
        ]);
    }

    public function updateRole(Request $request)
    {
        $user = User::find($request->userId);
        $user->role_id = $request->roleId;
        $user->save();

        return response()->json([
            'message' => 'Record has been updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('user')->with('delete', 'Record has been deleted');
    }
}
