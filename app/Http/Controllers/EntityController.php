<?php

namespace App\Http\Controllers;

use App\Lib\Validate;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\Datatables\DataTables;

class EntityController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('entities', ['C', 'r', 'u', 'd']);
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
        if ($datatables->getRequest()->ajax())
        {
            if(!$this->permission->r) {
                return [];
            }

            $entities = Entity::select(['id', 'name', 'type','fees','annual_average','annual_protection_fees','annual_allowed_tickets','extra_ticket_category','created_at'])->orderBy('id', 'desc');

            return $datatables->of($entities)
            ->addColumn('action', function ($entities) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';
                // href="pages/' . $entities->slug . '/edit/"
                if($this->permission->u) {
                    $btns .= '<a href="javascript:;" class="btn btn-primary btn-sm" onclick="edit(\''.$entities->id.'\', this)">Edit</a>';
                    if (!in_array($entities->slug, ['home', 'contact-us'])) {
                        if($this->permission->d) {
                            $btns .= '<button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $entities->id . '\')">Delete</button>';
                        }
                        // <button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="del(\'' . $entities->slug . '\')">Delete</button>';
                    }
                }
                $btns .= '</div>';
                return $btns;
            })
            ->rawColumns(['action'])
            ->make();
        }
        $permission = $this->permission;
        return view('entity.list', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('entity.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if(!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        } 

        $this->validate($request, [
            'name' => 'required|max:255',
            'type' =>  'required|max:255',
            'fees' => 'required|numeric|digits_between:1,255',
            'annual_average' => 'required|numeric|between:0.0,99999.0',
            'annual_protection_fees' => 'required|numeric|between:0.0,99999.0',
            'annual_allowed_tickets' => 'nullable|numeric|digits_between:1,255',
            'extra_ticket_category' => 'nullable|numeric|digits_between:1,255',
            'extra_ticket_category_fees' => 'nullable|numeric|digits_between:1,255',
        ], [
            'annual_average.required' => 'Annual Average is required',
            'annual_average.numeric' => 'Annual Average should be numeric',
            
            'annual_protection_fees.required' => 'Annual Protection Fees is required',
            'annual_protection_fees.numeric' => 'Annual Protection Fees should be numeric',
            
            'annual_allowed_tickets.numeric' => 'Annual Allowed Tickets should be numeric',
            'extra_ticket_category.numeric' => 'Extra Ticket Category should be numeric',
            'extra_ticket_category_fees.numeric' => 'Extra Ticket Category Fees should be numeric',
        ]);

        $entity = new Entity();
        $entity->name = $request->name;
        $entity->type = $request->type;
        $entity->fees = $request->fees;
        $entity->annual_average = $request->annual_average;
        $entity->annual_protection_fees = $request->annual_protection_fees;
        $entity->annual_allowed_tickets = $request->annual_allowed_tickets;
        $entity->extra_ticket_category = $request->extra_ticket_category;
        $entity->extra_ticket_category_fees = $request->extra_ticket_category_fees;       
        $entity->created_at = date('Y-m-d H:i:s');

        if ($entity->save()) {
            return response()->json(['type' => 'success', 'text' => 'Enitity added Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
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
    public function edit(Entity $entity)
    {
        //
        // dd($entity);
        if(!$this->permission->u) {
            return abort(403);
        }
        if($entity) {
            return view('entity.edit', compact('entity'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        } 

        $this->validate($request, [
            'name' => 'required|max:255',
            'type' =>  'required|max:255',
            'fees' => 'required|numeric|digits_between:1,255',
            'annual_average' => 'required|numeric|between:0.0,99999.0',
            'annual_protection_fees' => 'required|numeric|between:0.0,99999.0',
            'annual_allowed_tickets' => 'nullable|numeric|digits_between:1,255',
            'extra_ticket_category' => 'nullable|numeric|digits_between:1,255',
            'extra_ticket_category_fees' => 'nullable|numeric|digits_between:1,255',
        ], [
            'annual_average.required' => 'Annual Average is required',
            'annual_average.numeric' => 'Annual Average should be numeric',
            
            'annual_protection_fees.required' => 'Annual Protection Fees is required',
            'annual_protection_fees.numeric' => 'Annual Protection Fees should be numeric',
            
            'annual_allowed_tickets.numeric' => 'Annual Allowed Tickets should be numeric',
            'extra_ticket_category.numeric' => 'Extra Ticket Category should be numeric',
            'extra_ticket_category_fees.numeric' => 'Extra Ticket Category Fees should be numeric',
        ]);

        $entity->name = $request->name;
        $entity->type = $request->type;
        $entity->fees = $request->fees;
        $entity->annual_average = $request->annual_average;
        $entity->annual_protection_fees = $request->annual_protection_fees;
        $entity->annual_allowed_tickets = $request->annual_allowed_tickets;
        $entity->extra_ticket_category = $request->extra_ticket_category;
        $entity->extra_ticket_category_fees = $request->extra_ticket_category_fees;       
        $entity->updated_at = date('Y-m-d H:i:s');

        if ($entity->save()) {
            return response()->json(['type' => 'success', 'text' => 'Enitity updated Successfully'], 200);
        }
        return response()->json(['success' => false], 500);

        //
        // $this->validate($request, [
        //     'title' => 'required|max:255',
        //     'slug' => 'required|alpha_dash|max:255|unique:pages,slug,' . $page->id,
        //     // 'banner' => 'nullable|mimes:jpeg,jpg,png,gif',
        //     'content' => 'required',
        // ]);

        // if(in_array($request->slug, ['contact-us'])) {
        //     return response()->json(['message' => '', 'errors' => ['validation_error' => ['Slug Name not accepted'][0]]], 422);

        // }

        // $page->title = $request->title;
        // $page->slug = $request->slug;
        // $page->meta_title = $request->meta_title;
        // $page->meta_description = $request->meta_description;
        // $page->meta_keywords = $request->meta_keywords;
        // $page->updated_at = date('Y-m-d H:i:s');

        // $page->content = $request->content;

        // if($page->save()) {
        //     return response()->json(['type' => 'success', 'text' => 'Page updated Successfully'], 200);
        // }
        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Entity $entity)
    {
        //
        if(!$this->permission->d) {
            return $this->permissionCheckMessage('d');
        }
        if ($entity->delete()) {
            return response()->json(['type'=>'success','text'=>'Entity Deleted Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
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
