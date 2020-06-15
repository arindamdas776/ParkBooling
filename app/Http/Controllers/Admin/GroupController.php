<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Group;
use App\User;
use App\Models\Module;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use App\Http\Controllers\Controller;


class GroupController extends Controller
{
    function __construct() {
        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            if($usertype != 'admin') {
                return abort(403);
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Datatables $datatables)
    {
        //
        if ($datatables->getRequest()->ajax()) {
            $modules = Group::select(['id', 'name', 'description', 'is_active']);
            return $datatables->of($modules)
                ->addColumn('is_active', function($modules) {
                    if($modules->is_active == 1) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                })
                ->addColumn('rolechange', function($modules){
                    $rolechange = '<div class="btn-group">';
                    $rolechange .= '<a class="btn btn-info btn-sm white" title="Change role privileges" href="'.route('groups.edit_prev', $modules->id).'"><i class="fa fa-cogs"></i></a></div>';
                    return $rolechange;
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
                ->rawColumns(['id', 'name', 'description', 'is_active', 'rolechange', 'action'])
                ->make();
        }
        return view('group.list');
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
            'name' => 'required|unique:groups,name,NULL,id,deleted_at,NULL|max:255',

        ], [
            'name.required' => 'Please select name',
            'name.unique' => 'Please select unique name for the group',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $employee_status = 0;
        $ceo_status = 0;

        if($request->employee_status == "0") {
            $employee_status = 1;
            $ceo_status = 0;
        } else if($request->employee_status == '1') {
            $employee_status = 0;
            $ceo_status = 1;
        }

        $sess_user = auth()->user();

        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->employee_status = $employee_status;
        $group->ceo_status      = $ceo_status;
        $group->created_by = $sess_user->id;
        $group->created_at = date('Y-m-d H:i:s');
        $group->save();

        return response()->json(['type' => 'success', 'text' => 'Group added Successfully'], 200);
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
    public function edit(Group $group)
    {
        //
        return $group;
    }


    /**
     * Status Changed
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request) {
        if($request->id){
            $status = Group::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                Group::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                Group::where('id',$request->id)->update([
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
    public function update(Request $request, Group $group)
    {
        
        //
        $this->validate($request, [
            'name' => 'required|max:255|unique:groups,name,'.$request->id.',id,deleted_at,NULL'
        ]);
        $employee_status = 0;
        $ceo_status = 0;

        if($request->employee_status == "0") {
            $employee_status = 1;
            $ceo_status = 0;
        } else if($request->employee_status == '1') {
            $employee_status = 0;
            $ceo_status = 1;
        }

        
        if ($group::where('id',$request->id)
        ->update([
            'name'                => $request->name,
            'description'         => $request->description,
            'employee_status'     => $employee_status,
            'ceo_status'          => $ceo_status,
            'updated_at'          => date('Y-m-d H:i:s')
        ])) {
            return response()->json(['type'=>'success','text'=>'Group Info Updated Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $userExists = User::where('group_id', $group->id)->first();
        if($userExists) {
            // return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);

            return response()->json(['type'=>'error','errors'=>['validation_error' => ['Unable to delete, Group already assigned to the user.']]], 422);
        }
        //
        if($group->delete()) {            
            return response()->json(['type'=>'success','text'=>'Group Deleted Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }

    /**
     * Edit Preveliges
     */
    public function edit_prev(Request $request) {
        // Fetch all Modules
        // dd($request->group_id);
        $parentModules = Module::where('is_active', 1)->where('module_id', 0)->get();
        $childModules = [];
        $aclListArr = [];
        foreach ($parentModules as $key => $value) {
            $rec = Module::where('is_active', 1)->where('module_id', $value->id)->get()->toArray();
            $childModules[$value->slug][] = $rec;
            $aclList = PermissionRole::where('group_id', $request->group_id)->where('module_id', $value->id)->select('c', 'r', 'u', 'd')->get()->toArray();
            if(sizeof($aclList)) {
                $aclListArr[] = $aclList[0];
            } else {
                $aclListArr[] = [
                    "c" => 0,
                    "r" => 0,
                    "u" => 0,
                    "d" => 0
                ];
            }

        }
        $groupid = $request->group_id;

        // Check the permission role for the group id
        $prevpermissionRole = PermissionRole::where('group_id', $request->group_id)->select('module_id')->get()->toArray();
        

        $prevpermissionRole = array_column($prevpermissionRole, 'module_id');
        
        // dd($childModules);
        // dd(sizeof($childModules['dashboard']));
        return view('group.edit-prev', compact('parentModules', 'childModules', 'groupid', 'prevpermissionRole', 'aclListArr'));
    }

    public function update_prev(Request $request) {
        $validator = Validator::make($request->all(), [
            'groupid' => 'required',

        ], [
            'groupid.*' => 'Please select one of the Group Name'
        ]);
        if($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $idList = json_decode($request->idlist, true);
        if(sizeof($idList) < 1) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Please select at least one module type']]], 422);
        }
        $aclList = json_decode($request->acllist, true);

        // Delete the all the module name with the group id
        $prevPermissionRole = PermissionRole::where('group_id', $request->groupid)->delete();
        $allPermission = [];
        // dd($prevPermissionRole);
        // if($prevPermissionRole != null) {
        //     foreach ($prevPermissionRole as $key => $value) {
        //         $prevPermissionRole->delete();
        //     }
        // }
        $permissionRole = new PermissionRole();
        foreach ($idList as $key => $value) {
            $permissionRole->module_id = $value;
            $permissionRole->group_id = $request->groupid;

            $permissionRole->c = $aclList[$key][0];
            $permissionRole->r = $aclList[$key][1];
            $permissionRole->u = $aclList[$key][2];
            $permissionRole->d = $aclList[$key][3];
            
            $permissionRole->created_at = date('Y-m-d H:i:s');
            $allPermission[] = $permissionRole->attributesToArray();
        }
        if(sizeof($allPermission) > 0) {
            PermissionRole::insert($allPermission);
            return response()->json(['type' => 'success', 'text' => 'Pref added Successfully'], 200);

        }
    }
}
