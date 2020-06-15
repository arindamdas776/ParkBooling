<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LangController extends Controller
{
    //
    public function setlang(Request $request)
	{

        $lang_arr = ['en', 'ar'];
		if (in_array($request->lang, $lang_arr))
		{
            session(['lang' => $request->lang]);
			return ['status' => true];
		}
		return ['status' => false];;

	}

	public static function langFilter($arr) {
		$arr = json_decode($arr, true);
		$lang = session('lang');
		if($lang ==  null) {
			$lang = 'en';
		}
		return $arr[$lang];
	}
}
