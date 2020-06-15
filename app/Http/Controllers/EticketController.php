<?php

namespace App\Http\Controllers;

use App\Lib\Validate;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class EticketController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('users', ['C', 'r', 'u', 'd']);
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
        if($datatables->getRequest()->ajax()) {
            if(!$this->permission->r) {
                return [];
            } 
            $booking = Booking::select(['id','booking_no','date', 'person_name', 'person_number','guide_name','guide_number','visit_type', 'totalFees_usd','totalFees_egp'])->orderBy('id', 'desc');
            return $datatables->of($booking)
            ->addColumn('totalFees', function ($booking) {

                if ($booking->totalFees_usd == null) {
                    $totalFees_usd = '0.00';
                } else {
                    $totalFees_usd = $booking->totalFees_usd;
                }

                if ($booking->totalFees_egp == null) {
                    $totalFees_egp = '0.00';
                } else {
                    $totalFees_egp = $booking->totalFees_egp;
                }

                return '<ul><li>USD = '.$totalFees_usd.'</li><li>EGP = '.$totalFees_egp.'</li></ul>';
            })
            ->addColumn('action', function ($booking) {
                $action = '<div class="btn-group">';
                if($this->permission->r) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Info" onclick="window.location.href=\''.route('booking.view_ticket_summary', encrypt($booking->id)).'\'">Info</a>';
                }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['id', 'name', 'daily_capacity', 'annual_capacity', 'geo_location_type','geo_location_fees','reg_fees','ticket_price', 'is_active', 'action', 'totalFees'])
            ->make();
        }
        return view('booking.list');
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
