<?php

namespace App\Http\Controllers\Employee;

use Mail;
use Config;
use App\Lib\Validate;
use App\Models\Group;
use App\Models\LogsEmail;
use App\Models\Application;
use App\Models\Organization;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use App\Http\Controllers\Controller;



class ApplicationListController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('registration-requests', ['C', 'r', 'u', 'd']);
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
            
            $application = Application::where('regtype', '!=', null)->where('status', '!=', 'draft')->orderBy('id', 'DESC')->get();
            // dd($application);
            return $datatables->of($application)
                ->addColumn('application_no', function($application){
                    return '<a href="'.route('applicationlist.appByNo', $application->application_no).'">'.$application->application_no.'</a>';;
                })
                ->addColumn('user_info', function($application){
                    $userInfo = Organization::select('name', 'email')->where('id', $application->user_id)->first();
                    return $userInfo;
                })
                ->addColumn('user_approval', function($application){
                    if($application->status == 'fapprove') {
                       $status = '<span class="badge badge-success">Approved</span>';
                    } elseif($application->status == 'freject') {
                        $status = '<span class="badge badge-danger">Rejected</span>';
                    } elseif($application->status == 'review') {
                        $status = '<span class="badge badge-warning">Review</span>';
                    } else {
                        $status = '';
                    }
                    return $status;
                })
                ->addColumn('ceo_approval', function($application){
                    if($application->status == 'freject') {
                        return;
                    }
                    else if($application->ceo_status == 'lapprove') {
                        return '<span class="badge badge-success">Approved</span>';
                    } elseif($application->ceo_status == 'lreject') {
                        return '<span class="badge badge-danger">Rejected</span>';
                    // } elseif($application->ceo_status == 'review') {
                    //     return '<span class="badge badge-warning">Review</span>';
                    } else {
                        return;
                    }
                })
                ->addColumn('action', function($application){
                    $action = '<div class="btn-group">';
                    $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Approve" onclick="detail(\''.$application->application_no.'\', this)">Details</a>';
                    $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['id', 'application_no', 'regtype', 'regtype_text', 'data', 'amount', 'docname_list', 'status', 'user_info', 'action', 'user_approval', 'ceo_approval'])
                ->make();
        } else {
            return view('employee.application.list');
        }
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
     * App by No
     */
    public function appByNo(Request $request) {
        $application = Application::where('application_no', $request->application_no)->where('regtype', '!=', null)->first();
        if($application) {
            $regtype = $application->regtype;
            switch ($regtype) {
                case 'section1':
                    return $this->load_form_1($application);
                    break;
                case 'section2':
                    return $this->load_form_2($application);
                    break;
                case 'section3':
                    return $this->load_form_3($application);
                    break;
                case 'section4':
                    return $this->load_form_4($application);
                    break;
                case 'section5':
                    return $this->load_form_5($application);
                    break;
                case 'section6':
                    return $this->load_form_6($application);
                    break;
                default:
                    abort(404);
                    break;
            }
            dd($application);
        } else {
            abort(404);
        }
    }

    public function load_form_1($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t1_1');
        // Tab2
        $tab2 = Config::get('siteVars.t1_2');
        // Tab3
        $tab3 = Config::get('siteVars.t1_3');
        // Tab4
        $tab4 = Config::get('siteVars.t1_4');
        // Tab5
        $tab5 = Config::get('siteVars.t1_5');
        // Tab6
        $tab6 = Config::get('siteVars.t1_6');
        // Tab7
        $tab7 = Config::get('siteVars.t1_7');
        // Tab8
        $tab8 = Config::get('siteVars.t1_8');
        // Tab9
        $tab9 = Config::get('siteVars.t1_9');
        // Tab10
        $tab10 = Config::get('siteVars.t1_10');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_vessel', $decoded)) {
                $owner_vessel = $decoded['owner_vessel'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_vessel)) {
                        $tab2[$key] =  $owner_vessel[$key];
                    }
                }
            }

            if(array_key_exists('marine_unit', $decoded)) {
                $marine_unit = $decoded['marine_unit'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $marine_unit)) {
                        $tab3[$key] =  $marine_unit[$key];
                    }
                }
            }

            if(array_key_exists('vessel', $decoded)) {
                $vessel = $decoded['vessel'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $vessel)) {
                        $tab4[$key] =  $vessel[$key];
                    }
                }
            }

            if(array_key_exists('water_used_im', $decoded)) {
                $water_used_im = $decoded['water_used_im'];
                foreach ($tab5 as $key => $value) {
                    if(array_key_exists($key, $water_used_im)) {
                        $tab5[$key] =  $water_used_im[$key];
                    }
                }
            }
            if(array_key_exists('sanitation', $decoded)) {
                $sanitation = $decoded['sanitation'];
                foreach ($tab6 as $key => $value) {
                    if(array_key_exists($key, $sanitation)) {
                        $tab6[$key] =  $sanitation[$key];
                    }
                }
            }
            if(array_key_exists('waste_liquid', $decoded)) {
                $waste_liquid = $decoded['waste_liquid'];
                foreach ($tab7 as $key => $value) {
                    if(array_key_exists($key, $waste_liquid)) {
                        $tab7[$key] =  $waste_liquid[$key];
                    }
                }
            }
            if(array_key_exists('vessel_engine', $decoded)) {
                $vessel_engine = $decoded['vessel_engine'];
                foreach ($tab8 as $key => $value) {
                    if(array_key_exists($key, $vessel_engine)) {
                        $tab8[$key] =  $vessel_engine[$key];
                    }
                }
            }
            if(array_key_exists('solid_waste', $decoded)) {
                $solid_waste = $decoded['solid_waste'];
                foreach ($tab9 as $key => $value) {
                    if(array_key_exists($key, $solid_waste)) {
                        $tab9[$key] =  $solid_waste[$key];
                    }
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab10 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab10[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab11 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        $permission = $this->permission;
        return view('employee.application.form_1', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'tab6', 'tab7', 'tab8', 'tab9', 'tab10', 'tab11', 'userInfo', 'group', 'permission'));
    }

    public function load_form_2($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t2_1');
        // Tab2
        $tab2 = Config::get('siteVars.t2_2');
        // Tab3
        $tab3 = Config::get('siteVars.t2_3');
        // Tab4
        $tab4 = Config::get('siteVars.t2_4');
        // Tab5
        $tab5 = Config::get('siteVars.t2_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        $tab3[$key] =  $center_data[$key];
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        if(!$group){
            abort(403);
        }
        $permission = $this->permission;
        return view('employee.application.form_2', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group', 'permission'));
    }

    public function load_form_3($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t3_1');
        // Tab2
        $tab2 = Config::get('siteVars.t3_2');
        // Tab3
        $tab3 = Config::get('siteVars.t3_3');
        // Tab4
        $tab4 = Config::get('siteVars.t3_4');
        // Tab5
        $tab5 = Config::get('siteVars.t3_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        $tab3[$key] =  $center_data[$key];
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        $permission = $this->permission;

        return view('employee.application.form_3', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group', 'permission'));
    }

    public function load_form_4($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t4_1');
        // Tab2
        $tab2 = Config::get('siteVars.t4_2');
        // Tab3
        $tab3 = Config::get('siteVars.t4_3');
        // Tab4
        $tab4 = Config::get('siteVars.t4_4');
        // Tab5
        $tab5 = Config::get('siteVars.t4_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        $tab3[$key] =  $center_data[$key];
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        $permission = $this->permission;

        return view('employee.application.form_4', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group', 'permission'));
    }

    public function load_form_5($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t5_1');
        // Tab2
        $tab2 = Config::get('siteVars.t5_2');
        // Tab3
        $tab3 = Config::get('siteVars.t5_3');
        // Tab4
        $tab4 = Config::get('siteVars.t5_4');
        // Tab5
        $tab5 = Config::get('siteVars.t5_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        $tab3[$key] =  $center_data[$key];
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        $permission = $this->permission;
        return view('employee.application.form_5', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group', 'permission'));
    }

    public function load_form_6($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t6_1');
        // Tab2
        $tab2 = Config::get('siteVars.t6_2');
        // Tab3
        $tab3 = Config::get('siteVars.t6_3');
        // Tab4
        $tab4 = Config::get('siteVars.t6_4');
        // Tab5
        $tab5 = Config::get('siteVars.t6_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        $tab3[$key] =  $center_data[$key];
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        if(!$group){
            if(session('usertype') == 'admin'){
                $group = new Group;
                $group->name = 'admin';
            }
        }
        $permission = $this->permission;
        return view('employee.application.form_6', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group', 'permission'));
    }


    /**
     * Change Status
     */
    public function change_status(Request $request) {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        } 

        $application = Application::where('application_no', $request->application_no)->first();
        $rejectValues = ['freject', 'sreject', 'lreject'];
        if($application) {

            // Get the user
            $userDetails = Organization::where('id', $application->user_id)->first();

            // Group Status
            $group = Group::where('id', auth()->user()->group_id)->first();
            if($group->ceo_status) {
                $application->ceo_status = $request->status;
            } else {
                $application->status = $request->status;
            }

            $application->updated_at = date('Y-m-d H:i:s');
            $application->save();
            if(in_array($request->status, $rejectValues)) {
                $status = 'Rejected';
                $txt = "Sorry! Your application with no ".$request->application_no."  rejected!";
            } else {
                $status = 'Approved';
                $txt = "Your application with no ".$request->application_no." approved!";
            }

            // Reponse Email
            $to = $userDetails->email;
            $subject = $txt;
            $response = $this->send_email($to, $subject, $txt, $status);
            $logsemail = new LogsEmail;
            $logsemail->from  = 'noreply@eeaa.com';
            $logsemail->to  = $to;
            $logsemail->subject  = $subject;
            $logsemail->body  = $txt;
            $logsemail->created_at  = date('Y-m-d H:i:s');
            $logsemail->response  = $response;
            $logsemail->save();


            return response()->json(['type' => 'success', 'text' => 'Application '.$status.' Successfully.'], 200);
        } else {
            return response()->json(['type' => 'error', 'text' => 'Oops! some error occured'], 200);
        }
    }


    function send_email($to, $subject='', $txt='', $status, $from='noreply@eeaa.com') {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from;
		$data = [
            'txt' => $txt,
            'status' => $status
		];
		$info = json_decode(json_encode([
			'from' => $from,
			'subject' => $subject,
			'to' => $to,
		]));
		Mail::send('emails.application_status_update', $data, function ($message) use ($info) {
			$message->from($info->from);
			$message->subject($info->subject);
			$message->to($info->to);
		});
		if(count(Mail::failures()) > 0) {
			return json_encode(Mail::failures());
		} else {
			return true;
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
