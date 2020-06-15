<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LangController;
use App\Models\ApplicantStatus;
use App\Models\Nationality;
use App\Models\Doctype;
use App\Models\Reqtype;
use App\Models\RegPort;
use App\Models\ConstructionType;
use App\Models\Crafts;
use App\Models\ClassifiedUnit;
use App\Models\MarineActivity;
use App\Models\UnitAreaOfActivity;
use App\Models\DrainageSolution;
use App\Models\TankOilResidues;
use App\Models\FuelType;
use App\Models\SolidWasteSolution;
use App\Models\Organization;
use App\Models\Application;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\LogsEmail;
use Validator;
use App;
use Hash;
use Mail;


class RegController extends Controller
{
    public function __invoke(Request $request) {

		$parse_file = file_get_contents(url('/assets/picklist-eng.json'));
		$json_arr = json_decode($parse_file, true);
		if($json_arr == false) {
			$json_arr = [];
		}

		$applicant_status = array_key_exists('applicant_status', $json_arr) ? $json_arr['applicant_status'] : [];
		$nationality = array_key_exists('nationality', $json_arr) ? $json_arr['nationality'] : [];
		$doctype = array_key_exists('doctype', $json_arr) ? $json_arr['doctype'] : [];
		$reqtype = array_key_exists('reqtype', $json_arr) ? $json_arr['reqtype'] : [];
		$regport = array_key_exists('reg_port', $json_arr) ? $json_arr['reg_port'] : [];
		$craft = array_key_exists('crafts', $json_arr) ? $json_arr['crafts'] : [];
		$const_type = array_key_exists('construction_types', $json_arr) ? $json_arr['construction_types'] : [];
		$classified_unit = array_key_exists('classified_unit', $json_arr) ? $json_arr['classified_unit'] : [];
		$marine_activity = array_key_exists('marine_activities', $json_arr) ? $json_arr['marine_activities'] : [];
		$unit_area_of_activity = array_key_exists('units_area_of_activities', $json_arr) ? $json_arr['units_area_of_activities'] : [];
		$drainage_solution = array_key_exists('drainage_solutions', $json_arr) ? $json_arr['drainage_solutions'] : [];
		$tank_oil_residuces = array_key_exists('tank_oil_residues', $json_arr) ? $json_arr['tank_oil_residues'] : [];
		$fuel_types = array_key_exists('fuel_types', $json_arr) ? $json_arr['fuel_types'] : [];
		$solid_waste_solution = array_key_exists('soild_waste_solutions', $json_arr) ? $json_arr['soild_waste_solutions'] : [];

		$rate_by_carat = array_key_exists('rate_by_carat', $json_arr) ? $json_arr['rate_by_carat'] : [];
		$carat_quota = array_key_exists('carat_quota', $json_arr) ? $json_arr['carat_quota'] : [];
		$length_of_unit = array_key_exists('length_of_unit', $json_arr) ? $json_arr['length_of_unit'] : [];
		$weight_of_vessel = array_key_exists('weight_of_vessel', $json_arr) ? $json_arr['weight_of_vessel'] : [];
		$tank_capacity = array_key_exists('tank_capacity', $json_arr) ? $json_arr['tank_capacity'] : [];
		$daily_consumption = array_key_exists('daily_consumption', $json_arr) ? $json_arr['daily_consumption'] : [];
		$number_of_tanks = array_key_exists('number_of_tanks', $json_arr) ? $json_arr['number_of_tanks'] : [];
		$exchange_rate = array_key_exists('exchange_rate', $json_arr) ? $json_arr['exchange_rate'] : [];
		$capacity = array_key_exists('capacity', $json_arr) ? $json_arr['capacity'] : [];
		$daily_waste = array_key_exists('daily_waste', $json_arr) ? $json_arr['daily_waste'] : [];

		$countries = Country::orderBy('country_name', 'ASC')->get();

		if ($request->isMethod('post')) {
			switch ($request->regtype) {
				case 'section1':
					$validator = Validator::make($request->all(), [
						"name" => "required",
						"email" => "required|email|unique:organization",
						"password" => "required|same:cpassword",
						"cpassword" => "required|same:password",
						"regtype" => "required",
						"name_1_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"applicant_status_1_t1" => "required",
						"nationality_1_t1" => "required",
						"id_number_1_t1" => "numeric|required_if:passport_number_1_t1,",
						"passport_number_1_t1" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_1_t1,",
						"place_of_res_1_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"actual_place_of_res_1_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"corrs_add_1_t1" => "required",
						"land_with_code_1_t1" => "numeric",
						"fax_with_code_1_t1" => "numeric",
						"mobile_personal_1_t1" => "numeric",
						"mobile_work_1_t1" => "required",
						"email_personal_1_t1" => "email",
						"email_work_1_t1" => "email|required",
						// "website_1_t1" => "",
						"doctype_1_t1" => "required",
						"reqtype_1_t1" => "required",
						// "notes_1_t1" => "",
						"name_2_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"nationality_2_t1" => "required",
						"id_number_2_t1" => "numeric|required_if:passport_number_2_t1,",
						"passport_number_2_t1" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_2_t1,",
						"place_of_res_2_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"actual_place_of_res_2_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"partner_ship_rate_by_carat_2_t1" => "required",
						"land_with_code_2_t1" => "numeric",
						"fax_with_code_2_t1" => "numeric",
						"mobile_personal_2_t1" => "numeric",
						"mobile_work_2_t1" => "required|numeric",
						"email_personal_2_t1" => "email",
						"email_work_2_t1" => "required|email",
						// "website_2_t1" => "",
						// "notes_2_t1" => "",
						"name_of_unit_owner_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"business_attribute_of_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"entity_type_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"commer_reg_no_3_t1" => "required|numeric",
						"tax_card_no_3_t1" => "required|numeric",
						"corrs_add_3_t1" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"carat_quota_3_t1" => "required",
						"telephone_3_t1" => "numeric",
						"fax_with_code_3_t1" => "numeric",
						"mobile_number_p_3_t1" => "numeric",
						"mobile_work_w_3_t1" => "required|numeric",
						"email_personal_3_t1" => "email",
						"email_work_3_t1" => "required|email",
						// "website_3_t1" => "",
						// "notes_3_t1" => "", 
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
						"water_unit_in_5_t1" => "required",
						"tank_capacity_5_t1" => "required",
						"daily_consumption_5_t1" => "required",
						"number_of_tanks_5_t1" => "required",
						"vessel_drainage_in_6_t1" => "required",
						"tank_capacity_6_t1" => "required",
						"daily_exchange_rate_6_t1" => "required",
						"get_rid_of_drainage_6_t1" => "required",
						"vessel_drainage_in_7_t1" => "required",
						"tank_capacity_7_t1" => "required",
						"get_rid_of_residues_7_t1" => "required",
						"main_motor_per_unit_8_t1" => "required|numeric",
						"motor_brand_8_t1" => "required",
						"eng_capacity_1_8_t1" => "required",
						// "eng_capacity_2_8_t1" => "",
						// "eng_capacity_3_8_t1" => "",
						// "eng_capacity_4_8_t1" => "",
						"type_of_fuel_used_8_t1" => "required",
						"waste_collection_in_9_t1" => "required",
						"tank_capacity_9_t1" => "required",
						"avg_daily_waste_9_t1" => "required",
						"get_rid_of_solid_9_t1" => "required",
						"payment_fees" => "required"
		
		
					], [
						"name.required" => "Login name is required",

						"email.required" => "Login email is required",
						"email.email" => "Login email must be a valid email",
						"email.unique" => "Login email already taken",

						"password.required" => "Login password is required",
						"password.same" => "Login password and confirm password should be same",

						"regtype.required" => "Please select a registration type",


						'name_1_t1.required' => 'Full Name is required',

						'name_1_t1.regex' => 'Full Name must be contain only text',

						'applicant_status_1_t1.*' => 'Applicant Status is required',
						
						"nationality_1_t1.required" => "Nationality is required",

						"id_number_1_t1.numeric" => "ID number should be numeric",
						"id_number_1_t1.required" => "ID number is required",

						"passport_number_1_t1.required" => "Passport number is required",
						"passport_number_1_t1.regex" => "Passport number should contain text and numbers only",

						"place_of_res_1_t1.required" => "Place of residence is required",
						"place_of_res_1_t1.regex" => "Place of residence should contain text and numbers only",

						"actual_place_of_res_1_t1.required" => "Actual place of residence is required",
						"actual_place_of_res_1_t1" => "Actual place of residence should contain text and numbers only",
						
						"corrs_add_1_t1.required" => "Correspondence address is required",

						"land_with_code_1_t1.numeric" => "Landline with code should contain numbers only",

						"fax_with_code_1_t1.numeric" => "Fax with with code should contain numbers only",

						"mobile_personal_1_t1.numeric" => "Mobile personal should contain numbers only",

						"mobile_work_1_t1.required" => "Mobile work is required",

						"email_personal_1_t1.email" => "Email personal",
						
						"email_work_1_t1.required" => "Email work is required",
						
						"email_work_1_t1.email" => "Email work is should be a valid email",

						"doctype_1_t1.required" => "Please select a document type",

						"reqtype_1_t1.required" => "Please select a request type",




						"name_2_t1.required" => "Full name is required",
						"name_2_t1.regex" => "Full name should contain text only",

						"nationality_2_t1.required" => "Nationality is required",
						
						"id_number_2_t1.required" => "ID number is required",
						"id_number_2_t1.numeric" => "ID number should contain numbers only",
						
						"passport_number_2_t1.required" => "Passport number is required",
						"passport_number_2_t1.regex" => "Passport number should contain text and numbers only",
						
						"place_of_res_2_t1.required" => "Place of residence is required",
						"place_of_res_2_t1.regex" => "Place of residence should contain text and numbers only",
						
						"actual_place_of_res_2_t1.required" => "Actual place residence is required",
						"actual_place_of_res_2_t1.regex" => "Actual place residence should contain text and numbers only",
						
						"partner_ship_rate_by_carat_2_t1.required" => " partnership rate BY CARAT
						is required",
						// "mobile_work_2_t1.required" => "",
						"email_work_2_t1" => "required",

						"land_with_code_2_t1.numeric" => "Land Line with Code should contain numbers only",
						"fax_with_code_2_t1.numeric" => "Fax with Code should contain numbers only",
						"mobile_personal_2_t1.numeric" => "MOBILE (PERSONAL) should contain numbers only",
						"mobile_work_2_t1.required" => "MOBILE (Work) is required",
						"mobile_work_2_t1.numeric" => "MOBILE (Work) should contain numbers only",


						"email_personal_2_t1.email" => "EMAIL (PERSONAL) should be valid email",
						"email_work_2_t1.required" => "EMAIL (WORK) is required",


						"name_of_unit_owner_3_t1.required" => "Name of Unit Owner (Legal Representative) is required",
						"name_of_unit_owner_3_t1.regex" => "Name of Unit Owner (Legal Representative) should contain text only",

						"business_attribute_of_3_t1.required" => "Business attribute of the entity is required",
						"business_attribute_of_3_t1.regex" => "Business attribute of the entity should contain text only",

						"entity_type_3_t1" => "required|regex:/^[a-zA-Z ]*$/i",
						"entity_type_3_t1.required" => "Entity type is required",
						"entity_type_3_t1.regex" => "Entity type should contain text only",


						"commer_reg_no_3_t1.required" => "Commercial Registration No is required",
						"commer_reg_no_3_t1.numeric" => "Commercial Registration No should contain numbers only",

						"tax_card_no_3_t1.required" => "Tax card number is required",
						"tax_card_no_3_t1.numeric" => "Tax card number should contain numbers only",


						"corrs_add_3_t1.required" => "Correspondence address is required",
						"corrs_add_3_t1.regex" => "Correspondence address should contain text and numbers only",

						"carat_quota_3_t1.required" => "Carat quota is required",


						"telephone_3_t1.numeric" => "Telephone should contain numbers only", 
						"fax_with_code_3_t1.numeric" => "Fax (with code) should contain numbers only", 
						"mobile_number_p_3_t1.numeric" => "Mobile Number (Personal) should contain numbers only",

						"mobile_work_w_3_t1.required" => "MOBILE (WORK) is required",
						"mobile_work_w_3_t1.numeric" => "MOBILE (WORK) should contain numbers only",

						"email_work_3_t1.required" => "EMAIL (WORK) is required",
						"email_work_3_t1.email" => "EMAIL (WORK) is valid email",

						"maritime_unit_arabic_4_t1.required" => "Name of Maritime Unit (in Arabic) #ir",
						"maritime_unit_arabic_4_t1.regex" => "Name of Maritime Unit (in Arabic) accept only Arabic",

						"maritime_unit_4_t1.required" => "Name of Maritime Unit (in ENGLISH) #ir",
						"maritime_unit_4_t1.regex" => "Name of Maritime Unit (in ENGLISH) supports english only",

						"reg_number_4_t1.required" => "Registration Number #ir",
						"reg_number_4_t1" => "Registration Number #nu",


						"port_of_reg_4_t1.required" => "Port of Registration #ir",

						"date_of_reg_4_t1.required" => "Date of registration (day / month / year) #ir",
						"date_of_reg_4_t1.date_format" => "Date of registration (day / month / year) format should be (day / month / year)",

						"maritime_license_4_t1.required" => "Maritime Licensing Work Area #ir",
						"maritime_license_4_t1.regex" => "Maritime Licensing Work Area #to",

						"craft_4_t1.required" => "The craft according to the navigation license #ir",

						"number_of_crew_4_t1.required" => "Number of crew on unit #ir",
						"number_of_crew_4_t1.numeric" => "Number of crew on unit #nu",

						"total_length_of_unit_4_t1" => "Total length of unit (m) #ir",

						"number_of_passenger_4_t1.required" => "Number of Passengers Passed #ir",
						"number_of_passenger_4_t1.numeric" => "Number of Passengers Passed #nu",

						"construction_type_4_t1.required" => "Construction type #ir",

						"total_weight_of_vessel_4_t1.required" => "Total WEIGHT of VESSEL (ton) #ir",

						"classifi_unit_4_t1.required" => "Classification of the unit #ir",

						"marine_activity_unit_4_t1.required" => "Marine activities to be declared on the unit #ir",
						"unit_area_of_activity_4_t1.required" => "Unit's area of ​​activity (as per the attached statement and maps) #ir",

						"getty_marina_4_t1.required" => "GETTY-MARINA #ir",
						"unit_practice_location_4_t1.regex" => "The Unit's practice locations are detailed #to",



						"water_unit_in_5_t1.required" => "Water unit in the VESSEL #ir",
						"tank_capacity_5_t1.required" => "Tank Capacity (m3) #ir",
						"daily_consumption_5_t1" => "Average daily consumption (m3 / day) #ir",
						"number_of_tanks_5_t1" => "Number of Tanks #ir",

						"vessel_drainage_in_6_t1.required" => "VESSEL drainage tank #ir",
						"tank_capacity_6_t1.required" => "Tank Capacity (m3) #ir",
						"daily_exchange_rate_6_t1.required" => "Daily Exchange Rate (m3 / day) #ir",
						"get_rid_of_drainage_6_t1.required" => "How to get rid of drainage #ir",

						"vessel_drainage_in_7_t1.required" => "Oil residues TANK #ir",
						"tank_capacity_7_t1.required" => "Tank Capacity (m3) #ir",
						"get_rid_of_residues_7_t1.required" => "How to get rid of  residues TANK OIL #ir",

						"main_motor_per_unit_8_t1.required" => "Number of main MOTORS per unit #ir",
						"main_motor_per_unit_8_t1.required.numeric" => "Number of main MOTORS per unit #nu",

						"motor_brand_8_t1.required" => "Motor brand #ir",
						"eng_capacity_1_8_t1.required" => "Engine capacity 1 #ir",
						"type_of_fuel_used_8_t1.required" => "The type of fuel used in engines 1 #ir",


						"waste_collection_in_9_t1.required" => "Waste collection place in the VESSEL #ir",
						"tank_capacity_9_t1.required" => "Capacity (m3) #ir",
						"avg_daily_waste_9_t1.required" => "Average Daily Waste (m3 / day) #ir",
						"get_rid_of_solid_9_t1.required" => "How to get rid of solid waste #ir",		
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
		
		
					$Organization = new Organization;
					$Organization->name = $request->name;
					$Organization->email = $request->email;
					$Organization->password = Hash::make($request->password);
					$Organization->is_active = 1;
					$Organization->created_at = date('Y-m-d H:i:s');

					$innerArray = [
						'personal' => [
							"name" => $request->name,
							"email" => $request->email,
							"password" => $request->password,
							"regtype" => $request->regtype
						],
						'applicants' => [
							"name_1_t1" => $request->name_1_t1,
							"applicant_status_1_t1" => $request->applicant_status_1_t1,
							"nationality_1_t1" => $request->nationality_1_t1,
							"id_number_1_t1" => $request->id_number_1_t1,
							"passport_number_1_t1" => $request->passport_number_1_t1,
							"place_of_res_1_t1" => $request->place_of_res_1_t1,
							"actual_place_of_res_1_t1" => $request->actual_place_of_res_1_t1,
							"corrs_add_1_t1" => $request->corrs_add_1_t1,
							"land_with_code_1_t1" => $request->land_with_code_1_t1,
							"fax_with_code_1_t1" => $request->fax_with_code_1_t1,
							"mobile_personal_1_t1" => $request->mobile_personal_1_t1,
							"mobile_work_1_t1" => $request->mobile_work_1_t1,
							"email_personal_1_t1" => $request->email_personal_1_t1,
							"email_work_1_t1" => $request->email_work_1_t1,
							"website_1_t1" => $request->website_1_t1,
							"doctype_1_t1" => $request->doctype_1_t1,
							"reqtype_1_t1" => $request->reqtype_1_t1,
							"notes_1_t1" => $request->notes_1_t1
						],
						'owner_vessel' => [
							"name_2_t1" => $request->name_2_t1,
							"nationality_2_t1" => $request->nationality_2_t1,
							"id_number_2_t1" => $request->id_number_2_t1,
							"passport_number_2_t1" => $request->passport_number_2_t1,
							"place_of_res_2_t1" => $request->place_of_res_2_t1,
							"actual_place_of_res_2_t1" => $request->actual_place_of_res_2_t1,
							"partner_ship_rate_by_carat_2_t1" => $request->partner_ship_rate_by_carat_2_t1,
							"land_with_code_2_t1" => $request->land_with_code_2_t1,
							"fax_with_code_2_t1" => $request->fax_with_code_2_t1,
							"mobile_personal_2_t1" => $request->mobile_personal_2_t1,
							"mobile_work_2_t1" => $request->mobile_work_2_t1,
							"email_personal_2_t1" => $request->email_personal_2_t1,
							"email_work_2_t1" => $request->email_work_2_t1,
							"website_2_t1" => $request->website_2_t1,
							"notes_2_t1" => $request->notes_2_t1
						],
						'marine_unit' => [
							"name_of_unit_owner_3_t1" => $request->name_of_unit_owner_3_t1,
							"business_attribute_of_3_t1" => $request->business_attribute_of_3_t1,
							"entity_type_3_t1" => $request->entity_type_3_t1,
							"commer_reg_no_3_t1" => $request->commer_reg_no_3_t1,
							"tax_card_no_3_t1" => $request->tax_card_no_3_t1,
							"corrs_add_3_t1" => $request->corrs_add_3_t1,
							"carat_quota_3_t1" => $request->carat_quota_3_t1,
							"telephone_3_t1" => $request->telephone_3_t1,
							"fax_with_code_3_t1" => $request->fax_with_code_3_t1,
							"mobile_number_p_3_t1" => $request->mobile_number_p_3_t1,
							"mobile_work_w_3_t1" => $request->mobile_work_w_3_t1,
							"email_personal_3_t1" => $request->email_personal_3_t1,
							"email_work_3_t1" => $request->email_work_3_t1,
							"website_3_t1" => $request->website_3_t1,
							"notes_3_t1" => $request->notes_3_t1
						],
						'vessel' => [
							"maritime_unit_arabic_4_t1" => $request->maritime_unit_arabic_4_t1,
							"maritime_unit_4_t1" => $request->maritime_unit_4_t1,
							"reg_number_4_t1" => $request->reg_number_4_t1,
							"port_of_reg_4_t1" => $request->port_of_reg_4_t1,
							"date_of_reg_4_t1" => $request->date_of_reg_4_t1,
							"maritime_license_4_t1" => $request->maritime_license_4_t1,
							"craft_4_t1" => $request->craft_4_t1,
							"number_of_crew_4_t1" => $request->number_of_crew_4_t1,
							"total_length_of_unit_4_t1" => $request->total_length_of_unit_4_t1,
							"number_of_passenger_4_t1" => $request->number_of_passenger_4_t1,
							"construction_type_4_t1" => $request->construction_type_4_t1,
							"total_weight_of_vessel_4_t1" => $request->total_weight_of_vessel_4_t1,
							"spec_of_rubber_boat_unit_4_t1" => $request->spec_of_rubber_boat_unit_4_t1,
							"classifi_unit_4_t1" => $request->classifi_unit_4_t1,
							"marine_activity_unit_4_t1" => $request->marine_activity_unit_4_t1,
							"unit_area_of_activity_4_t1" => $request->unit_area_of_activity_4_t1,
							"getty_marina_4_t1" => $request->getty_marina_4_t1,
							"unit_practice_location_4_t1" => $request->unit_practice_location_4_t1
						],
						'water_used_im' => [
							"water_unit_in_5_t1" => $request->water_unit_in_5_t1,
							"tank_capacity_5_t1" => $request->tank_capacity_5_t1,
							"daily_consumption_5_t1" => $request->daily_consumption_5_t1,
							"number_of_tanks_5_t1" => $request->number_of_tanks_5_t1
						],
						'sanitation' => [
							"vessel_drainage_in_6_t1" => $request->vessel_drainage_in_6_t1,
							"tank_capacity_6_t1" => $request->tank_capacity_6_t1,
							"daily_exchange_rate_6_t1" => $request->daily_exchange_rate_6_t1,
							"get_rid_of_drainage_6_t1" => $request->get_rid_of_drainage_6_t1
						],
						'waste_liquid' => [
							"vessel_drainage_in_7_t1" => $request->vessel_drainage_in_7_t1,
							"tank_capacity_7_t1" => $request->tank_capacity_7_t1,
							"get_rid_of_residues_7_t1" => $request->get_rid_of_residues_7_t1
						],
						'vessel_engine' => [
							"main_motor_per_unit_8_t1" => $request->main_motor_per_unit_8_t1,
							"motor_brand_8_t1" => $request->motor_brand_8_t1,
							"eng_capacity_1_8_t1" => $request->eng_capacity_1_8_t1,
							"eng_capacity_2_8_t1" => $request->eng_capacity_2_8_t1,
							"eng_capacity_3_8_t1" => $request->eng_capacity_3_8_t1,
							"eng_capacity_4_8_t1" => $request->eng_capacity_4_8_t1,
							"type_of_fuel_used_8_t1" => $request->type_of_fuel_used_8_t1
						],
						'solid_waste' => [
							"waste_collection_in_9_t1" => $request->waste_collection_in_9_t1,
							"tank_capacity_9_t1" => $request->tank_capacity_9_t1,
							"avg_daily_waste_9_t1" => $request->avg_daily_waste_9_t1,
							"get_rid_of_solid_9_t1" => $request->get_rid_of_solid_9_t1
						],
						'branch_payment' => [
							"payment_fees" => $request->payment_fees
						]
					];
					$data = [$request->regtype => $innerArray];
		
					if($Organization->save()){
						$Application = new Application;
						$Application->user_id = $Organization->id;
						$Application->regtype_text = $request->regtype_t;
						$Application->data = json_encode($data);
						$Application->created_at = date('Y-m-d H:i:s');
						if($Application->save()){
							$to = $request->email;
							$subject = "Registration Successfull";
							$txt = '<p>Login URL: '.env('APP_URL').'sign-in'.'</p>';
							$txt .= '<p>Email: '.$request->email.' and Password: '.$request->password.'</p>';
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers .= "From: noreply@eeaa.com";
							mail($to, $subject, $txt,$headers);
							return response()->json(['type'=> "success", 'text'=>"Successfully Registered"], 200);
						}
					}
					break;
				
				case 'section2' : 
					// dd($request->all());
					$validator = Validator::make($request->all(), [
						"name" => "required",
						"email" => "required|email|unique:organization",
						"password" => "required|same:cpassword",
						"cpassword" => "required|same:password",
						"regtype" => "required",
						"name_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"applicant_status_1_t2" => "required",
						"nationality_1_t2" => "required",

						"id_number_1_t2" => "numeric|required_if:passport_number_1_t2,",
						"passport_number_1_t2" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_1_t2,",
						
						"place_of_res_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"actual_place_of_res_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"corrs_add_1_t2" => "required",
						"land_with_code_1_t2" => "numeric",
						"fax_with_code_1_t2" => "numeric",
						"mobile_personal_1_t2" => "numeric",
						"mobile_work_1_t2" => "required|numeric",
						"email_personal_1_t2" => "email",
						"email_work_1_t2" => "required|email",
						// "website_1_t2" => "",
						"agency_board_1_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"doc_office_1_t2" => "required|regex:/^[a-zA-Z ]*$/i",
						"reqtype_1_t2" => "required",
						// "notes_1_t2" => "",
						"name_2_t2" => "required|regex:/^[a-zA-Z ]*$/i",
						"nick_name_2_t2" => "regex:/^[a-zA-Z ]*$/i",
						"nationality_2_t2" => "required",
						"id_number_2_t2" => "required|numeric",
						"passport_number_2_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"place_of_res_2_t2" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"land_with_code_2_t2" => "numeric",
						"fax_with_code_2_t2" => "numeric",
						"mobile_personal_2_t2" => "numeric",
						"mobile_work_2_t2" => "numeric|required",
						"email_personal_2_t2" => "email",
						"email_work_2_t2" => "required|email",
						// "website_2_t2" => "",
						"center_name_arabic_3_t2" => "required|regex:/[اأإء-ي]/ui",
						"center_name_english_3_t2" => "required|regex:/^[a-zA-Z ]*$/i",
						"license_number_ministry_of_3_t2" => "required",
						"license_number_ministry_of_membership_3_t2" => "required",
						"commercial_reg_no_3_t2" => "required|numeric",
						"tax_card_no_3_t2" => "required|numeric",
						"address_of_the_center_3_t2" => "required",
						"landline_no_3_t2" => "numeric",
						"fax_no_3_t2" => "numeric",
						"mobile_no1_3_t2" => "required|numeric",
						"mobile_no2_3_t2" => "numeric",
						"email_3_t2" => "required|email",
						// "website_3_t2" => "",
						"marine_activity_authorized_3_t2" => "required",
  						"unit_area_of_activity_3_t2" => "required",
						"payment_fees_t2" => "required"
						
		
		
					], [
						"name.required" => "Login name is required",

						"email.required" => "Login email is required",
						"email.email" => "Login email must be a valid email",
						"email.unique" => "Login email already taken",

						"password.required" => "Login password is required",
						"password.same" => "Login password and confirm password should be same",

						"regtype.required" => "Please select a registration type",


						'name_1_t2.required' => 'Full Name is required',
						'name_1_t2.regex' => 'Full Name must be contain only text',

						'applicant_status_1_t2.*' => 'Applicant Status is required',
						"nationality_1_t2.required" => "Nationality is required",

						"id_number_1_t2.numeric" => "ID number should be numeric",
						"id_number_1_t2.required" => "ID number is required",

						"passport_number_1_t2.required" => "Passport number is required",
						"passport_number_1_t2.regex" => "Passport number should contain text and numbers only",

						"place_of_res_1_t2.required" => "Place of residence is required",
						"place_of_res_1_t2.regex" => "Place of residence should contain text and numbers only",

						"actual_place_of_res_1_t2.required" => "Actual place of residence is required",
						"actual_place_of_res_1_t2.regex" => "Actual place of residence should contain text and numbers only",

						"corrs_add_1_t2.required" => "Correspondence address is required",

						"land_with_code_1_t2.numeric" => "Landline with code should contain numbers only",

						"fax_with_code_1_t2.numeric" => "Fax with with code should contain numbers only",

						"mobile_personal_1_t2.numeric" => "Mobile personal should contain numbers only",

						"mobile_work_1_t2.required" => "Mobile work is required",

						"email_personal_1_t2.email" => "Email personal",

						"email_work_1_t2.required" => "Email work is required",

						"email_work_1_t2.email" => "Email work is should be a valid email",

						"agency_board_1_t2.required" => "Agency bond number #ir",
						"agency_board_1_t2.regex" => "Agency bond number #tn",

						"doc_office_1_t2.required" => "Documentation Office #ir",
						"doc_office_1_t2.regex" => "Documentation Office #to",
						'reqtype_1_t2.required' => 'REQUEST TYPE #ir',


						"name_2_t2.required" => "Full name is required",
						"name_2_t2.regex" => "Full name should contain text only",
						"nationality_2_t2.required" => "Nationality is required",

						"id_number_2_t2.required" => "ID number is required",
						"id_number_2_t2.numeric" => "ID number should contain numbers only",

						"passport_number_2_t2.required" => "Passport number is required",
						"passport_number_2_t2.regex" => "Passport number should contain text and numbers only",

						"place_of_res_2_t2.required" => "Place of residence is required",
						"place_of_res_2_t2.regex" => "Place of residence should contain text and numbers only",

						"land_with_code_2_t2.numeric" => "Land Line with Code should contain numbers only",

						"fax_with_code_2_t2.numeric" => "Fax with Code should contain numbers only",
						"mobile_personal_2_t2.numeric" => "MOBILE (PERSONAL) should contain numbers only",

						"mobile_work_2_t2.required" => "MOBILE (Work) is required",
						"mobile_work_2_t2.numeric" => "MOBILE (Work) should contain numbers only",

						"email_personal_2_t2.email" => "EMAIL (PERSONAL) should be valid email",
						"email_work_2_t2.required" => "EMAIL (WORK) is required",

						"email_work_2_t2" => "required",


						"center_name_arabic_3_t2.required" => "Center Name (Arabic) #ir",
						"center_name_arabic_3_t2.regex" => "Center Name (Arabic) only Arabic",




						"center_name_english_3_t2.required" => "Center Name (ENGLISH) #ir",
						"center_name_english_3_t2.regex" => "Center Name (ENGLISH) contains English Only",

						"license_number_ministry_of_3_t2.required" => "License number of the Ministry of Tourism #ir",
						"license_number_ministry_of_membership_3_t2.required" => "License number of the Ministry of Tourism Membership Number of Diving Tourism Rooms #ir",

						"commercial_reg_no_3_t2.required" => "Commercial Registration No #ir",
						"commercial_reg_no_3_t2.numeric" => "Commercial Registration No #nu",

						"tax_card_no_3_t2.required" => "Tax card number #ir",
						"tax_card_no_3_t2.numeric" => "Tax card number #nu",

						"address_of_the_center_3_t2.required" => "Address of the Center #ir",
						"landline_no_3_t2.numeric" => "Landline number #nu",
						"fax_no_3_t2.numeric" => "FAX NO #nu",

						"mobile_no1_3_t2.required" => "MOBILE NO1 #ir",
						"mobile_no1_3_t2.numeric" => "MOBILE NO1 #nu",

						"mobile_no2_3_t2.numeric" => "MOBILE NO 2 #nu",

						"email_3_t2.required" => "EMAIL #ir",
						"email_3_t2.email" => "EMAIL contains valid email",

						"marine_activity_authorized_3_t2.required" => "Marine activities to be authorized #ir",
						"unit_area_of_activity_3_t2.required" => "Unit's area of ​​activity (as per the attached statement and maps) #ir",
						"payment_fees_t2.required" => "Payment Fees #ir"

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
					break;				
				case 'section3' : 
					dd($request->all());
					$validator = Validator::make($request->all(), [
						"name" => "required",
						"email" => "required|email|unique:organization",
						"password" => "required|same:cpassword",
						"cpassword" => "required|same:password",
						"regtype" => "required",
						"name_1_t3" => "required|regex:/^[a-zA-Z ]*$/i",
						"applicant_status_1_t3" => "required",
						// "nationality_1_t3" => "",
						"id_number_1_t3" => "numeric|required_if:passport_number_1_t3,",
						"passport_number_1_t3" => "regex:/^[a-zA-Z0-9 ]*$/i|required_if:id_number_1_t3,",
						"place_of_res_1_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"actual_place_of_res_1_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"corrs_add_1_t3" => "required",
						"land_with_code_1_t3" => "numeric",
						"fax_with_code_1_t3" => "numeric",
						"mobile_personal_1_t3" => "numeric",
						"mobile_work_1_t3" => "required|numeric",
						"email_personal_1_t3" => "email",
						"email_work_1_t3" => "required|email",
						// "website_1_t3" => "",
						"agency_board_1_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"doc_office_1_t3" => "required|regex:/^[a-zA-Z ]*$/i",
						"reqtype_1_t3" => "required",
						"notes_1_t3" => "",
						"name_2_t3" => "required|regex:/^[a-zA-Z ]*$/i",
						"nick_name_2_t3" => "regex:/^[a-zA-Z ]*$/i",
						"id_number_2_t3" => "numeric|required_id:passport_number_2_t3,",
						"passport_number_2_t3" => "regex:/^[a-zA-Z0-9 ]*$/i|required_id:passport_number_2_t3,",
						"place_of_res_2_t3" => "required|regex:/^[a-zA-Z0-9 ]*$/i",
						"land_with_code_2_t3" => "numeric",
						"fax_with_code_2_t3" => "numeric",
						"mobile_personal_2_t3" => "numeric",
						"mobile_work_2_t3" => "required|numeric",
						"email_personal_2_t3" => "email",
						"email_work_2_t3" => "required|email",
						// "website_2_t3" => "",
						"center_name_arabic_3_t3" => "required|regex:/[اأإء-ي]/ui",
						"center_name_english_3_t3" => "required|regex:/^[a-zA-Z ]*$/i",
						"license_number_ministry_of_3_t3" => "required",
						"membership_number_3_t3" => "required",
						"commercial_reg_no_3_t3" => "required|numeric",
						"tax_card_no_3_t3" => "required|numeric",
						"address_of_the_center_3_t3" => "required",
						"landline_no_3_t3" => "numeric",
						"fax_no_3_t3" => "numeric",
						"mobile_no1_3_t3" => "required|numeric",
						"mobile_no2_3_t3" => "numeric",
						"email_3_t3" => "required|email",
						// "website_3_t3" => "",
						"marine_activity_authorized_3_t3" => "required",
  						"unit_area_of_activity_3_t3" => "required",
						"payment_fees_t3" => "required"
						
		
		
					], [
						"name.required" => "Login name is required",

						"email.required" => "Login email is required",
						"email.email" => "Login email must be a valid email",
						"email.unique" => "Login email already taken",

						"password.required" => "Login password is required",
						"password.same" => "Login password and confirm password should be same",

						"regtype.required" => "Please select a registration type",

						'name_1_t3.required' => 'Full Name is required',
						'name_1_t3.regex' => 'Full Name must be contain only text',

						'applicant_status_1_t3.*' => 'Applicant Status is required',

						"id_number_1_t3.numeric" => "ID number should be numeric",
						"id_number_1_t3.required" => "ID number is required",

						"passport_number_1_t3.required" => "Passport number is required",
						"passport_number_1_t3.regex" => "Passport number should contain text and numbers only",

						"place_of_res_1_t3.required" => "Place of residence is required",
						"place_of_res_1_t3.regex" => "Place of residence should contain text and numbers only",

						"actual_place_of_res_1_t3.required" => "Actual place of residence is required",
						"actual_place_of_res_1_t3.regex" => "Actual place of residence should contain text and numbers only",

						"corrs_add_1_t3.required" => "Correspondence address is required",

						"land_with_code_1_t3.numeric" => "Landline with code should contain numbers only",

						"fax_with_code_1_t3.numeric" => "Fax with with code should contain numbers only",

						"mobile_personal_1_t3.numeric" => "Mobile personal should contain numbers only",

						"mobile_work_1_t3.required" => "Mobile work is required",

						"email_personal_1_t3.email" => "Email personal",

						"email_work_1_t3.required" => "Email work is required",

						"email_work_1_t3.email" => "Email work is should be a valid email",

						"agency_board_1_t3.required" => "Agency bond number #ir",
						"agency_board_1_t3.regex" => "Agency bond number #tn",

						"doc_office_1_t3.required" => "Documentation Office #ir",
						"doc_office_1_t3.regex" => "Documentation Office #to",
						'reqtype_1_t3.required' => 'REQUEST TYPE #ir',


						"name_2_t3.required" => "Full name is required",
						"name_2_t3.regex" => "Full name should contain text only",
						"nick_name_2_t3.regex" => "NICK NAME (IF AVILABLE) #ir",

						"id_number_2_t3.required" => "ID number is required",
						"id_number_2_t3.numeric" => "ID number should contain numbers only",

						"passport_number_2_t3.required" => "Passport number is required",
						"passport_number_2_t3.regex" => "Passport number should contain text and numbers only",

						"place_of_res_2_t3.required" => "Place of residence is required",
						"place_of_res_2_t3.regex" => "Place of residence should contain text and numbers only",

						"land_with_code_2_t3.numeric" => "Land Line with Code should contain numbers only",

						"fax_with_code_2_t3.numeric" => "Fax with Code should contain numbers only",
						"mobile_personal_2_t3.numeric" => "MOBILE (PERSONAL) should contain numbers only",

						"mobile_work_2_t3.required" => "MOBILE (Work) is required",
						"mobile_work_2_t3.numeric" => "MOBILE (Work) should contain numbers only",

						"email_personal_2_t3.email" => "EMAIL (PERSONAL) should be valid email",
						"email_work_2_t3.required" => "EMAIL (WORK) is required",

						"email_work_2_t3" => "required",


						"center_name_arabic_3_t3.required" => "Center Name (Arabic) #ir",
						"center_name_arabic_3_t3.regex" => "Center Name (Arabic) only Arabic",




						"center_name_english_3_t3.required" => "Center Name (ENGLISH) #ir",
						"center_name_english_3_t3.regex" => "Center Name (ENGLISH) contains English Only",

						"license_number_ministry_of_3_t3.required" => "License number of the Ministry of Tourism #ir",
						"license_number_ministry_of_membership_3_t3.required" => "License number of the Ministry of Tourism Membership Number of Diving Tourism Rooms #ir",

						"membership_number_3_t3.required" => "Membership Number of Diving Tourism  #ir",

						"commercial_reg_no_3_t3.required" => "Commercial Registration No #ir",
						"commercial_reg_no_3_t3.numeric" => "Commercial Registration No #nu",

						"tax_card_no_3_t3.required" => "Tax card number #ir",
						"tax_card_no_3_t3.numeric" => "Tax card number #nu",

						"address_of_the_center_3_t3.required" => "Address of the Center #ir",
						"landline_no_3_t3.numeric" => "Landline number #nu",
						"fax_no_3_t3.numeric" => "FAX NO #nu",

						"mobile_no1_3_t3.required" => "MOBILE NO1 #ir",
						"mobile_no1_3_t3.numeric" => "MOBILE NO1 #nu",

						"mobile_no2_3_t3.numeric" => "MOBILE NO 2 #nu",

						"email_3_t3.required" => "EMAIL #ir",
						"email_3_t3.email" => "EMAIL contains valid email",

						"marine_activity_authorized_3_t3.required" => "Marine activities to be authorized #ir",
						"unit_area_of_activity_3_t3.required" => "Unit's area of ​​activity (as per the attached statement and maps) #ir",
						"payment_fees_t3.required" => "Payment Fees #ir"

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
					break;				
				case 'section4' : 
					dd($request->all());
					$validator = Validator::make($request->all(), [
						"name" => "required",
						"email" => "required|email|unique:organization",
						"password" => "required|same:cpassword",
						"cpassword" => "required|same:password",
						"regtype" => "required",
						
						
		
		
					], [
						"name.required" => "Login name is required",

						"email.required" => "Login email is required",
						"email.email" => "Login email must be a valid email",
						"email.unique" => "Login email already taken",

						"password.required" => "Login password is required",
						"password.same" => "Login password and confirm password should be same",

						"regtype.required" => "Please select a registration type",

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
					break;				
				case 'section5' :
					dd($request->all());
					break;				
				case 'section6' : 
					dd($request->all());
					break;	
				default:
					# code...
					break;
			}



		} else {
			return view('reg', compact('applicant_status', 'nationality', 'doctype', 'reqtype', 'regport', 'craft', 'const_type', 'classified_unit', 'marine_activity', 'unit_area_of_activity', 'drainage_solution', 'tank_oil_residuces', 'fuel_types', 'solid_waste_solution', 'rate_by_carat', 'carat_quota', 'length_of_unit', 'weight_of_vessel', 'tank_capacity','daily_consumption', 'number_of_tanks', 'exchange_rate', 'capacity', 'daily_waste', 'countries'));
		}
	}

	/**
	 * Signup Form
	 */
	public function Signup(Request $request) {
		if(isset(Auth::guard('org')->user()->id)) {
			return redirect()->route('home');
		}
		if($request->isMethod('post')) {
			// dd($request->all());
			$validator = Validator::make($request->all(), [
				"name" => "required",
				"email" => "required|email|unique:organization",
				"password" => "required|same:cpassword",
				"cpassword" => "required"
			], [
				'password.same' => 'Password and Confirm Password Should Match',
			]);
			if($validator->fails()) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
			}

			$captcha = session()->get('captcha_text');			
			if($request->captcha != $captcha) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
			}
			if($request->captcha == $captcha) {
				session()->put('captcha_text', '');
				session()->save();
			}

			$Organization = new Organization;
			$Organization->name = $request->name;
			$Organization->email = $request->email;
			$Organization->raw_pwd = $request->password;
			if(empty($Organization->raw_pwd)) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! Please Reenter the passwords']]], 422);
			}

			$Organization->password = Hash::make($request->password);
			$token = Hash::make($request->email);
			$Organization->verify_token = $token;
			$Organization->is_active = '0';
			$Organization->created_at = date('Y-m-d H:i:s');
			if($Organization->save()){
				$Organization->raw_pwd = $request->password;
				$Organization->save();

				$Application = new Application;
				$Application->user_id = $Organization->id;
				$Application->regtype = $request->reg_type;
				$Application->regtype_text = $request->regtype_text;
				// $Application->data = json_encode($data);
				$Application->created_at = date('Y-m-d H:i:s');
				$Application->save();

				$application_id = Application::whereId($Application->id);
				$label = env('APP_FORM_NO_LABEL');
				$appno = $label.str_pad($Application->id,10,0,STR_PAD_LEFT);
				$Application->application_no = $appno;
				$Application->save();


				$to = $request->email;
				$subject = "Registration Successfull";
				$txt = 'Please click the verify link to verfiy the account: '.env('APP_URL').'verify?token='.$token.'&appno='.$appno;


				$response = $this->send_email($to, $subject, $txt);
				$logsemail = new LogsEmail;
				$logsemail->from  = 'noreply@eeaa.com';
				$logsemail->to  = $to;
				$logsemail->subject  = $subject;
				$logsemail->body  = $txt;
				$logsemail->created_at  = date('Y-m-d H:i:s');
				$logsemail->response  = $response;
				$logsemail->save();

				return response()->json(['type' => 'success', 'text' => 'Registration Successfull'], 200);


				// $guard = 'org';				
				// $credentials = [
                //     'email' => $request->email,
                //     'password' => $request->password
                // ];
                // $remember = $request->remember === 'on' ? true : false;
                // if(Auth::guard($guard)->attempt($credentials, $remember)) {
                //     // session(['session_id' => $sessions->first()->id]);
                //     // return ['type' => 'success', 'text' => 'Login Successfull'];
				// 	return response()->json(['type' => 'success', 'text' => 'Registration Successfull'], 200);
                // }

		
			}
		} else {
			return view('sign-up');
		}
	}

	function verify(Request $request) {
		// dd($request->all());
		$token = $request->token;
		$appno = $request->appno;
		$expired_link = "<p>Oops Link Expired, Please <a href=".url('reverify-reg').">click</a> to resend verify link</p>";
		
		// $organization = Organization::where('verify_token', $token)->where('is_active', '0')->first();
		$organization = Organization::where('verify_token', $token)->first();
		if($organization) {
			if($organization->is_active == '1') {
				return redirect()->route('home');
			}
			$application = Application::where('application_no', $appno)->first();
			if($application) {
				$email = $organization->email;
				$password = $organization->raw_pwd;
				$expired_in = $organization->expired_in;


				$updated_at = new \DateTime($organization->updated_at);
				$now = new \DateTime();
				$interval = $updated_at->diff($now);
				$minutes = $interval->format('%i');
				if($minutes > $expired_in) {
					echo $expired_link;
					die();
				}

				$credentials = [
					'email' => $email,
					'password' => $password
				];
				$guard = 'org';
                $remember = $request->remember === 'on' ? true : false;
                if(Auth::guard($guard)->attempt($credentials, $remember)) {
					$organization->raw_pwd = '';
					$organization->is_active = '1';
					$organization->save();

					return redirect()->route('application.appByNo', $appno);
                } else {
					echo $expired_link;
					die();
				}	
			} else {
				echo "Invalid Credentials.";
				die();
				// die('Oops! Wrong Credentials');
			}
		} else {
			echo "Invalid Credentials.";
			die();
			// dd('Oops! Wrong Credentials');
		}
	}


	function ResendVerify(Request $request) {
		if ($request->isMethod('post')) {
			$validator = Validator::make($request->all(), [
				"email" => "required|email",
			]);
			if($validator->fails()) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
			}

			$captcha = session()->get('captcha_text');			
			if($request->captcha != $captcha) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
			}
			if($request->captcha == $captcha) {
				session()->put('captcha_text', '');
				session()->save();
			}

			$organization = Organization::where('email', $request->email)->where('is_active', '0')->first();
			if($organization) {
				$organization->updated_at = date('Y-m-d H:i:s');
				$raw_pwd = $organization->raw_pwd;
				$pwd_gen = false;
				if(empty($organization->raw_pwd)) {					
					$raw_pwd =  substr(str_shuffle('9ddfoaevyqgbq5abfp1f'), 5, 5);
					$organization->raw_pwd = $raw_pwd;
					$pwd_gen = true;
				}
				$organization->password = Hash::make($raw_pwd);
				$token = Hash::make($request->email);
				$organization->verify_token = $token;
				$organization->save();
				
				$Application = Application::where('user_id', $organization->id)->orderBy('id', 'DESC')->first();
				$appno = $Application->application_no;

				$to = $request->email;
				$subject = "Registration Successfull";
				$txt = "";
				if($pwd_gen == true) {
					$txt .= "Your New Password is:".$raw_pwd;
				}
				$txt .= 'Please click the verify link to verfiy the account: '.env('APP_URL').'verify?token='.$token.'&appno='.$appno;


				$response = $this->send_email($to, $subject, $txt);
				$logsemail = new LogsEmail;
				$logsemail->from  = 'noreply@eeaa.com';
				$logsemail->to  = $to;
				$logsemail->subject  = $subject;
				$logsemail->body  = $txt;
				$logsemail->created_at  = date('Y-m-d H:i:s');
				$logsemail->response  = $response;
				$logsemail->save();

				return response()->json(['type' => 'success', 'text' => 'Verification Link Sent Successfully'], 200);


			} else {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['Unable to get the user details']]], 422);
			}

		} else {
			return view('resend-verify');
		}
	}

	function ResendPwdResetLink(Request $request) {
		if ($request->isMethod('post')) {
			$validator = Validator::make($request->all(), [
				"email" => "required|email",
			]);
			if($validator->fails()) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
			}

			$captcha = session()->get('captcha_text');			
			if($request->captcha !== $captcha) {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
			}
			if($request->captcha == $captcha) {
				session()->put('captcha_text', '');
				session()->save();
			}

			$organization = Organization::where('email', $request->email)->first();
			if($organization) {
				$organization->updated_at = date('Y-m-d H:i:s');
				$raw_pwd = $organization->raw_pwd;
				$pwd_gen = false;
				// if(empty($organization->raw_pwd)) {					
				// 	$raw_pwd =  substr(str_shuffle('9ddfoaevyqgbq5abfp1f'), 5, 5);
				// 	$organization->raw_pwd = $raw_pwd;
				// 	$pwd_gen = true;
				// }
				// $organization->password = Hash::make($raw_pwd);
				$token = Hash::make($request->email);
				$organization->verify_token = $token;
				$organization->save();

				$to = $request->email;
				$subject = "Reset Password Link";
				$txt = "";
				$txt .= 'Please click the link to reset your account password: '.env('APP_URL').'reset-password?token='.$token;

				$from = 'noreply@eeaa.com';
				$data = [
					'head' => 'Reset Password Link',
					'sub' => 'Please Click the link below to reset the password',
					'txt' => $txt,
				];
				\Email::send($to, $from, $subject, 'emails.email', $data);

				return response()->json(['type' => 'success', 'text' => 'Password Verification Link Sent Successfully'], 200);


			} else {
				return response()->json(['message' => '', 'errors' => ['validation_error' => ['Unable to get the user details']]], 422);
			}

		} else {
			return view('resend-pwd-email');
		}
	}


	function reset_password(Request $request) {
		$token = $request->token;
		$expired_link = "<p>Oops Link Expired, Please <a href=".url('reverify-pwd').">click</a> to reset password verify link</p>";
		
		// $organization = Organization::where('verify_token', $token)->where('is_active', '0')->first();
		$organization = Organization::where('verify_token', $token)->first();
		if($organization) {
			$email = $organization->email;
			$expired_in = $organization->expired_in;


			$updated_at = new \DateTime($organization->updated_at);
			$now = new \DateTime();
			$interval = $updated_at->diff($now);
			$minutes = $interval->format('%i');
			if($minutes > $expired_in) {
				echo $expired_link;
				die();
			}
			return view('reset-pwd', compact('email'));

		} else {
			echo "Invalid Credentials.";
			die();
			// dd('Oops! Wrong Credentials');
		}
	}

	public function reset_org_password(Request $request)
	{

		$validator = Validator::make($request->all(), [
			"password" => "required|same:cpassword",
			"cpassword" => "required"
		], [
			'password.same' => 'Password and Confirm Password Should Match',
		]);
		if($validator->fails()) {
			return response()->json(['message' => '', 'errors' => ['validation_error' => $validator->errors()->all()]], 422);
		}

		$captcha = session()->get('captcha_text');			
		if($request->captcha != $captcha) {
			return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
		}
		if($request->captcha == $captcha) {
			session()->put('captcha_text', '');
			session()->save();
		}

		$Organization = Organization::where('email', $request->email)->first();
		$Organization->password = Hash::make($request->password);
		$Organization->is_active = '1';
		$Organization->updated_at = date('Y-m-d H:i:s');

		if($Organization->save()){
			return response()->json(['type' => 'success', 'text' => 'Password Reset Successfull, Please wait...'], 200);	
		} else {
			return response()->json(['message' => '', 'errors' => ['validation_error' => ['Oops! some error']]], 422);
		}
	}




	function send_email($to, $subject='', $txt='', $from='noreply@eeaa.com') {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from;		
		$data = [
			'txt' => $txt
		];
		$info = json_decode(json_encode([
			'from' => $from,
			'subject' => $subject,
			'to' => $to,
		]));
		Mail::send('emails.regverify', $data, function ($message) use ($info) {
			$message->from($info->from);
			$message->subject($info->subject);
			$message->to($info->to);
		});
		if(count(Mail::failures()) > 0) {
			return json_encode(Mail::failures());
		} else {
			return true;
		}

		// return mail($to, $subject, $txt, $headers);
		// mail('subhojit.mobotics@gmail.com', $subject, $txt, $from);
		// mail('mobotics.aniruddha@gmail.com', $subject, $txt,$headers);
		// dd('asas');
	}
}
