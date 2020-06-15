<?php

namespace App\Http\Controllers;

use Mail;
use Validator;
use App\Models\Page;
use App\Models\ContactUs;
use App\Models\LogsEmail;
use App\Models\NewsEvents;
use Illuminate\Http\Request;
use App\Models\NewsSubscribed;

class PageController extends Controller
{
    //

    function contact_us(Request $request) {
        if($request->isMethod('post')){
            $captcha = session()->get('captcha_text');
            if($request->captcha != $captcha) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
            }
            $validator = Validator::make($request->all(), [
                "name" => "required|max:255",
                "email" => "required|email|max:255",
                "mobile" => "required|numeric",
                "message" => "required"
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
            }

            $contact = new ContactUs();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->mobile = $request->mobile;
            $contact->message = $request->message;
            $contact->created_at = date('Y-m-d H:i:s');
            if($contact->save()){
                $data = [
                    'name'      => $contact->name,
                    'email'     => $contact->email,
                    'mobile'    => $contact->mobile,
                    'message'   => $contact->message,
                ];
                \Email::send('mobotics.aniruddha@gmail.com', 'noreply@eeaa.com', 'Email Enquiry', 'emails.contact', $data);
                return response()->json(['type' => 'success', 'text' => 'Submitted successfully! We will get back to you soon'], 200);
            } else {
                return response()->json(['type' => 'error', 'text' => 'Oops! something went wrong! Try again'], 200);
            }

        }
        return view('website.contact-us');
    }

    function page(Request $request, $slug) {
        /**
         * Check the slug exists inside the database or not
         */
        // dd($slug);
        $page = Page::where('slug', $slug)->first();
        if($slug == 'news-events') {
            $newsEvent = NewsEvents::where('type', 'Event')->orderBy('id', 'desc')->get();
            if(!$page) {
                $page = (object) [
                    'meta_title' => '',
                    'meta_description' => '',
                    'meta_keywords' => '',
                ];
            }            
            return view('news-events', compact('page', 'newsEvent'));
        }
        if($page) {
            return view('page-template', compact('page'));
        } else {
            abort(404);
        }
    }

    function singleNews(Request $request) {
        $newsEvent = NewsEvents::where('type', 'Event')->where('id', $request->id)->orderBy('id', 'desc')->first();
        if(!$newsEvent) {
            return abort(404);
        }
        $page = (object) [
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
        ];            
        return view('single-news-event', compact('page', 'newsEvent'));
    }

    /**
     * News Letter Subscription
     */
    function news_subscribed(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
        ]);
        if($validator->fails()) {
            return response()->json(['type' => 'error', 'errors' => ['validation_error' => $validator->errors()->all()[0]]], 422);
        }

        $newsSubscribed = NewsSubscribed::where('email', $request->email)->first();
        if($newsSubscribed) {
            return response()->json(['type' => 'error', 'errors' => ['validation_error' => ['Oops! you are already subscribed with this email!']]], 422);
        }

        $newsSubscribed = new NewsSubscribed;
        $newsSubscribed->name = $request->name;
        $newsSubscribed->phone = $request->phone;
        $newsSubscribed->email = $request->email;
        $newsSubscribed->created_at = date('Y-m-d H:i:s');
        $newsSubscribed->updated_at = date('Y-m-d H:i:s');

        if($newsSubscribed->save()) {
            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'mobile'    => $request->phone,
                'messageinfo'   => "Hi Thanks for subscription! Get Our Latest News Delivered Right to You Very soon",
            ];
            \Email::send($request->email, 'noreply@eeaa.com', 'News Letter Subscription', 'emails.contact', $data);
            
            // Email Logs
            $logsemail = new LogsEmail;
            $logsemail->from  = 'noreply@eeaa.com';
            $logsemail->to  = $request->email;
            $logsemail->subject  = 'News Letter Subscription';
            $logsemail->body  = json_encode($data);
            $logsemail->created_at  = date('Y-m-d H:i:s');
            $logsemail->response  = 1;
            $logsemail->save();
            
            return response()->json(['type' => 'success', 'text' => 'Subscribed successfully! We will get back to you soon'], 200);
        }
    }

}
