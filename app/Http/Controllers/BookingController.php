<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Slot;
use App\Models\Booking;
use App\Models\BookingMeta;
use App\Models\Activity;
use App\Models\Application;
use App\Models\ProtectedArea;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\Datatables\DataTables;
use Crypt;
use Validator;
use DB;
use App;
use DateTime;

class BookingController extends Controller
{
    //
    public function index(Request $request) {
        // dd($request->all());
        /**
         * sites against selected protected areas
         */
        $user_id = auth()->user()->id;
        $application = Application::where('user_id', $user_id)->where('status', 'fapprove')->where('ceo_status', 'lapprove')->get()->toArray();
        $json = array_map(function($v){
            if($v['regtype'] != 'section1'){
                $data = json_decode($v['data'], true);
                if(array_key_exists('center_data', $data)){
                    $name = explode('section',$v['regtype'])[1];
                    if(array_key_exists('unit_area_of_activity_3_t'.$name, $data['center_data'])){
                        return explode(',', $data['center_data']['unit_area_of_activity_3_t'.$name]);
                    }
                }
            }
        }, $application);
        $ids = [];
        array_walk_recursive($json, function($v,$k) use(&$ids){
            if($v){
                array_push($ids, $v);
            }
        });
        $protectedAreas = ProtectedArea::whereIn('id', $ids)->active()->pluck('sites')->toArray();
        $pAids = implode(',',$protectedAreas);
        $sites = Site::active()->whereIn('id', array_values(array_unique(explode(',',$pAids))))->get();
        return view('booking.site-select', compact('sites'));
    }

    public function seatlist(Request $request, $id, $visit_type) {
        return view('booking.date-select', compact('id', 'visit_type'));
    }
    public function json_seatlist(Request $request)
    {
        $siteid = Crypt::decrypt($request->siteid);
        // Get Site First
        $sites = Site::where('id', $siteid)->first();
        // Get the slots of the sites
        if($sites) {
            $startdate = date('Y-m-d', strtotime($request->start));
            $enddate = date('Y-m-d', strtotime($request->end));

            $begin = new \DateTime( $startdate );
            $end   = new \DateTime( $enddate );
            $crowdList = [];
            $keyIndex = 1;
            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                $slots = Slot::where('site_id', $siteid)->get();
                foreach ($slots as $key => $value) {
                    if(strtotime($i->format('Y-m-d')) >= strtotime(date('Y-m-d'))) {
                        if(strtotime($i->format('Y-m-d')) == strtotime(date('Y-m-d')) && strtotime(date('H:i', strtotime($value->time_to))) <= strtotime(date('H:i'))){
                            $active = false;
                            $className = "link-none";
                            $url = "";
                        } else {
                            $active = true;
                            $className = "";
                            $url = route('slot.book', [encrypt($value->site_id), encrypt($value->id), encrypt($i->format('Y-m-d')), $request->visit_type]);
                        }
                    } else { // Greater Date
                        $active = false;
                        $className = "link-none";
                        $url = "";
                    }
                    $date = $i->format('Y-m-d');

                    $booked_slot_count_for_day = Booking::where('site_id', $siteid)->where('slot_id', $value->id)->where('date', $date)->withCount('booking_metas')->get();
                    $bookingArray = $booked_slot_count_for_day->toArray();
                    $booked_slot_count_for_day = array_map(function($v) {
                        return $v['booking_metas_count'];
                    }, $bookingArray);
                    $booked_slot_count_for_day = array_sum($booked_slot_count_for_day);

                    // $booked_slot_count_for_day = rand(10, 99);
                    $greenLimit = $value->green_to;
                    $yellowLimit = $value->yellow_to;
                    $redLimit = $value->red_to;

                    if($booked_slot_count_for_day >= 0 && $booked_slot_count_for_day <= $greenLimit) {
                        // $color = ($active == true) ? '#5cb85c' : '#5cb85c80';
                        $color = ($active == true) ? '#5cb85c' : '#a5a5a580';
                    } else if($booked_slot_count_for_day > $greenLimit && $booked_slot_count_for_day <= $yellowLimit) {
                        // $color = ($active == true) ? '#f0ad4e' : '#f6ce95';
                        $color = ($active == true) ? '#f0ad4e' : '#a5a5a580';
                    } else if($booked_slot_count_for_day > $yellowLimit) {
                        // $color = ($active == true) ? '#d9534f' : '#eca9a7';
                        $color = ($active == true) ? '#d9534f' : '#a5a5a580';
                    }

                    $arr = [
                        'groupId' => $keyIndex,
                        'title' => $value->slot_name,
                        'start' => $i->format('Y-m-d'),
                        'end' => $i->format('Y-m-d'),
                        'active' => $active,
                        'color' => $color,
                        'textColor' => '#fff',
                        'className' => $className,
                        'meta_info' => $value,
                        'redirect' => $url

                    ];
                    $crowdList[] = $arr;
                }
            }
            return $crowdList;
            // dd($startdate, $enddate);
        }
        // $startdate =
        // return '[{"groupId":1,"title":"Lorem Ipsum","link":"dshdshd,sdjsjdsdj","url": "https://www.google.com","start":"2019-12-31T09:00:00","end":"2019-12-31T09:00:00","color": "red", "textColor": "#fff"},{"groupId":2,"title":"Lorem Ipsum 1","start":"2020-01-26T09:00:00","end":"2020-01-27T09:00:00"},{"groupId":3,"title":"Lorem Ipsum is a dummy text","start":"2020-01-30T09:00:00","end":"2020-01-30T09:00:00"},{"groupId":4,"title":"Test","start":"2020-01-25T09:00:00","end":"2020-01-25T09:00:00"}]';
    }

    public function slot_book(Request $request, $siteid, $slotid, $date, $visit_type) {
        // dd($siteid, $slotid, $date, $visit_type);
        $siteid = decrypt($siteid);
        $slotid = decrypt($slotid);
        $date = decrypt($date);
        $visit_type = decrypt($visit_type);


        if(App::getLocale() == 'en'){
            $parse_file = file_get_contents(url('/assets/picklist-eng.json'));
        } else {
            $parse_file = file_get_contents(url('/assets/picklist-arb.json'));
        }
        $json_arr = json_decode($parse_file, true);
        if($json_arr == false) {
            $json_arr = [];
        }
        $nationality = array_key_exists('nationality', $json_arr) ? $json_arr['nationality'] : [];

        // Vessel List
        $vessel = Vessel::active()->get();
        $sites = Site::where('id', $siteid)->first();
        $slots = Slot::where('id', $slotid)->first();
        $activitiesArr = explode(',', $sites->activitis);

        $protectedAreasId = ProtectedArea::whereIn('sites', explode(',', $sites->id))->pluck('id');
        // $protectedAreasId[] = 4;
        // dd($protectedAreasId);

        $application = Application::where([
            'regtype' => 'section1',
            'status' => 'fapprove',
            'ceo_status' => 'lapprove',
            // 'user_id' => auth()->user()->id
        ])->select('id', 'application_no', 'data')->get();

        $unitList = [];
        foreach ($application as $key => $value) {
            $dataInfo = json_decode($value->data, true);
            if(array_key_exists('vessel', $dataInfo)) {
                foreach ($protectedAreasId as $k => $v) {
                    if(in_array($v, explode(',', $dataInfo['vessel']['unit_area_of_activity_4_t1']))) {
                        $unitList[] = $dataInfo['vessel']['maritime_unit_4_t1']."(".$dataInfo['vessel']['maritime_unit_arabic_4_t1'].")";
                    }
                }
            }
        }
        if(sizeof($unitList) > 0) {
            $unitList = array_unique($unitList);
        }

        $arrValues[] = $sites->toArray();
        $sitesArr = [];
        array_map(function ($arr) use (&$sitesArr){
            $sitesArr =[
                'adult_ticket_price_usd' => $arr['adult_ticket_price_usd'],
                'adult_ticket_price_egp' => $arr['adult_ticket_price_egp'],
                'child_tikcet_price_usd' => $arr['child_tikcet_price_usd'],
                'child_tikcet_price_egp' => $arr['child_tikcet_price_egp']
            ];
        }, $arrValues);

        // Activitis
        $activities = Activity::whereIn('id', $activitiesArr)->get();
        return view('booking.slot-book', compact('vessel', 'sites', 'sitesArr', 'slots', 'activities', 'date', 'siteid', 'slotid', 'nationality', 'visit_type', 'unitList'));

    }

    public function book_ticket(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'vessel_type' => 'required',
            'activity' => 'required',
            'unit_list' => 'required',
            'guide_name' => 'required',
            'guide_number' => 'required|numeric',
            'person_name' => 'required',
            'person_number' => 'required|numeric',
        ], [
            'vessel_type.required' => 'Please select Vessel Type',
            'activity.required' => 'Please select Activity',
            'guide_name.required' => 'Guide Name Required',
            'guide_number.required' => 'Guide Phone Number Required',
            'guide_number.digits' => 'Guide Phone Number should be Numeric',

            'person_name.required' => 'Name Required',
            'person_number.required' => 'Phone Number Required',
            'unit_list.required' => 'Please select Unit',
            'person_number.digits' => 'Phone Number should be Numeric',
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }
        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }

        foreach ($request->nationality as $key => $value) {
            if(empty($request->name[$key])) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Name required at row '.($key+1)]]], 422);
            }

            if(empty($request->passport[$key])) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Passsport required at row '.($key+1)]]], 422);
            }

            if(empty($request->nationality[$key])) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Nationality required at row '.($key+1)]]], 422);
            }

            if(empty($request->adult[$key])) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Age Value required at row '.($key+1)]]], 422);
            }

            if(empty($request->gender[$key])) {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Gender Value required at row '.($key+1)]]], 422);
            }

        }
        // if(!is_numeric($request->totalFees)) {
        //     return response()->json(['message' => '', 'errors' => ['validation_error' => ['Total Fees should be greater than 0 ']]], 422);
        // }


        $sites = Site::where('id', $request->siteid)->first();
        $slots = Slot::where('id', $request->slotid)->first();
        $date = $request->date;
        $booked_slot_count_for_day = Booking::where('site_id', $request->siteid)->where('slot_id', $request->slotid)->where('date', $date)->withCount('booking_metas')->get();

        $bookingArray = $booked_slot_count_for_day->toArray();
        $booked_slot_count_for_day = array_map(function($v) {
            return $v['booking_metas_count'];
        }, $bookingArray);
        $booked_slot_count_for_day = array_sum($booked_slot_count_for_day);

        // Check Booking Slot Capacity
        if(intval($booked_slot_count_for_day) > intval($slots->booking_slot_capacity)) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Booked Solt Capacity full for this Site of this slot']]], 422);
        }
        // Check Site Daily Capacity
        if(intval($booked_slot_count_for_day) > intval($sites->daily_capacity)) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Site daily Capacity fulled.']]], 422);
        }
        // Check Annual Capacity
        $annual_capacity = Booking::where('site_id', $request->siteid)->where('slot_id', $request->slotid)->whereYear('date', '=', date('Y', strtotime($date)))->withCount('booking_metas')->get();
        $bookingArray = $annual_capacity->toArray();
        $booked_slot_count_for_year = array_map(function($v) {
            return $v['booking_metas_count'];
        }, $bookingArray);
        $booked_slot_count_for_year = array_sum($booked_slot_count_for_year);
        if(intval($booked_slot_count_for_year) > intval($sites->annual_capacity)) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Site annual Capacity fulled.']]], 422);
        }

        $no_of_booking = 0;
        // foreach ($booking as $key => $value) {
        //     # code...
        // }


        $booking = new Booking();
        $booking->site_id = $request->siteid;
        $booking->slot_id = $request->slotid;
        $booking->user_id = auth()->user()->id;
        $booking->date = $request->date;
        $booking->unit_name = $request->unit_list;
        $booking->vessel_id = $request->vessel_type;
        $booking->activity_id = $request->activity;
        $booking->person_name = $request->person_name;
        $booking->person_number = $request->person_number;
        $booking->guide_name = $request->guide_name;
        $booking->guide_number = $request->guide_number;
        $booking->visit_type = $request->visit_type;
        $booking->totalFees_egp = $request->totalFees_egp;
        $booking->totalFees_usd = $request->totalFees_usd;
        
        $booking->inv_usd = $request->inv_usd;
        $booking->vessel_ticket_price_usd = $request->vessel_ticket_price_usd;
        $booking->vessel_ticket_price_egp = $request->vessel_ticket_price_egp;

        $booking->adult_ticket_price_usd = $request->adult_ticket_price_usd;
        $booking->adult_ticket_price_egp = $request->adult_ticket_price_egp;
        $booking->child_ticket_price_usd = $request->child_ticket_price_usd;
        $booking->child_ticket_price_egp = $request->child_ticket_price_egp;
        
        $booking->created_at = date('Y-m-d H:i:s');
        $booking->save();
        // dd($booking);
        $booking_id_no = $booking->id;

        $label = env('BOOKED_NO_LABEL');
        $ticket_label = $label.str_pad($booking_id_no,10,0,STR_PAD_LEFT);
        $booking->booking_no = $ticket_label;
        $booking->save();



        $booking_meta = [];
        foreach ($request->name as $key => $value) {
            $arr = [
                'name' => $value,
                'lname' => $request->lname[$key],
                'passport' => $request->passport[$key],
                'nationality' => $request->nationality[$key],
                'age' => $request->adult[$key],
                'gender' => $request->gender[$key],
                'booking_id' => $booking->id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $booking_meta[] = $arr;
        }
        if(sizeof($booking_meta)) {
            BookingMeta::insert($booking_meta);
        }

        $redirect_url = route('booking.view_ticket', encrypt($booking_id_no));
        return response()->json(['type' => 'success', 'text' => 'Ticket Booked Successfully', 'redirect_url' => $redirect_url], 200);

    }

    public function view_ticket(Request $request, $booked_id)
    {
        $booked_id = decrypt($booked_id);
        // $booking = Booking::where('id', $booked_id)->first();
        $booking = Booking::where('id', $booked_id)->with('booking_metas')->withCount('booking_metas')->first();
        if($booking) {
            $booking_no = $booking->booking_no;
            // Site Info
            $site = Site::where('id', $booking->site_id)->first();
            // dd($sites);
            // Slot Info
            $slot = Slot::withTrashed()->where('id', $booking->slot_id)->first();

            // Vessel Info
            $vessel = Vessel::where('id', $booking->vessel_id)->first();
            // Activity Info
            $activity = Activity::where('id', $booking->activity_id)->first();
            // dd($booking);
            $metaArray = $booking->booking_metas->toArray();
            $fNationality = array_unique(array_column($metaArray,'nationality'));
            $ticketCountryWise = [];

            $groupNationality = '';
            foreach ($fNationality as $key => $value) {
                $adult = $child = 0;
                $groupNationality .= '<p> <strong>'.$value;
                foreach ($metaArray as $k => $v) {
                    if($value == $v['nationality']) {
                        if($v['age'] == 'a') {
                            $adult++;
                        }
                        if($v['age'] == 'c') {
                            $child++;
                        }
                    }
                }
                $ticketCountryWise[] = [
                    'Country' => $value,
                    'Adult' => $adult,
                    'Child' => $child,
                ];
                $groupNationality .= '</strong> (Adult = '.$adult.', Children = '.$child.') </p>';
            }
            return view('booking.book-success', compact('booking', 'site', 'slot', 'vessel', 'activity', 'ticketCountryWise'));
        } else {
            abort(404);
        }
    }

    public function view_ticket_summary(Request $request, $booked_id)
    {
        $booked_id = decrypt($booked_id);
        // $booking = Booking::where('id', $booked_id)->first();
        $booking = Booking::where('id', $booked_id)->with('booking_metas')->withCount('booking_metas')->first();
        if($booking) {
            $booking_no = $booking->booking_no;
            // Site Info
            $site = Site::where('id', $booking->site_id)->first();
            // dd($sites);
            // Slot Info
            $slot = Slot::withTrashed()->where('id', $booking->slot_id)->first();

            // Vessel Info
            $vessel = Vessel::where('id', $booking->vessel_id)->first();
            // Activity Info
            $activity = Activity::where('id', $booking->activity_id)->first();
            // dd($booking);
            $metaArray = $booking->booking_metas->toArray();
            $fNationality = array_unique(array_column($metaArray,'nationality'));
            $ticketCountryWise = [];

            $groupNationality = '';
            foreach ($fNationality as $key => $value) {
                $adult = $child = 0;
                $groupNationality .= '<p> <strong>'.$value;
                foreach ($metaArray as $k => $v) {
                    if($value == $v['nationality']) {
                        if($v['age'] == 'a') {
                            $adult++;
                        }
                        if($v['age'] == 'c') {
                            $child++;
                        }
                    }
                }
                $ticketCountryWise[] = [
                    'Country' => $value,
                    'Adult' => $adult,
                    'Child' => $child,
                ];
                $groupNationality .= '</strong> (Adult = '.$adult.', Children = '.$child.') </p>';
            }
            
            return view('booking.book-summary', compact('booking', 'site', 'slot', 'vessel', 'activity', 'ticketCountryWise'));
        } else {
            abort(404);
        }
    }

    public function all_tickets(DataTables $datatables)
    {
        if($datatables->getRequest()->ajax()) {
            $booking = Booking::select(['id','booking_no','date', 'person_name', 'person_number','guide_name','guide_number','visit_type', 'totalFees_usd','totalFees_egp'])->where('user_id', auth()->user()->id)->orderBy('id', 'desc');
            return $datatables->of($booking)
            ->addColumn('totalFees', function ($booking) {

                if ($booking->totalFees_usd == null) {
                    $totalFees_usd = '0.00';
                } else {
                    $totalFees_usd = $booking->totalFees_usd;
                }

                if ($booking->totalFees_egp == null) {
                    $totalFees_egp = '0.00';
                } else {
                    $totalFees_egp = $booking->totalFees_egp;
                }

                return '<ul><li>USD = '.$totalFees_usd.'</li><li>EGP = '.$totalFees_egp.'</li></ul>';
            })
            ->addColumn('action', function ($booking) {
                $action = '<div class="btn-group">';
                $action .= '<a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Info" onclick="window.location.href=\''.route('booking.view_ticket_summary', encrypt($booking->id)).'\'">Info</a>';
                return $action;
            })
            ->rawColumns(['id', 'name', 'daily_capacity', 'annual_capacity', 'geo_location_type','geo_location_fees','reg_fees','ticket_price','totalFees', 'is_active', 'action'])
            ->make();
        }
        return view('booking.list');
    }

    public function ticket_by_id(Request $request)
    {
        $booking = Booking::where('id', $request->id)->with('booking_metas')->first();
        if($booking) {
            return $booking;
        }
    }
}
