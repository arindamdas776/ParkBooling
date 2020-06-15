<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\User;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $usertype = session('usertype');
        $PermissionMenuSlug = [];
        $ByPassUrl = [

            /**
             * Frontend
             */
            'sign-up',
            'sign-in',
            'page.contact_us',
            'lang.setlang',
            'page.contact_us',
            'page.news_subscribed',



            /**
             * Backend
             */
            'home',

            'organizations.status_logs',
            'organizations.change_status',
            'organizations.index',

            'registration.requests',
            'registration.requests.appbyno',
            'applicationlist.change_status',
            'applicationlist.appByNo',
            'applicationlist.index',

            'e-tickets.index',
            'booking.view_ticket_summary',

            // 'organizations/change_status',
            // 'organizations/status_logs/*',
            // 'organizations',

            // 'registration-requests/*',

        ];

        // if($usertype == 'employee') {
        //     if(auth()->guard($usertype)->user()) {
        //         $id = auth()->guard($usertype)->user()->id;
        //         $userInfo = User::where('id', $id)->with(['PermissionModule' => function($query) {
        //             $query->select('group_id','module_id');
        //         }, 'PermissionModule.ModuleName:id,slug'])->first();
        //         if($userInfo->PermissionModule) {
        //             foreach ($userInfo->PermissionModule as $row) {
        //                 if($row->ModuleName) {
        //                     $PermissionMenuSlug[] = $row->ModuleName->slug;
        //                 }
        //             }
        //             // dump(request()->is('registration-requests/*'));
        //             // dd($request, $request->getPathInfo());
        //             // dd(\Request::fullUrl(), $PermissionMenuSlug);
        //             // $currentUri = \Route::current()->uri();
                    
        //             $currentUri = ltrim($request->getPathInfo(), "/");
        //             $currentUri = rtrim($currentUri, "/");
        //             // dd($currentUri);
        //             // dd(\Route::current()->getName());
        //             if(!in_array($currentUri, $PermissionMenuSlug)) {
        //                 $nameRoute = \Route::current()->getName();
        //                 if($nameRoute!= null &&  !in_array($nameRoute, $ByPassUrl)) {
        //                     return abort(403);
        //                 }
        //             }
        //         }
        //     }
        // }
        
        // dd(auth()->guard($usertype)->user()->id);

        $session_lang = session('lang');
        $lang_arr =  ['en', 'ar'];
        if(in_array($session_lang, $lang_arr)) {
            App::setLocale($session_lang);
        } else {
            App::setLocale('en');
        }
        return $next($request);
    }
}
