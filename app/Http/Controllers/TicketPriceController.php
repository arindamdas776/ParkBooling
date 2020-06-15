<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lib\Validate;

 use Validator;

use App\Models\TicketPrice;

use App\Models\ProtectedArea;

use Yajra\Datatables\DataTables;

class TicketPriceController extends Controller
{
    private $permission = [];

    public function __construct(){

          $this->middleware(function ($request, $next) {
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('Ticket', ['C', 'r', 'u', 'd']);

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

       $result = TicketPrice::select('id','name','VsitType','adult_ticket_price_usd','adult_ticket_price_egp','safari_ticket_price_usd','safari_ticket_price_egp', 'child_ticket_price_usd', 'status', 'child_ticket_price_egp','name_arabic')->orderBy('id','DESC')->get();    
         
        return $datatables->of($result)

        ->addColumn('action', function ($result) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';

               
                    if ($result->status == '1') {
                        $btns .= '<button type="button" class="btn btn-warning btn-sm white" data-id="'.$result->id.'" title="Inactive" onclick="changeStatus(this)">Inactive</button>';
                    } else {
                        $btns .= '<button  class="btn btn-success btn-sm white" data-id="'.$result->id.'" title="Active" onclick="changeStatus(this)">Active</button>';
                    }
                    $btns .= '<button type="button" class="btn btn-primary" data-id="'.$result->id.'" onclick="editTicket(this)" >Edit</button>';
              

                
                    $btns .= '<button onclick="DeleteTicket(this)" data-id="'.$result->id.'" class="btn btn-danger btn-sm">Delete</button>';
                

                // href="pages/' . $vessels->slug . '/edit/"
                // <button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $vessels->slug . '\')">Delete</button>';
                $btns .= '</div>';

                return $btns;
            })
            ->addColumn('status', function ($result) {
                if ($result->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->rawColumns(['action','status'])
            ->make();
        }

        $permission = $this->permission;
        return view('Ticket.list',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $protected_area = ProtectedArea::all();
        return view('Ticket.add', compact('protected_area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validation = Validator::make($request->all(),[
            'name'  =>  'required',
            'name_arabic'   =>  'required',
            'protect_area' => 'required',
            'daily_ticket_price_usd' => 'required',
            'daily_ticket_price_egp' => 'required',
            'Safari_ticket_price_usd' => 'required',
            'Safari_ticket_price_egp' => 'required',
            'visit_type'   => 'required',
            'adult_ticket_price_usd' => 'required',
            'adult_ticket_price_egp' => 'required',
            'child_tikcet_price_usd' => 'required',
            'child_tikcet_price_egp' => 'required',
        ],[
            'name.required' =>'Name Field is Required',
            'name_arabic.required'  =>'Name in Arabic is required',
            'protect_area. requried'    =>' Protected area must required',
            'daily_ticket_price_usd.required' =>' Ticket Price(usd) is required',
            'Safari_ticket_price_ego.required' =>'Safari_ticket_price_egp is required',
            'visit_type.required' => 'visit Type is required',
            'adult_ticket_price_usd.required' =>' Adult Ticket Price required',
            'adult_ticket_price_egp.required' =>'Adult Ticket Price is reuqired',
            'child_tikcet_price_usd.required' =>'Child Ticket price is required',
        ]);

         if ($validation->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validation->errors()->all()[0]]], 422);
        }

        $result = new TicketPrice();
        $result->name = $request->name;
        $result->name_arabic = $request->name_arabic;
        $result->VsitType =  $request->visit_type;
        $result->status = true;
        $result->protected_area = $request->protect_area;
        $result->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        $result->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        $result->child_ticket_price_usd = $request->child_tikcet_price_usd;
        $result->child_ticket_price_egp = $request->child_tikcet_price_egp;
        $result->safari_ticket_price_usd = $request->Safari_ticket_price_egp;
        $result->safari_ticket_price_egp = $request->Safari_ticket_price_usd;

          if($result->save()){
            return response()->json(['messages' =>'Ticket has been created successfully','success' =>true]);
          }else{
            return response()->json(['messages' =>'Ticket Create faield', 'success' => false]);
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Request::ajax()){
          $data = TicketPrice::find($id);

                
                    if($data->status){
                        $data->status = false;
                        $data->save();
                        return response()->json(['success' => true, 'messages' => 'Vechiles status has been Active']);
                    }else{
                        $data->status = true;
                        $data->save();

                        return response()->json(['success' => false, 'messages' =>'Vehicles status has been in active']);
                    }
        }else{
            alert(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = TicketPrice::find($id);
        $protected_area = ProtectedArea::all();

        return view('Ticket.edit', compact('result','protected_area'));
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
         $validation = Validator::make($request->all(),[
            'name'  =>  'required',
            'name_arabic'   =>  'required',
            'protect_area' => 'required',
            'daily_ticket_price_usd' => 'required',
            'daily_ticket_price_egp' => 'required',
            'Safari_ticket_price_usd' => 'required',
            'Safari_ticket_price_egp' => 'required',
            'visit_type'   => 'required',
            'adult_ticket_price_usd' => 'required',
            'adult_ticket_price_egp' => 'required',
            'child_ticket_price_usd' => 'required',
        ],[
            'name.required' =>'Name Field is Required',
            'name_arabic.required'  =>'Name in Arabic is required',
            'protect_area. requried'    =>' Protected area must required',
            'daily_ticket_price_usd.required' =>' Ticket Price(usd) is required',
            'Safari_ticket_price_ego.required' =>'Safari_ticket_price_egp is required',
            'visit_type.required' => 'visit Type is required',
            'adult_ticket_price_usd.required' =>' Adult Ticket Price required',
            'adult_ticket_price_egp.required' =>'Adult Ticket Price is reuqired',
            'child_tikcet_price_usd.required' =>'Child Ticket price is required',
        ]);

         if ($validation->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validation->errors()->all()[0]]], 422);
        }

        $data = TicketPrice::find($id);

            if($data){
                 $data->name = $request->name;
        $data->name_arabic = $request->name_arabic;
        $data->VsitType =  $request->visit_type;
        $data->status = true;
        $data->protected_area = $request->protect_area;
        $data->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        $data->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        $data->child_ticket_price_usd = $request->child_ticket_price_usd;
        $data->child_ticket_price_egp = $request->child_tikcet_price_egp;
        $data->safari_ticket_price_usd = $request->Safari_ticket_price_usd;
        $data->safari_ticket_price_egp = $request->Safari_ticket_price_usd;
        $data->daily_ticket_price_usd = $request->daily_ticket_price_usd;
        $data->daily_ticket_price_egp = $request->daily_ticket_price_egp;

        if($data->save()){
            return response()->json(['messagse' =>'Ticket Updated successfully','success' => true]);
        }else{
                return response()->json(['messages' =>'Ticket update fails', 'success' => false]);
            }

            }else{
                return response()->json(['messages' =>'Ticket update fails', 'success' => false]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = TicketPrice::find($id);

            if($result){
                $result->delete();

                return response()->json(['messages' =>'Ticket has been Deleted successfully', 'success' => false]);
            }
    }
}
