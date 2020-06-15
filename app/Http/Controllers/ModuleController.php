<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Module;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Datatables $datatables) {

        if ($datatables->getRequest()->ajax()) {
            $modules = Module::select(['id', 'name', 'description', 'is_active']);
            return $datatables->of($modules)
                ->addColumn('is_active', function($modules) {
                    if($modules->is_active == 1) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                })
                ->addColumn('action', function($modules){
                    $action = '<div class="btn-group">';
                    if($modules->is_active == 1) {
                        $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$modules->id.'\', this)">Inactive</a>';
                    } else {
                        $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$modules->id.'\', this)">Active</a>';
                        
                    }
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$modules->id.'\')">Edit</a><a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$modules->id.'\', this)">Delete</a></div>';
                    return $action;
                })
                ->rawColumns(['id', 'name', 'description', 'is_active', 'action'])
                ->make();
        }
        return view('module.list');
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',

        ], [
            'name.*' => 'Please select name'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $sess_user = auth()->user();

        $employee = new Module();
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
    public function edit($id)
    {
        //
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
        //
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
