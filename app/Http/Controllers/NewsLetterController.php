<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\NewsSubscribed;
use Yajra\Datatables\DataTables;

class NewsLetterController extends Controller
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
    
    function index(DataTables $datatables) {
        if($datatables->getRequest()->ajax()) {
            $messages = NewsSubscribed::select(['id','name','phone','email','created_at'])->orderBy('id','desc');
            return $datatables->of($messages)
            
            ->addColumn('action', function ($messages) {
                $action = '<div class="btn-group">';
                // if($messages->replied == 'no') {
                //     $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Replied/Answered" onclick="changeStatus(\''.$messages->id.'\', this)">Yes</a>';
                // }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['id','name', 'phone', 'email', 'created_at', 'action'])
            ->make();

        }
        return view('newsletter.list');
    }

    public function change_status(Request $request, Message $message)
    {
        $toggle = ['yes' => 'no','no'=> 'yes'];
        $message->replied = $toggle[$message->replied];
        $message->save();
        return response()->json(['type' => 'success', 'text' => 'Replied/Answered Successfully'], 200);
    }
}