<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\Site;
use App\Lib\Validate;
use Illuminate\Http\Request;
use App\Models\ProtectedArea;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Facades\Storage;

class ProtectedAreaController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('protected-areas', ['C', 'r', 'u', 'd']);
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

            $protectedArea = ProtectedArea::select(['id','name','description', 'slug', 'is_active', 'geo_location_type', 'geo_location_fees']);
            return $datatables->of($protectedArea)
            ->addColumn('is_active', function($protectedArea) {
                if($protectedArea->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('action', function ($protectedArea) {
                $action = '<div class="btn-group">';
                if($this->permission->u) {
                    if($protectedArea->is_active == 1) {
                        $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$protectedArea->id.'\', this)">Inactive</a>';
                    } else {
                        $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$protectedArea->id.'\', this)">Active</a>';
    
                    }
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$protectedArea->id.'\')">Edit</a>';
                }
                if($this->permission->d) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$protectedArea->id.'\', this)">Delete</a>';
                }
                if($this->permission->u) {
                    $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Manage photos" onclick="managePhotos(\''.$protectedArea->id.'\')">Manage Photos</a>';
                    $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm white" title="Manage documents" onclick="manageDocs(\''.$protectedArea->id.'\')">Manage Documents</a></div>';
                }
                return $action;
            })
            ->rawColumns(['id','name','description', 'slug', 'is_active', 'action'])
            ->make();
        }
        $protectedAreas = ProtectedArea::where('is_active', '1')->get();
        $sites = Site::select('name', 'id')->where('is_active', '1')->get();
        $permission = $this->permission;
        return view('protected-area.list', compact('sites', 'protectedAreas','permission'));
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

        //
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "sites" => "required",
            "loc_lat" => 'required',
            "loc_lng" => 'required',
            "slug" => 'required|unique:protected_areas,slug',
            "photos.*" => 'required|mimes:jpg,jpeg,png|max:10000',
            "documents.*" => 'nullable|mimes:pdf|max:10000',
            "geo_location_type" => "required",
            "geo_location_fees" => 'required|numeric',
        ], [
            'sites.*' => 'Please select al least one Site',
            'sites.required' => 'Sites is required',

            'loc_lat.required' => 'Location Lat is required',
            // 'loc_lat.required' => 'Location Lat is required',

            'loc_lng.required' => 'Location Long is required',
            // 'loc_lng.numeric' => 'Location Long should be numeric',

            'photos.*.required' => 'Photos is required',
            'photos.*.mimes' => 'Acceptable Photo format is jpg,png,jpeg',

            'documents.*.mimes' => 'Attach documents format is PDF',

            'geo_location_type.required' => 'Geo Location Type is required',

            'geo_location_fees.required' => 'Geo Location Type is required',
            'geo_location_fees.numeric' => 'Geo Location Fees should be numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        // save photos
        $photosArr = [];
        foreach ($request->photos as $key => $photo) {
            $file = explode("public/", $photo->store('public/protected-area/image'));
            $photosArr[] = end($file);
        }

        // save documents
        $docArr = [];
        if($request->documents){
            foreach ($request->documents as $key => $document) {
                if($document){
                    $file = explode("public/", $document->store('public/protected-area/document'));
                    $docArr[] = end($file);
                }
            }
        }

        $pArea = new ProtectedArea();
        $pArea->name = $request->name;
        $pArea->description = $request->description;
        $pArea->sites = implode(',',$request->sites);
        $pArea->loc_lat = $request->loc_lat;
        $pArea->loc_lng = $request->loc_lng;
        $pArea->slug = $request->slug;
        $pArea->video = $request->video;
        if(sizeof($photosArr) > 0) {
            $pArea->photo = json_encode($photosArr);
        }
        if(sizeof($docArr) > 0) {
            $pArea->documents = json_encode($docArr);
        }
        $pArea->created_by = auth()->user()->id;

        $pArea->meta_title = $request->meta_title;
        $pArea->meta_description = $request->meta_description;
        $pArea->geo_location_type = $request->geo_location_type;
        $pArea->geo_location_fees = $request->geo_location_fees;

        $pArea->created_at = date('Y-m-d H:i:s');
        if($pArea->save()){
            return response()->json(['type' => 'success', 'text' => 'Protected Area added Successfully'], 200);
        } else {
            return response()->json(['type' => 'error', 'text' => ''], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProtectedArea $protectedArea)
    {
        //
        return $protectedArea;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProtectedArea $protectedArea)
    {
        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        } 
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "sites" => "required",
            "loc_lat" => 'required',
            "loc_lng" => 'required',
            "slug" => 'required|unique:protected_areas,slug,'.$protectedArea->id.',id,deleted_at,NULL',
            "geo_location_type" => "required",
            "geo_location_fees" => 'required|numeric',
        ], [
            'sites.*' => 'Please select al least one Site',
            'sites.required' => 'Sites is required',

            'loc_lat.required' => 'Location Lat is required',
            // 'loc_lat.required' => 'Location Lat is required',

            'loc_lng.required' => 'Location Long is required',

            'geo_location_type.required' => 'Geo Location Type is required',

            'geo_location_fees.required' => 'Geo Location Type is required',
            'geo_location_fees.numeric' => 'Geo Location Fees should be numeric',

            // 'loc_lng.numeric' => 'Location Long should be numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $protectedArea->name = $request->name;
        $protectedArea->description = $request->description;
        $protectedArea->sites = implode(',',$request->sites);
        $protectedArea->loc_lat = $request->loc_lat;
        $protectedArea->loc_lng = $request->loc_lng;
        $protectedArea->slug = $request->slug;
        $protectedArea->video = $request->video;


        $protectedArea->meta_title = $request->meta_title;
        $protectedArea->meta_description = $request->meta_description;
        $protectedArea->geo_location_type = $request->geo_location_type;
        $protectedArea->geo_location_fees = $request->geo_location_fees;

        $protectedArea->updated_at = date('Y-m-d H:i:s');
        if($protectedArea->save()){
            return response()->json(['type' => 'success', 'text' => 'Protected Area edited Successfully'], 200);
        } else {
            return response()->json(['type' => 'error', 'text' => ''], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProtectedArea $protectedArea)
    {
        if(!$this->permission->d) {
            return $this->permissionCheckMessage('d');
        } 
        if($protectedArea->delete()) {
            return response()->json(['type'=>'success','text'=>'Protected Area Deleted Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
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
            $status = ProtectedArea::select('is_active')->where('id',$request->id)->first()->is_active;
            if($status == '0'){
                ProtectedArea::where('id',$request->id)->update([
                    'is_active' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
            } else {
                ProtectedArea::where('id',$request->id)->update([
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
        // if(!$this->permission->u) {
        //     return $this->permissionCheckMessage('u');
        // } 
        if($request->id){
            $photos = ProtectedArea::select('photo')->where('id', $request->id)->first()->photo;
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
            return response()->json(['type' => 'error', 'text' => 'Update permission not set'], 200);
        } 
        if(isset($request->id) && isset($request->key)){
            $pArea = ProtectedArea::where('id', $request->id)->first();
            $photos = json_decode($pArea->photo);
            if(isset($photos[$request->key])){
                Storage::disk('public')->delete($photos[$request->key]);
                unset($photos[$request->key]);
                $pArea->photo = json_encode(array_values($photos));
                if($pArea->save()){
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
            return response()->json(['type' => 'error', 'text' => 'Update permission not set'], 200);
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

        $pArea = ProtectedArea::where('id', $request->id)->first();
        if($pArea){
            $fileArr = [];
            foreach ($request->photos as $key => $photo) {
                $file = explode("public/", $photo->store('public/protected-area/image'));
                $fileArr[] = end($file);
            }
            if(sizeof($fileArr) > 0) {
                $pArea->photo = json_encode(array_merge(json_decode($pArea->photo), $fileArr));
            }
            if($pArea->save()){
                return response()->json(['type' => 'success', 'text' => count($fileArr).' Image(s) uploded Successfully'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => ''], 500);
            }
        } else {
            return response()->json(['type' => 'error', 'text' => 'Protected Area does not exist'], 200);
        }


    }

    /**
     * Manage Documents
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_docs(Request $request){
        // if(!$this->permission->u) {
        //     return $this->permissionCheckMessage('u');
        // } 
        if($request->id){
            $documents = ProtectedArea::select('documents')->where('id', $request->id)->first()->documents;
            return $documents ? $documents : [];
        }
    }

    /**
     * Delete Document
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_doc(Request $request){
        if(!$this->permission->u) {
            return response()->json(['type' => 'error', 'text' => 'Update permission not set'], 200);
        } 
        if(isset($request->id) && isset($request->key)){
            $pArea = ProtectedArea::where('id', $request->id)->first();
            $documents = json_decode($pArea->documents);
            if(isset($documents[$request->key])){
                Storage::disk('public')->delete($documents[$request->key]);
                unset($documents[$request->key]);
                $pArea->documents = json_encode(array_values($documents));
                if($pArea->save()){
                    return response()->json(['type' => 'success', 'text' => 'Document deleted Successfully'], 200);
                } else {
                    return response()->json(['type' => 'error', 'text' => ''], 500);
                }
            } else {
                return response()->json(['type' => 'error', 'text' => 'Document does not exist'], 200);
            }

        }
    }


    /**
     * Upload Documents
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_docs(Request $request){
        if(!$this->permission->u) {
            return response()->json(['type' => 'error', 'text' => 'Update permission not set'], 200);;
        } 
        $validator = Validator::make($request->all(), [
            "documents.*" => 'required|mimes:pdf|max:10000'
        ], [
            'documents.*.required' => 'Documents is required',
            'documents.*.mimes' => 'Acceptable Documents format is PDF',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $pArea = ProtectedArea::where('id', $request->id)->first();
        if($pArea){
            $fileArr = [];
            foreach ($request->documents as $key => $document) {
                $file = explode("public/", $document->store('public/protected-area/document'));
                $fileArr[] = end($file);
            }
            if(sizeof($fileArr) > 0) {
                $pArea->documents = json_encode(array_merge(json_decode($pArea->documents), $fileArr));
            }
            if($pArea->save()){
                return response()->json(['type' => 'success', 'text' => count($fileArr).' Document(s) uploded Successfully'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => ''], 500);
            }
        } else {
            return response()->json(['type' => 'error', 'text' => 'Protected Area does not exist'], 200);
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
