<?php

namespace App\Http\Controllers;

use Validator;
use App\Lib\Validate;
use App\Models\Message;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class MessageController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('messages', ['C', 'r', 'u', 'd']);
            if($usertype == 'admin' || $usertype == 'employee') {
                return $next($request); 
            }
            return abort(403);
        });

    }
    
    function index(DataTables $datatables) {
        if($datatables->getRequest()->ajax()) {
            if(!$this->permission->r) {
                return [];
            } 
            $messages = Message::select(['id','type','name','message','mobile','email','replied','created_at'])->orderBy('id','desc');
            return $datatables->of($messages)
            ->addColumn('type', function($messages) {
                if($messages->type == 'contact_us'){
                    return 'Contact Us';
                }
                if($messages->type == 'send_us_message'){
                    return 'Send Us Message';
                }
                if($messages->type == 'ask_question'){
                    return 'Ask Question';
                }
            })
            ->addColumn('replied', function($messages) {
                if($messages->replied == 'yes') {
                    return '<span class="badge badge-success">Yes</span>';
                } else {
                    return '<span class="badge badge-warning">No</span>';
                }
            })
            ->addColumn('action', function ($messages) {
                $action = '<div class="btn-group">';
                if($this->permission->u) {
                    if($messages->replied == 'no') {
                        $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Replied/Answered" onclick="changeStatus(\''.$messages->id.'\', this)">Yes</a>';
                    }
                }
                
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['id','type','name', 'message', 'mobile', 'email', 'replied', 'created_at', 'action'])
            ->make();

        }
        return view('messages.list');
    }

    public function change_status(Request $request, Message $message)
    {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }
        $toggle = ['yes' => 'no','no'=> 'yes'];
        $message->replied = $toggle[$message->replied];
        $message->save();
        return response()->json(['type' => 'success', 'text' => 'Replied/Answered Successfully'], 200);
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