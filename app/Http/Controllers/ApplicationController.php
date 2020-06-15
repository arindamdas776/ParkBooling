<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Models\Country;
use App\Models\Application;
use App\Models\Organization;
use App\Models\ProtectedArea;
use App\Models\Activity;
use Illuminate\Http\Request;
use Validator;
use Config;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Add Application From Dashboard
     */
    public function add_application(Request $request) {
        $validator = Validator::make($request->all(), [
            'regtype' => 'required'
        ], [
            'regtype.required' => 'Please select Registartion Type'
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

        $Application = new Application;
        $Application->user_id = Auth::user()->id;
        $Application->regtype = $request->regtype;
        $Application->regtype_text = $request->regtype_text;
        $Application->created_at = date('Y-m-d H:i:s');
        $Application->save();

        $application_id = Application::whereId($Application->id);
        $label = env('APP_FORM_NO_LABEL');
        $appno = $label.str_pad($Application->id,10,0,STR_PAD_LEFT);
        $Application->application_no = $appno;
        $Application->save();
        // dd($Application);
        return response()->json(['type' => 'success', 'text' => 'Application Created Successfully', 'appno' => $Application->application_no], 200);
    }

    /**
     * Load App By APP No
     */
    public function appByNo(Request $request) {
        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
            if($application) {
                $regtype = $application->regtype;
                if(App::getLocale() == 'en'){
                    $parse_file = file_get_contents(url('/assets/picklist-eng.json'));
                } else {
                    $parse_file = file_get_contents(url('/assets/picklist-arb.json'));
                }
                $json_arr = json_decode($parse_file, true);
                if($json_arr == false) {
                    $json_arr = [];
                }
                // dd($json_arr);

                $this->applicant_status = array_key_exists('applicant_status', $json_arr) ? $json_arr['applicant_status'] : [];
                $this->nationality = array_key_exists('nationality', $json_arr) ? $json_arr['nationality'] : [];
                $this->doctype = array_key_exists('doctype', $json_arr) ? $json_arr['doctype'] : [];
                $this->reqtype = array_key_exists('reqtype', $json_arr) ? $json_arr['reqtype'] : [];
                $this->regport = array_key_exists('reg_port', $json_arr) ? $json_arr['reg_port'] : [];
                $this->craft = array_key_exists('crafts', $json_arr) ? $json_arr['crafts'] : [];
                $this->const_type = array_key_exists('construction_types', $json_arr) ? $json_arr['construction_types'] : [];
                $this->classified_unit = array_key_exists('classified_unit', $json_arr) ? $json_arr['classified_unit'] : [];
                $this->marine_activity = Activity::select('id', 'name')->active()->get();
                $this->unit_area_of_activity = ProtectedArea::select('id', 'name')->active()->get();
                $this->drainage_solution = array_key_exists('drainage_solutions', $json_arr) ? $json_arr['drainage_solutions'] : [];
                $this->tank_oil_residuces = array_key_exists('tank_oil_residues', $json_arr) ? $json_arr['tank_oil_residues'] : [];
                $this->fuel_types = array_key_exists('fuel_types', $json_arr) ? $json_arr['fuel_types'] : [];
                $this->solid_waste_solution = array_key_exists('soild_waste_solutions', $json_arr) ? $json_arr['soild_waste_solutions'] : [];

                $this->rate_by_carat = array_key_exists('rate_by_carat', $json_arr) ? $json_arr['rate_by_carat'] : [];
                $this->carat_quota = array_key_exists('carat_quota', $json_arr) ? $json_arr['carat_quota'] : [];
                $this->length_of_unit = array_key_exists('length_of_unit', $json_arr) ? $json_arr['length_of_unit'] : [];
                $this->weight_of_vessel = array_key_exists('weight_of_vessel', $json_arr) ? $json_arr['weight_of_vessel'] : [];
                $this->tank_capacity = array_key_exists('tank_capacity', $json_arr) ? $json_arr['tank_capacity'] : [];
                $this->waste_tank_capacity = array_key_exists('waste_tank_capacity', $json_arr) ? $json_arr['waste_tank_capacity'] : [];
                $this->daily_consumption = array_key_exists('daily_consumption', $json_arr) ? $json_arr['daily_consumption'] : [];
                $this->number_of_tanks = array_key_exists('number_of_tanks', $json_arr) ? $json_arr['number_of_tanks'] : [];
                $this->exchange_rate = array_key_exists('exchange_rate', $json_arr) ? $json_arr['exchange_rate'] : [];
                $this->capacity = array_key_exists('capacity', $json_arr) ? $json_arr['capacity'] : [];
                $this->capacity_of_solid_waste_area = array_key_exists('capacity_of_solid_waste_area', $json_arr) ? $json_arr['capacity_of_solid_waste_area'] : [];
                $this->daily_waste = array_key_exists('daily_waste', $json_arr) ? $json_arr['daily_waste'] : [];
                $this->marine_activities = array_key_exists('marine_activities', $json_arr) ? $json_arr['marine_activities'] : [];
                $this->units_area_of_activities = array_key_exists('units_area_of_activities', $json_arr) ? $json_arr['units_area_of_activities'] : [];

                $this->countries = Country::orderBy('country_name', 'ASC')->get();

                // Upload Doc Name
                $this->upload_doc_name = array_key_exists('upload_doc', $json_arr) ? $json_arr['upload_doc']['name'] : [];
                // Upload Doc Type
                $this->upload_doc_type = array_key_exists('upload_doc', $json_arr) ? $json_arr['upload_doc']['type'] : [];
                // Upload Doc Required
                $this->upload_doc_required = array_key_exists('upload_doc', $json_arr) ? $json_arr['upload_doc']['required'] : [];
                switch ($regtype) {
                    case 'section1':
                        return $this->load_form_1($regtype, $application);
                        break;
                    case 'section2':
                        return $this->load_form_2($regtype, $application);
                        break;
                    case 'section3':
                        return $this->load_form_3($regtype, $application);
                        break;
                    case 'section4':
                        return $this->load_form_4($regtype, $application);
                        break;
                    case 'section5':
                        return $this->load_form_5($regtype, $application);
                        break;
                    case 'section6':
                        return $this->load_form_6($regtype, $application);
                        break;
                    default:
                        dd('Bad Input');
                        break;
                }


            } else {
                dd('Not Found');
            }

        }
    }

    /**
     * Load Form 1(Type 1)
     */
    public function load_form_1($regtype, $application) {

        // $application = Application::where('user_id', 7)->first();
        $applicants = [
            "name_1_t1" => "",
            "applicant_status_1_t1" => "",
            "nationality_1_t1" => "",
            "id_number_1_t1" => "",
            "passport_number_1_t1" => "",
            "place_of_res_1_t1" => "",
            "actual_place_of_res_1_t1" => "",
            "corrs_add_1_t1" => "",
            "land_with_code_1_t1" => "",
            "land_with_ext_1_t1" => "",
            "fax_with_code_1_t1" => "",
            "fax_with_ext_1_t1" => "",
            "mobile_personal_1_t1" => "",
            "mobile_personal_ext_1_t1" => "",
            "mobile_work_1_t1" => "",
            "mobile_work_ext_1_t1" => "",
            "email_personal_1_t1" => "",
            "email_work_1_t1" => "",
            "website_1_t1" => "",
            "doctype_1_t1" => "",
            "reqtype_1_t1" => "",
            "notes_1_t1" => "",
        ];

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
            $applicants_d = $decoded['applicants'];
            foreach ($applicants as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $applicants[$key] =  $applicants_d[$key];
                }
            }
            $owner_vessel = $decoded['owner_vessel'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $owner_vessel)) {
                    $tab2[$key] =  $owner_vessel[$key];
                }
            }
            $marine_unit = $decoded['marine_unit'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $marine_unit)) {
                    $tab3[$key] =  $marine_unit[$key];
                }
            }
            $vessel = $decoded['vessel'];
            foreach ($tab4 as $key => $value) {
                if(array_key_exists($key, $vessel)) {
                    $tab4[$key] =  $vessel[$key];
                }
            }
            $water_used_im = $decoded['water_used_im'];
            foreach ($tab5 as $key => $value) {
                if(array_key_exists($key, $water_used_im)) {
                    $tab5[$key] =  $water_used_im[$key];
                }
            }
            $sanitation = $decoded['sanitation'];
            foreach ($tab6 as $key => $value) {
                if(array_key_exists($key, $sanitation)) {
                    $tab6[$key] =  $sanitation[$key];
                }
            }
            $waste_liquid = $decoded['waste_liquid'];
            foreach ($tab7 as $key => $value) {
                if(array_key_exists($key, $waste_liquid)) {
                    $tab7[$key] =  $waste_liquid[$key];
                }
            }
            $vessel_engine = $decoded['vessel_engine'];
            foreach ($tab8 as $key => $value) {
                if(array_key_exists($key, $vessel_engine)) {
                    $tab8[$key] =  $vessel_engine[$key];
                }
            }
            $solid_waste = $decoded['solid_waste'];
            foreach ($tab9 as $key => $value) {
                if(array_key_exists($key, $solid_waste)) {
                    $tab9[$key] =  $solid_waste[$key];
                }
            }
            $payment_fees = $decoded['branch_payment'];
            foreach ($tab10 as $key => $value) {
                if(array_key_exists($key, $payment_fees)) {
                    $tab10[$key] =  $payment_fees[$key];
                }
            }
            $upload_doc = $decoded['upload_doc'];
            $tab11 = $upload_doc;
        }

        if(!isset($tab11)) {
            $tab11 = [];
        }

        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $doctype = $this->doctype;
        $reqtype = $this->reqtype;
        $regport = $this->regport;
        $craft = $this->craft;
        $const_type = $this->const_type;
        $classified_unit = $this->classified_unit;
        // 
        $entity = \App\Models\Entity::orderBy('name', 'ASC')->get();
        $usage_right_fees = []; $average_annual = []; $protection_cost= []; $entity_item_name = [];
        foreach ($entity as $row) {
            $usage_right_fees[] = $row->fees;
            $average_annual[] = $row->annual_average;
            $protection_cost[] = $row->annual_protection_fees;
            $entity_item_name[] = $row->name;
        }
        // $entity_usage_right =
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $drainage_solution = $this->drainage_solution;
        $tank_oil_residuces = $this->tank_oil_residuces;
        $fuel_types = $this->fuel_types;
        $solid_waste_solution = $this->solid_waste_solution;
        $rate_by_carat = $this->rate_by_carat;
        $carat_quota = $this->carat_quota;
        $length_of_unit = $this->length_of_unit;
        $weight_of_vessel = $this->weight_of_vessel;
        $tank_capacity = $this->tank_capacity;
        $waste_tank_capacity = $this->waste_tank_capacity;
        $daily_consumption = $this->daily_consumption;
        $number_of_tanks = $this->number_of_tanks;
        $exchange_rate = $this->exchange_rate;
        $capacity = $this->capacity;
        $capacity_of_solid_waste_area = $this->capacity_of_solid_waste_area;
        $daily_waste = $this->daily_waste;
        $countries = $this->countries;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;
        $doctype = $this->doctype;
        return view('application.form_1', compact('application', 'regtype', 'applicant_status', 'nationality', 'doctype', 'reqtype', 'regport', 'craft', 'const_type', 'classified_unit', 'marine_activity', 'unit_area_of_activity', 'drainage_solution', 'tank_oil_residuces', 'fuel_types', 'solid_waste_solution', 'rate_by_carat', 'carat_quota', 'length_of_unit', 'weight_of_vessel', 'tank_capacity', 'waste_tank_capacity', 'daily_consumption', 'number_of_tanks', 'exchange_rate', 'capacity', 'capacity_of_solid_waste_area', 'daily_waste', 'countries', 'applicants', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'tab2', 'tab3', 'tab4', 'tab5', 'tab6', 'tab7', 'tab8', 'tab9', 'tab10', 'tab11', 'entity', 'usage_right_fees', 'average_annual','protection_cost', 'entity_item_name'));
    }

    public function form1RegFees(Request $request)
    {

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->first();
            if($application) {
                if($request->isMethod('POST')) {
                    $activity_sum = 0;
                    $sites_sum_geo_coeff = 0;
                    if($request->activityId) {
                        $activities = Activity::whereIn('id',explode(',', $request->activityId))->get();
                        if($activities) {
                            foreach ($activities as $row) {
                                $activity_sum += ($row->annual_average * $row->environmental_effect);
                            }
                        }
                    }

                    if($request->protectedAreaId) {
                        // 
                        // $result = ProtectedArea::whereIn('id', explode(',', $request->protectedAreaId))->select(\DB::raw('group_concat(sites) as sites'))->first();
                        $result = ProtectedArea::whereIn('id', explode(',', $request->protectedAreaId))->sum('geo_location_fees');
                        if($result) {
                            // \DB::enableQueryLog();
                            // $sites = \DB::select(\DB::raw("SELECT * FROM `sites`  WHERE activitis IN(".$result->sites.")"));
                            
                            // $sites = \DB::select(\DB::raw("SELECT id,geo_location_fees FROM `sites`  WHERE id IN(".$result->sites.")"));
                            // if($sites) {
                            //     foreach ($sites as $row) {
                            //     $sites_sum_geo_coeff += $row->geo_location_fees; 
                            //     }
                            // }
                            $sites_sum_geo_coeff = $result;
                            // dd(\DB::getQueryLog());
                        }
                        
                    }
                    

                    $totalFees = ($request->entitySum + $activity_sum) * ($sites_sum_geo_coeff);
                    // dd($request->entitySum, $activity_sum, $sites_sum_geo_coeff, $totalFees);

                    $section1ArrC = Config::get('siteVars.section1Arr');
                    $t1_10 =  Config::get('siteVars.t1_10');
                    foreach ($t1_10 as $key => $value) {
                        $t1_10[$key] = $request->$key;
                    }

                    $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
                    if(!$application) {
                        return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
                    }

                    $prev_data = json_decode($application->data, true);
                    if($prev_data != null) {
                        foreach ($prev_data as $key => $value) {
                            $section1ArrC[$key] = $prev_data[$key];
                        }
                    }

                    $section1ArrC['branch_payment'] = $t1_10;
                    $application->data = json_encode($section1ArrC);
                    $application->amount = $totalFees;
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['payment_fees' => number_format($totalFees)], 200);

                }
                else {
                    return response()->json(['payment_fees' => number_format($application->amount)], 200);
                }
                

            }
        }
    }

    

    public function tab1_t1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name_1_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "applicant_status_1_t1" => "required",
            "nationality_1_t1" => "required",
            "id_number_1_t1" => "nullable|numeric",
            "passport_number_1_t1" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_1_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t1" => "required",
            "land_with_code_1_t1" => "nullable|numeric",
            "fax_with_code_1_t1" => "nullable|numeric",
            "mobile_personal_1_t1" => "nullable|numeric",
            "mobile_work_1_t1" => "required|numeric",
            "email_personal_1_t1" => "nullable|email",
            "email_work_1_t1" => "email|required",
            // "website_1_t1" => "",
            "doctype_1_t1" => "required",
            "reqtype_1_t1" => "required",

            "land_with_ext_1_t1" => "numeric",
            "fax_with_ext_1_t1" => "numeric",
            "mobile_personal_ext_1_t1" => "numeric",
            "mobile_work_ext_1_t1" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t1.required' => __("Full Name is required"),
            'name_1_t1.regex' => __("Full Name must be contain only text"),

            'applicant_status_1_t1.*' => __("Applicant Status is required"),

            "nationality_1_t1.required" => __("Nationality is required"),

            "id_number_1_t1.numeric" => __("ID number should be numeric"),
            "id_number_1_t1.required" => __("ID number is required"),

            "passport_number_1_t1.required" => __("Passport number is required"),
            "passport_number_1_t1.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_1_t1.required" => __("Address (as stated in ID) is required"),
            "place_of_res_1_t1.regex" => __("Address (as stated in ID) should contain text and numbers only"),

            "actual_place_of_res_1_t1.required" => __("Actual address is required"),
            "actual_place_of_res_1_t1.regex" => __("Actual address should contain text and numbers only"),

            "corrs_add_1_t1.required" => __("Mailing address is required"),

            "land_with_code_1_t1.numeric" => __("Landline with code should contain numbers only"),

            "fax_with_code_1_t1.numeric" => __("Fax with with code should contain numbers only"),

            "mobile_personal_1_t1.numeric" => __("Mobile personal should contain numbers only"),

            "mobile_work_1_t1.required" => __("Mobile work is required"),
            "mobile_work_1_t1.numeric" => __("Mobile work should contain numbers only"),

            "email_personal_1_t1.email" => __("Email personal is not in email format"),

            "email_work_1_t1.required" => __("Email work is required"),

            "email_work_1_t1.email" => __("Email work is should be a valid email"),

            "doctype_1_t1.required" => __("Please select a document type"),

            "reqtype_1_t1.required" => __("Please select a request type"),

            "land_with_ext_1_t1.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_1_t1.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_1_t1.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_1_t1.required" => __("Mobile Work Code required"),
            "mobile_work_ext_1_t1.numeric" => __("Mobile Work Code should contain numbers only")
        ]);

        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }
        if(empty($errroList)) {
            if($request->nationality_1_t1) {
                $nationalityName = strtolower($request->nationality_1_t1);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_1_t1) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_1_t1) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }
        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }



        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_1 =  Config::get('siteVars.t1_1');
        foreach ($t1_1 as $key => $value) {
          $t1_1[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }
        $section1ArrC['applicants'] = $t1_1;
        $application->data = json_encode($section1ArrC);
        $application->user_unit_owned_by_company = ($request->user_unit_owned_by_company == "false") ? '' : $request->user_unit_owned_by_company;
        $application->user_unit_owned_by_individual = ($request->user_unit_owned_by_individual == "false") ? '' : $request->user_unit_owned_by_individual;
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Applicants Data added successfully'], 200);

    }

    public function tab1_t2(Request $request) {
        $validator = Validator::make($request->all(), [

            "name_2_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "nationality_2_t1" => "required",
            "id_number_2_t1" => "nullable|numeric",
            "passport_number_2_t1" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_2_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_2_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "partner_ship_rate_by_carat_2_t1" => "required",
            "land_with_code_2_t1" => "nullable|numeric",
            "fax_with_code_2_t1" => "nullable|numeric",
            "mobile_personal_2_t1" => "nullable|numeric",
            "mobile_work_2_t1" => "required|numeric",
            "email_personal_2_t1" => "nullable|email",
            "email_work_2_t1" => "required|email",

            "land_with_ext_2_t1" => "numeric",
            "fax_with_ext_2_t1" => "numeric",
            "mobile_personal_ext_2_t1" => "numeric",
            "mobile_work_ext_2_t1" => "required|numeric",

            // "notes_1_t1" => "",
        ], [

            "name_2_t1.required" => __("Full name is required"),
            "name_2_t1.regex" => __("Full name should contain text only"),

            "nationality_2_t1.required" => __("Nationality is required"),

            "id_number_2_t1.required" => __("ID number is required"),
            "id_number_2_t1.numeric" => __("ID number should contain numbers only"),

            "passport_number_2_t1.required" => __("Passport number is required"),
            "passport_number_2_t1.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_2_t1.required" => __("Place of residence is required"),
            "place_of_res_2_t1.regex" => __("Place of residence should contain text and numbers only"),

            "actual_place_of_res_2_t1.required" => __("Actual place residence is required"),
            "actual_place_of_res_2_t1.regex" => __("Actual place residence should contain text and numbers only"),

            "partner_ship_rate_by_carat_2_t1.required" => __("partnership rate BY CARAT
            is required"),
            // "mobile_work_2_t1.required" => "",
            "email_work_2_t1.required" => __("Email Work required"),

            "land_with_code_2_t1.numeric" => __("Land Line with Code should contain numbers only"),
            "fax_with_code_2_t1.numeric" => __("Fax with Code should contain numbers only"),
            "mobile_personal_2_t1.numeric" => __("MOBILE (PERSONAL) should contain numbers only"),
            "mobile_work_2_t1.required" => __("MOBILE (Work) is required"),
            "mobile_work_2_t1.numeric" => __("MOBILE (Work) should contain numbers only"),


            "email_personal_2_t1.email" => __("EMAIL (PERSONAL) should be valid email"),
            "email_work_2_t1.required" => __("EMAIL (WORK) is required"),



            "land_with_ext_2_t1.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_2_t1.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_2_t1.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_2_t1.required" => __("Mobile Work Code required"),
            "mobile_work_ext_2_t1.numeric" => __("Mobile Work Code should contain numbers only")
        ]);

        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        if(empty($errroList)) {
            if($request->nationality_2_t1) {
                $nationalityName = strtolower($request->nationality_2_t1);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_2_t1) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_2_t1) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_2 =  Config::get('siteVars.t1_2');
        foreach ($t1_2 as $key => $value) {
          $t1_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }
        $section1ArrC['owner_vessel'] = $t1_2;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '1';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Owners Of Vessel Data added successfully'], 200);
    }

    public function tab1_t3(Request $request) {
        $validator = Validator::make($request->all(), [

            "name_of_unit_owner_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "business_attribute_of_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "entity_type_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "commer_reg_no_3_t1" => "required|numeric",
            "tax_card_no_3_t1" => "required|numeric",
            // "corrs_add_3_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_3_t1" => "required",
            "carat_quota_3_t1" => "required",
            "telephone_3_t1" => "nullable|numeric",
            "fax_with_code_3_t1" => "nullable|numeric",
            "mobile_number_p_3_t1" => "nullable|numeric",
            "mobile_work_w_3_t1" => "required|numeric",
            "email_personal_3_t1" => "nullable|email",
            "email_work_3_t1" => "required|email",

            "telephone_ext_3_t1" => "numeric",
            "fax_with_ext_3_t1" => "numeric",
            "mobile_number_p_ext_3_t1" => "numeric",
            "mobile_work_w_ext_3_t1" => "required|numeric",

            // "notes_1_t1" => "",
        ], [

            "name_of_unit_owner_3_t1.required" => __("Name of Unit Owner (Legal Representative) is required"),
            "name_of_unit_owner_3_t1.regex" => __("Name of Unit Owner (Legal Representative) should contain text only"),

            "business_attribute_of_3_t1.required" => __("Entity trade mark is required"),
            "business_attribute_of_3_t1.regex" => __("Entity trade mark should contain text only"),

            "entity_type_3_t1.required" => __("Entity type is required"),
            "entity_type_3_t1.regex" => __("Entity type should contain text only"),


            "commer_reg_no_3_t1.required" => __("Commercial Registration No is required"),
            "commer_reg_no_3_t1.numeric" => __("Commercial Registration No should contain numbers only"),

            "tax_card_no_3_t1.required" => __("Tax card number is required"),
            "tax_card_no_3_t1.numeric" => __("Tax card number should contain numbers only"),


            "corrs_add_3_t1.required" => __("Mailing address is required"),
            "corrs_add_3_t1.regex" => __("Mailing address should contain text and numbers only"),

            "carat_quota_3_t1.required" => __("(Carat\Kirat) quota is required"),


            "telephone_3_t1.numeric" => __("Telephone should contain numbers only"),
            "fax_with_code_3_t1.numeric" => __("Fax (with code) should contain numbers only"),
            "mobile_number_p_3_t1.numeric" => __("Mobile Number (Personal) should contain numbers only"),

            "mobile_work_w_3_t1.required" => __("MOBILE (WORK) is required"),
            "mobile_work_w_3_t1.numeric" => __("MOBILE (WORK) should contain numbers only"),

            "email_personal_3_t1.required" => __("EMAIL Personal Should be valid email"),
            "email_work_3_t1.required" => __("EMAIL (WORK) is required"),
            "email_work_3_t1.email" => __("EMAIL (WORK) Should be valid email"),




            "telephone_ext_3_t1.numeric" => __("Telephone code contain numbers only"),
            "fax_with_ext_3_t1.numeric" => __("Fax Code should contain numbers only"),
            "mobile_number_p_ext_3_t1.numeric" => __("Mobile Number Code should contain numbers only"),
            "mobile_work_w_ext_3_t1.required" => __("Mobile Work Code required"),
            "mobile_work_w_ext_3_t1.numeric" => __("Mobile Work Code should contain numbers only")
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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_3 =  Config::get('siteVars.t1_3');
        foreach ($t1_3 as $key => $value) {
          $t1_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['marine_unit'] = $t1_3;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '1';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'MARINE UNIT Data added successfully'], 200);
    }

    public function tab1_t4(Request $request) {

        $validator = Validator::make($request->all(), [

            "maritime_unit_arabic_4_t1" => "required|regex:/[اأإء-ي]/ui",
            "maritime_unit_4_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "reg_number_4_t1" => "required|numeric",
            "port_of_reg_4_t1" => "required",
            "date_of_reg_4_t1" => "required|date_format:d/m/Y",
            "maritime_license_4_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "craft_4_t1" => "required",
            "number_of_crew_4_t1" => "required|numeric",
            "total_length_of_unit_4_t1" => "required",
            "number_of_passenger_4_t1" => "required|numeric",
            "construction_type_4_t1" => "required",
            "total_weight_of_vessel_4_t1" => "required",
            // "spec_of_rubber_boat_unit_4_t1" => "",
            "classifi_unit_4_t1" => "required",
            "marine_activity_unit_4_t1" => "required",
            "unit_area_of_activity_4_t1" => "required",
            "getty_marina_4_t1" => "required|regex:/^[a-zA-Z ]*$/i",
            "unit_practice_location_4_t1" => "regex:/^[a-zA-Z ]*$/i",
            // "notes_1_t1" => "",
        ], [

            "maritime_unit_arabic_4_t1.required" => __("Name of vessel (in Arabic) is required"),
            "maritime_unit_arabic_4_t1.regex" => __("Name of vessel (in Arabic) accept only Arabic"),

            "maritime_unit_4_t1.required" => __("Name of vessel (in ENGLISH) is required"),
            "maritime_unit_4_t1.regex" => __("Name of vessel (in ENGLISH) supports english only"),

            "reg_number_4_t1.required" => __("Registration Number is required"),
            "reg_number_4_t1.numeric" => __("Registration Number number only"),


            "port_of_reg_4_t1.required" => __("Port of Registration is required"),

            "date_of_reg_4_t1.required" => __("Date of registration (day / month / year) is required"),
            "date_of_reg_4_t1.date_format" => __("Date of registration (day / month / year) format should be (day / month / year)"),

            "maritime_license_4_t1.required" => __("Name of vessel  (in ENGLISH) Area is required"),
            "maritime_license_4_t1.regex" => __("Name of vessel  (in ENGLISH) Area text only"),

            "craft_4_t1.required" => __("Vessel registered activities (as described in navigation license) is required"),

            "number_of_crew_4_t1.required" => __("Number of crew by vessel is required"),
            "number_of_crew_4_t1.numeric" => __("Number of crew by vessel number only"),

            "total_length_of_unit_4_t1.required" => __("Total length of the vessel (m) is required"),

            "number_of_passenger_4_t1.required" => __("Maximum registered passengers capacity by the vessel is required"),
            "number_of_passenger_4_t1.numeric" => __("Maximum registered passengers capacity by the vessel number only"),

            "construction_type_4_t1.required" => __("Construction type is required"),

            "total_weight_of_vessel_4_t1.required" => __("Total WEIGHT of VESSEL (ton) is required"),

            "classifi_unit_4_t1.required" => __("Classification of the vessel (as indicated by eeaa) is required"),

            "marine_activity_unit_4_t1.required" => __("Requested marine activity by the owner(s) of the vessel inside PAs is required"),
            "unit_area_of_activity_4_t1.required" => __("Avilable allowed activities by each PAs (please chick attached maps) is required"),

            "getty_marina_4_t1.required" => __("Jetty(ies)/marina(s) used by the vessel is required"),
            "unit_practice_location_4_t1.regex" => __("Specific navigation route for requested activities by the vessel text only"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_4 =  Config::get('siteVars.t1_4');
        foreach ($t1_4 as $key => $value) {
          $t1_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['vessel'] = $t1_4;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Vessel Data added successfully'], 200);
    }

    public function tab1_t5(Request $request) {
        $validator = Validator::make($request->all(), [

            "water_unit_in_5_t1" => "required",
            "tank_capacity_5_t1" => "required_if:water_unit_in_5_t1,y",
            "daily_consumption_5_t1" => "required_if:water_unit_in_5_t1,y",
            "number_of_tanks_5_t1" => "required_if:water_unit_in_5_t1,y",
        ], [

            "water_unit_in_5_t1.required" => __("Water tank in the vessel is required"),
            "tank_capacity_5_t1.required_if" => __("Water tank capacity (m3) if Water tank in the vessel  is Yes"),
            "daily_consumption_5_t1.required_if" => __("Average daily water consumption (m3/day) is required if Water tank in the vessel  is Yes"),
            "number_of_tanks_5_t1.required_if" => __("Number of water tanks is required if Water tank in the vessel  is Yes"),

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


        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_5 =  Config::get('siteVars.t1_5');
        foreach ($t1_5 as $key => $value) {
          $t1_5[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['water_used_im'] = $t1_5;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '4';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Water Used in the Unit added successfully'], 200);
    }

    public function tab1_t6(Request $request) {
        $validator = Validator::make($request->all(), [

            "vessel_drainage_in_6_t1" => "required",
            "tank_capacity_6_t1" => "required_if:vessel_drainage_in_6_t1,y",
            "daily_exchange_rate_6_t1" => "required_if:vessel_drainage_in_6_t1,y",
            "get_rid_of_drainage_6_t1" => "required_if:vessel_drainage_in_6_t1,y",
        ], [

            "vessel_drainage_in_6_t1.required" => __("Vessel's sewage tank is required"),
            "tank_capacity_6_t1.required_if" => __("Sewage tank capacity (m3) is required if Vessel's sewage tank is Yes"),
            "daily_exchange_rate_6_t1.required_if" => __("Average daily amount of sewage (m3/day) is required if Vessel's sewage tank is Yes"),
            "get_rid_of_drainage_6_t1.required_if" => __("Handling and treatment of sewage is required if Vessel's sewage tank is Yes"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_6 =  Config::get('siteVars.t1_6');
        foreach ($t1_6 as $key => $value) {
          $t1_6[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['sanitation'] = $t1_6;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '5';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'SANITATION RESULTING FROM THE USE OF THE UNIT added successfully'], 200);
    }

    public function tab1_t7(Request $request) {
        $validator = Validator::make($request->all(), [
            "vessel_drainage_in_7_t1" => "required",
            "tank_capacity_7_t1" => "required_if:vessel_drainage_in_7_t1,y",
            "get_rid_of_residues_7_t1" => "required_if:vessel_drainage_in_7_t1,y"
        ], [

            "vessel_drainage_in_7_t1.required" => __("Tank for oil/fuel wastes is required"),
            "tank_capacity_7_t1.required_if" => __("Waste tank capacity (m3) is required  if Tank for oil/fuel wastes is Yes"),
            "get_rid_of_residues_7_t1.required_if" => __("Handling and treatment of oil/fuel wastes if Tank for oil/fuel wastes is Yes"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_7 =  Config::get('siteVars.t1_7');
        foreach ($t1_7 as $key => $value) {
          $t1_7[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['waste_liquid'] = $t1_7;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '6';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'WASTE LIQUID OILS USED IN THE UNIT added successfully'], 200);
    }

    public function tab1_t8(Request $request) {
        $validator = Validator::make($request->all(), [
            "main_motor_per_unit_8_t1" => "required|numeric",
            "motor_brand_8_t1" => "required",
            "eng_capacity_1_8_t1" => "required",
            "eng_capacity_2_8_t1" => "",
            "eng_capacity_3_8_t1" => "",
            "eng_capacity_4_8_t1" => "",
            "type_of_fuel_used_8_t1" => "required",
        ], [

            "main_motor_per_unit_8_t1.required" => __("Number of engines per vessel unit is required"),
            "main_motor_per_unit_8_t1.numeric" => __("Number of engines per vessel unit number only"),
            "motor_brand_8_t1.required" => __("Engine brand is required"),
            "eng_capacity_1_8_t1.required" => __("Engine power 1 is required"),
            "type_of_fuel_used_8_t1.required" => __("Types of fuel used in engines in engines is required"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_8 =  Config::get('siteVars.t1_8');
        foreach ($t1_8 as $key => $value) {
          $t1_8[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['vessel_engine'] = $t1_8;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '7';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'VESSEL ENGINES added successfully'], 200);
    }

    public function tab1_t9(Request $request) {
        $validator = Validator::make($request->all(), [
            "waste_collection_in_9_t1" => "required",
            "tank_capacity_9_t1" => "required_if:waste_collection_in_9_t1,y",
            "avg_daily_waste_9_t1" => "required_if:waste_collection_in_9_t1,y",
            "get_rid_of_solid_9_t1" => "required_if:waste_collection_in_9_t1,y"
        ], [

            "waste_collection_in_9_t1.required" => __("Solid waste collection area in the vessel is required"),
            "tank_capacity_9_t1.required_if" => __("Capacity of solid waste area (m3)  is required  if Solid waste collection area in the vessel is Yes"),
            "avg_daily_waste_9_t1.required_if" => __("Average daily generated solid waste (m3/day) is required  if Solid waste collection area in the vessel is Yes"),
            "get_rid_of_solid_9_t1.required_if" => __("Handling and treatment of solid waste if Solid waste collection area in the vessel is Yes"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_9 =  Config::get('siteVars.t1_9');
        foreach ($t1_9 as $key => $value) {
          $t1_9[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        $section1ArrC['solid_waste'] = $t1_9;
        $application->data = json_encode($section1ArrC);
        $application->last_tab = '8';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'SOLID WASTE added successfully'], 200);
    }

    public function tab1_t10(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => __("No of Branches is required"),
            "payment_fees.numeric" => __("No of Branches should numeric"),

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

        $section1ArrC = Config::get('siteVars.section1Arr');
        $t1_10 =  Config::get('siteVars.t1_10');
        foreach ($t1_10 as $key => $value) {
          $t1_10[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section1ArrC[$key] = $prev_data[$key];
            }
        }

        

        $section1ArrC['branch_payment'] = $t1_10;
        $application->data = json_encode($section1ArrC);
        $application->no_of_branches = $request->payment_fees;
        $application->last_tab = '9';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("No of branches added successfully")], 200);
    }

    public function tab1_t11(Request $request) {
        $request['last_tab'] = 10;
        return $this->upload_doc($request);
    }

    public function t1_json_data(Request $request) {
        // dd($request->all());
        $parse_file = file_get_contents(url('/assets/picklist-eng.json'));
        $json_arr = json_decode($parse_file, true);
        if($json_arr != false) {
            $upload_doc_names = $json_arr['upload_doc']['name'];
        }

        $application = Application::where('application_no', $request->application_no)->first()->toArray();
        if(sizeof($application) > 0){
            $application['data'] = json_decode($application['data'], true);
            $docname_list = json_decode($application['docname_list'], true);
            $name = explode('section',$application['regtype'])[1];
            if($name == 1){
                if(array_key_exists('vessel', $application['data'])){
                    if(array_key_exists('unit_area_of_activity_4_t'.$name, $application['data']['vessel'])){
                        $application['data']['vessel']['unit_area_of_activity_4_t'.$name] = explode(',', $application['data']['vessel']['unit_area_of_activity_4_t'.$name]);
                        foreach($application['data']['vessel']['unit_area_of_activity_4_t'.$name] as $key => $pArea){
                            $p = ProtectedArea::find($pArea);
                            if($p){
                                $application['data']['vessel']['unit_area_of_activity_4_t'.$name][$key] = $p->name;
                            }
                        }
                        $application['data']['vessel']['unit_area_of_activity_4_t'.$name] = implode(', ', $application['data']['vessel']['unit_area_of_activity_4_t'.$name]);
                    }
                    if(array_key_exists('marine_activity_unit_4_t'.$name, $application['data']['vessel'])){
                        $application['data']['vessel']['marine_activity_unit_4_t'.$name] = explode(',', $application['data']['vessel']['marine_activity_unit_4_t'.$name]);
                        foreach($application['data']['vessel']['marine_activity_unit_4_t'.$name] as $key => $act){
                            $a = Activity::find($act);
                            if($a){
                                $application['data']['vessel']['marine_activity_unit_4_t'.$name][$key] = $a->name;
                            }
                        }
                        $application['data']['vessel']['marine_activity_unit_4_t'.$name] = implode(', ', $application['data']['vessel']['marine_activity_unit_4_t'.$name]);
                    }
                }
            } else {
                if(array_key_exists('unit_area_of_activity_3_t'.$name, $application['data']['center_data'])){
                    $application['data']['center_data']['unit_area_of_activity_3_t'.$name] = explode(',', $application['data']['center_data']['unit_area_of_activity_3_t'.$name]);
                    foreach($application['data']['center_data']['unit_area_of_activity_3_t'.$name] as $key => $pArea){
                        $p = ProtectedArea::find($pArea);
                        if($p){
                            $application['data']['center_data']['unit_area_of_activity_3_t'.$name][$key] = $p->name;
                        }
                    }
                    $application['data']['center_data']['unit_area_of_activity_3_t'.$name] = implode(', ', $application['data']['center_data']['unit_area_of_activity_3_t'.$name]);
                }
                if(array_key_exists('marine_activity_authorized_3_t'.$name, $application['data']['center_data'])){
                    $application['data']['center_data']['marine_activity_authorized_3_t'.$name] = explode(',', $application['data']['center_data']['marine_activity_authorized_3_t'.$name]);
                    foreach($application['data']['center_data']['marine_activity_authorized_3_t'.$name] as $key => $act){
                        $a = Activity::find($act);
                        if($a){
                            $application['data']['center_data']['marine_activity_authorized_3_t'.$name][$key] = $a->name;
                        }
                    }
                    $application['data']['center_data']['marine_activity_authorized_3_t'.$name] = implode(', ', $application['data']['center_data']['marine_activity_authorized_3_t'.$name]);
                }
            }
            die(json_encode(['application' => $application, 'doc_list' => $docname_list]));
        }
    }

    /**
     * Section Type 2
     */

    public function load_form_2($regtype, $application) {
        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $reqtype = $this->reqtype;
        $countries = $this->countries;
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;

        // Tab1
        $tab1 = Config::get('siteVars.t2_1');
        // Tab2
        $tab2 = Config::get('siteVars.t2_2');
        // Tab3
        $tab3 = Config::get('siteVars.t2_3');
        // Tab4
        $tab4 = Config::get('siteVars.t2_4');
        // Tab4
        $tab5 = Config::get('siteVars.t2_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            $applicants_d = $decoded['applicants'];
            foreach ($tab1 as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $tab1[$key] =  $applicants_d[$key];
                }
            }
            $data= $decoded['owner_data'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab2[$key] =  $data[$key];
                }
            }
            $data= $decoded['center_data'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab3[$key] =  $data[$key];
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $data= $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $data)) {
                        $tab4[$key] =  $data[$key];
                    }
                }
            } else {
                $tab4['branch_payment'] = '';
            }

            $upload_doc = $decoded['upload_doc'];
            $tab5 = $upload_doc;
        }
        return view('application.form_2', compact('application', 'regtype', 'applicant_status', 'nationality', 'countries', 'reqtype', 'marine_activity', 'unit_area_of_activity', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5'));
    }
    public function tab2_t1(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_1_t2" => "required|regex:/^[مرحباA-Z ]+$/ui",
            "applicant_status_1_t2" => "required",
            "nationality_1_t2" => "required",
            "id_number_1_t2" => "nullable|numeric",
            "passport_number_1_t2" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t2" => "required",
            "land_with_code_1_t2" => "nullable|numeric",
            "fax_with_code_1_t2" => "nullable|numeric",
            "mobile_personal_1_t2" => "nullable|numeric",
            "mobile_work_1_t2" => "required|numeric",
            "email_personal_1_t2" => "nullable|email",
            "email_work_1_t2" => "email|required",
            // "website_1_t1" => "",
            "agency_board_1_t2" => "required|numeric",
            "doc_office_1_t2" => "required",
            "reqtype_1_t2" => "required",

            "land_with_ext_1_t2" => "numeric",
            "fax_with_ext_1_t2" => "numeric",
            "mobile_personal_ext_1_t2" => "numeric",
            "mobile_work_ext_1_t2" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t2.required' => __("Full Name is required"),
            'name_1_t2.regex' => __("Full Name must be contain only text"),

            'applicant_status_1_t2.*' => __("Applicant Status is required"),

            "nationality_1_t2.required" => __("Nationality is required"),

            "id_number_1_t2.numeric" => __("ID number should be numeric"),
            "id_number_1_t2.required" => __("ID number is required"),

            "passport_number_1_t2.required" => __("Passport number is required"),
            "passport_number_1_t2.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_1_t2.required" => __("Place of residence is required"),
            "place_of_res_1_t2.regex" => __("Place of residence should contain text and numbers only"),

            "actual_place_of_res_1_t2.required" => __("Actual address is required"),
            "actual_place_of_res_1_t2.regex" => __("Actual address should contain text and numbers only"),

            "corrs_add_1_t2.required" => __("Mailing address is required"),

            "land_with_code_1_t2.numeric" => __("Landline with code should contain numbers only"),

            "fax_with_code_1_t2.numeric" => __("Fax with with code should contain numbers only"),

            "mobile_personal_1_t2.numeric" => __("Mobile personal should contain numbers only"),

            "mobile_work_1_t2.required" => __("Mobile work is required"),
            "mobile_work_1_t2.numeric" => __("Mobile work should contain numbers only"),

            "email_personal_1_t2.email" => __("Email personal is not in email format"),

            "email_work_1_t2.required" => __("Email work is required"),

            "email_work_1_t2.email" => __("Email work is should be a valid email"),

            "doc_office_1_t2.required" => __("Please select a document office"),

            "reqtype_1_t2.required" => __("Please select a request type"),

            "agency_board_1_t2.required" => __("Agency Bond is Required"),
            "agency_board_1_t2.numeric" => __("Agency Bond should contains Number Only"),

            "doc_office_1_t2.required" => __("Agency Bond is Required"),

            "land_with_ext_1_t2.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_1_t2.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_1_t2.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_1_t2.required" => __("Mobile Work Code required"),
            "mobile_work_ext_1_t2.numeric" => __("Mobile Work Code should contain numbers only")
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        if(empty($errroList)) {
            if($request->nationality_1_t2) {
                $nationalityName = strtolower($request->nationality_1_t2);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_1_t2) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_1_t2) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }
        $section2ArrC = Config::get('siteVars.section2Arr');
        $t2_1 =  Config::get('siteVars.t2_1');
        foreach ($t2_1 as $key => $value) {
            $t2_1[$key] = $request->$key;
          }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section2ArrC[$key] = $prev_data[$key];
            }
        }

        $section2ArrC['applicants'] = $t2_1;
        $application->data = json_encode($section2ArrC);
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Applicants Data added successfully")], 200);


    }
    public function tab2_t2(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_2_t2" => "required|regex:/^[a-zA-Z ]*$/i",
            "nick_name_2_t2" => "nullable|regex:/^[a-zA-Z ]*$/i",
            "nationality_2_t2" => "required",
            "id_number_2_t2" => "nullable|numeric",
            "passport_number_2_t2" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_2_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "land_with_code_2_t2" => "nullable|numeric",
            "fax_with_code_2_t2" => "nullable|numeric",
            "mobile_personal_2_t2" => "nullable|numeric",
            "mobile_work_2_t2" => "required|numeric",
            "email_personal_2_t2" => "nullable|email",
            "email_work_2_t2" => "email|required",
            // "website_1_t1" => "",

            "land_with_ext_2_t2" => "numeric",
            "fax_with_ext_2_t2" => "numeric",
            "mobile_personal_ext_2_t2" => "numeric",
            "mobile_work_ext_2_t2" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_2_t2.required' => __("Full Name is required"),
            'name_2_t2.regex' => __("Full Name must be contain only text"),

            'nick_name_2_t2.regex' => __("Nick Name must be contain only text"),

            "nationality_2_t2.required" => __("Nationality is required"),

            "id_number_2_t2.numeric" => __("ID number should be numeric"),
            "id_number_2_t2.required" => __("ID number is required"),

            "passport_number_2_t2.required" => __("Passport number is required"),
            "passport_number_2_t2.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_2_t2.required" => __("Address (as stated in ID) is required"),
            "place_of_res_2_t2.regex" => __("Address (as stated in ID) should contain text and numbers only"),

            "land_with_code_2_t2.numeric" => __("Landline with code should contain numbers only"),

            "fax_with_code_2_t2.numeric" => __("Fax with with code should contain numbers only"),

            "mobile_personal_2_t2.numeric" => __("Mobile personal should contain numbers only"),

            "mobile_work_2_t2.required" => __("Mobile work is required"),
            "mobile_work_2_t2.numeric" => __("Mobile work should contain numbers only"),

            "email_personal_2_t2.email" => __("Email personal is not in email format"),

            "email_work_2_t2.required" => __("Email work is required"),

            "email_work_2_t2.email" => __("Email work is should be a valid email"),

            "land_with_ext_2_t2.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_2_t2.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_2_t2.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_2_t2.required" => __("Mobile Work Code required"),
            "mobile_work_ext_2_t2.numeric" => __("Mobile Work Code should contain numbers only")
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        if(empty($errroList)) {
            if($request->nationality_2_t2) {
                $nationalityName = strtolower($request->nationality_2_t2);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_2_t2) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_2_t2) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }
        $section2ArrC = Config::get('siteVars.section2Arr');
        $t2_2 =  Config::get('siteVars.t2_2');
        foreach ($t2_2 as $key => $value) {
            $t2_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section2ArrC[$key] = $prev_data[$key];
            }
        }

        $section2ArrC['owner_data'] = $t2_2;
        $application->data = json_encode($section2ArrC);
        $application->last_tab = '1';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Owner Data added successfully")], 200);


    }
    public function tab2_t3(Request $request) {
        $validator = Validator::make($request->all(), [
            "center_name_arabic_3_t2" => "required|regex:/[اأإء-ي]/ui",
            "center_name_english_3_t2" => "required|regex:/^[a-zA-Z ]*$/i",
            "license_number_ministry_of_3_t2" => "required",
            "license_number_ministry_of_membership_3_t2" => "required",
            "commercial_reg_no_3_t2" => "required|numeric",
            "tax_card_no_3_t2" => "required|numeric",
            "address_of_the_center_3_t2" => "required",
            "landline_no_3_t2" => "nullable|numeric",
            "fax_no_3_t2" => "nullable|numeric",
            "mobile_no1_3_t2" => "required|numeric",
            "mobile_no2_3_t2" => "nullable|numeric",
            "email_3_t2" => "required|email",
            "marine_activity_authorized_3_t2" => "required",
            "unit_area_of_activity_3_t2" => "required",

            "telephone_ext_3_t2" => "numeric",
            "fax_with_ext_3_t2" => "numeric",
            "mobile_no1_ext_3_t2" => "required|numeric",
            "mobile_no2_ext_3_t2" => "numeric",

            // "notes_1_t1" => "",
        ], [
            "center_name_arabic_3_t2.required" => __("Center Name Arabic is required"),
            "center_name_arabic_3_t2.regex" => __("Center Name Arabic should contain arabic only"),

            "center_name_english_3_t2.required" => __("Center Name (ENGLISH) is required"),
            "center_name_english_3_t2.regex" => __("Center Name (ENGLISH) should contain english only"),

            "license_number_ministry_of_3_t2.required" => __("License number of the Ministry of Tourism is required"),

            "license_number_ministry_of_membership_3_t2.required" => __("License number of the Ministry of Tourism Membership Number of Diving Tourism Rooms is required"),

            "commercial_reg_no_3_t2.required" => __("Commercial Registration No is required"),
            "commercial_reg_no_3_t2.numeric" => __("Commercial Registration No is number only"),

            "tax_card_no_3_t2.required" => __("Tax card number is required"),
            "tax_card_no_3_t2.numeric" => __("Tax card number should contian number only"),

            "address_of_the_center_3_t2.required" => __("Address of the Center is required"),

            "landline_no_3_t2.numeric" => __("Landline number should contain number only"),
            "fax_no_3_t2.numeric" => __("FAX NO should contain number only"),

            "mobile_no1_3_t2.required" => __("MOBILE NO1 is required"),
            "mobile_no1_3_t2.numeric" => __("MOBILE NO1 should contain number only"),

            "mobile_no2_3_t2.numeric" => __("MOBILE NO 2 should contain number only"),

            "email_3_t2.required" => __("EMAIL is required"),
            "email_3_t2.email" => __("EMAIL should contain email only"),

            "marine_activity_authorized_3_t2.required" => __("Marine activities to be authorized is required"),
            "unit_area_of_activity_3_t2.required" => __("Unit's area of ​​activity (as per the attached statement and maps) is required"),


            "telephone_ext_3_t2.numeric" => __("Telephone Code should contain numbers only"),
            "fax_with_ext_3_t2.numeric" => __("Fax Code should contain numbers only"),
            "mobile_no2_ext_3_t2.numeric" => __("Mobile No 2 should contain numbers only"),
            "mobile_no1_ext_3_t2.required" => __("Mobile No 1 Code required"),
            "mobile_no1_ext_3_t2.numeric" => __("Mobile No 1 Code should contain numbers only")
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
        $section2ArrC = Config::get('siteVars.section2Arr');
        $t2_3 =  Config::get('siteVars.t2_3');
        foreach ($t2_3 as $key => $value) {
            $t2_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section2ArrC[$key] = $prev_data[$key];
            }
        }

        $section2ArrC['center_data'] = $t2_3;
        $application->data = json_encode($section2ArrC);
        $application->last_tab = '2';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Center Data added successfully")], 200);


    }
    public function tab2_t4(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => __("No of Branch is required"),
            "payment_fees.numeric" => __("No of Branch should numeric"),

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

        $section2ArrC = Config::get('siteVars.section2Arr');
        $t2_4 =  Config::get('siteVars.t2_4');
        foreach ($t2_4 as $key => $value) {
          $t2_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section2ArrC[$key] = $prev_data[$key];
            }
        }

        $section2ArrC['branch_payment'] = $t2_4;
        $application->data = json_encode($section2ArrC);
        $application->no_of_branches = $request->payment_fees;
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("No of branches added successfully")], 200);
    }
    public function tab2_t5(Request $request) {
        $request['last_tab'] = 4;
        $this->upSectionType = 't2';
        return $this->upload_doc($request);
    }

    
    public function formRegFees(Request $request)
    {

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->first();
            if($application) {
                if($request->isMethod('POST')) {
                    if($request->frm_type == 2) {
                        $sectionArr = 'section2Arr';
                        $typeName = "t2_4";
                    } else if($request->frm_type == 3) {
                        $sectionArr = 'section3Arr';
                        $typeName = "t3_4";
                    } else if($request->frm_type == 4) {
                        $sectionArr = 'section4Arr';
                        $typeName = "t4_4";
                    } else if($request->frm_type == 5) {
                        $sectionArr = 'section5Arr';
                        $typeName = "t5_4";
                    } else if($request->frm_type == 6) {
                        $sectionArr = 'section6Arr';
                        $typeName = "t6_4";
                    } else {
                    return response()->json(['errors' => ['validation_error' => [__("Unable to find Section")]]], 422);

                    }
                    $activity_sum = 0;
                    $sites_sum_geo_coeff = 0;
                    $entity_sum = 0;
                    if($request->activityId) {
                        $activities = Activity::whereIn('id',explode(',', $request->activityId))->get();
                        if($activities) {
                            foreach ($activities as $row) {
                                $activity_sum += ($row->annual_average * $row->environmental_effect);
                            }
                        }
                    }

                    if($request->protectedAreaId) {
                        // 
                        // $result = ProtectedArea::whereIn('id', explode(',', $request->protectedAreaId))->select(\DB::raw('group_concat(sites) as sites'))->first();
                        $result = ProtectedArea::whereIn('id', explode(',', $request->protectedAreaId))->sum('geo_location_fees');
                        if($result) {
                            // \DB::enableQueryLog();
                            // $sites = \DB::select(\DB::raw("SELECT * FROM `sites`  WHERE activitis IN(".$result->sites.")"));
                            // $sites = \DB::select(\DB::raw("SELECT id,geo_location_fees FROM `sites`  WHERE id IN(".$result->sites.")"));
                            // if($sites) {
                            //     foreach ($sites as $row) {
                            //     $sites_sum_geo_coeff += $row->geo_location_fees; 
                            //     }
                            // }
                            $sites_sum_geo_coeff = $result;
                            // dd(\DB::getQueryLog());
                        }
                        
                    }
                    

                    $totalFees = ($entity_sum + $activity_sum) * ($sites_sum_geo_coeff);
                    // dd($request->entitySum, $activity_sum, $sites_sum_geo_coeff, $totalFees);

                    $section2ArrC = Config::get('siteVars.'.$sectionArr);
                    $t2_4 =  Config::get('siteVars.'.$typeName);
                    foreach ($t2_4 as $key => $value) {
                        $t2_4[$key] = $request->$key;
                    }

                    $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
                    if(!$application) {
                        return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
                    }

                    $prev_data = json_decode($application->data, true);
                    if($prev_data != null) {
                        foreach ($prev_data as $key => $value) {
                            $section2ArrC[$key] = $prev_data[$key];
                        }
                    }

                    $section2ArrC['branch_payment'] = $t2_4;
                    $application->data = json_encode($section2ArrC);
                    $application->amount = $totalFees;
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['payment_fees' => number_format($totalFees)], 200);

                }
                else {
                    return response()->json(['payment_fees' => number_format($application->amount)], 200);
                }
                

            }
        }
    }

    /**
     * Section Type 3
     */
    public function load_form_3($regtype, $application) {
        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $reqtype = $this->reqtype;
        $countries = $this->countries;
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;
        $doctype = $this->doctype;

        // Tab1
        $tab1 = Config::get('siteVars.t3_1');
        // Tab2
        $tab2 = Config::get('siteVars.t3_2');
        // Tab3
        $tab3 = Config::get('siteVars.t3_3');
        // Tab4
        $tab4 = Config::get('siteVars.t3_4');
        // Tab4
        $tab5 = Config::get('siteVars.t3_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            $applicants_d = $decoded['applicants'];
            foreach ($tab1 as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $tab1[$key] =  $applicants_d[$key];
                }
            }
            $data= $decoded['owner_data'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab2[$key] =  $data[$key];
                }
            }
            $data= $decoded['center_data'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab3[$key] =  $data[$key];
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $data= $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $data)) {
                        $tab4[$key] =  $data[$key];
                    }
                }
            } else {
                $tab4['branch_payment'] = '';
            }

            $upload_doc = $decoded['upload_doc'];
            $tab5 = $upload_doc;
        }

        return view('application.form_3', compact('application', 'regtype', 'applicant_status', 'nationality', 'countries', 'reqtype', 'marine_activity', 'unit_area_of_activity', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'doctype', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5'));

    }
    public function tab3_t1(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_1_t3" => "required|regex:/^[a-zA-Z ]*$/i",
            "applicant_status_1_t3" => "required",
            "nationality_1_t3" => "required",
            "id_number_1_t3" => "nullable|numeric",
            "passport_number_1_t3" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_1_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t3" => "required",
            "land_with_code_1_t3" => "nullable|numeric",
            "fax_with_code_1_t3" => "nullable|numeric",
            "mobile_personal_1_t3" => "nullable|numeric",
            "mobile_work_1_t3" => "required|numeric",
            "email_personal_1_t3" => "nullable|email",
            "email_work_1_t3" => "email|required",
            // "website_1_t1" => "",
            "agency_board_1_t3" => "required|numeric",
            "doc_office_1_t3" => "required",
            "reqtype_1_t3" => "required",

            "land_with_ext_1_t3" => "numeric",
            "fax_with_ext_1_t3" => "numeric",
            "mobile_personal_ext_1_t3" => "numeric",
            "mobile_work_ext_1_t3" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t3.required' => __("Full Name is required"),
            'name_1_t3.regex' => __("Full Name must be contain only text"),

            'applicant_status_1_t3.*' => __("Applicant Status is required"),

            "nationality_1_t3.required" => __("Nationality is required"),

            "id_number_1_t3.numeric" => __("ID number should be numeric"),
            "id_number_1_t3.required" => __("ID number is required"),

            "passport_number_1_t3.required" => __("Passport number is required"),
            "passport_number_1_t3.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_1_t3.required" => __("Place of residence is required"),
            "place_of_res_1_t3.regex" => __("Place of residence should contain text and numbers only"),

            "actual_place_of_res_1_t3.required" => __("Actual place of residence is required"),
            "actual_place_of_res_1_t3.regex" => __("Actual place of residence should contain text and numbers only"),

            "corrs_add_1_t3.required" => __("Correspondence address is required"),

            "land_with_code_1_t3.numeric" => __("Landline with code should contain numbers only"),

            "fax_with_code_1_t3.numeric" => __("Fax with with code should contain numbers only"),

            "mobile_personal_1_t3.numeric" => __("Mobile personal should contain numbers only"),

            "mobile_work_1_t3.required" => __("Mobile work is required"),
            "mobile_work_1_t3.numeric" => __("Mobile work should contain numbers only"),

            "email_personal_1_t3.email" => __("Email personal is not in email format"),

            "email_work_1_t3.required" => __("Email work is required"),

            "email_work_1_t3.email" => __("Email work is should be a valid email"),

            "doc_office_1_t3.required" => __("Please select a document office"),

            "reqtype_1_t3.required" => __("Please select a request type"),

            "agency_board_1_t3.required" => __("Agency Bond is Required"),
            "agency_board_1_t3.numeric" => __("Agency Bond should contains Number Only"),

            "land_with_ext_1_t3.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_1_t3.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_1_t3.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_1_t3.required" => __("Mobile Work Code required"),
            "mobile_work_ext_1_t3.numeric" => __("Mobile Work Code should contain numbers only")
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        if(empty($errroList)) {
            if($request->nationality_1_t3) {
                $nationalityName = strtolower($request->nationality_1_t3);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_1_t3) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_1_t3) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }
        $recordArr = Config::get('siteVars.section3Arr');
        $t3_1 =  Config::get('siteVars.t3_1');
        foreach ($t3_1 as $key => $value) {
            $t3_1[$key] = $request->$key;
          }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $recordArr[$key] = $prev_data[$key];
            }
        }

        $recordArr['applicants'] = $t3_1;
        $application->data = json_encode($recordArr);
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Applicants Data added successfully")], 200);


    }
    public function tab3_t2(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_2_t3" => "required|regex:/^[a-zA-Z ]*$/i",
            "nick_name_2_t3" => "nullable|regex:/^[a-zA-Z ]*$/i",
            "id_number_2_t3" => "numeric|required_if:passport_number_2_t3,",
            "passport_number_2_t3" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_2_t3,",
            "place_of_res_2_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "land_with_code_2_t3" => "nullable|numeric",
            "fax_with_code_2_t3" => "nullable|numeric",
            "mobile_personal_2_t3" => "nullable|numeric",
            "mobile_work_2_t3" => "required|numeric",
            "email_personal_2_t3" => "nullable|email",
            "email_work_2_t3" => "email|required",
            // "website_1_t1" => "",

            "land_with_ext_2_t3" => "numeric",
            "fax_with_ext_2_t3" => "numeric",
            "mobile_personal_ext_2_t3" => "numeric",
            "mobile_work_ext_2_t3" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_2_t3.required' => __("Full Name is required"),
            'name_2_t3.regex' => __("Full Name must be contain only text"),

            'nick_name_2_t3.regex' => __("Nick Name must be contain only text"),

            "id_number_2_t3.numeric" => __("ID number should be numeric"),
            "id_number_2_t3.required" => __("ID number is required"),

            "passport_number_2_t3.required" => __("Passport number is required"),
            "passport_number_2_t3.regex" => __("Passport number should contain text and numbers only"),

            "place_of_res_2_t3.required" => __("Place of residence is required"),
            "place_of_res_2_t3.regex" => __("Place of residence should contain text and numbers only"),

            "land_with_code_2_t3.numeric" => __("Landline with code should contain numbers only"),

            "fax_with_code_2_t3.numeric" => __("Fax with with code should contain numbers only"),

            "mobile_personal_2_t3.numeric" => __("Mobile personal should contain numbers only"),

            "mobile_work_2_t3.required" => __("Mobile work is required"),
            "mobile_work_2_t3.numeric" => __("Mobile work should contain numbers only"),

            "email_personal_2_t3.email" => __("Email personal is not in email format"),

            "email_work_2_t3.required" => __("Email work is required"),

            "email_work_2_t3.email" => __("Email work is should be a valid email"),

            "land_with_ext_2_t3.numeric" => __("Land Code should contain numbers only"),
            "fax_with_ext_2_t3.numeric" => __("Fax Code should contain numbers only"),
            "mobile_personal_ext_2_t3.numeric" => __("Mobile Personal Code should contain numbers only"),
            "mobile_work_ext_2_t3.required" => __("Mobile Work Code required"),
            "mobile_work_ext_2_t3.numeric" => __("Mobile Work Code should contain numbers only")
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
        $section3ArrC = Config::get('siteVars.section3Arr');
        $t3_2 =  Config::get('siteVars.t3_2');
        foreach ($t3_2 as $key => $value) {
            $t3_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section3ArrC[$key] = $prev_data[$key];
            }
        }

        $section3ArrC['owner_data'] = $t3_2;
        $application->data = json_encode($section3ArrC);
        $application->last_tab = '1';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Owner Data added successfully")], 200);


    }
    public function tab3_t3(Request $request) {
        $validator = Validator::make($request->all(), [
            "center_name_arabic_3_t3" => "required|regex:/[اأإء-ي]/ui",
            "center_name_english_3_t3" => "required|regex:/^[a-zA-Z ]*$/i",
            "license_number_ministry_of_3_t3" => "required",
            "membership_number_3_t3" => "required",
            "commercial_reg_no_3_t3" => "required|numeric",
            "tax_card_no_3_t3" => "required|numeric",
            "address_of_the_center_3_t3" => "required",
            "landline_no_3_t3" => "nullable|numeric",
            "fax_no_3_t3" => "nullable|numeric",
            "mobile_no1_3_t3" => "required|numeric",
            "mobile_no2_3_t3" => "nullable|numeric",
            "email_3_t3" => "required|email",
            "marine_activity_authorized_3_t3" => "required",
            "unit_area_of_activity_3_t3" => "required",

            "telephone_ext_3_t3" => "numeric",
            "fax_with_ext_3_t3" => "numeric",
            "mobile_no1_ext_3_t3" => "required|numeric",
            "mobile_no2_ext_3_t3" => "numeric",

            // "notes_1_t1" => "",
        ], [
            "center_name_arabic_3_t3.required" => __("Center Name Arabic is required"),
            "center_name_arabic_3_t3.regex" => __("Center Name Arabic should contain arabic only"),

            "center_name_english_3_t3.required" => __("Center Name (ENGLISH) is required"),
            "center_name_english_3_t3.regex" => __("Center Name (ENGLISH) should contain english only"),

            "license_number_ministry_of_3_t3.required" => __("License number of the Ministry of Tourism is required"),
            "membership_number_3_t3.required" => __("Membership Number of Diving Tourism  is required"),

            "commercial_reg_no_3_t3.required" => __("Commercial Registration No is required"),
            "commercial_reg_no_3_t3.numeric" => __("Commercial Registration No is number only"),

            "tax_card_no_3_t3.required" => __("Tax card number is required"),
            "tax_card_no_3_t3.numeric" => __("Tax card number should contian number only"),

            "address_of_the_center_3_t3.required" => __("Address of the Center is required"),

            "landline_no_3_t3.numeric" => __("Landline number should contain number only"),
            "fax_no_3_t3.numeric" => __("FAX NO should contain number only"),

            "mobile_no1_3_t3.required" => __("MOBILE NO1 is required"),
            "mobile_no1_3_t3.numeric" => __("MOBILE NO1 should contain number only"),

            "mobile_no2_3_t3.numeric" => __("MOBILE NO 2 should contain number only"),

            "email_3_t3.required" => __("EMAIL is required"),
            "email_3_t3.email" => __("EMAIL should contain email only"),

            "marine_activity_authorized_3_t3.required" => __("Marine activities to be authorized is required"),
            "unit_area_of_activity_3_t3.required" => __("Unit's area of ​​activity (as per the attached statement and maps) is required"),


            "telephone_ext_3_t3.numeric" => __("Telephone Code should contain numbers only"),
            "fax_with_ext_3_t3.numeric" => __("Fax Code should contain numbers only"),
            "mobile_no2_ext_3_t3.numeric" => __("Mobile No 2 should contain numbers only"),
            "mobile_no1_ext_3_t3.required" => __("Mobile No 1 Code required"),
            "mobile_no1_ext_3_t3.numeric" => __("Mobile No 1 Code should contain numbers only")
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
        $section3ArrC = Config::get('siteVars.section3Arr');
        $t3_3 =  Config::get('siteVars.t3_3');
        foreach ($t3_3 as $key => $value) {
            $t3_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section3ArrC[$key] = $prev_data[$key];
            }
        }

        $section3ArrC['center_data'] = $t3_3;
        $application->data = json_encode($section3ArrC);
        $application->last_tab = '2';
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("Center Data added successfully")], 200);


    }
    public function tab3_t4(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => __("No of Branch is required"),
            "payment_fees.numeric" => __("No of Branch should numeric"),

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

        $section3ArrC = Config::get('siteVars.section3Arr');
        $t3_4 =  Config::get('siteVars.t3_4');
        foreach ($t3_4 as $key => $value) {
          $t3_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => [__("Oops! some error occured!")]]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section3ArrC[$key] = $prev_data[$key];
            }
        }

        $section3ArrC['branch_payment'] = $t3_4;
        $application->data = json_encode($section3ArrC);
        $application->no_of_branches = $request->payment_fees;
        // $application->amount = $request->payment_fees;
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => __("No of branches added successfully")], 200);
    }
    public function tab3_t5(Request $request) {
        $request['last_tab'] = 4;
        $this->upSectionType = 't3';
        return $this->upload_doc($request);
    }



    public function confirm_tab1(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->where('user_id', auth()->user()->id)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_vessel', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Vessle Data Tab first']]], 422);
                } elseif(!array_key_exists('marine_unit', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Marine Unit Tab first']]], 422);
                } elseif(!array_key_exists('vessel', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Vessel Data Tab first']]], 422);
                } elseif(!array_key_exists('water_used_im', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Water Used In The Unit Data Tab first']]], 422);
                } elseif(!array_key_exists('sanitation', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Sanitation Tab first']]], 422);
                } elseif(!array_key_exists('waste_liquid', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Waste liquid Tab first']]], 422);
                } elseif(!array_key_exists('vessel_engine', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Vessel Engine Tab first']]], 422);
                } elseif(!array_key_exists('solid_waste', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Solid Waste Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branches & Payment Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }

    public function confirm_tab2(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Owner Data Tab first']]], 422);
                } elseif(!array_key_exists('center_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Center Data Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branch Payment Data Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }

    public function confirm_tab3(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Owner Data Tab first']]], 422);
                } elseif(!array_key_exists('center_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Center Data Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branch Payment Data Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }

    public function confirm_tab4(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->where('user_id', auth()->user()->id)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Owner Data Tab first']]], 422);
                } elseif(!array_key_exists('center_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Center Data Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branch Payment Data Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }

    public function confirm_tab5(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->where('user_id', auth()->user()->id)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Owner Data Tab first']]], 422);
                } elseif(!array_key_exists('center_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Center Data Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branch Payment Data Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }

    public function confirm_tab6(Request $request) {
        $validator = Validator::make($request->all(), [
            "application_no" => "required",
        ], [
            "application_no.required" => "Application no required",
        ]);

        if($request->application_no) {
            $application = Application::where('application_no', $request->application_no)->where('user_id', auth()->user()->id)->get()->first();
            $data = json_decode($application->data, true);
            if($data) {
                if(!array_key_exists('applicants', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Applicants Data Tab first']]], 422);
                } elseif(!array_key_exists('owner_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Owner Data Tab first']]], 422);
                } elseif(!array_key_exists('center_data', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Center Data Tab first']]], 422);
                } elseif(!array_key_exists('branch_payment', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Branch Payment Data Tab first']]], 422);
                }elseif(!array_key_exists('upload_doc', $data)) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save Upload Document Tab first']]], 422);
                } else {
                    $application->status = 'review';
                    $application->updated_at = date('Y-m-d H:i:s');
                    $application->save();
                    return response()->json(['type' => 'success', 'text' => 'Application Confirmed'], 200);
                }
            } else {
                $errorArr = array_slice($errroList, 0, 1);
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured, Please save all the section before.']]], 422);
            }
        }
    }


    /**
     * Section Type 4
     */
    public function load_form_4($regtype, $application) {
        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $reqtype = $this->reqtype;
        $countries = $this->countries;
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;
        $doctype = $this->doctype;

        // Tab1
        $tab1 = Config::get('siteVars.t4_1');
        // Tab2
        $tab2 = Config::get('siteVars.t4_2');
        // Tab3
        $tab3 = Config::get('siteVars.t4_3');
        // Tab4
        $tab4 = Config::get('siteVars.t4_4');
        // Tab4
        $tab5 = Config::get('siteVars.t4_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            $applicants_d = $decoded['applicants'];
            foreach ($tab1 as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $tab1[$key] =  $applicants_d[$key];
                }
            }
            $data= $decoded['owner_data'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab2[$key] =  $data[$key];
                }
            }
            $data= $decoded['center_data'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab3[$key] =  $data[$key];
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $data= $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $data)) {
                        $tab4[$key] =  $data[$key];
                    }
                }
            } else {
                $tab4['branch_payment'] = '';
            }

            $upload_doc = $decoded['upload_doc'];
            $tab5 = $upload_doc;
        }

        // dd($tab2);
        // dd($tab2['fax_with_code_2_t4']);

        $upload_doc_required = $this->upload_doc_required;
        return view('application.form_4', compact('application', 'regtype', 'applicant_status', 'nationality', 'countries', 'reqtype', 'marine_activity', 'unit_area_of_activity', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'doctype', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5'));

    }
    public function tab4_t1(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_1_t4" => "required|regex:/^[a-zA-Z ]*$/i",
            "applicant_status_1_t4" => "required",
            "nationality_1_t4" => "required",
            "id_number_1_t4" => "nullable|numeric",
            "passport_number_1_t4" => "nullable|regex:/^[a-zA-Z0-9 ]*$/i",
            "place_of_res_1_t4" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t4" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t4" => "required",
            "land_with_code_1_t4" => "nullable|numeric",
            "fax_with_code_1_t4" => "nullable|numeric",
            "mobile_personal_1_t4" => "nullable|numeric",
            "mobile_work_1_t4" => "required|numeric",
            "email_personal_1_t4" => "email",
            "email_work_1_t4" => "email|required",
            // "website_1_t1" => "",
            "agency_board_1_t4" => "required|numeric",
            "doc_office_1_t4" => "required",
            "reqtype_1_t4" => "required",

            "land_with_ext_1_t4" => "numeric",
            "fax_with_ext_1_t4" => "numeric",
            "mobile_personal_ext_1_t4" => "numeric",
            "mobile_work_ext_1_t4" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t4.required' => 'Full Name is required',
            'name_1_t4.regex' => 'Full Name must be contain only text',

            'applicant_status_1_t4.*' => 'Applicant Status is required',

            "nationality_1_t4.required" => "Nationality is required",

            "id_number_1_t4.numeric" => "ID number should be numeric",
            "id_number_1_t4.required" => "ID number is required",

            "passport_number_1_t4.required" => "Passport number is required",
            "passport_number_1_t4.regex" => "Passport number should contain text and numbers only",

            "place_of_res_1_t4.required" => "Place of residence is required",
            "place_of_res_1_t4.regex" => "Place of residence should contain text and numbers only",

            "actual_place_of_res_1_t4.required" => "Actual place of residence is required",
            "actual_place_of_res_1_t4.regex" => "Actual place of residence should contain text and numbers only",

            "corrs_add_1_t4.required" => "Correspondence address is required",

            "land_with_code_1_t4.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_1_t4.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_1_t4.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_1_t4.required" => "Mobile work is required",
            "mobile_work_1_t4.numeric" => "Mobile work should contain numbers only",

            "email_personal_1_t4.email" => "Email personal is not in email format",

            "email_work_1_t4.required" => "Email work is required",

            "email_work_1_t4.email" => "Email work is should be a valid email",

            "doc_office_1_t4.required" => "Please select a document office",

            "reqtype_1_t4.required" => "Please select a request type",

            "agency_board_1_t4.required" => "Agency Bond is Required",
            "agency_board_1_t4.numeric" => "Agency Bond should contains Number Only",

            "land_with_ext_1_t4.numeric" => "Land Code should contain numbers only",
            "fax_with_ext_1_t4.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_1_t4.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_1_t4.required" => "Mobile Work Code required",
            "mobile_work_ext_1_t4.numeric" => "Mobile Work Code should contain numbers only"
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        if(empty($errroList)) {
            if($request->nationality_1_t4) {
                $nationalityName = strtolower($request->nationality_1_t4);
                if($nationalityName == 'egyptian') {
                    if(!$request->id_number_1_t4) {
                        $errroList[] = 'ID number is mandatory if nationality is Egyptian';
                    }
                }
                else {
                    if(!$request->passport_number_1_t4) {
                        $errroList[] = 'Passport number is mandatory if nationality is not Egyptian';
                    }
                }
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }
        $recordArr = Config::get('siteVars.section4Arr');
        $t4_1 =  Config::get('siteVars.t4_1');
        foreach ($t4_1 as $key => $value) {
            $t4_1[$key] = $request->$key;
          }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $recordArr[$key] = $prev_data[$key];
            }
        }

        $recordArr['applicants'] = $t4_1;
        $application->data = json_encode($recordArr);
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Applicants Data added successfully'], 200);


    }
    public function tab4_t2(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_2_t4" => "required|regex:/^[a-zA-Z ]*$/i",
            "nick_name_2_t4" => "nullable|regex:/^[a-zA-Z ]*$/i",
            "id_number_2_t4" => "numeric|required_if:passport_number_2_t4,",
            "passport_number_2_t4" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_2_t4,",
            "place_of_res_2_t4" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "land_with_code_2_t4" => "nullable|numeric",
            "fax_with_code_2_t4" => "nullable|numeric",
            "mobile_personal_2_t4" => "nullable|numeric",
            "mobile_work_2_t4" => "required|numeric",
            "email_personal_2_t4" => "email",
            "email_work_2_t4" => "email|required",
            // "website_1_t1" => "",

            "land_with_ext_2_t4" => "numeric",
            "fax_with_code_ext_2_t4" => "numeric",
            "mobile_personal_ext_2_t4" => "numeric",
            "mobile_work_ext_2_t4" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_2_t4.required' => 'Full Name is required',
            'name_2_t4.regex' => 'Full Name must be contain only text',

            'nick_name_2_t4.regex' => 'Nick Name must be contain only text',

            "id_number_2_t4.numeric" => "ID number should be numeric",
            "id_number_2_t4.required" => "ID number is required",

            "passport_number_2_t4.required" => "Passport number is required",
            "passport_number_2_t4.regex" => "Passport number should contain text and numbers only",

            "place_of_res_2_t4.required" => "Place of residence is required",
            "place_of_res_2_t4.regex" => "Place of residence should contain text and numbers only",

            "land_with_code_2_t4.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_2_t4.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_2_t4.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_2_t4.required" => "Mobile work is required",
            "mobile_work_2_t4.numeric" => "Mobile work should contain numbers only",

            "email_personal_2_t4.email" => "Email personal is not in email format",

            "email_work_2_t4.required" => "Email work is required",

            "email_work_2_t4.email" => "Email work is should be a valid email",

            "land_with_ext_2_t4.numeric" => "Land Code should contain numbers only",
            "fax_with_code_ext_2_t4.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_2_t4.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_2_t4.required" => "Mobile Work Code required",
            "mobile_work_ext_2_t4.numeric" => "Mobile Work Code should contain numbers only"
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
        $section4ArrC = Config::get('siteVars.section4Arr');
        $t4_2 =  Config::get('siteVars.t4_2');
        foreach ($t4_2 as $key => $value) {
            $t4_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section4ArrC[$key] = $prev_data[$key];
            }
        }

        $section4ArrC['owner_data'] = $t4_2;
        $application->data = json_encode($section4ArrC);
        $application->last_tab = '1';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Owner Data added successfully'], 200);


    }
    public function tab4_t3(Request $request) {
        $validator = Validator::make($request->all(), [
            "company_name_arabic_3_t4" => "required|regex:/[اأإء-ي]/ui",
            "company_name_english_3_t4" => "required|regex:/^[a-zA-Z ]*$/i",
            "license_number_ministry_of_3_t4" => "required",
            "membership_number_3_t4" => "required",
            "commercial_reg_no_3_t4" => "required|numeric",
            "tax_card_no_3_t4" => "required|numeric",
            "address_of_the_center_3_t4" => "required",
            "landline_no_3_t4" => "nullable|numeric",
            "fax_no_3_t4" => "nullable|numeric",
            "mobile_no1_3_t4" => "required|numeric",
            "mobile_no2_3_t4" => "nullable|numeric",
            "email_3_t4" => "required|email",
            "marine_activity_authorized_3_t4" => "required",
            "unit_area_of_activity_3_t4" => "required",

            "landline_no_ext_3_t4" => "numeric",
            "fax_no_ext_3_t4" => "numeric",
            "mobile_no1_ext_3_t4" => "required|numeric",
            "mobile_no2_ext_3_t4" => "numeric",

            // "notes_1_t1" => "",
        ], [
            "company_name_arabic_3_t4.required" => "COMPANY Name (Arabic) is required",
            "company_name_arabic_3_t4.regex" => "COMPANY Name (Arabic) should contain arabic only",

            "company_name_english_3_t4.required" => "COMPANY Name (ENGLISH) is required",
            "company_name_english_3_t4.regex" => "COMPANY Name (ENGLISH) should contain english only",

            "license_number_ministry_of_3_t4.required" => "License number of the Ministry of Tourism is required",
            "membership_number_3_t4.required" => "Membership Number of Diving Tourism  is required",

            "commercial_reg_no_3_t4.required" => "Commercial Registration No is required",
            "commercial_reg_no_3_t4.numeric" => "Commercial Registration No is number only",

            "tax_card_no_3_t4.required" => "Tax card number is required",
            "tax_card_no_3_t4.numeric" => "Tax card number should contian number only",

            "address_of_the_center_3_t4.required" => "Address of the Center is required",

            "landline_no_3_t4.numeric" => "Landline number should contain number only",
            "fax_no_3_t4.numeric" => "FAX NO should contain number only",

            "mobile_no1_3_t4.required" => "MOBILE NO1 is required",
            "mobile_no1_3_t4.numeric" => "MOBILE NO1 should contain number only",

            "mobile_no2_3_t4.numeric" => "MOBILE NO 2 should contain number only",

            "email_3_t4.required" => "EMAIL is required",
            "email_3_t4.email" => "EMAIL should contain email only",

            "marine_activity_authorized_3_t4.required" => "Marine activities to be authorized is required",
            "unit_area_of_activity_3_t4.required" => "Unit's area of ​​activity (as per the attached statement and maps) is required",


            "landline_no_ext_3_t4.numeric" => "Landline Code should contain numbers only",
            "fax_no_ext_3_t4.numeric" => "Fax Code should contain numbers only",
            "mobile_no2_ext_3_t4.numeric" => "Mobile No 2 should contain numbers only",
            "mobile_no1_ext_3_t4.required" => "Mobile No 1 Code required",
            "mobile_no1_ext_3_t4.numeric" => "Mobile No 1 Code should contain numbers only"
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
        $section4ArrC = Config::get('siteVars.section4Arr');
        $t4_3 =  Config::get('siteVars.t4_3');
        foreach ($t4_3 as $key => $value) {
            $t4_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section4ArrC[$key] = $prev_data[$key];
            }
        }

        $section4ArrC['center_data'] = $t4_3;
        $application->data = json_encode($section4ArrC);
        $application->last_tab = '2';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Center Data added successfully'], 200);


    }
    public function tab4_t4(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => "No Of Branch is required",
            "payment_fees.numeric" => "No Of Branch should numeric",

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

        $section4ArrC = Config::get('siteVars.section4Arr');
        $t4_4 =  Config::get('siteVars.t4_4');
        foreach ($t4_4 as $key => $value) {
          $t4_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section4ArrC[$key] = $prev_data[$key];
            }
        }

        $section4ArrC['branch_payment'] = $t4_4;
        $application->data = json_encode($section4ArrC);
        $application->no_of_branches = $request->payment_fees;
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => __('No of branches added successfully')], 200);
    }
    public function tab4_t5(Request $request) {
        $request['last_tab'] = 4;
        $this->upSectionType = 't4';
        return $this->upload_doc($request);
    }

    /**
     * Section Type 5
     */
    public function load_form_5($regtype, $application) {
        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $reqtype = $this->reqtype;
        $countries = $this->countries;
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;
        $doctype = $this->doctype;

        // Tab1
        $tab1 = Config::get('siteVars.t5_1');
        // Tab2
        $tab2 = Config::get('siteVars.t5_2');
        // Tab3
        $tab3 = Config::get('siteVars.t5_3');
        // Tab4
        $tab4 = Config::get('siteVars.t5_4');
        // Tab4
        $tab5 = Config::get('siteVars.t5_5');

        if($application->data != null) {
            $decoded = json_decode($application->data, true);
            $applicants_d = $decoded['applicants'];
            foreach ($tab1 as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $tab1[$key] =  $applicants_d[$key];
                }
            }
            $data= $decoded['owner_data'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab2[$key] =  $data[$key];
                }
            }
            $data= $decoded['center_data'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab3[$key] =  $data[$key];
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $data= $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $data)) {
                        $tab4[$key] =  $data[$key];
                    }
                }
            } else {
                $tab4['branch_payment'] = '';
            }

            $upload_doc = $decoded['upload_doc'];
            $tab5 = $upload_doc;
        }

        // dd($tab3);
        // dd($tab2['fax_with_code_2_t4']);

        return view('application.form_5', compact('application', 'regtype', 'applicant_status', 'nationality', 'countries', 'reqtype', 'marine_activity', 'unit_area_of_activity', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'doctype', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5'));

    }

    public function tab5_t1(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_1_t5" => "required|regex:/^[a-zA-Z ]*$/i",
            "applicant_status_1_t5" => "required",
            // "nationality_1_t4" => "required",
            "id_number_1_t5" => "numeric|required_if:passport_number_2_t3,",
            "passport_number_1_t5" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_1_t5,",
            "place_of_res_1_t5" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t5" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t5" => "required",
            "land_with_code_1_t5" => "nullable|numeric",
            "fax_with_code_1_t5" => "nullable|numeric",
            "mobile_personal_1_t5" => "nullable|numeric",
            "mobile_work_1_t5" => "required|numeric",
            "email_personal_1_t5" => "email",
            "email_work_1_t5" => "email|required",
            // "website_1_t1" => "",
            "agency_board_1_t5" => "required|numeric",
            "doc_office_1_t5" => "required",
            "reqtype_1_t5" => "required",

            "land_with_code_ext_1_t5" => "numeric",
            "fax_with_code_ext_1_t5" => "numeric",
            "mobile_personal_ext_1_t5" => "numeric",
            "mobile_work_ext_1_t5" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t5.required' => 'Full Name is required',
            'name_1_t5.regex' => 'Full Name must be contain only text',

            'applicant_status_1_t5.*' => 'Applicant Status is required',

            // "nationality_1_t4.required" => "Nationality is required",

            "id_number_1_t5.numeric" => "ID number should be numeric",
            "id_number_1_t5.required" => "ID number is required",

            "passport_number_1_t5.required" => "Passport number is required",
            "passport_number_1_t5.regex" => "Passport number should contain text and numbers only",

            "place_of_res_1_t5.required" => "Place of residence is required",
            "place_of_res_1_t5.regex" => "Place of residence should contain text and numbers only",

            "actual_place_of_res_1_t5.required" => "Actual place of residence is required",
            "actual_place_of_res_1_t5.regex" => "Actual place of residence should contain text and numbers only",

            "corrs_add_1_t5.required" => "Correspondence address is required",

            "land_with_code_1_t5.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_1_t5.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_1_t5.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_1_t5.required" => "Mobile work is required",
            "mobile_work_1_t5.numeric" => "Mobile work should contain numbers only",

            "email_personal_1_t5.email" => "Email personal is not in email format",

            "email_work_1_t5.required" => "Email work is required",

            "email_work_1_t5.email" => "Email work is should be a valid email",

            "doc_office_1_t5.required" => "Please select a document office",

            "reqtype_1_t5.required" => "Please select a request type",

            "agency_board_1_t5.required" => "Agency Bond is Required",
            "agency_board_1_t5.numeric" => "Agency Bond should contains Number Only",

            "land_with_code_ext_1_t5.numeric" => "Land Code should contain numbers only",
            "fax_with_code_ext_1_t5.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_1_t5.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_1_t5.required" => "Mobile Work Code required",
            "mobile_work_ext_1_t5.numeric" => "Mobile Work Code should contain numbers only"
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
        $recordArr = Config::get('siteVars.section5Arr');
        $t5_1 =  Config::get('siteVars.t5_1');
        foreach ($t5_1 as $key => $value) {
            $t5_1[$key] = $request->$key;
          }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $recordArr[$key] = $prev_data[$key];
            }
        }

        $recordArr['applicants'] = $t5_1;
        $application->data = json_encode($recordArr);
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Applicants Data added successfully'], 200);


    }

    public function tab5_t2(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_2_t5" => "required|regex:/^[a-zA-Z ]*$/i",
            "nick_name_2_t5" => "nullable|regex:/^[a-zA-Z ]*$/i",
            "id_number_2_t5" => "numeric|required_if:passport_number_2_t3,",
            "passport_number_2_t5" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_2_t5,",
            "place_of_res_2_t5" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_2_t5" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "land_with_code_2_t5" => "nullable|numeric",
            "fax_with_code_2_t5" => "nullable|numeric",
            "mobile_personal_2_t5" => "nullable|numeric",
            "mobile_work_2_t5" => "required|numeric",
            "email_personal_2_t5" => "email",
            "email_work_2_t5" => "email|required",
            // "website_1_t1" => "",

            "land_with_code_ext_2_t5" => "numeric",
            "fax_with_code_ext_2_t5" => "numeric",
            "mobile_personal_ext_2_t5" => "numeric",
            "mobile_work_ext_2_t5" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_2_t5.required' => 'Full Name is required',
            'name_2_t5.regex' => 'Full Name must be contain only text',

            'nick_name_2_t5.regex' => 'Nick Name must be contain only text',

            "id_number_2_t5.numeric" => "ID number should be numeric",
            "id_number_2_t5.required" => "ID number is required",

            "passport_number_2_t5.required" => "Passport number is required",
            "passport_number_2_t5.regex" => "Passport number should contain text and numbers only",

            "place_of_res_2_t5.required" => "Place of residence is required",
            "place_of_res_2_t5.regex" => "Place of residence should contain text and numbers only",

            "actual_place_of_res_2_t5.required" => "Actual place of residence is required",
            "actual_place_of_res_2_t5.regex" => "Actual place of residence should contain text and numbers only",

            "land_with_code_2_t5.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_2_t5.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_2_t5.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_2_t5.required" => "Mobile work is required",
            "mobile_work_2_t5.numeric" => "Mobile work should contain numbers only",

            "email_personal_2_t5.email" => "Email personal is not in email format",

            "email_work_2_t5.required" => "Email work is required",

            "email_work_2_t5.email" => "Email work is should be a valid email",

            "land_with_code_ext_2_t5.numeric" => "Land Code should contain numbers only",
            "fax_with_code_ext_2_t5.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_2_t5.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_2_t5.required" => "Mobile Work Code required",
            "mobile_work_ext_2_t5.numeric" => "Mobile Work Code should contain numbers only"
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
        $section5Arr = Config::get('siteVars.section5Arr');
        $t5_2 =  Config::get('siteVars.t5_2');
        foreach ($t5_2 as $key => $value) {
            $t5_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section5Arr[$key] = $prev_data[$key];
            }
        }

        $section5Arr['owner_data'] = $t5_2;
        $application->data = json_encode($section5Arr);
        $application->last_tab = '1';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Owner Data added successfully'], 200);


    }

    public function tab5_t3(Request $request) {
        $validator = Validator::make($request->all(), [
            "entity_name_arabic_3_t5" => "required|regex:/[اأإء-ي]/ui",
            "entity_name_english_3_t5" => "required|regex:/^[a-zA-Z ]*$/i",
            // "license_number_ministry_of_3_t3" => "required",
            "membership_number_3_t5" => "required",
            "commercial_reg_no_3_t5" => "required|numeric",
            // "tax_card_no_3_t3" => "required|numeric",
            "address_of_the_entity_3_t5" => "required",
            "landline_no_3_t5" => "nullable|numeric",
            "fax_no_3_t5" => "nullable|numeric",
            "mobile_no1_3_t5" => "required|numeric",
            "mobile_no2_3_t5" => "nullable|numeric",
            "email_3_t5" => "required|email",
            "marine_activity_authorized_3_t5" => "required",
            "unit_area_of_activity_3_t5" => "required",

            "landline_no_ext_3_t5" => "numeric",
            "fax_no_3_ext_t5" => "numeric",
            "mobile_no1_ext_3_t5" => "required|numeric",
            "mobile_no2_ext_3_t5" => "numeric",

            // "notes_1_t1" => "",
        ], [
            "entity_name_arabic_3_t5.required" => "Center Name Arabic is required",
            "entity_name_arabic_3_t5.regex" => "Center Name Arabic should contain arabic only",

            "entity_name_english_3_t5.required" => "Center Name (ENGLISH) is required",
            "entity_name_english_3_t5.regex" => "Center Name (ENGLISH) should contain english only",

            // "license_number_ministry_of_3_t3.required" => "License number of the Ministry of Tourism is required",
            "membership_number_3_t5.required" => "Membership Number of Diving Tourism  is required",

            "commercial_reg_no_3_t5.required" => "Commercial Registration No is required",
            "commercial_reg_no_3_t5.numeric" => "Commercial Registration No is number only",

            // "tax_card_no_3_t3.required" => "Tax card number is required",
            // "tax_card_no_3_t3.numeric" => "Tax card number should contian number only",

            "address_of_the_entity_3_t5.required" => "Address of the Center is required",

            "landline_no_3_t5.numeric" => "Landline number should contain number only",
            "fax_no_3_t5.numeric" => "FAX NO should contain number only",

            "mobile_no1_3_t5.required" => "MOBILE NO1 is required",
            "mobile_no1_3_t5.numeric" => "MOBILE NO1 should contain number only",

            "mobile_no2_3_t5.numeric" => "MOBILE NO 2 should contain number only",

            "email_3_t5.required" => "EMAIL is required",
            "email_3_t5.email" => "EMAIL should contain email only",

            "marine_activity_authorized_3_t5.required" => "Marine activities to be authorized is required",
            "unit_area_of_activity_3_t5.required" => "Unit's area of ​​activity (as per the attached statement and maps) is required",


            "landline_no_ext_3_t5.numeric" => "Landline Code should contain numbers only",
            "fax_no_3_ext_t5.numeric" => "Fax Code should contain numbers only",
            "mobile_no2_ext_3_t5.numeric" => "Mobile No 2 should contain numbers only",
            "mobile_no1_ext_3_t5.required" => "Mobile No 1 Code required",
            "mobile_no1_ext_3_t5.numeric" => "Mobile No 1 Code should contain numbers only"
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
        $section5ArrC = Config::get('siteVars.section5Arr');
        $t5_3 =  Config::get('siteVars.t5_3');
        foreach ($t5_3 as $key => $value) {
            $t5_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section5ArrC[$key] = $prev_data[$key];
            }
        }

        $section5ArrC['center_data'] = $t5_3;
        $application->data = json_encode($section5ArrC);
        $application->last_tab = '2';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Center Data added successfully'], 200);


    }

    public function tab5_t4(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => "No Of Branch is required",
            "payment_fees.numeric" => "No Of Branch should numeric",

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

        $section5ArrC = Config::get('siteVars.section5Arr');
        $t5_4 =  Config::get('siteVars.t5_4');
        foreach ($t5_4 as $key => $value) {
          $t5_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section5ArrC[$key] = $prev_data[$key];
            }
        }

        $section5ArrC['branch_payment'] = $t5_4;
        $application->data = json_encode($section5ArrC);
        $application->no_of_branches = $request->payment_fees;
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'No of branches added successfully'], 200);
    }

    public function tab5_t5(Request $request) {
        $request['last_tab'] = 4;
        $this->upSectionType = 't5';
        return $this->upload_doc($request);
    }


    /**
     * Section Type 6
     */
    public function load_form_6($regtype, $application) {
        $applicant_status = $this->applicant_status;
        $nationality = $this->nationality;
        $reqtype = $this->reqtype;
        $countries = $this->countries;
        $marine_activity = $this->marine_activity;
        $unit_area_of_activity = $this->unit_area_of_activity;
        $upload_doc_name = $this->upload_doc_name;
        $upload_doc_type = $this->upload_doc_type;
        $upload_doc_required = $this->upload_doc_required;
        $doctype = $this->doctype;

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
            $applicants_d = $decoded['applicants'];
            foreach ($tab1 as $key => $value) {
                if(array_key_exists($key, $applicants_d)) {
                    $tab1[$key] =  $applicants_d[$key];
                }
            }
            $data= $decoded['owner_data'];
            foreach ($tab2 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab2[$key] =  $data[$key];
                }
            }
            $data= $decoded['center_data'];
            foreach ($tab3 as $key => $value) {
                if(array_key_exists($key, $data)) {
                    $tab3[$key] =  $data[$key];
                }
            }
            if(array_key_exists('branch_payment', $decoded)) {
                $data= $decoded['branch_payment'];
                foreach ($tab4 as $key => $value) {
                    if(array_key_exists($key, $data)) {
                        $tab4[$key] =  $data[$key];
                    }
                }
            } else {
                $tab4['branch_payment'] = '';
            }

            $upload_doc = $decoded['upload_doc'];
            $tab5 = $upload_doc;
        }

        // dd($tab1);
        // dd($tab2['fax_with_code_2_t4']);

        return view('application.form_6', compact('application', 'regtype', 'applicant_status', 'nationality', 'countries', 'reqtype', 'marine_activity', 'unit_area_of_activity', 'upload_doc_name', 'upload_doc_type', 'upload_doc_required', 'doctype', 'tab1', 'tab2', 'tab3', 'tab4', 'tab5'));

    }
    public function tab6_t1(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_1_t6" => "required|regex:/^[a-zA-Z ]*$/i",
            "applicant_status_1_t6" => "required",
            // "nationality_1_t3" => "required",
            "id_number_1_t6" => "numeric|required_if:passport_number_2_t3,",
            "passport_number_1_t6" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_1_t6,",
            "place_of_res_1_t6" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_1_t6" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "corrs_add_1_t6" => "required",
            "land_with_code_1_t6" => "nullable|numeric",
            "fax_with_code_1_t6" => "nullable|numeric",
            "mobile_personal_1_t6" => "nullable|numeric",
            "mobile_work_1_t6" => "required|numeric",
            "email_personal_1_t6" => "email",
            "email_work_1_t6" => "email|required",
            // "website_1_t1" => "",
            "agency_board_1_t6" => "required|numeric",
            "doc_office_1_t6" => "required",
            "reqtype_1_t6" => "required",

            "land_with_code_ext_1_t6" => "numeric",
            "fax_with_code_ext_1_t6" => "numeric",
            "mobile_personal_ext_1_t6" => "numeric",
            "mobile_work_ext_1_t6" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_1_t6.required' => 'Full Name is required',
            'name_1_t6.regex' => 'Full Name must be contain only text',

            'applicant_status_1_t6.*' => 'Applicant Status is required',

            // "nationality_1_t3.required" => "Nationality is required",

            "id_number_1_t6.numeric" => "ID number should be numeric",
            "id_number_1_t6.required" => "ID number is required",

            "passport_number_1_t6.required" => "Passport number is required",
            "passport_number_1_t6.regex" => "Passport number should contain text and numbers only",

            "place_of_res_1_t6.required" => "Place of residence is required",
            "place_of_res_1_t6.regex" => "Place of residence should contain text and numbers only",

            "actual_place_of_res_1_t6.required" => "Actual place of residence is required",
            "actual_place_of_res_1_t6.regex" => "Actual place of residence should contain text and numbers only",

            "corrs_add_1_t6.required" => "Correspondence address is required",

            "land_with_code_1_t6.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_1_t6.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_1_t6.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_1_t6.required" => "Mobile work is required",
            "mobile_work_1_t6.numeric" => "Mobile work should contain numbers only",

            "email_personal_1_t6.email" => "Email personal is not in email format",

            "email_work_1_t6.required" => "Email work is required",

            "email_work_1_t6.email" => "Email work is should be a valid email",

            "doc_office_1_t6.required" => "Please select a document office",

            "reqtype_1_t6.required" => "Please select a request type",

            "agency_board_1_t6.required" => "Agency Bond is Required",
            "agency_board_1_t6.numeric" => "Agency Bond should contains Number Only",

            "land_with_code_ext_1_t6.numeric" => "Land Code should contain numbers only",
            "fax_with_code_ext_1_t6.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_1_t6.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_1_t6.required" => "Mobile Work Code required",
            "mobile_work_ext_1_t6.numeric" => "Mobile Work Code should contain numbers only"
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
        $recordArr = Config::get('siteVars.section6Arr');
        $t6_1 =  Config::get('siteVars.t6_1');
        foreach ($t6_1 as $key => $value) {
            $t6_1[$key] = $request->$key;
          }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $recordArr[$key] = $prev_data[$key];
            }
        }

        $recordArr['applicants'] = $t6_1;
        $application->data = json_encode($recordArr);
        $application->last_tab = '0';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Applicants Data added successfully'], 200);


    }

    public function tab6_t2(Request $request) {
        $validator = Validator::make($request->all(), [
            "name_2_t6" => "required|regex:/^[a-zA-Z ]*$/i",
            "nick_name_2_t6" => "nullable|regex:/^[a-zA-Z ]*$/i",
            "id_number_2_t6" => "numeric|required_if:passport_number_2_t6,",
            "passport_number_2_t6" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_2_t6,",
            "place_of_res_2_t6" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "actual_place_of_res_2_t6" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
            "land_with_code_2_t6" => "nullable|numeric",
            "fax_with_code_2_t6" => "nullable|numeric",
            "mobile_personal_2_t6" => "nullable|numeric",
            "mobile_work_2_t6" => "required|numeric",
            "email_personal_2_t6" => "email",
            "email_work_2_t6" => "email|required",
            // "website_1_t1" => "",

            "land_with_code_ext_2_t6" => "numeric",
            "fax_with_code_ext_2_t6" => "numeric",
            "mobile_personal_ext_2_t6" => "numeric",
            "mobile_work_ext_2_t6" => "required|numeric",

            // "notes_1_t1" => "",
        ], [
            'name_2_t6.required' => 'Full Name is required',
            'name_2_t6.regex' => 'Full Name must be contain only text',

            'nick_name_2_t6.regex' => 'Nick Name must be contain only text',

            "id_number_2_t6.numeric" => "ID number should be numeric",
            "id_number_2_t6.required" => "ID number is required",

            "passport_number_2_t6.required" => "Passport number is required",
            "passport_number_2_t6.regex" => "Passport number should contain text and numbers only",

            "place_of_res_2_t6.required" => "Place of residence is required",
            "place_of_res_2_t6.regex" => "Place of residence should contain text and numbers only",

            "actual_place_of_res_2_t6.required" => "Actual Place of residence is required",
            "actual_place_of_res_2_t6.regex" => "Actual Place of residence should contain text and numbers only",

            "land_with_code_2_t6.numeric" => "Landline with code should contain numbers only",

            "fax_with_code_2_t6.numeric" => "Fax with with code should contain numbers only",

            "mobile_personal_2_t6.numeric" => "Mobile personal should contain numbers only",

            "mobile_work_2_t6.required" => "Mobile work is required",
            "mobile_work_2_t6.numeric" => "Mobile work should contain numbers only",

            "email_personal_2_t6.email" => "Email personal is not in email format",

            "email_work_2_t6.required" => "Email work is required",

            "email_work_2_t6.email" => "Email work is should be a valid email",

            "land_with_code_ext_2_t6.numeric" => "Land Code should contain numbers only",
            "fax_with_code_ext_2_t6.numeric" => "Fax Code should contain numbers only",
            "mobile_personal_ext_2_t6.numeric" => "Mobile Personal Code should contain numbers only",
            "mobile_work_ext_2_t6.required" => "Mobile Work Code required",
            "mobile_work_ext_2_t6.numeric" => "Mobile Work Code should contain numbers only"
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
        $section6ArrC = Config::get('siteVars.section6Arr');
        $t6_2 =  Config::get('siteVars.t6_2');
        foreach ($t6_2 as $key => $value) {
            $t6_2[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section6ArrC[$key] = $prev_data[$key];
            }
        }

        $section6ArrC['owner_data'] = $t6_2;
        $application->data = json_encode($section6ArrC);
        $application->last_tab = '1';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Owner Data added successfully'], 200);


    }
    public function tab6_t3(Request $request) {
        $validator = Validator::make($request->all(), [
            "entity_name_arabic_3_t6" => "required|regex:/[اأإء-ي]/ui",
            "entity_name_english_3_t6" => "required|regex:/^[a-zA-Z ]*$/i",
            // "license_number_ministry_of_3_t3" => "required",
            "membership_number_3_t6" => "required",
            "commercial_reg_no_3_t6" => "required|numeric",
            // "tax_card_no_3_t3" => "required|numeric",
            "address_of_the_entity_3_t6" => "required",
            "landline_no_3_t6" => "numeric",
            "fax_no_3_t6" => "numeric",
            "mobile_no1_3_t6" => "required|numeric",
            "mobile_no2_3_t6" => "numeric",
            "email_3_t6" => "required|email",
            "marine_activity_authorized_3_t6" => "required",
            "unit_area_of_activity_3_t6" => "required",
            "time_period_3_t6" => "required",

            "landline_no_ext_3_t6" => "numeric",
            "fax_no_ext_3_t6" => "numeric",
            "mobile_no1_ext_3_t6" => "required|numeric",
            "mobile_no2_ext_3_t6" => "numeric",

            // "notes_1_t1" => "",
        ], [
            "entity_name_arabic_3_t6.required" => "Entity Name Arabic is required",
            "entity_name_arabic_3_t6.regex" => "Entity Name Arabic should contain arabic only",

            "entity_name_english_3_t6.required" => "Entity Name (ENGLISH) is required",
            "entity_name_english_3_t6.regex" => "Entity Name (ENGLISH) should contain english only",

            // "license_number_ministry_of_3_t3.required" => "License number of the Ministry of Tourism is required",
            "membership_number_3_t6.required" => "Membership Number of Diving Tourism  is required",

            "commercial_reg_no_3_t6.required" => "Commercial Registration No is required",
            "commercial_reg_no_3_t6.numeric" => "Commercial Registration No is number only",

            // "tax_card_no_3_t3.required" => "Tax card number is required",
            // "tax_card_no_3_t3.numeric" => "Tax card number should contian number only",

            "address_of_the_entity_3_t6.required" => "Address of the Center is required",

            "landline_no_3_t6.numeric" => "Landline number should contain number only",
            "fax_no_3_t6.numeric" => "FAX NO should contain number only",

            "mobile_no1_3_t6.required" => "MOBILE NO1 is required",
            "mobile_no1_3_t6.numeric" => "MOBILE NO1 should contain number only",

            "mobile_no2_3_t6.numeric" => "MOBILE NO 2 should contain number only",

            "email_3_t6.required" => "EMAIL is required",
            "email_3_t6.email" => "EMAIL should contain email only",

            "marine_activity_authorized_3_t6.required" => "Marine activities to be authorized is required",
            "unit_area_of_activity_3_t6.required" => "Unit's area of ​​activity (as per the attached statement and maps) is required",
            "time_period_3_t6.required" => "The time periods required to carry out the activity is required",


            "landline_no_ext_3_t6.numeric" => "Landline Code should contain numbers only",
            "fax_no_ext_3_t6.numeric" => "Fax Code should contain numbers only",
            "mobile_no2_ext_3_t6.numeric" => "Mobile No 2 should contain numbers only",
            "mobile_no1_ext_3_t6.required" => "Mobile No 1 Code required",
            "mobile_no1_ext_3_t6.numeric" => "Mobile No 1 Code should contain numbers only"
        ]);
        $errroList = [];
        if($validator->errors()->messages()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $errroList[$key] = $value[0];
            }
        }

        // Daterange Checking greater than one year or not
        if(empty($errroList)) {
            $daterange = explode("-", $request->time_period_3_t6);
            $startdate_ = trim($daterange[0]);
            $enddate_ = trim($daterange[1]);

            // $startdate = explode('/', trim($daterange[0]));
            // $enddate = explode('/', trim($daterange[1]));
            // $startdate_ = $startdate[2].'-'.$startdate[1].'-'.$startdate[0];
            // $enddate_ = $enddate[2].'-'.$enddate[1].'-'.$enddate[0];

            $startdate = \DateTime::createFromFormat('d/m/Y', $startdate_);
            $enddate = \DateTime::createFromFormat('d/m/Y', $enddate_);
            $diff = $enddate->diff($startdate)->format("%a");
            if($diff > 365) {
                $errroList['time_period_3_t6'] = "Diff Of Start Date & End Date Should be Maximum 1 Year";
            }
        }

        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }
        $section6ArrC = Config::get('siteVars.section6Arr');
        $t6_3 =  Config::get('siteVars.t6_3');
        foreach ($t6_3 as $key => $value) {
            $t6_3[$key] = $request->$key;
        }
        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }
        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section6ArrC[$key] = $prev_data[$key];
            }
        }

        $section6ArrC['center_data'] = $t6_3;
        $application->data = json_encode($section6ArrC);
        $application->last_tab = '2';
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'Center Data added successfully'], 200);


    }
    public function tab6_t4(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_fees" => "required|numeric|min:1",
        ], [

            "payment_fees.required" => "No Of Branch is required",
            "payment_fees.numeric" => "No Of Branch should numeric",

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

        $section6ArrC = Config::get('siteVars.section6Arr');
        $t6_4 =  Config::get('siteVars.t6_4');
        foreach ($t6_4 as $key => $value) {
          $t6_4[$key] = $request->$key;
        }

        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $section6ArrC[$key] = $prev_data[$key];
            }
        }

        $section6ArrC['branch_payment'] = $t6_4;
        $application->data = json_encode($section6ArrC);
        $application->no_of_branches = $request->payment_fees;
        $application->last_tab = '3';
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();

        return response()->json(['type' => 'success', 'text' => 'No of branches added successfully'], 200);
    }
    public function tab6_t5(Request $request) {
        $request['last_tab'] = 4;
        $this->upSectionType = 't6';
        return $this->upload_doc($request);
    }




    public function upload_doc($request) {
        $parse_file = file_get_contents(url('/assets/picklist-eng.json'));
        $json_arr = json_decode($parse_file, true);
        // Upload Doc Type
        $upload_doc_type = array_key_exists('upload_doc', $json_arr) ? $json_arr['upload_doc']['type'] : [];
        // Upload Doc Valid
        $upload_doc_required = array_key_exists('upload_doc', $json_arr) ? $json_arr['upload_doc']['required'] : [];

        $upload_file = [];
        for($i=0; $i<sizeof($request->select_doc_name); $i++) {
            $var = 'upload_file_'.$i;
            $upload_file[] = !empty($request->$var) ? $request->$var : null;
        }

        // Duplicate Array Value
        if(sizeof($request->select_doc_name)  != sizeof(array_unique($request->select_doc_name))) {
            $errroList[] = "Duplicate Document name not accepted";
        }

        // dd($request->select_doc_name);
        // dd($request->pre_image);
        // dd($upload_file);
        // print_r($request->select_doc_name);


        // if(empty($errroList)) {
        //     foreach ($request->select_doc_name as $key => $value) {
        //         if($value != "" && ($request->pre_image[$key] == null && $upload_file[$key] == null)) {
        //             $errroList[] = 'Please select file to upload at row '.($key+1);
        //         }
        //     }
        // }

        // File required  Check
        if(empty($errroList)) {
            foreach ($upload_file as $key => $file) {
                $required = $upload_doc_required[$request->select_doc_name[$key]];
                if($required == "required" && ($request->pre_image[$key] == null || $request->pre_image[$key] == '')) {
                    $validator = Validator::make($request->all(), [
                        'upload_file_'.$key => $required,
                    ]);

                    if($validator->fails()) {
                        $errroList[] = "File required at row ".($key+1);
                        break;
                    }
                }
            }
        }


        // Mime type Check
        if(empty($errroList)) {
            foreach ($upload_file as $key => $file) {
                if($file != null) {
                    $mimecheck = false;
                    $saveType = $upload_doc_type[$request->select_doc_name[$key]];
                    $required = $upload_doc_required[$request->select_doc_name[$key]];
                    $allowableType = explode(',', $saveType);
                    $fileMimeType = $file->getMimeType();
                    $upload_error_file_index = $key;

                    $validator = Validator::make($request->all(), [
                        'upload_file_'.$key => 'mimes:'.$saveType,
                    ]);

                    if($validator->fails()) {
                        $errroList[] = "MimeCheck Failed for the file at row ".($upload_error_file_index+1).", Allowed Upload File format is ".$saveType;
                        break;
                    }
                }
            }
        }


        if(!empty($errroList)) {
            $errorArr = array_slice($errroList, 0, 1);
            return response()->json(['message' => '', 'errors' => ['validation_error' => $errorArr]], 422);
        }



        $newArr = [];
        foreach ($upload_file as $key => $value) {
            if($value != null){
                $file = explode("public/", $value->store('public/form_doc'));
                // print_r($file);
                $newArr[$request->select_doc_name[$key]] = 'storage/'.end($file);
            }
        }

        if(isset($this->upSectionType) && $this->upSectionType == 't2') {
            $templateArrList = Config::get('siteVars.section2Arr');
            $t1_11 =  Config::get('siteVars.t2_5');
            $t1_11 = $newArr;
        }
        else if(isset($this->upSectionType) && $this->upSectionType == 't3') {
            $templateArrList = Config::get('siteVars.section3Arr');
            $t1_11 =  Config::get('siteVars.t3_5');
            $t1_11 = $newArr;
        }
        else if(isset($this->upSectionType) && $this->upSectionType == 't4') {
            $templateArrList = Config::get('siteVars.section4Arr');
            $t1_11 =  Config::get('siteVars.t4_5');
            $t1_11 = $newArr;
        }
        else if(isset($this->upSectionType) && $this->upSectionType == 't5') {
            $templateArrList = Config::get('siteVars.section5Arr');
            $t1_11 =  Config::get('siteVars.t5_5');
            $t1_11 = $newArr;
        }
        else if(isset($this->upSectionType) && $this->upSectionType == 't6') {
            $templateArrList = Config::get('siteVars.section6Arr');
            $t1_11 =  Config::get('siteVars.t6_5');
            $t1_11 = $newArr;
        }
        else {
            $templateArrList = Config::get('siteVars.section1Arr');
            $t1_11 =  Config::get('siteVars.t1_11');
            $t1_11 = $newArr;
        }



        $application = Application::where('application_no', $request->application_no)->where('user_id', Auth::user()->id)->first();
        if(!$application) {
            return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error occured!']]], 422);
        }

        $prev_data = json_decode($application->data, true);
        if($prev_data != null) {
            foreach ($prev_data as $key => $value) {
                $templateArrList[$key] = $prev_data[$key];
            }
        }

        $select_doc_name = $request->select_doc_name;
        foreach ($select_doc_name as $key => $value) {
            $pre_image[$value] = $request->pre_image[$key];
        }

        $old_upload_doc = $templateArrList['upload_doc'];



        foreach ($old_upload_doc as $key => $value) {
            if(array_key_exists($key, $pre_image)) {
                $old_upload_doc[$key] = $pre_image[$key];
            }
        }
        foreach ($old_upload_doc as $key => $value) {
            if(!in_array($key, $select_doc_name)) {
                unset($old_upload_doc[$key]);
            }
        }
        foreach ($pre_image as $key => $value) {
            if(!in_array($key, $old_upload_doc)) {
                $old_upload_doc[$key] = $pre_image[$key];
            }
        }

        foreach ($t1_11 as $key => $value) {
            if(!array_key_exists($key, $old_upload_doc)) {
                $old_upload_doc[$key] = $t1_11[$key];
            }
        }
        foreach ($t1_11 as $key => $value) {
            if(array_key_exists($key, $old_upload_doc)) {
                if(!empty($t1_11[$key]) && $t1_11[$key] != null) {
                    $old_upload_doc[$key] = $t1_11[$key];
                }
            }
        }


        // $templateArrList['upload_doc'] = $old_upload_doc;

        $parse_file = file_get_contents(url('/assets/picklist-eng.json'));
        $json_arr = json_decode($parse_file, true);
        if($json_arr != false) {
            $upload_doc_names = $json_arr['upload_doc']['name'];
        }
        foreach ($old_upload_doc as $key => $value) {
            if($old_upload_doc[$key] != null) {
                $docname_list[$key] = $upload_doc_names[$key];
            }
        }
        foreach ($old_upload_doc as $key => $value) {
            if($old_upload_doc[$key] == null) {
                unset($old_upload_doc[$key]);
            }
        }


        $templateArrList['upload_doc'] = $old_upload_doc;
        $application->data = json_encode($templateArrList);
        $application->docname_list = json_encode($docname_list);
        $application->last_tab = $request->last_tab;
        $application->updated_at = date('Y-m-d H:i:s');
        $application->save();
        return response()->json(['type' => 'success', 'text' => 'Document Uploaded successfully'], 200);
    }

    public function remove_doc(Request $request) {
        if($request->application_no) {
           $application = Application::where('application_no', $request->application_no)->first();
           if($application) {
               $data = json_decode($application->data, true);
               $docname_list = json_decode($application->docname_list, true);
               if(array_key_exists($request->docname, $data['upload_doc'])) {
                   unset($data['upload_doc'][$request->docname]);
                   unset($docname_list[$request->docname]);

                   $application->docname_list = json_encode($docname_list);
                   if(isset($request->focustab)) {
                       $application->last_tab = $request->focustab;
                    } else {
                        $application->last_tab = 6;
                    }
                   $application->data = json_encode($data);
                   $application->save();
                   return response()->json(['type' => 'success', 'text' => 'File Deleted'], 200);

               }
           }

        }

    }

}
