<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\DataTables;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Datatables $datatables)
    {
        //
        if ($datatables->getRequest()->ajax()) {
            $employee = Employee::select(['id', 'name', 'email', 'phone', 'role_id', 'is_active']);
            return $datatables->of($employee)
            ->addColumn('role_name', function($employee) {
                $role = Group::whereId($employee->role_id)->first();
                return $role->name;
            })
            ->addColumn('is_active', function($employee) {
                if($employee->is_active == 1) {
                    return 'Active';
                } else {
                    return 'Inactive';
                }
            })
            ->addColumn('action', function ($employee) {
                $action = '<div class="btn-group">';
                if($employee->is_active == 1) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$employee->id.'\', this)">Inactive</a>';
                } else {
                    $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$employee->id.'\', this)">Active</a>';
                    
                }
                $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$employee->id.'\')">Edit</a><a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$employee->id.'\', this)">Delete</a></div>';
                return $action;
            })
            ->rawColumns(['id', 'name', 'email', 'phone', 'role_name', 'is_active', 'action'])
            ->make();
        }
        $roles = Group::where('is_active', '1')->get();
        return view('employee.list', compact('roles'));
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
            'name' => 'required|max:255',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:employees',
            'emp_role' => 'required|numeric'

        ], [
            'role_id.*' => 'Please select one of the role'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $sess_user = auth()->user();

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->phone = $request->mobile;
        $employee->email = $request->email;
        $employee->role_id = $request->emp_role;
        $employee->role_id = $request->emp_role;
        $employee->created_by = $sess_user->id;
        $employee->created_at = date('Y-m-d H:i:s');
        $employee->save();

        return response()->json(['type' => 'success', 'text' => 'Employee added Successfully'], 200);

        
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
    public function edit(Employee $employee)
    {
        //
        return $employee;
    }

    /**
     * User Status Changed
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request) {
        if($request->id){
            $status = Employee::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                Employee::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                Employee::where('id',$request->id)->update([
                    'is_active' => '0',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employee $employee)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:employees,email,'.$request->id,
            'emp_role' => 'required|numeric',
        ]);
        if ($employee::where('id',$request->id)
        ->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->mobile,
            'role_id'       => $request->emp_role,
            'updated_at'    => date('Y-m-d H:i:s')
        ])) {
            return response()->json(['type'=>'success','text'=>'Employee Info Updated Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        if($employee->delete()) {            
            return response()->json(['type'=>'success','text'=>'Role Deleted Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }
}
