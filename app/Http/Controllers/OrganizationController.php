<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Lib\Validate;
use App\Models\Admin;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationLog;
use Yajra\Datatables\DataTables;

class OrganizationController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('organizations', ['C', 'r', 'u', 'd']);
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
        if ($datatables->getRequest()->ajax())
        {
            if(!$this->permission->r) {
                return [];
            } 

            $organization = Organization::select(['id', 'name', 'email', 'is_active', 'created_at'])->orderBy('id', 'desc');
            return $datatables->of($organization)
            ->addColumn('created_at', function ($organization) {
                return date('d/m/Y H:i:s A', strtotime($organization->created_at));
            })
            // ->addColumn('is_active', function($organization) {
            //     if($organization->is_active == '1') {
            //         return 'Active';
            //     } else {
            //         return 'Inactive';
            //     }
            // })
            ->addColumn('action', function ($organization) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';
                if($this->permission->u) {
                    if($organization->is_active == '1') {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$organization->id.'\', \''.$organization->is_active.'\', this)">Inactive</a>';
                    } else {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$organization->id.'\', \''.$organization->is_active.'\', this)">Active</a>';
                        
                    }
                }
                $btns .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm white" title="Info" onclick="statusLog(\''.$organization->id.'\', this)">Info</a>';
                // href="pages/' . $organization->slug . '/edit/"

                // $btns .= '<a href="javascript:;" class="btn btn-primary btn-sm">Edit</a>';
                // $btns .= '<a href="javascript:;" class="btn btn-danger btn-sm">Delete</a>';
                // if (!in_array($organization->slug, ['home', 'contact-us'])) {
                    // <button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $entities->slug . '\')">Delete</button>';
                // }
                $btns .= '</div>';
                return $btns;
            })
            ->rawColumns(['created_at', 'action'])
            ->make();
        }
        return view('organization.list');
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

    /**
     * User Status Changed
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request) {
        if(!$request->comment) {
            return response()->json(['type' => 'error', 'errors' => ['validation_error' => ['Comment is required']]],422);
        }
        if($request->id){
            $usertype = session('usertype');
            if($usertype == 'admin') {
                $userInfo = Admin::where('id', auth()->user()->id)->first();
            } else {
                $userInfo = User::where('id', auth()->user()->id)->first();
            }
            if(!$usertype) {
                return response()->json(['type' => 'error', 'errors' => ['validation_error' => ['User Access is not allowed']]],422);
            }

            $status = Organization::select('is_active')->where('id',$request->id)->first();
            $is_active = !$status->is_active;

            $organizationLog = new OrganizationLog;
            $organizationLog->org_id = $request->id;
            $organizationLog->comment = $request->comment;
            $organizationLog->username = $userInfo->email;
            $organizationLog->usertype = $usertype;
            $organizationLog->status = $is_active;
            $organizationLog->userinfo = json_encode($userInfo->toArray());
            $organizationLog->created_at = date('Y-m-d H:i:s');
            $organizationLog->save();

            Organization::where('id',$request->id)->update([
                'is_active' => ($is_active ==1) ? '1' : '0',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
        }

    }


    /**
     * Organization Status Logs 
     */
    public function status_logs(Request $request)
    {
        if(!$this->permission->r) {
            return $this->permissionCheckMessage('r');
        }

        $organization = Organization::where('id', $request->id)->with('OrganizationLog')->first();
        if($organization) {      
            $info = '';
            foreach ($organization->OrganizationLog as $key => $value) {
                $organization['OrganizationLog'][$key]['userArr'] = json_decode($value->userinfo); 

                $status = (boolean)$value->status;
                $info .= '
                    <div class="card">
                        <div class="card-body"><b style="font-weight: 500;">#</b>'.$key.'<br/>                            
                            <b style="font-weight: 500;">Status:</b> ';
                $info .= ($status == true) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-warning'>Inactive</label>";
                $info .='&nbsp;&nbsp;<br/> <b style="font-weight: 500;">Username:</b> '.$value->username.'
                            <p> <b style="font-weight: 500;">Comment:</b> '.$value->comment.'</p>
                        </div>
                    </div>
                ';
            }
            return response()->json(['type' => 'success', 'data' => $info], 200);

        } else {
            return response()->json(['type' => 'success', 'data' => []], 200);
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
