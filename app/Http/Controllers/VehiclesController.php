<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProtectedArea;
use Validator;
use Carbon\Carbon;


use App\Models\Vehicles;
use App\Lib\Validate;
use Yajra\Datatables\DataTables;

class VehiclesController extends Controller
{
    private $permission = [];

    public function __construct()
    {
        // Route filter
        $this->middleware(function ($request, $next) {
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('vessel', ['C', 'r', 'u', 'd']);

            if ($usertype == 'admin' || $usertype == 'employee') {
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
    public function index(Datatables $datatables)
    {
         
      if($datatables->getRequest()->ajax()){
            if(! $this->permission->r){
                return [];
            }

              $Vehicles = Vehicles::select(['id','vehicle_name','type','logo', 'protected_area','daily_ticket_price_usd','daily_ticket_price_ESD','safari_ticket_price_USD','safari_ticket_price_ESD','is_active'])->orderBy('id','desc')->get();
            
            return $datatables->of($Vehicles)
             ->addColumn('logo', function ($Vehicles) {
                return '<img src="'.asset('Vehicles_image/'.$Vehicles->logo).'" style="width: 100px;"/>';
            })
            
            ->addColumn('action', function ($Vehicles) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';

               
                    if ($Vehicles->is_active == '1') {
                        $btns .= '<button type="button" class="btn btn-warning btn-sm white" data-id="'.$Vehicles->id.'" title="Inactive" onclick="changeStatus(this)">Inactive</button>';
                    } else {
                        $btns .= '<button  class="btn btn-success btn-sm white" data-id="'.$Vehicles->id.'" title="Active" onclick="changeStatus(this)">Active</button>';
                    }
                    $btns .= '<button type="button" class="btn btn-primary" data-id="'.$Vehicles->id.'" onclick="editVehicles(this)" >Edit</button>';
              

                
                    $btns .= '<button onclick="DeleteVehicles(this)" data-id="'.$Vehicles->id.'" class="btn btn-danger btn-sm">Delete</button>';
                

                // href="pages/' . $vessels->slug . '/edit/"
                // <button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $vessels->slug . '\')">Delete</button>';
                $btns .= '</div>';

                return $btns;
            })
            ->addColumn('status', function ($Vehicles) {
                if ($Vehicles->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->rawColumns(['logo','action','status'])
            ->make();
        }
        $permission = $this->permission;
        return view('Vehicles.list', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $protec_area = ProtectedArea::where('is_active',1)->get();
        
        return view('Vehicles.create',compact('protec_area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          if(\Request::ajax()){
             // return $request->all();
             if (!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        }

  $this->validate($request,[
                'Vehicles_name' =>'required',
                'name_arabic' => 'required',
                'description'   => 'required',
                'description_arabic' => 'required',
                'type'  => 'required',
                'protect_area' => 'required',
                 'logo' => 'required|mimes:jpeg,jpg,png|max:1024',
                 'daily_ticket_price_usd' => 'required',
                 'daily_ticket_price_egp' => 'required',
                 'Safari_ticket_price_usd' => 'required',
                 'Safari_ticket_price_egp' => 'required',
            ],[

                'name_arabic.required' => 'Name in arabic required',
                'description_arabic.required' => 'Description in arabic is required',
                'logo.mimes' => 'Logo  Acceptence file Only jpg, jpg, png',
                'logo'  => 'Logo Size is Too height Must be less then 1 mb',
                'Vehicles_name.required' => 'Vehicles Name Must Required',
                'description'    => 'Description Must Field Must required',
                'type.required' => 'Type Must Request',
                'daily_ticket_price_usd.required' => 'Daily Ticket Price Must Request',
                'daily_ticket_price_usd.egp' => ' Daily Tocket Price Must Request',
            ]);
                $image = $request->file('logo');
                $image_name = $request->Vehicles_name.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('Vehicles_image'),$image_name);


                 $createVechicles = new Vehicles();
                 $createVechicles->vehicle_name = $request->Vehicles_name;
                 $createVechicles->name_arabic = $request->name_arabic;
                 $createVechicles->description = $request->description;
                 $createVechicles->description_arabic = $request->description_arabic;
                 $createVechicles->logo = $image_name;
                 $createVechicles->type = $request->type;
           
                 $createVechicles->protected_area = $request->protect_area;
                 $createVechicles->daily_ticket_price_usd = $request->daily_ticket_price_usd;
                 $createVechicles->daily_ticket_price_ESD = $request->daily_ticket_price_egp;
                 $createVechicles->safari_ticket_price_USD = $request->Safari_ticket_price_usd;
                 $createVechicles->safari_ticket_price_ESD = $request->Safari_ticket_price_egp;

                    if($createVechicles->save()){
                        return response()->json(['success' => true , 'messages' =>'Vehicles created successfully'],200);
                    }else{
                        return response()->json(['success' => false, 'messages' =>'Faildes to create Vehicles'],404);
                    }
          }else{
            abort(404);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // change status 
        if(\Request::ajax()){
            $data = Vehicles::find($id);

            // return response()->json($data->statu);

                    if($data->is_active){
                        $data->is_active = false;
                        $data->save();
                        return response()->json(['success' => true, 'messages' => 'Vechiles status has been Active']);
                    }else{
                        $data->is_active = true;
                        $data->save();

                        return response()->json(['success' => false, 'messages' =>'Vehicles status has been in active']);
                    }
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protected_area = ProtectedArea::all();
        $result = Vehicles::find($id);

        return view('Vehicles.edit', compact('result', 'protected_area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Request::ajax()){
            $validator = Validator::make($request->all(), [
            'Vehicles_name' =>'required',
                'name_arabic' => 'required',
                'description'   => 'required',
                'description_arabic' => 'required',
                'type'  => 'required',
                'protect_area' => 'required',
                 'logo' => 'required|mimes:jpeg,jpg,png|max:1024',
                 'daily_ticket_price_usd' => 'required',
                 'daily_ticket_price_egp' => 'required',
                 'Safari_ticket_price_usd' => 'required',
                 'Safari_ticket_price_egp' => 'required',
        ], [
            'name_arabic.required' => 'Name in arabic required',
                'description_arabic.required' => 'Description in arabic is required',
                'logo.mimes' => 'Logo  Acceptence file Only jpg, jpg, png',
                'logo'  => 'Logo Size is Too height Must be less then 1 mb',
                'Vehicles_name.required' => 'Vehicles Name Must Required',
                'description'    => 'Description Must Field Must required',
                'type.required' => 'Type Must Request',
                'daily_ticket_price_usd.required' => 'Daily Ticket Price Must Request',
                'daily_ticket_price_usd.egp' => ' Daily Tocket Price Must Request',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $image = $request->file('logo');

            if(isset($image)){
                $image = $request->file('logo');
                $image_name = Carbon::now()->toDateString().'.'.$request->Vehicles_name.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('Vehicles_image'),$image_name);
            }

            $Vehicles = Vehicles::find($id);
              
               if($Vehicles){
                 $Vehicles->vehicle_name = $request->Vehicles_name;
                 $Vehicles->name_arabic = $request->name_arabic;
                 $Vehicles->logo = $image_name;
                 $Vehicles->description = $request->description;
                 $Vehicles->description_arabic = $request->description_arabic;
                 $Vehicles->type = $request->type;
                 $Vehicles->protected_area = $request->protect_area;
                 $Vehicles->daily_ticket_price_usd = $request->daily_ticket_price_usd;
                 $Vehicles->daily_ticket_price_ESD = $request->daily_ticket_price_egp;
                 $Vehicles->safari_ticket_price_USD = $request->Safari_ticket_price_usd;
                 $Vehicles->safari_ticket_price_ESD = $request->Safari_ticket_price_egp;

                 $Vehicles->save();

                 return response()->json(['messages' => 'Vehicles has been updated successfully', 'success' => true]);
               }else{
                 return response()->json(['messages' => 'Vehicles has not been updated', 'success' => false]);
               }
        }else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vehicles::find($id);

            if($data){
                $data->delete();

                return response()->json(['messages' => 'Data delete successfully', 'success' => true]);
            }
    }

    // public function ChangeStatus($id){
    //     return $id;
    // }
}