<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Site;
use App\Lib\Validate;
use App\Models\Activity;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;


class ActivityController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('activities', ['C', 'r', 'u', 'd']);
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
            if(!$this->permission->r) {
                return [];
            }  
            $activities = Activity::select(['id', 'name', 'logo', 'description', 'type', 'is_active']);
            return $datatables->of($activities)
            ->addColumn('logo_image', function($activities) {
                if($activities->logo) {
                    return '<img src="'.asset('storage/'.$activities->logo).'" width="100"/>';
                } else {
                    return '';
                }
            })
            ->addColumn('is_active', function($activities) {
                if($activities->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('action', function ($activities) {
                $action = '<div class="btn-group">';
                if($this->permission->u) {
                    if($activities->is_active == 1) {
                        $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$activities->id.'\', this)">Inactive</a>';
                    } else {
                        $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$activities->id.'\', this)">Active</a>';
                    }
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$activities->id.'\')">Edit</a>';
                }
                if($this->permission->d) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$activities->id.'\', this)">Delete</a></div>';
                }

                return $action;
            })
            ->rawColumns(['id', 'name', 'logo', 'logo_image', 'description', 'type', 'is_active', 'action'])
            ->make();

        }
        $permission = $this->permission;
        return view('activity.list', compact('permission'));
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
        if(!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        }  

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "name_arabic" => "required|max:255",
            "type" => "required",
            "annual_average" => "required|numeric",
            "environmental_effect" => "required|numeric",
            "description" => "nullable",
            "description_arabic" => "nullable",
            "logo" => "nullable|max:10000|mimes:png,jpg,jpeg",
        ], [
            'name_arabic.required' => 'Name Arabic is required',
            'name_arabic.max' => 'Name Arabic maximum 255 chracters',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }

        $activity = new Activity();
        if($request->logo) {
            $file = explode("public/", $request->logo->store('public/activities/logo'));
            $activity->logo = end($file);
        }
        $activity->name = $request->name;
        $activity->name_arabic = $request->name_arabic;
        $activity->type = $request->type;
        $activity->annual_average = $request->annual_average;
        $activity->environmental_effect = $request->environmental_effect;
        $activity->description = $request->description;
        $activity->description_arabic = $request->description_arabic;
        $activity->created_by = auth()->user()->id;

        $activity->meta_title = $request->meta_title;
        $activity->meta_description = $request->meta_description;

        $activity->created_at = date('Y-m-d H:i:s');
        $activity->save();
        return response()->json(['type' => 'success', 'text' => 'Activity added Successfully'], 200);

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
    public function edit(Activity $activity)
    {
        //
        return $activity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "name_arabic" => "required|max:255",
            
            "type" => "required",
            "annual_average" => "required|numeric",
            "environmental_effect" => "required|numeric",
            "description" => "nullable",
            "description_arabic" => "nullable",
            "logo" => "nullable|max:10000|mimes:png,jpg,jpeg",
        ], [
            'name_arabic.required' => 'Name Arabic is required',
            'name_arabic.max' => 'Name Arabic maximum 255 chracters',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
        }


        if($request->logo != null) {
            $file = explode("public/", $request->logo->store('public/activities/logo'));
        } else {
            $file = null;
        }
        $activity->name = $request->name;
        $activity->name_arabic = $request->name_arabic;
        $activity->type = $request->type;
        $activity->annual_average = $request->annual_average;
        $activity->environmental_effect = $request->environmental_effect;
        $activity->description = $request->description;
        $activity->description_arabic = $request->description_arabic;

        $activity->meta_title = $request->meta_title;
        $activity->meta_description = $request->meta_description;

        $activity->created_by = auth()->user()->id;
        if($file != null) {
            $activity->logo = end($file);
        }
        $activity->updated_at = date('Y-m-d H:i:s');
        $activity->save();
        return response()->json(['type' => 'success', 'text' => 'Activity updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        if(!$this->permission->d) {
            return $this->permissionCheckMessage('d');
        }

        $site = DB::table('sites')->select('name')->whereRaw('FIND_IN_SET('.$activity->id.',activitis)')->get();
        if(count($site) > 0){
            return response()->json(['type'=>'error','text'=>'First remove this activity from all sites'], 200);
        } else {
            if($activity->delete()){
                return response()->json(['type'=>'success','text'=>'Activity Deleted Successfully'], 200);
            } else {
                return response()->json(['success' => false], 500);
            }
        }
    }

    /**
     * Status Changed
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request) {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        if($request->id){
            $status = Activity::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                Activity::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                Activity::where('id',$request->id)->update([
                    'is_active' => '0',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            }
        }

    }

    public function permissionCheckMessage($action) {
        $perform = '';
        if($action == 'c') {
            $perform = 'Create';
        }
        if($action == 'r') {
            $perform = 'Read';
        }
        if($action == 'u') {
            $perform = 'Update';
        }
        if($action == 'd') {
            $perform = 'Delete';
        }

        return response()->json(['message' => '', 'errors' => ['validation_error' => ["Sorry you dont have permission to $perform ."]]], 422);
    }

    
}
