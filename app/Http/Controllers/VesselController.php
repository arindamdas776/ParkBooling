<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Port;
use App\Lib\Validate;
use App\Models\Crafts;
use App\Models\Length;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class VesselController extends Controller
{
    private $permission = [];

    public function __construct()
    {
        // Route filter
        $this->middleware(function ($request, $next) {
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('vessels', ['C', 'r', 'u', 'd']);

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
    public function index(DataTables $datatables)
    {
        if ($datatables->getRequest()->ajax()) {
            if (!$this->permission->r) {
                return [];
            }

            $vessels = Vessel::select(['id', 'name', 'type', 'logo', 'adult_ticket_price_usd', 'adult_ticket_price_egp', 'reg_fees', 'Safari_ticket_price_usd', 'ticket_price_usd', 'ticket_price_egp', 'is_active'])->orderBy('id', 'desc');

            return $datatables->of($vessels)
            ->addColumn('logo', function ($vessels) {
                return '<img src="'.asset('storage/'.$vessels->logo).'" style="width: 100px;"/>';
            })
            ->addColumn('status', function ($vessels) {
                if ($vessels->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('action', function ($vessels) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';

                if ($this->permission->u) {
                    if ($vessels->is_active == '1') {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive" onclick="changeStatus(\''.$vessels->id.'\', this)">Inactive</a>';
                    } else {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active" onclick="changeStatus(\''.$vessels->id.'\', this)">Active</a>';
                    }
                    $btns .= '<a href="'.route('vessels.edit', ['vessel' => $vessels->id]).'" class="btn btn-primary btn-sm">Edit</a>';
                }

                if ($this->permission->d) {
                    $btns .= '<button onclick="del(\''.$vessels->id.'\', this)" class="btn btn-danger btn-sm">Delete</button>';
                }

                // href="pages/' . $vessels->slug . '/edit/"
                // <button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $vessels->slug . '\')">Delete</button>';
                $btns .= '</div>';

                return $btns;
            })
            ->rawColumns(['logo', 'action', 'status'])
            ->make();
        }
        $permission = $this->permission;

        return view('vessel.list', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ports = Port::where('is_active', 1)->get();
        $crafts = Crafts::where('is_active', 1)->get();
        $lengths = Length::where('is_active', 1)->get();

        // return response()->json(['data' => $ports]);

        return view('vessel.add', compact('ports', 'crafts', 'lengths'));
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
        // dd($request->all());
        if (!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'name_arabic' => 'required|max:255',
            'logo' => 'required|mimes:jpeg,jpg,png|max:1024',
            'description' => 'required',
            'description_arabic' => 'required',
            'type' => 'required|max:255',
            'ticket_price_usd' => 'nullable|numeric',
            'ticket_price_egp' => 'nullable|numeric',
            'Safari_ticket_price_usd' => 'required',

            // 'adult_ticket_price_usd' => 'nullable|numeric',
            // 'adult_ticket_price_egp' => 'nullable|numeric',
            // 'child_tikcet_price_usd' => 'nullable|numeric',
            // 'child_tikcet_price_egp' => 'nullable|numeric',
        ], [
            'name_arabic.required' => 'Name in Arabic Required',

            'name_arabic.max' => 'Name in Arabic Supports Maximumn 255 Characters',
            'description_arabic.required' => 'Description in Arabic Required',
            'logo.mimes' => 'Acceptable Image format is jpg,png,jpeg',
            'logo.max' => 'Your logo is too large, must be less than 1 mb.',
        ]);

        $vessel = new Vessel();

        $vessel->name = $request->name;
        $vessel->name_arabic = $request->name_arabic;

        if ($request->hasFile('logo')) {
            $logo = $request->logo->store('vessels', 'public');
            $vessel->logo = $logo;
        }

        $vessel->description = $request->description;
        $vessel->description_arabic = $request->description_arabic;

        $vessel->type = $request->type;
        $vessel->port_id = $request->port;
        $vessel->craft_id = $request->craft;
        $vessel->length_id = $request->length;

        $vessel->ticket_price_usd = $request->ticket_price_usd;
        $vessel->ticket_price_egp = $request->ticket_price_egp;
        $vessel->Safari_ticket_price_usd = $request->Safari_ticket_price_usd;

        // $vessel->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        // $vessel->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        // $vessel->child_tikcet_price_usd = $request->child_tikcet_price_usd;
        // $vessel->child_tikcet_price_egp = $request->child_tikcet_price_egp;
        $vessel->construction_type = $request->construction_type;
        $vessel->created_at = date('Y-m-d H:i:s');

        if ($vessel->save()) {
            return response()->json(['type' => 'success', 'text' => 'Vessel added Successfully'], 200);
        }

        return response()->json(['success' => false], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vessel $vessel)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vessel $vessel)
    {
        $ports = Port::where('is_active', 1)->get();
        $crafts = Crafts::where('is_active', 1)->get();
        $lengths = Length::where('is_active', 1)->get();

        if ($vessel) {
            return view('vessel.edit', compact('vessel', 'ports', 'crafts', 'lengths'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vessel $vessel)
    {
        if (!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }
            $this->validate($request, [
            'name' => 'required|max:255',
            'name_arabic' => 'required|max:255',
            'logo' => 'nullable|mimes:jpeg,jpg,png|max:1024',
            'description' => 'required',
            'description_arabic' => 'required',
            'type' => 'required|max:255',
            'ticket_price_usd' => 'nullable|numeric',
            'ticket_price_egp' => 'nullable|numeric',
        ], [
            'name_arabic.required' => 'Name in Arabic Required',

            'name_arabic.max' => 'Name in Arabic Supports Maximumn 255 Characters',
            'description_arabic.required' => 'Description in Arabic Required',
            'logo.mimes' => 'Acceptable Image format is jpg,png,jpeg',
            'logo.max' => 'Your logo is too large, must be less than 1 mb.',
        ]);

        $vessel->name = $request->name;
        $vessel->name_arabic = $request->name_arabic;

        if ($request->hasFile('logo')) {
            $logo = $request->logo->store('vessels', 'public');
            $vessel->logo = $logo;
        }

        $vessel->description = $request->description;
        $vessel->description_arabic = $request->description_arabic;
        $vessel->type = $request->type;
        $vessel->port_id = $request->port;
        $vessel->craft_id = $request->craft;
        $vessel->length_id = $request->length;

        $vessel->ticket_price_usd = $request->ticket_price_usd;
        $vessel->ticket_price_egp = $request->ticket_price_egp;

        // $vessel->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        // $vessel->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        // $vessel->child_tikcet_price_usd = $request->child_tikcet_price_usd;
        // $vessel->child_tikcet_price_egp = $request->child_tikcet_price_egp;
        $vessel->construction_type = $request->construction_type;
        $vessel->updated_at = date('Y-m-d H:i:s');

        if ($vessel->save()) {
            return response()->json(['type' => 'success', 'text' => 'Vessel edited Successfully'], 200);
        }

        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vessel $vessel)
    {
        if (!$this->permission->d) {
            return $this->permissionCheckMessage('d');
        }
        // \DB::enableQueryLog();
        $res = Vessel::where('id', $vessel->id)->with('booking:vessel_id,booking_no')->first();
        // dump(\DB::getQueryLog());
        if ($res->booking) {
            return response()->json(['type' => 'error', 'errors' => ['validation_error' => ['Unable to delete as ticket already booked against this vehicle.']]], 422);
        }

        if ($vessel->delete()) {
            return response()->json(['type' => 'success', 'text' => 'Record Deleted Successfully'], 200);
        }

        return response()->json(['success' => false], 500);
    }

    public function change_status(Request $request)
    {
        if (!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        if ($request->id) {
            $status = Vessel::select('is_active')->where('id', $request->id)->first();
            Vessel::where('id', $request->id)->update([
                'is_active' => !$status->is_active,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['type' => 'success', 'text' => 'Status changed Successfully'], 200);
        }
    }

    public function permissionCheckMessage($action)
    {
        $perform = '';
        if ($action == 'c') {
            $perform = 'Create';
        }
        if ($action == 'r') {
            $perform = 'Read';
        }
        if ($action == 'u') {
            $perform = 'Update';
        }
        if ($action == 'd') {
            $perform = 'Delete';
        }

        return response()->json(['message' => '', 'errors' => ['validation_error' => ["Sorry you dont have permission to $perform ."]]], 422);
    }
}