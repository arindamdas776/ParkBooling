<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use App\Lib\Validate;
use Illuminate\Http\Request;
use App\Models\ProtectedArea;
use Illuminate\Validation\Rule;
use Yajra\Datatables\DataTables;

class SeoController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('pages', ['C', 'r', 'u', 'd']);
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
        // if($datatables->getRequest()->ajax()) {
        //     $protectedArea = ProtectedArea::select(['id','name','description', 'slug', 'is_active']);
        //     return $datatables->of($protectedArea)
        //     ->addColumn('is_active', function($protectedArea) {
        //         if($protectedArea->is_active == 1) {
        //             return '<span class="badge badge-success">Active</span>';
        //         } else {
        //             return '<span class="badge badge-warning">Inactive</span>';
        //         }
        //     })
        //     ->addColumn('action', function ($protectedArea) {
        //         $action = '<div class="btn-group">';
        //         if($protectedArea->is_active == 1) {
        //             $action .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$protectedArea->id.'\', this)">Inactive</a>';
        //         } else {
        //             $action .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$protectedArea->id.'\', this)">Active</a>';

        //         }
        //         $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="edit(\''.$protectedArea->id.'\')">Edit</a>';
        //         $action .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="del(\''.$protectedArea->id.'\', this)">Delete</a>';
        //         $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Manage photos" onclick="managePhotos(\''.$protectedArea->id.'\')">Manage Photos</a>';
        //         $action .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm white" title="Manage documents" onclick="manageDocs(\''.$protectedArea->id.'\')">Manage Documents</a></div>';
        //         return $action;
        //     })
        //     ->rawColumns(['id','name','description', 'slug', 'is_active', 'action'])
        //     ->make();
        // }
        // $protectedAreas = ProtectedArea::where('is_active', '1')->get();
        // $sites = Site::select('name', 'id')->where('is_active', '1')->get();


        if ($datatables->getRequest()->ajax()) {
            if(!$this->permission->r) {
                return [];
            }

            // $pages = Page::select(['id', 'title', 'slug'])->whereNotIn('slug', ['home'])->orderBy('id', 'desc');
            $pages = Page::select(['id', 'title', 'slug','is_active'])->orderBy('id', 'desc');
            return $datatables->of($pages)
            ->addColumn('slug', function ($pages) {
                return '<a href="' . config('app.url') . $pages->slug . '" target="_blank">' . $pages->slug . '</a>';
            })
            ->addColumn('status', function ($pages) {
                if ($pages->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('action', function ($pages) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';
                if($this->permission->u) {
                    $btns .= '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1"><a href="javascript:;" class="btn btn-primary btn-sm">Edit</a></div>';
                }
                if (!in_array($pages->slug, ['home', 'contact-us'])) {
                    if($this->permission->d) {
                        $btns .= '<button title="Delete" type="button" class="btn btn-danger btn-sm" onclick="">Delete</button>';
                    }
                }
                $btns .= '</div>';
                return $btns;
            })
            ->rawColumns(['title','slug','status','action'])
            ->make();
        }

        // $sites = Site::select('name', 'id')->where('is_active', '1')->get();
        // $dt = $datatables->getHtmlBuilder()->columns(['title','slug','action']);
        $permission = $this->permission;
        return view('page.list', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('page.add');

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
            'title' => 'required|max:255',
            'slug' =>  'required|unique:pages,slug|alpha_dash|max:255',
            'description' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'banners.*' => 'nullable|mimes:jpeg,jpg,png',
            'pdfs.*' => 'nullable|mimes:pdf',
            'content' => 'required',
        ], [
            'banners.*.mimes' => 'Acceptable Image format is jpg,png,jpeg',
            'pdfs.*.mimes' => 'Attach PDF files format is pdf',
        ]);

        if(in_array($request->slug, ['contact-us'])) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Slug Name not accepted'][0]]], 422);

        }

        // $request->file('file')->getSize();

        // dd($request->file('banners')->getSize(),$request->file('pdf')->getSize());
        $bannerTotal = 0;
        if($request->banners){
            if($request->banners[0]){
                $bannerSize = array_map(function($v){
                    return $v->getSize();
                },$request->banners);
                $bannerTotal = (array_sum($bannerSize)/1024)/1024;
            }
        }
        if($bannerTotal < 10){
            if($request->pdfs){
                if($request->pds[0]){
                    $pdfsSize = array_map(function($v){
                        return $v->getSize();
                    },$request->pdfs);
                    $pdfsTotal = (array_sum($pdfsSize)/1024)/1024;
                    if(($bannerTotal+$pdfsTotal) > 10){
                        return response()->json(['message' => '', 'errors' => ['validation_error' => ['Maximum file upload size 10MB'][0]]], 422);
                    }
                }
            }
        }

        /**
         * Youtube Video Link Format Check
         */
        if($request->videos){
            foreach ($request->videos as $key => $vid) {
                $pattern = '/^http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/embed\/|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/';
                if(!preg_match($pattern, $vid)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Videos Link should look like example at row '.($key+1)][0]]], 422);
                    break;
                }
            }
        }
        // dd($request->all());
        $page = new Page;

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->description = $request->description;
        if($request->videos){
            $page->videos = json_encode($request->videos);
        }
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->content = $request->content;
        
        if ($request->hasFile('banners')) {
            $all_banners = [];
            foreach ($request->banners as $key => $photo) {
                $banner = $photo->store('page-banner', 'public');
                $all_banners[] = $banner;
            }
            
            $page->banner = json_encode($all_banners);
        }
        
        if($request->hasFile('pdfs')){

            $all_pdf = [];
            foreach ($request->pdfs as $key => $pdf) {
                $pdfs = $pdf->store('page-attachments', 'public');
                $all_pdf[] = $pdfs;
            }
            $page->pdfs = json_encode($all_pdf);
        }
        
        $page->created_at = date('Y-m-d H:i:s');

        if ($page->save()) {
            return response()->json(['type' => 'success', 'text' => 'Page added Successfully'], 200);
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
    public function edit(Page $page)
    {
        //
        return view('page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
        if($this->permission->u) {
            return $this->permissionCheckMessage('u');
        }
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:pages,slug,' . $page->id,
            // 'banner' => 'nullable|mimes:jpeg,jpg,png,gif',
            'content' => 'required',
        ]);

        if(in_array($request->slug, ['contact-us'])) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Slug Name not accepted'][0]]], 422);

        }

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->updated_at = date('Y-m-d H:i:s');

        // if ($request->hasFile('banner')) {
        //     $banner = $request->banner->store('page-banner', 'public');
        //     $page->banner = $banner;
        // }

        $page->content = $request->content;

        if($page->save()) {
            return response()->json(['type' => 'success', 'text' => 'Page updated Successfully'], 200);
        }
        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
        if($this->permission->d) {
            return $this->permissionCheckMessage('d');
        }
        if ($page->delete()) {
            return response()->json(['type'=>'success','text'=>'Page Deleted Successfully'], 200);
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
