<?php

namespace App\Http\Controllers;

use App\Lib\Validate;
use App\Models\NewsEvents;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;


class NewsEventsController extends Controller
{
    private $permission = [];
    public function __construct() {

        // Route filter
        $this->middleware(function ($request, $next){
            $usertype = session('usertype');
            $this->permission = Validate::hasModuleAccess('news-events', ['C', 'r', 'u', 'd']);
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
        if ($datatables->getRequest()->ajax()) {

            if(!$this->permission->r) {
                return [];
            }

            // $pages = Page::select(['id', 'title', 'slug'])->whereNotIn('slug', ['home'])->orderBy('id', 'desc');
            $news = NewsEvents::select(['id', 'title', 'short_description','photos', 'type', 'is_active'])->orderBy('id', 'desc');
            return $datatables->of($news)
            ->addColumn('status', function($item) {
                if($item->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-warning">Inactive</span>';
                }
            })
            ->addColumn('image', function ($news) {
                $images = json_decode($news->photos);
                if($images && $images[0]) {
                    return '<a href="'.asset('storage/'.$images[0]).'" target="_blank"><img src="'.asset('storage/'.$images[0]).'" width="200" /></a>';
                } else {
                    return '<i class="mdi mdi-image-remove"></i>';
                }
            })
            ->addColumn('action', function ($news) {
                $btns = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">';

                if($this->permission->u) {
                    if($news->is_active == '1') {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm white" title="Inactive Status" onclick="changeStatus(\''.$news->id.'\', this)">Inactive</a>';
                    } else {
                        $btns .= '<a href="javascript:void(0)" class="btn btn-success btn-sm white" title="Active Status" onclick="changeStatus(\''.$news->id.'\', this)">Active</a>';
                        
                    }
                    $btns .= '<button title="Edit" onclick="edit(\''.$news->id.'\', this)" type="button" class="btn btn-primary btn-sm" onclick="">Edit</button>';
                }
                if($this->permission->d) {
                    $btns .= '<button title="Delete" onclick="del(\''.$news->id.'\', this)" type="button" class="btn btn-danger btn-sm" onclick="">Delete</button>';
                }

                $btns .= '</div>';
                return $btns;
            })
            ->rawColumns(['title','short_description', 'type', 'status', 'image', 'action'])
            ->make();
        }
        return view('news-events.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('news-events.add');

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
        if(!$this->permission->c) {
            return $this->permissionCheckMessage('c');
        }

        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:news-events,slug,NULL,id,deleted_at,NULL',
            'body' => 'required',
            'banners.*' => 'nullable|mimes:jpeg,jpg,png|max:10024',
            'type' => 'required',
        ], [
            'banners.*.mimes' => __("Acceptable Image format is jpg,png,jpeg"),
            'banners.*.max' => __("Your Banner(s) is to large must be less than 10 MB"),
        ]);

        /**
         * Youtube Video Link Format Check
         */
        if($request->videos){
            foreach ($request->videos as $key => $vid) {
                if($vid) {
                    $pattern = '/^http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/embed\/|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/';
                    if(!preg_match($pattern, $vid)) {
                        return response()->json(['message' => '', 'errors' => ['validation_error' => [__("'Videos Link should look like example at row '").($key+1)][0]]], 422);
                        break;
                    }
                }
            }
        }

        $newsevents = new NewsEvents;
        $newsevents->title = $request->title;
        $newsevents->slug = $request->slug;
        $newsevents->short_description = $request->short_description;
        $newsevents->body = $request->body;
        if ($request->hasFile('banners')) {
            $all_banners = [];
            foreach ($request->banners as $key => $photo) {
                $banner = $photo->store('news-events', 'public');
                $all_banners[] = $banner;
            }
            
            $newsevents->photos = json_encode($all_banners);
        }
        if($request->videos){
            $newsevents->videos = json_encode($request->videos);
        }

        $newsevents->type = $request->type;
        $newsevents->created_at = date('Y-m-d H:i:s');
        if ($newsevents->save()) {
            return response()->json(['type' => 'success', 'text' => __("News/Events added Successfully")], 200);
        }
        return response()->json(['success' => false], 500);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewsEvents $newsevent)
    {
        // dd($newsevent);
        // $newsEvent = NewsEvents::where('type', 'Event')->orderBy('id', 'desc')->get();
        //     if(!$newsEvent) {
        //     }
        //     $page = (object) [
        //         'meta_title' => '',
        //         'meta_description' => '',
        //         'meta_keywords' => '',
        //     ];            
        //     return view('single-news-events', compact('page', 'newsEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsEvents $newsevent)
    {
        //
        if(!$this->permission->u) {
            return abort(403);
        }
        if(!$newsevent) {
            return abort(404);
        }
        return view('news-events.edit', compact('newsevent'));
        // dd($newsevent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsEvents $newsevent)
    {
        //

        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:news-events,slug,'.$newsevent->id.',id,deleted_at,NULL',
            'body' => 'required',
            'banners.*' => 'nullable|mimes:jpeg,jpg,png|max:10024',
            'type' => 'required',
        ], [
            'banners.*.mimes' => __("Acceptable Image format is jpg,png,jpeg"),
            'banners.*.max' => __("Your Banner(s) is to large must be less than 10 MB"),
        ]);

        /**
         * Youtube Video Link Format Check
         */
        if($request->videos){
            foreach ($request->videos as $key => $vid) {
                if($vid) {
                    $pattern = '/^http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/embed\/|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/';
                    if(!preg_match($pattern, $vid)) {
                        return response()->json(['message' => '', 'errors' => ['validation_error' => [__("'Videos Link should look like example at row '").($key+1)][0]]], 422);
                        break;
                    }
                }
            }
        }

        $newsevent->title = $request->title;
        $newsevent->slug = $request->slug;
        $newsevent->short_description = $request->short_description;
        $newsevent->body = $request->body;
        if ($request->hasFile('banners')) {
            $all_banners = [];
            foreach ($request->banners as $key => $photo) {
                if($photo) {
                    $banner = $photo->store('news-events', 'public');
                    $all_banners[] = $banner;
                }
            }
            
            $newsevent->photos = json_encode($all_banners);
        }
        if($request->videos){
            $newsevent->videos = json_encode($request->videos);
        }

        $newsevent->type = $request->type;
        $newsevent->updated_at = date('Y-m-d H:i:s');
        if ($newsevent->save()) {
            return response()->json(['type' => 'success', 'text' => __("News/Events updaated Successfully")], 200);
        }
        return response()->json(['success' => false], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, NewsEvents $newsevent)
    {
        //
        if(!$this->permission->d) {
            return $this->permissionCheckMessage('d');
        }
        if($newsevent->delete()) {
            return response()->json(['type' => 'success', 'text' => __("News/Events Deleted Successfully")], 200);
            
        }
        return response()->json(['type' => 'success', 'errors' => ['validation_error' => [__("Oops! there are some problem")]]], 422);

    }

    public function change_status(Request $request)
    {

        if(!$this->permission->u) {
            return $this->permissionCheckMessage('u');
        }

        if($request->id){
            $status = NewsEvents::select('is_active')->where('id',$request->id)->first();
            NewsEvents::where('id',$request->id)->update([
                'is_active' => !$status->is_active,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['type'=>'success','text'=>'Status changed Successfully'], 200);
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
