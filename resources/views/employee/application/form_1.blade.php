@extends('common.backend.layout')
@section('title',__('Registration'))
@push('styles')
{{-- <link rel="stylesheet" href="http://www.jquery-steps.com/Content/Examples?v=oArYkice2OEJI0LuKioGJ4ayetiUonme8i983GzQqX41"> --}}
<link href="{{ asset('assets/css/blue.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"
	crossorigin="anonymous" />
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
	.vertical-wizard .steps.clearfix {
		clear: none;
		width: 30%;
		float: left;
	}

	.vertical-wizard .content.clearfix {
		clear: none;
		width: 70%;
		float: left;
	}

	.vertical-wizard .content {
		background: #eee;
		padding: 20px;
	}

	.vertical-wizard .content h3 {
		display: none;
	}

	.vertical-wizard ul[role="tablist"],
	.vertical-wizard ul[role="menu"] {
		list-style: none;
		padding-left: 0px;
	}

	.vertical-wizard ul[role="tablist"] li .current-info {
		display: none;
	}

	.wizard>.steps a,
	.wizard>.steps a:hover,
	.wizard>.steps a:active {
		display: block;
		width: auto;
		margin: 0 .5em .5em;
		padding: 1em 1em;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}

	.wizard>.steps .done a,
	.wizard>.steps .done a:hover,
	.wizard>.steps .done a:active {
		background: #9dc8e2;
		color: #fff;
	}

	.wizard>.steps .current a,
	.wizard>.steps .current a:hover,
	.wizard>.steps .current a:active {
		background: #2184be;
		color: #fff;
		cursor: default;
	}

	.wizard>.actions a,
	.wizard>.actions a:hover,
	.wizard>.actions a:active {
		background: #2184be;
		color: #fff;
		display: block;
		padding: .5em 1em;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}

	.wizard.vertical>.actions {
		display: inline;
		float: right;
		margin: 0 2.5%;
		width: 95%;
	}

	.wizard>.actions>ul {
		display: inline-block;
		text-align: right;
	}

	.wizard.vertical>.actions>ul>li {
		margin: 0 0 0 1em;
	}

	.wizard>.actions>ul>li {
		float: left;
	}

	.wizard>.actions>ul {
		float: right;
	}

	.wizard>.actions a,
	.wizard>.actions a:hover,
	.wizard>.actions a:active {
		background: #2184be;
		color: #fff;
		display: block;
		padding: .5em 1em;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}

	label {
		color: #000;
	}

	label.error {
		color: #ff006a;
	}

	.input-sm {
		height: 20px;
	}

	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		margin: 0;
	}

	.checkbox input[type=checkbox],
	.checkbox-inline input[type=checkbox],
	.radio input[type=radio],
	.radio-inline input[type=radio],
	[type=radio]:not(:checked),
	[type=radio]:checked {
		position: initial;
		left: 0px;
		opacity: 11;
	}

	.select2 {
		display: block;
		width: 100%;
	}

	.btn:hover {
		color: #fff;
	}

	.vertical-wizard {
		background: #fff;
		padding: 30px;
	}

	.vertical-wizard .number {
		display: none;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #444;
		line-height: 38px;
	}

	.select2-container .select2-selection--single {
		border: 1px solid #ddd;
		height: 38px
	}

	.form-box .btn,
	.form-box .btn-large,
	.form-box .btn-small {
		background: #dc3545;
		border-color: #dc3545;
		padding: 5px 20px;
	}

	.form-box .btn:hover,
	.form-box .btn-large:hover,
	.form-box .btn-small:hover {
		background: #dc3545;
		border-color: #dc3545;
	}

	input.error,
	select.error {
		border: 1px solid red;
	}

	.country_ext {
		width: 30%;
	}

	.country_ext .select2 {
		width: 100% !important;
	}

	.btn-success {
		background: green !important;
		border: 1px solid !important;
	}

	.bg-white {
		background: #fff;
		padding: 30px;
	}

	.fw-600 {
		font-weight: 600;
	}
</style>
@endpush

@push('style')
<style>
	label {
		font-weight: 600;
	}

	label.info {
		font-weight: 400;
	}
</style>
@endpush

@section('content')

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 col-12 align-self-center">
				<h3 class="text-white">Groups</h3>
				<ol class="breadcrumb ">
					<li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
					<li class="breadcrumb-item active text-white">Application List</li>
				</ol>
			</div>
			<div class="col-md-7 col-4 align-self-center">
			</div>
		</div>



		<div class="row mt-low">
			<div class="col-lg-12 col-md-12">
				<div class="card ">
					<div class="card-body">
						<div class="row bg-white">
							<div class="col-md-12">

								<h3 class="text-center">Review Form</h3>
								@if ($application->status == 'review' && $group->employee_status && $permission->u)
								<div class="col-lg-12 text-right">
									<button class="btn btn-default btn-danger"
										onclick="reject(this)">Reject</button>&nbsp;&nbsp;
									<button class="btn btn-default btn-primary" onclick="approve(this)">Approve</button>
								</div>
								@endif

								@if (($application->status == 'fapprove' && $application->ceo_status == 'review') &&
								$group->ceo_status && $permission->u)
								<div class="col-lg-12 text-right">
									<button class="btn btn-default btn-danger"
										onclick="reject(this, 'lreject')">Reject</button>&nbsp;&nbsp;
									<button class="btn btn-default btn-primary"
										onclick="approve(this, 'lapprove')">Approve</button>
								</div>
								@endif
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-12">
												<label for=""
													class="text-center"><b><i>{{__("Account Info")}}</i></b></label>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">{{__("Company Name")}}:</label><br />
													<label for="" id="lbl_name">{{$userInfo->name}}</label><br />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">{{__("Email")}}:</label>
													<label for="" id="lbl_email">{{$userInfo->email}}</label>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">{{__("Password")}}</label>
													<label for="" id="lbl_password"></label>
												</div>
											</div>
											<div class="col-lg-4 d-none">
												<div class="form-group">
													<label for="">Regtype</label>
													<label for="" id="lbl_regtype"></label>
												</div>
											</div>

											<div class="col-lg-12" id="wrapper_view_t1">
												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__(" Applicant data")}}</i></b></label>
													</div>

													<div class="col-md-12">
														<label>{{__("Full Name")}} <code>*</code></label>
														<div class="form-group">
															<label for="" id="lbl_name_1_t1"></label>
														</div>
													</div>
													<div class="col-md-6 mb-2">
														<label>{{__("Applicant Status")}} <code>*</code></label><br />
														<label for="" id="lbl_applicant_status_1_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label>{{__("Nationality")}}<code>*</code></label><br />
														<label for="" id="lbl_nationality_1_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label>{{__("ID number (full) ")}} <code>*</code></label><br />
														<label for="" id="lbl_id_number_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("Passport number (for non-Egyptians) ")}}
															<code>*</code></label><br />
														<label for="" id="lbl_passport_number_1_t1">22</label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("Address (as stated in ID) ")}}<code>*</code></label><br />
														<label for="" id="lbl_place_of_res_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("Actual address")}}<code>*</code></label><br />
														<label for="" id="lbl_actual_place_of_res_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("Mailing address")}}<code>*</code></label><br />
														<label for="" id="lbl_corrs_add_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_land_with_ext_1_t1"></label>)
																</td>
																<td>
																	<label>{{__("LAND LINE (WITH CODE)")}}<code>*</code></label><br />
																	<label for="" id="lbl_land_with_code_1_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_fax_with_ext_1_t1"></label>)
																</td>
																<td>
																	<label>{{__("FAX (WITH CODE)")}}</label><br />
																	<label for="" id="lbl_fax_with_code_1_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_personal_ext_1_t1"></label>)
																</td>
																<td>
																	<label>{{__("MOBILE (PERSONAL)")}}</label><br />
																	<label for="" id="lbl_mobile_personal_1_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_work_ext_1_t1"></label>)
																</td>
																<td>
																	<label>{{__("MOBILE (WORK)")}}<code>*</code></label><br />
																	<label for="" id="lbl_mobile_work_1_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("EMAIL (PERSONAL)")}}</label><br />
														<label for="" id="lbl_email_personal_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("EMAIL (WORK)")}}<code>*</code></label><br />
														<label for="" id="lbl_email_work_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("WEBSITE (for companies only)")}}</label><br />
														<label for="" id="lbl_website_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("DOCUMENT TYPE")}}<code>*</code></label><br />
														<label for="" id="lbl_doctype_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("REQUEST TYPE")}} <code>*</code></label><br />
														<label for="" id="lbl_reqtype_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("NOTES")}}</label><br />
														<label for="" id="lbl_notes_1_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Owners data")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label>{{__("Full Name")}}</label><br />
														<label id="lbl_name_2_t1"></label>
													</div>
													<div class="col-md-12">
														<label>{{__("Nationality")}} <code>*</code></label><br />
														<label id="lbl_nationality_2_t1"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label
															for="">{{__("ID number (full)")}}<code>*</code></label><br />
														<label id="lbl_id_number_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">{{__("Passport number (for non-Egyptians)")}}
															<code>*</code></label><br />
														<label id="lbl_passport_number_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">{{__("Address (as stated in ID)")}}
															<code>*</code></label><br />
														<label id="lbl_place_of_res_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">{{__("Actual address")}}
															<code>*</code></label><br />
														<label id="lbl_actual_place_of_res_2_t1"></label>
													</div>
													<div class="col-lg-4 mt-3">
														<label for="">{{__("Owners' shares (Carat\Kirat)")}}
															<code>*</code></label><br />
														<label for="" id="lbl_partner_ship_rate_by_carat_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_land_with_ext_2_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("LAND LINE (WITH CODE)")}}</label><br />
																	<label id="lbl_land_with_code_2_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_fax_with_ext_2_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("FAX (WITH CODE)")}}</label><br />
																	<label for="" id="lbl_fax_with_code_2_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_personal_ext_2_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("MOBILE (PERSONAL)")}}</label><br />
																	<label for="" id="lbl_mobile_personal_2_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_work_ext_2_t1"></label>)
																</td>
																<td>
																	<label for="">{{__("MOBILE (WORK)")}}
																		<code>*</code></label><br />
																	<label for="" id="lbl_mobile_work_2_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("EMAIL (PERSONAL)")}}</label><br />
														<label id="lbl_email_personal_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("EMAIL (WORK)")}}<code>*</code></label><br />
														<label for="" id="lbl_email_work_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("WEBSITE (for companies only)")}}</label><br />
														<label for="" id="lbl_website_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("NOTES")}}</label><br />
														<label for="" id="lbl_notes_2_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Marine unit data")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Name of vessel Owner (Legal Representative)")}}
															<code>*</code></label><br />
														<label id="lbl_name_of_unit_owner_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("Entity trade mark")}}
															<code>*</code></label><br />
														<label id="lbl_business_attribute_of_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("Entity type")}} <code>*</code></label><br />
														<label id="lbl_entity_type_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">>{{__("Commercial Registration No")}}
															<code>*</code></label><br />
														<label for="" id="lbl_commer_reg_no_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Tax card number")}}<code>*</code></label><br />
														<label for="" id="lbl_tax_card_no_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("Mailing address")}}
															<code>*</code></label><br />
														<label for="" id="lbl_corrs_add_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("(Carat\Kirat) quota")}}<code>*</code></label><br />
														<label for="" id="lbl_carat_quota_3_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_telephone_ext_3_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("Land line (with code)")}}</label><br />
																	<label id="lbl_telephone_3_t1"></label><br />
																</td>
															</tr>
														</table>
													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for="" id="lbl_fax_with_ext_3_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("Fax (with code)")}}</label><br />
																	<label for="" id="lbl_fax_with_code_3_t1"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_number_p_ext_3_t1"></label>)
																</td>
																<td>
																	<label
																		for="">{{__("Mobile Number (Personal)")}}</label><br />
																	<label for="" id="lbl_mobile_number_p_3_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>{{__("CODE")}}<code>*</code></label><br />
																	(<label for=""
																		id="lbl_mobile_work_w_ext_3_t1"></label>)
																</td>
																<td>
																	<label for="">{{__("MOBILE (WORK)")}}
																		<code>*</code></label><br />
																	<label for="" id="lbl_mobile_work_w_3_t1"></label>
																</td>
															</tr>
														</table>

													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("EMAIL (PERSONAL)")}}</label><br />
														<label for="" id="lbl_email_personal_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("WEB SITE")}}</label><br />
														<label for="" id="lbl_website_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>{{__("NOTES")}}</label><br />
														<label for="" id="lbl_notes_3_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("VESSEL DATA")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Name of vessel (in Arabic)")}}<code>*</code></label><br />
														<label id="lbl_maritime_unit_arabic_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Name of vessel  (in ENGLISH)")}}<code>*</code></label><br />
														<label id="lbl_maritime_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Registration Number")}}<code>*</code></label><br />
														<label id="lbl_reg_number_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">{{__("Port of Registration")}}
															<code>*</code></label><br />
														<label id="lbl_port_of_reg_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Date of registration (day / month / year)")}}<code>*</code></label><br />
														<label id="lbl_date_of_reg_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Vessel navigation area (as described in the license)")}}<code>*</code></label><br />
														<label id="lbl_maritime_license_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Vessel registered activities (as described in navigation license)")}}<code>*</code></label><br />
														<label id="lbl_craft_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Number of crew by vessel")}}<code>*</code></label><br />
														<label for="" id="lbl_number_of_crew_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Total length of the vessel (m)")}}<code>*</code></label><br />
														<label id="lbl_total_length_of_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Maximum registered passengers capacity by the vessel")}}<code>*</code></label><br />
														<label id="lbl_number_of_passenger_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Construction type")}}<code>*</code></label><br />
														<label id="lbl_construction_type_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Total WEIGHT of VESSEL (ton)")}}<code>*</code></label><br />
														<label id="lbl_total_weight_of_vessel_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Specification of zodiac accompanying the unit (if avilable)")}}</label><br />
														<label id="lbl_spec_of_rubber_boat_unit_4_t1"></label><br />
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Classification of the vessel (as indicated by eeaa)")}}<code>*</code></label><br />
														<label for="" id="lbl_classifi_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Requested marine activity by the owner(s) of the vessel inside PAs")}}<code>*</code></label><br />
														<label for="" id="lbl_marine_activity_unit_4_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Avilable allowed activities by each PAs (please chick attached maps)")}}<code>*</code></label><br />
														<label id="lbl_unit_area_of_activity_4_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Jetty(ies)/marina(s) used by the vessel")}}<code>*</code></label><br />
														<label id="lbl_getty_marina_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Specific navigation route for requested activities by the vessel")}}</label><br />
														<label id="lbl_unit_practice_location_4_t1"></label>
													</div>
												</div>


												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Water used on board")}}</i></b></label>
													</div>
												</div>


												<div class="row">
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__('Water tank in the vessel')}}<code>*</code></label><br />
														<label id="lbl_water_unit_in_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__('Water tank capacity (m3)')}}<code>*</code></label><br />
														<label id="lbl_tank_capacity_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__('Average daily water consumption (m3/day)')}}<code>*</code></label><br />
														<label id="lbl_daily_consumption_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__('Number of water tanks')}}<code>*</code></label><br />
														<label id="lbl_number_of_tanks_5_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Sewage")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__('Vessel\'s sewage tank')}}<code>*</code></label><br />
														<label id="lbl_vessel_drainage_in_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Sewage tank capacity (m3)")}}<code>*</code></label><br />
														<label id="lbl_tank_capacity_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Average daily amount of sewage (m3/day)")}}<code>*</code></label><br />
														<label id="lbl_daily_exchange_rate_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Handling and treatment of sewage")}}<code>*</code></label><br />
														<label id="lbl_get_rid_of_drainage_6_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Oil/Fuel waste")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Tank for oil/fuel wastes ")}}<code>*</code></label><br />
														<label id="lbl_vessel_drainage_in_7_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Waste tank capacity (m3)")}}<code>*</code></label><br />
														<label id="lbl_tank_capacity_7_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label
															for="">{{__("Handling and treatment of oil/fuel wastes ")}}<code>*</code></label><br />
														<label id="lbl_get_rid_of_residues_7_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Engines")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Number of engines per vessel")}}<code>*</code></label><br />
														<label id="lbl_main_motor_per_unit_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">{{__("Engine brand")}}<code>*</code></label><br />
														<label id="lbl_motor_brand_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Engine power 1")}}<code>*</code></label><br />
														<label for="" id="lbl_eng_capacity_1_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">{{__("Engine power 2")}}</label><br />
														<label id="lbl_eng_capacity_2_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">{{__("Engine power 3")}}</label><br />
														<label id="lbl_eng_capacity_3_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">{{__("Engine power 4")}}</label><br />
														<label id="lbl_eng_capacity_4_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label
															for="">{{__("Types of fuel used in engines")}}<code>*</code></label><br />
														<label id="lbl_type_of_fuel_used_8_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Solid waste")}}</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-5 mb-2">
														<label
															for="">{{__("Solid waste collection area in the vessel")}}<code>*</code></label><br />
														<label for="" id="lbl_waste_collection_in_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label
															for="">{{__("Capacity of solid waste area (m3)")}}<code>*</code></label><br />
														<label id="lbl_tank_capacity_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label
															for="">{{__("Average daily generated solid waste (m3/day)")}}<code>*</code></label><br />
														<label id="lbl_avg_daily_waste_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label
															for="">{{__("Handling and treatment of solid waste")}}<code>*</code></label><br />
														<label id="lbl_get_rid_of_solid_9_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12 text-center">
														<label for="" class=""><b><i>{{__("BRANCHES")}}</i></b></label>
													</div>
													<div class="row">
														<div class="col-lg-12">
															<label
																for="">{{__("No. Of Branches")}}<code>*</code></label><br />
															<label for="" id="payment_fees"></label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12 text-center">
														<label for="" class=""><b><i>{{__("Reg Fess")}}</i></b></label>
													</div>
													<div class="row">
														<div class="col-lg-12">
															<label
																for="">{{__("Total Reg. Fees")}}<code>*</code></label><br />
															<label for=""
																id="lbl_reg_fees"></label>&nbsp;&nbsp;{{__("(USD)")}}
														</div>
													</div>
												</div>


												<div class="row">
													<div class="col-md-12">
														<label for=""
															class="text-center"><b><i>{{__("Attached Documents")}}</i></b></label>
													</div>
													<div class="col-lg-12">
														<div class="row col-wrapper-doc">
															{{-- <div class="col-lg-6">
																<label for="">Doc1</label><br/>
																<a href="">Ani</a>
															</div> --}}
															{{-- <div class="col-lg-6">
																<label for="">Doc2</label><br/>
																<a href="">Lorem Ipsum</a>
															</div> --}}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer class="footer">
			© {{date('Y')}} Admin
		</footer>
	</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	$(function(){
		t1_json_data();
	})
	var tabArr = ['$tab1'];
	$tab1 = <?php echo json_encode($tab1); ?>;
	$.each($tab1, function(i,v) {
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab2 = <?php echo json_encode($tab2); ?>;
	$.each($tab2, function(i,v) {
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab3 = <?php echo json_encode($tab3); ?>;
	$.each($tab3, function(i,v) {
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab4 = <?php echo json_encode($tab4); ?>;
	$.each($tab4, function(i,v) {
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab5 = <?php echo json_encode($tab5); ?>;
	$.each($tab5, function(i,v) {
		if(i == 'water_unit_in_5_t1') {
			if(v == 'y') {
				v = 'yes';
			} else if(v == 'n') {
				v = 'no';
			} else {
				v= '';
			}
		}
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab6 = <?php echo json_encode($tab6); ?>;
	$.each($tab6, function(i,v) {
		if(i == 'vessel_drainage_in_6_t1') {
			if(v == 'y') {
				v = 'yes';
			} else if(v == 'n') {
				v = 'no';
			} else {
				v= '';
			}
		}
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab7 = <?php echo json_encode($tab7); ?>;
	$.each($tab7, function(i,v) {
		if(i == 'vessel_drainage_in_7_t1') {
			if(v == 'y') {
				v = 'yes';
			} else if(v == 'n') {
				v = 'no';
			} else {
				v= '';
			}
		}
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab8 = <?php echo json_encode($tab8); ?>;
	$.each($tab8, function(i,v) {
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab9 = <?php echo json_encode($tab9); ?>;
	$.each($tab9, function(i,v) {
		if(i == 'waste_collection_in_9_t1') {
			if(v == 'y') {
				v = 'yes';
			} else if(v == 'n') {
				v = 'no';
			} else {
				v= '';
			}
		}
		$('#lbl_'+i).html(v).addClass('info');
	})
	$tab10 = <?php echo json_encode($tab10); ?>;
	$.each($tab10, function(i,v) {
		$('#payment_fees').html(v).addClass('info');
	})

	function t1_json_data(){
		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', "{{ $application->application_no }}");
		$.ajax({
			url: "{{route('application.t1_json_data')}}",
			type: 'POST',
			data: formData,
			dataType: 'JSON',
			processData: false,
			contentType: false,
			success: function(res) {
				// console.log(res);
				const {data} = res.application;
				const {doc_list} = res;
				if(data) {
					$('.col-wrapper-doc').html('');
					for(var i in data.upload_doc) {
						// console.log(i, data.upload_doc[i], doc_list[i]);
						$('.col-wrapper-doc').append(`<div class="col-lg-6">
																<label for="">${doc_list[i]}</label><br/>
																<a href="{{url('/')}}/${data.upload_doc[i]}" target="_blank">Uploaded File</a>
															</div>
													 </div>`);
					}

					$('#lbl_marine_activity_unit_4_t1').html(data.vessel.marine_activity_unit_4_t1);
					$('#lbl_unit_area_of_activity_4_t1').html(data.vessel.unit_area_of_activity_4_t1);
				}
			},
			error: function(error) {
				console.log(error)
			},
			complete: function(data) {
				console.log('Complete');
			}

		});
	}

	function approve(elem, status='fapprove') {
		window._this = $(elem);
		if(confirm('Are you sure want to approve?')) {
			changeStatus('{{$application->application_no}}', status);

		}
	}

	function reject(elem, status='freject') {
		window._this = $(elem);
		if(confirm('Are you sure want to reject?')) {
			changeStatus('{{$application->application_no}}', status);

		}
	}

	$(function(){
		$.ajax({
			url: '{{route("application.form1RegFees", ["application_no" =>$application->application_no])}}',
			type : 'GET',
			dataType: 'json',
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {				
				422: function(errors) {
					// var html = '';

					// $.each(errors.responseJSON.errors.validation_error, function(key,value){
					// 	html +=value;
					// });

					// toastr("error")[html];
					// $.LoadingOverlay("hide");

				},
				500: function (error) {
					
				},
				200: function (res) {
					$('#totalFees, #lbl_reg_fees').text(res.payment_fees);
					$.LoadingOverlay("hide");

				}
			}

		});
	})

	function changeStatus(appno, status) {
		$('button').prop('disabled', true);
		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', appno);
		formData.append('status', status);
		$.ajax({
			url: "{{route('applicationlist.change_status')}}",
			type: 'POST',
			data: formData,
			dataType: 'JSON',
			processData: false,
			contentType: false,
			success: function(res) {
				// console.log(res);
				if(res.type == 'error') {
					toastr['error'](res.text);
				} else {
					toastr['success'](res.text);
				}
				window.location.href="{{route('applicationlist.index')}}";
				$(_this).prop('disabled', false);
			},
			error: function(error) {
				console.log(error);
				$(_this).prop('disabled', false);

			},
			complete: function(data) {
				console.log('Complete');
				$(_this).prop('disabled', false);

			}

		});
	}

</script>
@endpush