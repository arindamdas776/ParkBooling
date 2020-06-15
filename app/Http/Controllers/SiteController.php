<?php

namespace App\Http\Controllers;


use DB;
use Validator;

use App\Models\Site;
use App\Models\Slot;
use App\Lib\Validate;
use App\Models\Activity;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Facades\Storage;


class SiteController extends Controller
{
    private $permission = [];
    function __construct() {
        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('sites', ['C', 'r', 'u', 'd']);
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

            $site = Site::select(['id','name','daily_capacity', 'annual_capacity','reg_fees','ticket_price','adult_ticket_price_usd','adult_ticket_price_egp','child_tikcet_price_usd','child_tikcet_price_egp','is_active']);
            return $datatables->of($site)
            ->addColumn('is_active', function($site) {
                if($site->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('action', function ($site) {
                $action = '<div class="btn-group">';
                if($this->permission->u) {
                    if($site->is_active == 1) {
                        $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$site->id.'\', this)">Inactive</a>';
                    } else {
                        $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$site->id.'\', this)">Active</a>';
    
                    }
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$site->id.'\')">Edit</a>';
                    $action .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$site->id.'\', this)">Delete</a>';
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Manage photos" onclick="managePhotos(\''.$site->id.'\')">Manage Photos</a></div>';
                }
                return $action;
            })
            ->addColumn('slots', function ($site) {
                return '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Manage slots" onclick="manageSlots(\''.$site->id.'\')">'.$site->slots()->count().'</a>';
            })
            ->rawColumns(['id', 'name', 'daily_capacity', 'annual_capacity', 'geo_location_type','geo_location_fees','reg_fees','ticket_price', 'is_active', 'action', 'slots'])
            ->make();
        }
        $sites = Site::where('is_active', '1')->get();
        $activities = Activity::where('is_active', '1')->get();
        $permission = $this->permission;
        return view('site.list', compact('sites', 'activities', 'permission'));
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
        if(!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        }


        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "activities" => "required",
            "daily_capacity" => "required|numeric",
            "annual_capacity" => "required|numeric",
            // "geo_location_type" => "required",
            // "geo_location_fees" => 'required|numeric',
            // "booking_time" => 'required|numeric',
            // "booking_slot" => 'required|numeric',
            // "booking_slot_capacity" => 'required|numeric',
            "loc_lat" => 'required',
            "loc_lng" => 'required',
            "photos.*" => 'nullable|mimes:jpg,jpeg,png|max:10000',
            // "reg_fees" => 'required|numeric',
            // "ticket_price" => 'required|numeric',

            'adult_ticket_price_usd' => 'nullable|numeric',
            'adult_ticket_price_egp' => 'nullable|numeric',
            'child_tikcet_price_usd' => 'nullable|numeric',
            'child_tikcet_price_egp' => 'nullable|numeric',
        ], [
            'activities.*' => 'Please select al least one Activity',
            'activities.required' => 'Activities is required',

            'daily_capacity.required' => 'Daily Capacity is required',
            'daily_capacity.numeric' => 'Daily Capacity should be numeric',

            'annual_capacity.required' => 'Annual Capacity is required',
            'annual_capacity.numeric' => 'Annual Capacity should be numeric',

            // 'geo_location_type.required' => 'Geo Location Type is required',

            // 'geo_location_fees.required' => 'Geo Location Type is required',
            // 'geo_location_fees.numeric' => 'Geo Location Fees should be numeric',


            // 'booking_time.required' => 'Booking Time is required',
            // 'booking_time.numeric' => 'Booking Time should be numeric',

            // 'booking_slot.required' => 'Booking Slot is required',
            // 'booking_slot.numeric' => 'Booking Slot should be numeric',

            // 'booking_slot_capacity.required' => 'Booking Slot Capacity is required',
            // 'booking_slot_capacity.numeric' => 'Booking Slot Capacity should be numeric',



            'loc_lat.required' => 'Location Lat is required',
            // 'loc_lat.required' => 'Location Lat is required',

            'loc_lng.required' => 'Location Long is required',
            // 'loc_lng.numeric' => 'Location Long should be numeric',

            // 'reg_fees.required' => 'Registration is required',
            // 'reg_fees.numeric' => 'Registration should be numeric',

            // 'ticket_price.required' => 'Ticket price is required',
            // 'ticket_price.numeric' => 'Ticket price should be numeric',

            // 'ticket_price.numeric' => 'Ticket price should be numeric',

            'adult_ticket_price_usd.numeric' => 'Adult Ticket Price USD Should be numeric',
            'adult_ticket_price_egp.numeric' => 'Adult Ticket Price EGP Should be numeric',
            'child_tikcet_price_usd.numeric' => 'Child Ticket Price USD Should be numeric',
            'child_tikcet_price_egp.numeric' => 'Child Ticket Price EGP Should be numeric',

            'photos.*.mimes' => 'Acceptable Photo format is jpg,png,jpeg',
            'photos.*.max' => 'Acceptable Photo should not greater than 10 M.B',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $fileArr = [];

        if($request->photos) {
            foreach ($request->photos as $key => $photo) {
                if($photo) {
                    $file = explode("public/", $photo->store('public/site/image'));
                    $fileArr[] = end($file);
                }
            }
        }

        $site = new Site();
        $site->name = $request->name;
        $site->activitis = implode(',',$request->activities);
        $site->description = $request->description;
        $site->daily_capacity = $request->daily_capacity;
        $site->annual_capacity = $request->annual_capacity;
        // $site->geo_location_type = $request->geo_location_type;
        // $site->geo_location_fees = $request->geo_location_fees;
        $site->booking_time = $request->booking_time;
        $site->booking_slot = $request->booking_slot;
        $site->booking_slot_capacity = $request->booking_slot_capacity;
        $site->loc_lat = $request->loc_lat;
        $site->loc_lng = $request->loc_lng;
        $site->video = $request->video;
        $site->reg_fees = $request->reg_fees;
        $site->ticket_price = $request->ticket_price;

        $site->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        $site->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        $site->child_tikcet_price_usd = $request->child_tikcet_price_usd;
        $site->child_tikcet_price_egp = $request->child_tikcet_price_egp;

        $site->created_by = auth()->user()->id;
        if(sizeof($fileArr) > 0) {
            $site->photo = json_encode($fileArr);
        }
        $site->created_at = date('Y-m-d H:i:s');
        $site->save();
        return response()->json(['type' => 'success', 'text' => 'Site added Successfully'], 200);

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
    public function edit(Site $site)
    {
        //
        return $site;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "activities" => "required",
            "daily_capacity" => "required|numeric",
            "annual_capacity" => "required|numeric",
            // "geo_location_type" => "required",
            // "geo_location_fees" => 'required|numeric',
            // "booking_time" => 'required|numeric',
            // "booking_slot" => 'required|numeric',
            // "booking_slot_capacity" => 'required|numeric',
            "loc_lat" => 'required',
            "loc_lng" => 'required',
            // "reg_fees" => 'required|numeric',
            // "ticket_price" => 'required|numeric',

            'adult_ticket_price_usd' => 'nullable|numeric',
            'adult_ticket_price_egp' => 'nullable|numeric',
            'child_tikcet_price_usd' => 'nullable|numeric',
            'child_tikcet_price_egp' => 'nullable|numeric',
        ], [
            'activities.*' => 'Please select al least one Activity',
            'activities.required' => 'Activities is required',

            'daily_capacity.required' => 'Daily Capacity is required',
            'daily_capacity.numeric' => 'Daily Capacity should be numeric',

            'annual_capacity.required' => 'Annual Capacity is required',
            'annual_capacity.numeric' => 'Annual Capacity should be numeric',

            // 'geo_location_type.required' => 'Geo Location Type is required',

            // 'geo_location_fees.required' => 'Geo Location Type is required',
            // 'geo_location_fees.numeric' => 'Geo Location Fees should be numeric',


            // 'booking_time.required' => 'Booking Time is required',
            // 'booking_time.numeric' => 'Booking Time should be numeric',

            // 'booking_slot.required' => 'Booking Slot is required',
            // 'booking_slot.numeric' => 'Booking Slot should be numeric',

            // 'booking_slot_capacity.required' => 'Booking Slot Capacity is required',
            // 'booking_slot_capacity.numeric' => 'Booking Slot Capacity should be numeric',



            'loc_lat.required' => 'Location Lat is required',
            // 'loc_lat.required' => 'Location Lat is required',

            'loc_lng.required' => 'Location Long is required',
            // 'loc_lng.numeric' => 'Location Long should be numeric',

            // 'reg_fees.required' => 'Registration is required',
            // 'reg_fees.numeric' => 'Registration should be numeric',

            // 'ticket_price.required' => 'Ticket price is required',
            // 'ticket_price.numeric' => 'Ticket price should be numeric',

            // 'ticket_price.numeric' => 'Ticket price should be numeric'

            'adult_ticket_price_usd.numeric' => 'Adult Ticket Price USD Should be numeric',
            'adult_ticket_price_egp.numeric' => 'Adult Ticket Price EGP Should be numeric',
            'child_tikcet_price_usd.numeric' => 'Child Ticket Price USD Should be numeric',
            'child_tikcet_price_egp.numeric' => 'Child Ticket Price EGP Should be numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $site->name = $request->name;
        $site->activitis = implode(',',$request->activities);
        $site->description = $request->description;
        $site->daily_capacity = $request->daily_capacity;
        $site->annual_capacity = $request->annual_capacity;
        // $site->geo_location_type = $request->geo_location_type;
        // $site->geo_location_fees = $request->geo_location_fees;
        $site->booking_time = $request->booking_time;
        $site->booking_slot = $request->booking_slot;
        $site->booking_slot_capacity = $request->booking_slot_capacity;
        $site->loc_lat = $request->loc_lat;
        $site->loc_lng = $request->loc_lng;
        $site->video = $request->video;
        // $site->reg_fees = $request->reg_fees;
        // $site->ticket_price = $request->ticket_price;

        $site->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        $site->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        $site->child_tikcet_price_usd = $request->child_tikcet_price_usd;
        $site->child_tikcet_price_egp = $request->child_tikcet_price_egp;

        $site->updated_at = date('Y-m-d H:i:s');
        $site->save();
        return response()->json(['type' => 'success', 'text' => 'Site edited Successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        if(!$this->permission->d) {
            return response()->json(['type'=>'error','text'=>'Delete Permission not have'], 200);
        }
        
        $pArea = DB::table('protected_areas')->select('name')->whereRaw('FIND_IN_SET('.$site->id.',sites)')->get();
        if(count($pArea) > 0){
            return response()->json(['type'=>'error','text'=>'First remove this site from all Protected Areas'], 200);
        } else {
            if($site->delete()){
                return response()->json(['type'=>'success','text'=>'Site Deleted Successfully'], 200);
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
            $status = Site::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                Site::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                Site::where('id',$request->id)->update([
                    'is_active' => '0',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            }
        }

    }


    /**
     * Manage Photos
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_photos(Request $request){
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }
        if($request->id){
            $photos = Site::select('photo')->where('id', $request->id)->first()->photo;
            return $photos;
        }
    }

    /**
     * Delete Photo
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_photo(Request $request){
        if(!$this->permission->u) {
            return response()->json(['type' => 'error', 'text' => 'Update permission not have'], 200);    
        }
        if(isset($request->id) && isset($request->key)){
            $site = Site::where('id', $request->id)->first();
            $photos = json_decode($site->photo);
            if(isset($photos[$request->key])){
                Storage::disk('public')->delete($photos[$request->key]);
                unset($photos[$request->key]);
                $site->photo = json_encode(array_values($photos));
                if($site->save()){
                    return response()->json(['type' => 'success', 'text' => 'Image deleted Successfully'], 200);
                } else {
                    return response()->json(['type' => 'error', 'text' => ''], 500);
                }
            } else {
                return response()->json(['type' => 'error', 'text' => 'Image does not exist'], 200);
            }

        }
    }


    /**
     * Upload Photos
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_photos(Request $request){
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        $validator = Validator::make($request->all(), [
            "photos.*" => 'required|mimes:jpg,jpeg,png|max:10000'
        ], [
            'photos.*.required' => 'Photos is required',
            'photos.*.mimes' => 'Acceptable Photo format is jpg,png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $site = Site::where('id', $request->id)->first();
        if($site){
            $fileArr = [];
            foreach ($request->photos as $key => $photo) {
                $file = explode("public/", $photo->store('public/site/image'));
                $fileArr[] = end($file);
            }
            if(sizeof($fileArr) > 0) {
                if(!is_array(json_decode($site->photo))) {
                    $prevPhotoArr = [];
                } else {
                    $prevPhotoArr =  json_decode($site->photo);
                }
                $site->photo = json_encode(array_merge($prevPhotoArr, $fileArr));
            }
            if($site->save()){
                return response()->json(['type' => 'success', 'text' => count($fileArr).' Image(s) uploded Successfully'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => ''], 500);
            }
        } else {
            return response()->json(['type' => 'error', 'text' => 'Site does not exist'], 200);
        }


    }

    public function upload_slots(Request $request) {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        $validator = Validator::make($request->all(), [
            "site_id" => 'required',
            "time_from" => 'required',
            "time_to" => 'required',
            "slot_name" => 'required',
            "booking_time_span" => 'required|numeric',
            "booking_slot_capacity" => 'required|numeric',
            "green_to" => 'required|numeric',
            "yellow_to" => 'required|numeric',
            "red_to" => 'required|numeric'
        ], [
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $site = Site::find($request->site_id);
        if($site){
            $slot = new Slot;
            $slot->slot_name = $request->slot_name;
            $slot->time_from = $request->time_from;
            $slot->time_to = $request->time_to;
            $slot->booking_time_span = $request->booking_time_span;
            $slot->booking_slot_capacity = $request->booking_slot_capacity;
            $slot->green_to = $request->green_to;
            $slot->yellow_to = $request->yellow_to;
            $slot->red_to = $request->red_to;
            if($site->slots()->save($slot)){
                return response()->json(['type' => 'success', 'text' => 'Slot added successfully'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => 'Try again!'], 200);
            }
        } else {
            return response()->json(['type' => 'error', 'text' => 'Site does not exist'], 200);
        }
    }

    public function manage_slots(Request $request) {
        $slots = Site::find($request->id)->slots;
        return json_encode($slots);

    }

    public function edit_slot(Request $request)
    {
        $slot = Slot::find($request->id);
        return $slot;
    }

    public function del_slot(Request $request)
    {
        if(!$this->permission->u) {
            return response()->json(['type' => 'error', 'text' => 'Permission not have'], 200);
        }
        $bookingCount = Slot::find($request->id)->postBookings()->count();
        if($bookingCount > 0){
            return response()->json(['type' => 'error', 'text' => 'Booking already done against this slot'], 200);
        }
        if(Slot::find($request->id)->delete()){
            return response()->json(['type' => 'success', 'text' => 'Slot deleted successfully'], 200);
        } else {
            return response()->json(['type' => 'error'], 500);
        }
    }

    public function edit_slot_save(Request $request)
    {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        $validator = Validator::make($request->all(), [
            "site_id" => 'required',
            "time_to" => 'required',
            "time_from" => 'required',
            "slot_name" => 'required',
            "booking_time_span" => 'required|numeric',
            "booking_slot_capacity" => 'required|numeric',
            "green_to" => 'required|numeric',
            "yellow_to" => 'required|numeric',
            "red_to" => 'required|numeric'
        ], [
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $slot = Slot::where('id', $request->slot_id)->where('site_id', $request->site_id)->first();
        if($slot){
            $slot->slot_name = $request->slot_name;
            $slot->time_from = $request->time_from;
            $slot->time_to = $request->time_to;
            $slot->booking_time_span = $request->booking_time_span;
            $slot->booking_slot_capacity = $request->booking_slot_capacity;
            $slot->green_to = $request->green_to;
            $slot->yellow_to = $request->yellow_to;
            $slot->red_to = $request->red_to;
            if($slot->save()){
                return response()->json(['type' => 'success', 'text' => 'Slot updated successfully'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => 'Try again!'], 200);
            }
        } else {
            return response()->json(['type' => 'error', 'text' => 'Slot does not exist'], 200);
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
