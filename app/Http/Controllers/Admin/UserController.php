<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\User;
use Validator;
use App\Lib\Validate;
use App\Models\Group;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            if($usertype == 'admin' || $usertype == 'employee') {
                return $next($request); 
            }
            return abort(403);
        });

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        //
        if($datatables->getRequest()->ajax()) {
            $user = User::select(['id', 'name', 'email', 'phone', 'group_id', 'is_active']);
            return $datatables->of($user)
            ->addColumn('role_name', function($user) {
                $role = Group::whereId($user->group_id)->first();
                if(!isset($role->name)) {
                    return '';
                }
                return $role->name;
            })
            ->addColumn('is_active', function($user) {
                if($user->is_active == 1) {
                    return 'Active';
                } else {
                    return 'Inactive';
                }
            })
            ->addColumn('action', function ($user) {
                $action = '<div class="btn-group">';
                if($user->is_active == 1) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$user->id.'\', this)">Inactive</a>';
                } else {
                    $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$user->id.'\', this)">Active</a>';

                }
                $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$user->id.'\')">Edit</a><a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$user->id.'\', this)">Delete</a></div>';
                return $action;
            })
            ->rawColumns(['id', 'name', 'email', 'phone', 'role_name', 'is_active', 'action'])
            ->make();
        }
        $groups = Group::where('is_active', '1')->get();
        return view('user.list', compact('groups'));
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
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|same:cpassword|regex:/(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,})/u",
            "cpassword" => "required",
            "mobile" => "required|numeric",
            "emp_role" => 'required|numeric',
        ], [
            'password.same' => 'Password and Confirm Password Should Match',
            'password.regex' => 'Password policy does not match',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->mobile;
        $user->group_id = $request->emp_role;
        $user->save();
        return response()->json(['type' => 'success', 'text' => 'User added Successfully'], 200);



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
    public function edit(User $user)
    {
        //
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "email" => "required|email|unique:users,email,".$user->id,
            // "password" => "required|same:cpassword",
            // "cpassword" => "required",
            "mobile" => "required|numeric",
            "emp_role" => 'required',
        ], [
            'password.same' => 'Password and Confirm Password Should Match',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->phone = $request->mobile;
        $user->group_id = $request->emp_role;
        $user->save();
        return response()->json(['type' => 'success', 'text' => 'User updated Successfully'], 200);

    }

    /**
     * Status Changed
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request) {
        if($request->id){
            $status = User::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                User::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                User::where('id',$request->id)->update([
                    'is_active' => '0',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            }
        }

    }

    /**
     * Reset Passsword
     *
     * @return \Illuminate\Http\Response
     */
    public function reset_pwd(Request $request) {
        $validator = Validator::make($request->all(), [
            "password" => "required|same:cpassword",
            "cpassword" => "required",
        ], [
            'password.same' => 'Password and Confirm Password Should Match',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        if(!(Validate::pwdPolicy($request->password))) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Password policy not matched']]], 422);

        }

        $user = User::find($request->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['type' => 'success', 'text' => 'User Password updated Successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if($user->delete()) {
            return response()->json(['type'=>'success','text'=>'User Deleted Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }

}
