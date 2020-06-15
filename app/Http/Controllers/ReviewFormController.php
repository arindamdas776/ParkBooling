<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Auth;
use App\Models\Application;
use App\Models\Organization;
use App\Models\Group;
use App\Models\ProtectedArea;
use Illuminate\Http\Request;
use Config;

class ReviewFormController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    function review(Request $request, $formno) {
        $usertype = session('usertype');
        if($usertype == 'admin' || $usertype == 'employee') {
            $application = Application::where('application_no', $formno)->first();
            return $this->appByNo($application);
        } elseif($usertype == 'owner') {
            $application = Application::where('application_no', $formno)->where('user_id', auth()->user()->id)->first();
            return $this->appByNo($application);
        } else {
            abort(403);
        }
    }

    /**
     * App by No
     */
    public function appByNo($application) {
        if($application) {
            $regtype = $application->regtype;
            switch ($regtype) {
                case 'section1':
                    return $this->load_form_1($application);
                    break;
                case 'section2':
                    return $this->load_form_2($application);
                    break;
                case 'section3':
                    return $this->load_form_3($application);
                    break;
                case 'section4':
                    return $this->load_form_4($application);
                    break;
                case 'section5':
                    return $this->load_form_5($application);
                    break;
                case 'section6':
                    return $this->load_form_6($application);
                    break;
                default:
                    abort(404);
                    break;
            }
            dd($application);
        } else {
            abort(404);
        }
    }

    public function load_form_1($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t1_1');
        // Tab2
        $tab2 = Config::get('siteVars.t1_2');
        // Tab3
        $tab3 = Config::get('siteVars.t1_3');
        // Tab4
        $tab4 = Config::get('siteVars.t1_4');
        // Tab5
        $tab5 = Config::get('siteVars.t1_5');
        // Tab6
        $tab6 = Config::get('siteVars.t1_6');
        // Tab7
        $tab7 = Config::get('siteVars.t1_7');
        // Tab8
        $tab8 = Config::get('siteVars.t1_8');
        // Tab9
        $tab9 = Config::get('siteVars.t1_9');
        // Tab10
        $tab10 = Config::get('siteVars.t1_10');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_vessel', $decoded)) {
                $owner_vessel = $decoded['owner_vessel'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_vessel)) {
                        $tab2[$key] =  $owner_vessel[$key];
                    }
                }
            }

            if(array_key_exists('marine_unit', $decoded)) {
                $marine_unit = $decoded['marine_unit'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $marine_unit)) {
                        $tab3[$key] =  $marine_unit[$key];
                    }
                }
            }

            if(array_key_exists('vessel', $decoded)) {
                $vessel = $decoded['vessel'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $vessel)) {
                        if($key == 'marine_activity_unit_4_t1'){
                            $tab4[$key] = Activity::whereIn('id', explode(',', $vessel[$key]))->pluck('name')->toArray();
                            $tab4[$key] = implode(', ', $tab4[$key]);
                        } elseif($key == 'unit_area_of_activity_4_t1') {
                            $tab4[$key] = ProtectedArea::whereIn('id', explode(',', $vessel[$key]))->pluck('name')->toArray();
                            $tab4[$key] = implode(', ', $tab4[$key]);
                        } else {
                            $tab4[$key] =  $vessel[$key];
                        }
                    }
                }
            }

            if(array_key_exists('water_used_im', $decoded)) {
                $water_used_im = $decoded['water_used_im'];
                foreach ($tab5 as $key => $value) {
                    if(array_key_exists($key, $water_used_im)) {
                        $tab5[$key] =  $water_used_im[$key];
                    }
                }
            }
            if(array_key_exists('sanitation', $decoded)) {
                $sanitation = $decoded['sanitation'];
                foreach ($tab6 as $key => $value) {
                    if(array_key_exists($key, $sanitation)) {
                        $tab6[$key] =  $sanitation[$key];
                    }
                }
            }
            if(array_key_exists('waste_liquid', $decoded)) {
                $waste_liquid = $decoded['waste_liquid'];
                foreach ($tab7 as $key => $value) {
                    if(array_key_exists($key, $waste_liquid)) {
                        $tab7[$key] =  $waste_liquid[$key];
                    }
                }
            }
            if(array_key_exists('vessel_engine', $decoded)) {
                $vessel_engine = $decoded['vessel_engine'];
                foreach ($tab8 as $key => $value) {
                    if(array_key_exists($key, $vessel_engine)) {
                        $tab8[$key] =  $vessel_engine[$key];
                    }
                }
            }
            if(array_key_exists('solid_waste', $decoded)) {
                $solid_waste = $decoded['solid_waste'];
                foreach ($tab9 as $key => $value) {
                    if(array_key_exists($key, $solid_waste)) {
                        $tab9[$key] =  $solid_waste[$key];
                    }
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab10 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab10[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab11 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_1', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'tab6', 'tab7', 'tab8', 'tab9', 'tab10', 'tab11', 'userInfo', 'group'));
    }

    public function load_form_2($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t2_1');
        // Tab2
        $tab2 = Config::get('siteVars.t2_2');
        // Tab3
        $tab3 = Config::get('siteVars.t2_3');
        // Tab4
        $tab4 = Config::get('siteVars.t2_4');
        // Tab5
        $tab5 = Config::get('siteVars.t2_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        if($key == 'marine_activity_authorized_3_t2'){
                            $tab3[$key] = Activity::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } elseif ($key == 'unit_area_of_activity_3_t2') {
                            $tab3[$key] = ProtectedArea::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } else {
                            $tab3[$key] =  $center_data[$key];
                        }
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_2', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group'));
    }

    public function load_form_3($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t3_1');
        // Tab2
        $tab2 = Config::get('siteVars.t3_2');
        // Tab3
        $tab3 = Config::get('siteVars.t3_3');
        // Tab4
        $tab4 = Config::get('siteVars.t3_4');
        // Tab5
        $tab5 = Config::get('siteVars.t3_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        if($key == 'marine_activity_authorized_3_t3'){
                            $tab3[$key] = Activity::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } elseif ($key == 'unit_area_of_activity_3_t3') {
                            $tab3[$key] = ProtectedArea::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } else {
                            $tab3[$key] =  $center_data[$key];
                        }
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_3', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group'));
    }

    public function load_form_4($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t4_1');
        // Tab2
        $tab2 = Config::get('siteVars.t4_2');
        // Tab3
        $tab3 = Config::get('siteVars.t4_3');
        // Tab4
        $tab4 = Config::get('siteVars.t4_4');
        // Tab5
        $tab5 = Config::get('siteVars.t4_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        if($key == 'marine_activity_authorized_3_t4'){
                            $tab3[$key] = Activity::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } elseif ($key == 'unit_area_of_activity_3_t4') {
                            $tab3[$key] = ProtectedArea::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } else {
                            $tab3[$key] =  $center_data[$key];
                        }
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_4', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group'));
    }

    public function load_form_5($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t5_1');
        // Tab2
        $tab2 = Config::get('siteVars.t5_2');
        // Tab3
        $tab3 = Config::get('siteVars.t5_3');
        // Tab4
        $tab4 = Config::get('siteVars.t5_4');
        // Tab5
        $tab5 = Config::get('siteVars.t5_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        if($key == 'marine_activity_authorized_3_t5'){
                            $tab3[$key] = Activity::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } elseif ($key == 'unit_area_of_activity_3_t5') {
                            $tab3[$key] = ProtectedArea::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } else {
                            $tab3[$key] =  $center_data[$key];
                        }
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_5', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group'));
    }

    public function load_form_6($application) {
        // Tab1
        $tab1 = Config::get('siteVars.t6_1');
        // Tab2
        $tab2 = Config::get('siteVars.t6_2');
        // Tab3
        $tab3 = Config::get('siteVars.t6_3');
        // Tab4
        $tab4 = Config::get('siteVars.t6_4');
        // Tab5
        $tab5 = Config::get('siteVars.t6_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            if(array_key_exists('applicants', $decoded)) {
                $applicants = $decoded['applicants'];
                foreach ($tab1 as $key => $value) {
                    if(array_key_exists($key, $applicants)) {
                        $tab1[$key] =  $applicants[$key];
                    }
                }
            }

            if(array_key_exists('owner_data', $decoded)) {
                $owner_data = $decoded['owner_data'];
                foreach ($tab2 as $key => $value) {
                    if(array_key_exists($key, $owner_data)) {
                        $tab2[$key] =  $owner_data[$key];
                    }
                }
            }

            if(array_key_exists('center_data', $decoded)) {
                $center_data = $decoded['center_data'];
                foreach ($tab3 as $key => $value) {
                    if(array_key_exists($key, $center_data)) {
                        if($key == 'marine_activity_authorized_3_t6'){
                            $tab3[$key] = Activity::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } elseif ($key == 'unit_area_of_activity_3_t6') {
                            $tab3[$key] = ProtectedArea::whereIn('id', explode(',', $center_data[$key]))->pluck('name')->toArray();
                            $tab3[$key] = implode(', ', $tab3[$key]);
                        } else {
                            $tab3[$key] =  $center_data[$key];
                        }
                    }
                }
            }

            if(array_key_exists('branch_payment', $decoded)) {
                $payment_fees = $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $payment_fees)) {
                        $tab4[$key] =  $payment_fees[$key];
                    }
                }
            }
            if(array_key_exists('upload_doc', $decoded)) {
                $upload_doc = $decoded['upload_doc'];
                $tab5 = $upload_doc;
            }
        }

        $userInfo = Organization::where('id', $application->user_id)->first();

        // Group Status
        $group = Group::where('id', auth()->user()->group_id)->first();
        return view('application.review.form_6', compact('application', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5', 'userInfo', 'group'));
    }
}
