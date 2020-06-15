@extends('common.layout')
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
</style>
@endpush
@section('content')
<div class="bg-image" style="background-image: url({{url('assets/images/background/login-register.jpg')}})">
	<div class="container">
		<div class="form-box">
			<h2 class="text-center text-white mb-3">SIGN UP</h2>


			<div class="row justify-content-md-center" id="login_section">
				<div class="col-md-7 p-5" style="border: 1px solid #ccc; background: #fff;">
					<div class="row mb-5">
						<div class="col-md-12 text-center mb-5">
							<h2 for=""><b>Registration</b></h2>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control input-sm" placeholder="Name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control input-sm" placeholder="Email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control input-sm"
									placeholder="Password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cpassword">Confirm Password</label>
								<input type="password" name="cpassword" class="form-control input-sm"
									placeholder="Confirm Password">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Registration Type</label>
								<select name="reg_type" class="form-control select2" onchange="regTypeChange(this)">
									<option value="">Select</option>
									<option value="section1">Marine units</option>
									<option value="section2">Dive centers</option>
									<option value="section3">Marine activity centers</option>
									<option value="section4">Tourist companies a</option>
									<option value="section5">Other entities and individuals</option>
									<option value="section6">Temporary activities (individual entities)</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<button style="color: #fff;" onclick="personalCred()"
								class=" btn btn-sm btn-default float-right  mt-3">Next</button>
						</div>
					</div>

				</div>
			</div>
			<div class="row justify-content-md-center mb-3" style="display: none;" id="login_section_reedit">
				<div class="col-md-6">
					<button onclick="login_section_reedit()" class="btn btn-primary btn-block btn-link">Back To Login
						Section Edit</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div id="errorDiv"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="successDiv"></div>
				</div>
			</div>

			{{-- Section1 Tab (Marine units) --}}
			<div class="row" id="section1_tab" style="display: none;">
				<div class="col-md-12">
					<form action="{{ route('sign-up') }}" id="regForm_t1" role="form" method="post"
						accept-charset="utf-8">
						@csrf
						<div id="vertical-wizard" class="vertical-wizard">

							<h3>APPLICANT'S DATA AND PRESCRIPTION</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant's data and
													prescription</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-11</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name <code>*</code></label>
										<div class="form-group">
											<input type="text" name="name_1_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t1" id="applicant_status_1_t1"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_1_t1" id="nationality_1_t1"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">The actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t1"
												id="corrs_add_1_t1" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_1_t1" id="land_with_ext_1_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t1"
												class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_1_t1" id="fax_with_ext_1_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t1"
												class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t1" id="mobile_personal_ext_1_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t1" id="mobile_work_ext_1_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t1" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>DOCUMENT TYPE <code>*</code></label>
										<select name="doctype_1_t1" id="doctype_1_t1" class="form-control select2">
											<option value="">Select</option>
											@foreach ($doctype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t1" id="reqtype_1_t1" class="form-control select2">
											<option value="">Select</option>
											@foreach ($doctype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t1" id="notes_1_t1" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
									</div>
								</div>
							</section>

							<h3>OWNER / OWNERS OF VESSEL DATA</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Owner / Owners of VESSEL
													DATA</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-11</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t1" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t1" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_2_t1" id="nationality_2_t1"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_2_t1"
												class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-4 mt-3">
										<label for="">Partnership rate BY CARAT <code>*</code></label>
										<div class="form-group">
											<select name="partner_ship_rate_by_carat_2_t1" class="form-control select2"
												id="partner_ship_rate_by_carat_2_t1">
												<option value="">Select</option>
												@foreach ($rate_by_carat as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_2_t1" id="land_with_ext_2_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_2_t1" id="fax_with_ext_2_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t1" id="mobile_personal_ext_2_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t1" id="mobile_work_ext_2_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t1" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_2_t1" id="notes_2_t1" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Marine unit data</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Marine unit data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-11</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Name of Unit Owner (Legal Representative) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="name_of_unit_owner_3_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Business attribute of the entity <code>*</code></label>
										<div class="form-group">
											<input type="text" name="business_attribute_of_3_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Entity type <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_type_3_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No <code>*</code></label>
										<div class="form-group">
											<input type="number" name="commer_reg_no_3_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Tax card number <code>*</code></label>
										<div class="form-group">
											<input type="number" name="tax_card_no_3_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_3_t1"
												id="corrs_add_2_1" cols="5" rows="3"></textarea>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Carat quota <code>*</code></label>
										<div class="form-group">
											<select name="carat_quota_3_t1" class="form-control select2"
												id="carat_quota_3_t1">
												<option value="">Select</option>
												@foreach ($carat_quota as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Telephone</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="telephone_ext_3_t1" id="telephone_ext_3_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="telephone_3_t1" class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Fax (with code)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_3_t1" id="fax_with_ext_3_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_3_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Mobile Number (Personal)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_number_p_ext_3_t1" id="mobile_number_p_ext_3_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_number_p_3_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_w_ext_3_t1" id="mobile_work_w_ext_3_t1" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_w_3_t1"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_3_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK) <code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_3_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_3_t1" id="" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>VESSEL DATA</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8 text-left mt-3">
										<label for="" class="text-uppercase"><b><i>Marine unit data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-11</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Name of Maritime Unit (in Arabic)<code>*</code></label>
										<div class="form-group">
											<input type="text" name="maritime_unit_arabic_4_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Name of Maritime Unit (in ENGLISH)<code>*</code></label>
										<div class="form-group">
											<input type="text" name="maritime_unit_4_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Registration Number<code>*</code></label>
										<div class="form-group">
											<input type="number" name="reg_number_4_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Port of Registration<code>*</code></label>
										<div class="form-group">
											<select name="port_of_reg_4_t1" id="port_of_reg_4_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($regport as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Date of registration (day / month / year)<code>*</code></label>
										<div class="form-group">
											<input type="text" name="date_of_reg_4_t1"
												class="form-control input-sm  datepicker">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Maritime Licensing Work Area<code>*</code></label>
										<div class="form-group">
											<input type="text" name="maritime_license_4_t1"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">The craft according to the navigation
											license<code>*</code></label>
										<div class="form-group">
											<select name="craft_4_t1" id="craft_4_t1" class="form-control select2">
												<option value="">Select</option>
												@foreach ($craft as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Number of crew on unit<code>*</code></label>
										<div class="form-group">
											<input type="number" name="number_of_crew_4_t1" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Total length of unit (m)<code>*</code></label>
										<div class="form-group">
											<select name="total_length_of_unit_4_t1" id="total_length_of_unit_4_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($length_of_unit as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Number of Passengers Passed<code>*</code></label>
										<div class="form-group">
											<input type="number" name="number_of_passenger_4_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Construction type<code>*</code></label>
										<div class="form-group">
											<select name="construction_type_4_t1" id="construction_type_4_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($const_type as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Total WEIGHT of VESSEL (ton)<code>*</code></label>
										<div class="form-group">
											<select name="total_weight_of_vessel_4_t1" id="total_weight_of_vessel_4_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($weight_of_vessel as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Specification of rubber boat accompanying the unit (if
											AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="spec_of_rubber_boat_unit_4_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Classification of the unit<code>*</code></label>
										<div class="form-group">
											<select name="classifi_unit_4_t1" multiple id="classifi_unit_4_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($classified_unit as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Marine activities to be declared on the unit<code>*</code></label>
										<div class="form-group">
											<select name="marine_activity_unit_4_t1" multiple
												id="marine_activity_unit_4_t1" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									{{-- //// --}}

									<div class="col-lg-12">
										<label for="" class="text-uppercase"><b><i>VESSEL Data</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)<code>*</code></label>
										<div class="form-group">
											<select name="unit_area_of_activity_4_t1" multiple
												id="unit_area_of_activity_4_t1" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">GETTY-MARINA<code>*</code></label>
										<div class="form-group">
											<input type="text" name="getty_marina_4_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">The Unit's practice locations are detailed</label>
										<div class="form-group">
											<input type="text" name="unit_practice_location_4_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>WATER USED IN THE UNIT</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Water used in the
													unit</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-11</i></b></label>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Water unit in the VESSEL<code>*</code></label>
										<div class="form-group">
											<label><input type="radio" name="water_unit_in_5_t1" value="yes"
													checked>Yes</label>
											<label><input type="radio" name="water_unit_in_5_t1" value="no">No</label>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Tank Capacity (m3)<code>*</code></label>
										<div class="form-group">
											<select name="tank_capacity_5_t1" id="tank_capacity_5_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($tank_capacity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Average daily consumption (m3 / day)<code>*</code></label>
										<div class="form-group">
											<select name="daily_consumption_5_t1" id="daily_consumption_5_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($daily_consumption as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Number of Tanks<code>*</code></label>
										<div class="form-group">
											<select name="number_of_tanks_5_t1" id="number_of_tanks_5_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($number_of_tanks as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>SANITATION RESULTING FROM THE USE OF THE UNIT</h3>
							<section data-tab="6">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Sanitation resulting from the use of
													the unit</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 6-11</i></b></label>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">VESSEL drainage tank<code>*</code></label>
										<div class="form-group">
											<label><input type="radio" name="vessel_drainage_in_6_t1" value="yes"
													checked>Yes</label>
											<label><input type="radio" name="vessel_drainage_in_6_t1"
													value="no">No</label>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Tank Capacity (m3)<code>*</code></label>
										<div class="form-group">
											<select name="tank_capacity_6_t1" id="tank_capacity_6_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($tank_capacity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">Daily Exchange Rate (m3 / day)<code>*</code></label>
										<div class="form-group">
											<select name="daily_exchange_rate_6_t1" id="daily_exchange_rate_6_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($exchange_rate as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">How to get rid of drainage<code>*</code></label>
										<div class="form-group">
											<select name="get_rid_of_drainage_6_t1" id="get_rid_of_drainage_6_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($drainage_solution as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>WASTE LIQUID OILS USED IN THE UNIT</h3>
							<section data-tab="7">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Waste liquid oils used in the
													unit</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 7-11</i></b></label>
									</div>

									<div class="col-lg-3 mb-2">
										<label for="">Oil residues TANK<code>*</code></label>
										<div class="form-group">
											<label><input type="radio" name="vessel_drainage_in_7_t1" value="yes"
													checked>Yes</label>
											<label><input type="radio" name="vessel_drainage_in_7_t1"
													value="no">No</label>
										</div>
									</div>
									<div class="col-lg-3 mb-2">
										<label for="">Tank Capacity (m3)<code>*</code></label>
										<div class="form-group">
											<select name="tank_capacity_7_t1" id="tank_capacity_7_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($tank_capacity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">How to get rid of residues TANK OIL<code>*</code></label>
										<div class="form-group">
											<select name="get_rid_of_residues_7_t1" id="get_rid_of_residues_7_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($tank_oil_residuces as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>VESSEL ENGINES</h3>
							<section data-tab="8">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>VESSEL engines</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 8-11</i></b></label>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Number of main MOTORS per unit<code>*</code></label>
										<div class="form-group">
											<input type="number" name="main_motor_per_unit_8_t1"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Motor brand<code>*</code></label>
										<div class="form-group">
											<input type="text" name="motor_brand_8_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Engine capacity 1<code>*</code></label>
										<div class="form-group">
											<input type="text" name="eng_capacity_1_8_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Engine capacity 2</label>
										<div class="form-group">
											<input type="text" name="eng_capacity_2_8_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Engine capacity 3</label>
										<div class="form-group">
											<input type="text" name="eng_capacity_3_8_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Engine capacity 4</label>
										<div class="form-group">
											<input type="text" name="eng_capacity_4_8_t1" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">The type of fuel used in engines <code>*</code></label>
										<div class="form-group">
											<select name="type_of_fuel_used_8_t1" id="type_of_fuel_used_8_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($fuel_types as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>SOLID WASTE</h3>
							<section data-tab="9">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Solid Waste</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 9-11</i></b></label>
									</div>

									<div class="col-lg-5 mb-2">
										<label for="">Waste collection place in the VESSEL<code>*</code></label>
										<div class="form-group">
											<label><input type="radio" name="waste_collection_in_9_t1" value="yes"
													checked>Yes</label>
											<label><input type="radio" name="waste_collection_in_9_t1"
													value="no">No</label>
										</div>
									</div>
									<div class="col-lg-3 mb-2">
										<label for="">Capacity (m3)<code>*</code></label>
										<div class="form-group">
											<select name="tank_capacity_9_t1" id="tank_capacity_9_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($tank_capacity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Average Daily Waste (m3 / day)<code>*</code></label>
										<div class="form-group">
											<select name="avg_daily_waste_9_t1" id="avg_daily_waste_9_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($daily_waste as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">How to get rid of solid waste<code>*</code></label>
										<div class="form-group">
											<select name="get_rid_of_solid_9_t1" id="get_rid_of_solid_9_t1"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($solid_waste_solution as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>

								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="10">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 10-11</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees"
													value="250.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="11">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 11-11</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">Name:</label><br />
													<label for="" id="lbl_name"></label><br />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">Email:</label>
													<label for="" id="lbl_email"></label>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">Password</label>
													<label for="" id="lbl_password"></label>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">Regtype</label>
													<label for="" id="lbl_regtype"></label>
												</div>
											</div>

											<div class="col-lg-12" id="wrapper_view_t1">
												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>APPLICANT'S DATA AND
																	PRESCRIPTION</i></b></label>
													</div>

													<div class="col-md-12">
														<label>Full Name <code>*</code></label>
														<div class="form-group">
															<label for="" id="lbl_name_1_t1">Aniruddha</label>
														</div>
													</div>
													<div class="col-md-6 mb-2">
														<label>Applicant Status <code>*</code></label><br />
														<label for="" id="lbl_applicant_status_1_t1">sdsds</label>
													</div>
													<div class="col-lg-6 mb-2">
														<label>Nationality<code>*</code></label><br />
														<label for="" id="lbl_nationality_1_t1">SJSJ</label>
													</div>

													<div class="col-lg-4 mb-2">
														<label>ID number <code>*</code></label><br />
														<label for="" id="lbl_id_number_1_t1">sdsd</label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>Passport number (for non-Egyptians)
															<code>*</code></label><br />
														<label for="" id="lbl_passport_number_1_t1">22</label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>Place of residence IN ID<code>*</code></label><br />
														<label for="" id="lbl_place_of_res_1_t1">sdsdsd</label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>The actual place of residence<code>*</code></label><br />
														<label for="" id="lbl_actual_place_of_res_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>Correspondence address<code>*</code></label><br />
														<label for="" id="lbl_corrs_add_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>LAND LINE (WITH CODE)<code>*</code></label><br />
														<label for="" id="lbl_land_with_code_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>FAX (WITH CODE)</label><br />
														<label for="" id="lbl_fax_with_code_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>MOBILE (PERSONAL)</label><br />
														<label for="" id="lbl_mobile_personal_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>MOBILE (WORK)<code>*</code></label><br />
														<label for="" id="lbl_mobile_work_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>EMAIL (PERSONAL)</label><br />
														<label for="" id="lbl_email_personal_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>EMAIL (WORK)<code>*</code></label><br />
														<label for="" id="lbl_email_work_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>WEB SITE</label><br />
														<label for="" id="lbl_website_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>DOCUMENT TYPE<code>*</code></label><br />
														<label for="" id="lbl_doctype_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>REQUEST TYPE <code>*</code></label><br />
														<label for="" id="lbl_reqtype_1_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>NOTES</label><br />
														<label for="" id="lbl_notes_1_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>OWNER / OWNERS OF VESSEL
																	DATA</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t1"></label>
													</div>
													<div class="col-md-12">
														<label>Nationality <code>*</code></label><br />
														<label id="lbl_nationality_2_t1"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br />
														<label id="lbl_id_number_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians)
															<code>*</code></label><br />
														<label id="lbl_passport_number_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID
															<code>*</code></label><br />
														<label id="lbl_place_of_res_2_t1"></label>
													</div>
													<div class="col-md-4">
														<label for="">Actual place of residence
															<code>*</code></label><br />
														<label id="lbl_actual_place_of_res_2_t1"></label>
													</div>
													<div class="col-lg-4 mt-3">
														<label for="">Partnership rate BY CARAT
															<code>*</code></label><br />
														<label for="" id="lbl_partner_ship_rate_by_carat_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">LAND LINE (WITH CODE)</label><br />
														<label id="lbl_land_with_code_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">FAX (WITH CODE)</label><br />
														<label for="" id="lbl_fax_with_code_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">MOBILE (PERSONAL)</label><br />
														<label for="" id="lbl_mobile_personal_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">MOBILE (WORK) <code>*</code></label><br />
														<label for="" id="lbl_mobile_work_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br />
														<label id="lbl_email_personal_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br />
														<label for="" id="lbl_email_work_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br />
														<label for="" id="lbl_website_2_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>NOTES</label><br />
														<label for="" id="lbl_notes_2_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>MARINE UNIT
																	DATA</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label for="">Name of Unit Owner (Legal Representative)
															<code>*</code></label><br />
														<label id="lbl_name_of_unit_owner_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Business attribute of the entity
															<code>*</code></label><br />
														<label id="lbl_business_attribute_of_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Entity type <code>*</code></label><br />
														<label id="lbl_entity_type_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Commercial Registration No
															<code>*</code></label><br />
														<label for="" id="lbl_commer_reg_no_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Tax card number <code>*</code></label><br />
														<label for="" id="lbl_tax_card_no_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Correspondence address
															<code>*</code></label><br />
														<label for="" id="lbl_corrs_add_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Carat quota <code>*</code></label><br />
														<label for="" id="lbl_carat_quota_3_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label for="">Telephone</label><br />
														<label id="lbl_telephone_3_t1"></label><br />
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Fax (with code)</label><br />
														<label for="" id="lbl_fax_with_code_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Mobile Number (Personal)</label><br />
														<label for="" id="lbl_mobile_number_p_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">MOBILE (WORK) <code>*</code></label><br />
														<label for="" id="lbl_mobile_work_w_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br />
														<label for="" id="lbl_email_personal_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br />
														<label for="" id="lbl_website_3_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label>NOTES</label><br />
														<label for="" id="lbl_notes_3_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>VESSEL
																	DATA</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label for="">Name of Maritime Unit (in
															Arabic)<code>*</code></label><br />
														<label id="lbl_maritime_unit_arabic_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Name of Maritime Unit (in
															ENGLISH)<code>*</code></label><br />
														<label id="lbl_maritime_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Registration Number<code>*</code></label><br />
														<label id="lbl_reg_number_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Port of Registration <code>*</code></label><br />
														<label id="lbl_port_of_reg_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Date of registration (day / month /
															year)<code>*</code></label><br />
														<label id="lbl_date_of_reg_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Maritime Licensing Work
															Area<code>*</code></label><br />
														<label id="lbl_maritime_license_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">The craft according to the navigation
															license<code>*</code></label><br />
														<label id="lbl_craft_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Number of crew on unit<code>*</code></label><br />
														<label for="" id="lbl_number_of_crew_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Total length of unit
															(m)<code>*</code></label><br />
														<label id="lbl_total_length_of_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Number of Passengers
															Passed<code>*</code></label><br />
														<label id="lbl_number_of_passenger_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Construction type<code>*</code></label><br />
														<label id="lbl_construction_type_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Total WEIGHT of VESSEL
															(ton)<code>*</code></label><br />
														<label id="lbl_total_weight_of_vessel_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Specification of rubber boat accompanying the unit
															(if AVILABLE)</label><br />
														<label id="lbl_spec_of_rubber_boat_unit_4_t1"></label><br />
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Classification of the
															unit<code>*</code></label><br />
														<label for="" id="lbl_classifi_unit_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Marine activities to be declared on the
															unit<code>*</code></label><br />
														<label for="" id="lbl_marine_activity_unit_4_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached
															statement and maps)<code>*</code></label><br />
														<label id="lbl_unit_area_of_activity_4_t1"></label>
													</div>

													<div class="col-lg-4 mb-2">
														<label for="">GETTY-MARINA<code>*</code></label><br />
														<label id="lbl_getty_marina_4_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">The Unit's practice locations are
															detailed</label><br />
														<label id="lbl_unit_practice_location_4_t1"></label>
													</div>
												</div>


												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>WATER USED IN THE
																	UNIT</i></b></label>
													</div>
												</div>


												<div class="row">
													<div class="col-lg-6 mb-2">
														<label for="">Water unit in the
															VESSEL<code>*</code></label><br />
														<label id="lbl_water_unit_in_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Tank Capacity (m3)<code>*</code></label><br />
														<label id="lbl_tank_capacity_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Average daily consumption (m3 /
															day)<code>*</code></label><br />
														<label id="lbl_daily_consumption_5_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Number of Tanks<code>*</code></label><br />
														<label id="lbl_number_of_tanks_5_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>SANITATION RESULTING
																	FROM THE USE OF THE UNIT</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 mb-2">
														<label for="">VESSEL drainage tank<code>*</code></label><br />
														<label id="lbl_vessel_drainage_in_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Tank Capacity (m3)<code>*</code></label><br />
														<label id="lbl_tank_capacity_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Daily Exchange Rate (m3 /
															day)<code>*</code></label><br />
														<label id="lbl_daily_exchange_rate_6_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">How to get rid of
															drainage<code>*</code></label><br />
														<label id="lbl_get_rid_of_drainage_6_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>WASTE LIQUID OILS USED
																	IN THE UNIT</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4 mb-2">
														<label for="">Oil residues TANK<code>*</code></label><br />
														<label id="lbl_vessel_drainage_in_7_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Tank Capacity (m3)<code>*</code></label><br />
														<label id="lbl_tank_capacity_7_t1"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">How to get rid of residues TANK
															OIL<code>*</code></label><br />
														<label id="lbl_get_rid_of_residues_7_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>VESSEL
																	ENGINES</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 mb-2">
														<label for="">Number of main MOTORS per
															unit<code>*</code></label><br />
														<label id="lbl_main_motor_per_unit_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Motor brand<code>*</code></label><br />
														<label id="lbl_motor_brand_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Engine capacity 1<code>*</code></label><br />
														<label for="" id="lbl_eng_capacity_1_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Engine capacity 2</label><br />
														<label id="lbl_eng_capacity_2_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Engine capacity 3</label><br />
														<label id="lbl_eng_capacity_3_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">Engine capacity 4</label><br />
														<label id="lbl_eng_capacity_4_8_t1"></label>
													</div>
													<div class="col-lg-6 mb-2">
														<label for="">The type of fuel used in
															engines<code>*</code></label><br />
														<label id="lbl_type_of_fuel_used_8_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>SOLID
																	WASTE</i></b></label>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-5 mb-2">
														<label for="">Waste collection place in the
															VESSEL<code>*</code></label><br />
														<label for="" id="lbl_waste_collection_in_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label for="">Capacity (m3)<code>*</code></label><br />
														<label id="lbl_tank_capacity_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label for="">Average Daily Waste (m3 /
															day)<code>*</code></label><br />
														<label id="lbl_avg_daily_waste_9_t1"></label>
													</div>
													<div class="col-lg-3 mb-2">
														<label for="">How to get rid of solid
															waste<code>*</code></label><br />
														<label id="lbl_get_rid_of_solid_9_t1"></label>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12 text-center">
														<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
													</div>
													<div class="row">
														<div class="col-lg-12">
															<label for="">Payment Fees<code>*</code></label><br />
															<label for="" id="lbl_payment_fees"></label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<!-- Default unchecked -->
														<div class="checkbox">
															<label style="margin-left:30px;"><input type="checkbox"
																	name="accpet_terms_t1" onclick="accept_terms(this)"
																	value="">I accept the terms & conditions</label>
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t1" disabled
											onclick="submit_t1()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>


						</div>
					</form>
				</div>
			</div>

			{{-- Section2 Tab (Dive Centers) --}}
			<div class="row" id="section2_tab" style="display: none;">
				<div class="col-md-12">
					<form action="" id="regForm_t2" role="form" method="post" accept-charset="utf-8">
						<div id="vertical-wizard_t2" class="vertical-wizard">

							<h3>APPLICANT'S DATA AND PRESCRIPTION</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant's data and
													prescription</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_1_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t2" id="applicant_status_1_t2"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_1_t2" id="nationality_1_t2"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t2" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">The actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t2"
												id="corrs_add_1_t2" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_1_t2" id="land_with_ext_1_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_1_t2" id="fax_with_ext_1_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t2" id="mobile_personal_ext_1_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t2" id="mobile_work_ext_1_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t2" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t2" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t2" class="form-control input-sm">
									</div>
									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t2" id="reqtype_1_t2" class="form-control select2">
											<option value="">Select</option>
											@foreach ($reqtype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t2" id="notes_1_t2" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz2_nextbutton()">Next</button>
									</div>
								</div>
							</section>

							<h3>Center owner data</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Center owner data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-5</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t2" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t2" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t2" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_2_t2" id="nationality_2_t2"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t2"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_2_t2" id="land_with_ext_2_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_2_t2" id="fax_with_ext_2_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t2" id="mobile_personal_ext_2_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t2"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t2" id="mobile_work_ext_2_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t2"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz2_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz2_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Center data (based on official documents)</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Center data (based on official
													documents)</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-5</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Center Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="center_name_arabic_3_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Center Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="center_name_english_3_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">License number of the Ministry of Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="license_number_ministry_of_3_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for=""> License number of the Ministry of Tourism Membership Number of
											Diving Tourism Rooms <code>*</code></label>
										<div class="form-group">
											<input type="text" name="license_number_ministry_of_membership_3_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t2"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Tax card number<code>*</code></label>
										<div class="form-group">
											<input type="number" name="tax_card_no_3_t2" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Address of the Center<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_center_3_t2" id="address_of_the_center_3_t2"
												cols="30" rows="3"></textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="telephone_ext_3_t2" id="telephone_ext_3_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX NO</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_3_t2" id="fax_with_ext_3_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NO1<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t2" id="mobile_no1_ext_3_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NO 2</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t2" id="mobile_no2_ext_3_t2" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t2" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL</label>
										<div class="form-group">
											<input type="email" name="email_3_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t2" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Marine activities to be authorized</label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t2" multiple
												id="marine_activity_authorized_3_t2" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)</label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t2" multiple
												id="unit_area_of_activity_3_t2" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz2_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz2_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees_t2"
													value="50.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz2_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz2_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-5</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Name:</label><br/>
												<label for="" id="lbl2_name"></label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br/>
												<label for="" id="lbl2_email"></label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br/>
												<label for="" id="lbl2_password"></label>
											</div>
											<div class="col-md-4">
												<label for="">Regtype</label><br/>
												<label for="" id="lbl2_regtype"></label>
											</div>	
										</div>
										
										<div class="col-lg-12" id="wrapper_view_t2">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT'S DATA AND PRESCRIPTION</i></b></label>
												</div>

												<div class="col-md-12">
													<label>Full Name <code>*</code></label>
													<div class="form-group">
														<label for="" id="lbl_name_1_t2"></label>
													</div>
												</div>
												<div class="col-md-6 mb-2">
													<label>Applicant Status <code>*</code></label><br />
													<label for="" id="lbl_applicant_status_1_t2"></label>
												</div>
												<div class="col-lg-6 mb-2">
													<label>Nationality<code>*</code></label><br />
													<label for="" id="lbl_nationality_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>ID number <code>*</code></label><br />
													<label for="" id="lbl_id_number_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Passport number (for non-Egyptians)
														<code>*</code></label><br />
													<label for="" id="lbl_passport_number_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Place of residence IN ID<code>*</code></label><br />
													<label for="" id="lbl_place_of_res_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>The actual place of residence<code>*</code></label><br />
													<label for="" id="lbl_actual_place_of_res_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Correspondence address<code>*</code></label><br />
													<label for="" id="lbl_corrs_add_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>LAND LINE (WITH CODE)<code>*</code></label><br />
													<label for="" id="lbl_land_with_code_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>FAX (WITH CODE)</label><br />
													<label for="" id="lbl_fax_with_code_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (PERSONAL)</label><br />
													<label for="" id="lbl_mobile_personal_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (WORK)<code>*</code></label><br />
													<label for="" id="lbl_mobile_work_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (PERSONAL)</label><br />
													<label for="" id="lbl_email_personal_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (WORK)<code>*</code></label><br />
													<label for="" id="lbl_email_work_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>WEB SITE</label><br />
													<label for="" id="lbl_website_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Agency bond number <code>*</code></label><br />
													<label for="" id="lbl_agency_board_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Documentation Office <code>*</code></label><br/>
													<label for="" id="lbl_doc_office_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>REQUEST TYPE <code>*</code></label><br />
													<label for="" id="lbl_reqtype_1_t2"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>NOTES</label><br />
													<label for="" id="lbl_notes_1_t2"></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>CENTER OWNER DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t2"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br/>
														<label for="" id="lbl_nick_name_2_t2"></label>
													</div>
													<div class="col-md-12">
														<label>Nationality <code>*</code></label><br />
														<label id="lbl_nationality_2_t2"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br/>
														<label for="" id="lbl_id_number_2_t2"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians) <code>*</code></label><br/>
														<label for="" id="lbl_passport_number_2_t2"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID <code>*</code></label><br/>
														<label for="" id="lbl_place_of_res_2_t2"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">LAND LINE (WITH CODE)</label><br/>
														<label id="lbl_land_with_code_2_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX (WITH CODE)</label><br/>
														<label id="lbl_fax_with_code_2_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (PERSONAL)</label><br/>
														<label id="lbl_mobile_personal_2_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (WORK) <code>*</code></label><br/>
														<label for="" id="lbl_mobile_work_2_t2"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br/>
														<label id="lbl_email_personal_2_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br/>
														<label id="lbl_email_work_2_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_2_t2"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>CENTER DATA (BASED ON OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">
														<label for="">Center Name (Arabic) <code>*</code></label><br/>
														<label for="" id="lbl_center_name_arabic_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Center Name (ENGLISH) <code>*</code></label><br/>
														<label for="" id="lbl_center_name_english_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">License number of the Ministry of Tourism <code>*</code></label><br/>
														<label for="" id="lbl_license_number_ministry_of_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> License number of the Ministry of Tourism Membership Number of
															Diving Tourism Rooms <code>*</code></label><br/>
														<label for="" id="lbl_license_number_ministry_of_membership_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration No<code>*</code></label><br/>
														<label id="lbl_commercial_reg_no_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Tax card number<code>*</code></label><br/>
														<label id="lbl_tax_card_no_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the Center<code>*</code></label><br/>
														<label for="" id="lbl_address_of_the_center_3_t2"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Landline number</label><br/>
														<label for="" id="lbl_landline_no_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX NO</label><br/>
														<label for="" id="lbl_fax_no_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO1<code>*</code></label><br/>
														<label for="" id="lbl_mobile_no1_3_t2"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO 2</label><br/>
														<label for="" id="lbl_mobile_no2_3_t2"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br/>
														<label for="" id="lbl_email_3_t2"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_3_t2"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Marine activities to be authorized</label><br/>
														<label for="" id="lbl_marine_activity_authorized_3_t2"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached statement and maps)</label><br/>
														<label for="" id="lbl_unit_area_of_activity_3_t2"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">Payment Fees<code>*</code></label><br />
														<label for="" id="lbl_payment_fees_t2"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox" name="accpet_terms_t2" onclick="accept_terms_t2(this)" value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t2" disabled
											onclick="submit_t2()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz2_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>

			{{-- Section3 Tab (Marine activity centers) --}}
			<div class="row" id="section3_tab" style="display: none;">
				<div class="col-md-12">
					<form action="" id="regForm_t3" role="form" method="post" accept-charset="utf-8">
						<div id="vertical-wizard_t3" class="vertical-wizard">

							<h3>APPLICANT'S DATA AND PRESCRIPTION</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant's data and
													prescription</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_1_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t3" id="applicant_status_1_t3"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_1_t3" id="nationality_1_t3"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t3" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">The actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t3"
												id="corrs_add_1_t3" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_1_t3" id="land_with_ext_1_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_1_t3" id="fax_with_ext_1_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t3" id="mobile_personal_ext_1_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t3" id="mobile_work_ext_1_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t3" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t3" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t3" class="form-control input-sm">
									</div>
									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t3" id="reqtype_1_t3" class="form-control select2">
											<option value="">Select</option>
											@foreach ($doctype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t3" id="notes_1_t3" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz3_nextbutton()">Next</button>
									</div>
								</div>
							</section>
							<h3>Owner / Owners of Marine Unit DATA</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Owner / Owners of Marine Unit
													DATA</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-5</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t3" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t3" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t3"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_2_t3" id="land_with_ext_2_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_ext_2_t3" id="fax_with_ext_2_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t3" id="mobile_personal_ext_2_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t3"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t3" id="mobile_work_ext_2_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t3"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t3" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz3_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz3_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Data of the Center (from official documents)</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Data of the Center (from official
													documents)</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-5</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Center Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="center_name_arabic_3_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Center Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="center_name_english_3_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">License number of the Ministry of Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="license_number_ministry_of_3_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for=""> Membership Number of Diving Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="membership_number_3_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t3"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Tax card number<code>*</code></label>
										<div class="form-group">
											<input type="number" name="tax_card_no_3_t3" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Address of the Center<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_center_3_t3" id="address_of_the_center_3_t3"
												cols="30" rows="3"></textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_3_t3" id="land_with_ext_3_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX NO</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_no_ext_3_t3" id="fax_no_ext_3_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NO1<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t3" id="mobile_no1_ext_3_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NO 2</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t3" id="mobile_no2_ext_3_t3" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t3" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL</label>
										<div class="form-group">
											<input type="email" name="email_3_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t3" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Marine activities to be authorized</label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t3" multiple
												id="marine_activity_authorized_3_t3" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)</label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t3" multiple
												id="unit_area_of_activity_3_t3" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz3_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz3_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-15</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees_t3"
													value="250.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz3_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz3_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-5</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Name:</label><br/>
												<label for="" id="lbl3_name"></label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br/>
												<label for="" id="lbl3_email"></label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br/>
												<label for="" id="lbl3_password"></label>
											</div>
											<div class="col-md-4">
												<label for="">Regtype</label><br/>
												<label for="" id="lbl3_regtype"></label>
											</div>	
										</div>
										
										<div class="col-lg-12" id="wrapper_view_t3">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT'S DATA AND PRESCRIPTION</i></b></label>
												</div>

												<div class="col-md-12">
													<label>Full Name <code>*</code></label>
													<div class="form-group">
														<label for="" id="lbl_name_1_t3"></label>
													</div>
												</div>
												<div class="col-md-6 mb-2">
													<label>Applicant Status <code>*</code></label><br />
													<label for="" id="lbl_applicant_status_1_t3"></label>
												</div>
												<div class="col-lg-6 mb-2">
													<label>Nationality<code>*</code></label><br />
													<label for="" id="lbl_nationality_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>ID number <code>*</code></label><br />
													<label for="" id="lbl_id_number_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Passport number (for non-Egyptians)
														<code>*</code></label><br />
													<label for="" id="lbl_passport_number_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Place of residence IN ID<code>*</code></label><br />
													<label for="" id="lbl_place_of_res_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>The actual place of residence<code>*</code></label><br />
													<label for="" id="lbl_actual_place_of_res_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Correspondence address<code>*</code></label><br />
													<label for="" id="lbl_corrs_add_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>LAND LINE (WITH CODE)<code>*</code></label><br />
													<label for="" id="lbl_land_with_code_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>FAX (WITH CODE)</label><br />
													<label for="" id="lbl_fax_with_code_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (PERSONAL)</label><br />
													<label for="" id="lbl_mobile_personal_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (WORK)<code>*</code></label><br />
													<label for="" id="lbl_mobile_work_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (PERSONAL)</label><br />
													<label for="" id="lbl_email_personal_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (WORK)<code>*</code></label><br />
													<label for="" id="lbl_email_work_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>WEB SITE</label><br />
													<label for="" id="lbl_website_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Agency bond number <code>*</code></label><br />
													<label for="" id="lbl_agency_board_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Documentation Office <code>*</code></label><br/>
													<label for="" id="lbl_doc_office_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>REQUEST TYPE <code>*</code></label><br />
													<label for="" id="lbl_reqtype_1_t3"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>NOTES</label><br />
													<label for="" id="lbl_notes_1_t3"></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>OWNER / OWNERS OF MARINE UNIT DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t3"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br/>
														<label for="" id="lbl_nick_name_2_t3"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br/>
														<label for="" id="lbl_id_number_2_t3"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians) <code>*</code></label><br/>
														<label for="" id="lbl_passport_number_2_t3"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID <code>*</code></label><br/>
														<label for="" id="lbl_place_of_res_2_t3"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">LAND LINE (WITH CODE)</label><br/>
														<label id="lbl_land_with_code_2_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX (WITH CODE)</label><br/>
														<label id="lbl_fax_with_code_2_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (PERSONAL)</label><br/>
														<label id="lbl_mobile_personal_2_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (WORK) <code>*</code></label><br/>
														<label for="" id="lbl_mobile_work_2_t3"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br/>
														<label id="lbl_email_personal_2_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br/>
														<label id="lbl_email_work_2_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_2_t3"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>DATA OF THE CENTER (FROM OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">
														<label for="">Center Name (Arabic) <code>*</code></label><br/>
														<label for="" id="lbl_center_name_arabic_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Center Name (ENGLISH) <code>*</code></label><br/>
														<label for="" id="lbl_center_name_english_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">License number of the Ministry of Tourism <code>*</code></label><br/>
														<label for="" id="lbl_license_number_ministry_of_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> Membership Number of Diving Tourism  <code>*</code></label><br/>
														<label for="" id="lbl_membership_number_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration No<code>*</code></label><br/>
														<label id="lbl_commercial_reg_no_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Tax card number<code>*</code></label><br/>
														<label id="lbl_tax_card_no_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the Center<code>*</code></label><br/>
														<label for="" id="lbl_address_of_the_center_3_t3"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Landline number</label><br/>
														<label for="" id="lbl_landline_no_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX NO</label><br/>
														<label for="" id="lbl_fax_no_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO1<code>*</code></label><br/>
														<label for="" id="lbl_mobile_no1_3_t3"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO 2</label><br/>
														<label for="" id="lbl_mobile_no2_3_t3"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br/>
														<label for="" id="lbl_email_3_t3"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_3_t3"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Marine activities to be authorized</label><br/>
														<label for="" id="lbl_marine_activity_authorized_3_t3"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached statement and maps)</label><br/>
														<label for="" id="lbl_unit_area_of_activity_3_t3"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">Payment Fees<code>*</code></label><br />
														<label for="" id="lbl_payment_fees_t3"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox" name="accpet_terms_t3" onclick="accept_terms_t3(this)" value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t3" disabled
											onclick="submit_t3()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz3_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>

			{{-- Section4 Tab (Tourist companies a) --}}
			<div class="row" id="section4_tab" style="display: none;">
				<div class="col-md-12">
					<form action="" id="regForm_t4" role="form" method="post" accept-charset="utf-8">
						<div id="vertical-wizard_t4" class="vertical-wizard">

							<h3>Applicant data and description</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant data and
													description</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_1_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t4" id="applicant_status_1_t4"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 mb-2">
										<label>Nationality <code>*</code></label>
										<select name="nationality_1_t4" id="nationality_1_t4"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($nationality as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t4" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">The actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t4"
												id="corrs_add_1_t4" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">											
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_1_t4" id="land_with_ext_1_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t4"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t4" id="mobile_personal_ext_1_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t4"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t4" id="mobile_work_ext_1_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t4" class="form-control input-sm">
											</div>
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t4" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t4" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t4" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t4" id="reqtype_1_t4" class="form-control select2">
											<option value="">Select</option>
											@foreach ($reqtype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t4" id="notes_1_t4" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz4_nextbutton()">Next</button>
									</div>
								</div>
							</section>

							<h3>Company owner data</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Company owner data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-5</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t4" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t4" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t4"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_ext_2_t4" id="land_with_ext_2_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t4"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_2_t4" id="fax_with_code_ext_2_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t4"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t4" id="mobile_personal_ext_2_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t4"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t4" id="mobile_work_ext_2_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t4" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t4"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t4" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz4_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz4_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Company data (based on official documents)</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Company data (based on official
													documents)</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-5</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">COMPANY Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="company_name_arabic_3_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">COMPANY Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="company_name_english_3_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">License number of the Ministry of Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="license_number_ministry_of_3_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for=""> Membership Number of Diving Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="membership_number_3_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t4"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Tax card number<code>*</code></label>
										<div class="form-group">
											<input type="number" name="tax_card_no_3_t4" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Address of the Center<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_center_3_t4" id="address_of_the_center_3_t4"
												cols="30" rows="3"></textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="landline_no_ext_3_t4" id="landline_no_ext_3_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t4" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX NO</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_no_ext_3_t4" id="fax_no_ext_3_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t4" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (1)<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t4" id="mobile_no1_ext_3_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t4" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (2)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t4" id="mobile_no2_ext_3_t4" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t4" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL</label>
										<div class="form-group">
											<input type="email" name="email_3_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t4" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Marine activities to be authorized</label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t4" multiple
												id="marine_activity_authorized_3_t4" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)</label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t4" multiple
												id="unit_area_of_activity_3_t4" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz4_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz4_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees_t4"
													value="50.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz4_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz4_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-5</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Name:</label><br/>
												<label for="" id="lbl4_name"></label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br/>
												<label for="" id="lbl4_email"></label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br/>
												<label for="" id="lbl4_password"></label>
											</div>
											<div class="col-md-4">
												<label for="">Regtype</label><br/>
												<label for="" id="lbl4_regtype"></label>
											</div>	
										</div>
										
										<div class="col-lg-12" id="wrapper_view_t4">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT DATA AND DESCRIPTION</i></b></label>
												</div>

												<div class="col-md-12">
													<label>Full Name <code>*</code></label>
													<div class="form-group">
														<label for="" id="lbl_name_1_t4"></label>
													</div>
												</div>
												<div class="col-md-6 mb-2">
													<label>Applicant Status <code>*</code></label><br />
													<label for="" id="lbl_applicant_status_1_t4"></label>
												</div>
												<div class="col-lg-6 mb-2">
													<label>Nationality<code>*</code></label><br />
													<label for="" id="lbl_nationality_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>ID number <code>*</code></label><br />
													<label for="" id="lbl_id_number_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Passport number (for non-Egyptians)
														<code>*</code></label><br />
													<label for="" id="lbl_passport_number_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Place of residence IN ID<code>*</code></label><br />
													<label for="" id="lbl_place_of_res_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>The actual place of residence<code>*</code></label><br />
													<label for="" id="lbl_actual_place_of_res_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Correspondence address<code>*</code></label><br />
													<label for="" id="lbl_corrs_add_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>LAND LINE (WITH CODE)<code>*</code></label><br />
													<label for="" id="lbl_land_with_code_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (PERSONAL)</label><br />
													<label for="" id="lbl_mobile_personal_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>MOBILE (WORK)<code>*</code></label><br />
													<label for="" id="lbl_mobile_work_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (PERSONAL)</label><br />
													<label for="" id="lbl_email_personal_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (WORK)<code>*</code></label><br />
													<label for="" id="lbl_email_work_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>WEB SITE</label><br />
													<label for="" id="lbl_website_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Agency bond number <code>*</code></label><br />
													<label for="" id="lbl_agency_board_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Documentation Office <code>*</code></label><br/>
													<label for="" id="lbl_doc_office_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>REQUEST TYPE <code>*</code></label><br />
													<label for="" id="lbl_reqtype_1_t4"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>NOTES</label><br />
													<label for="" id="lbl_notes_1_t4"></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>COMPANY OWNER DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t4"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br/>
														<label for="" id="lbl_nick_name_2_t4"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br/>
														<label for="" id="lbl_id_number_2_t4"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians) <code>*</code></label><br/>
														<label for="" id="lbl_passport_number_2_t4"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID <code>*</code></label><br/>
														<label for="" id="lbl_place_of_res_2_t4"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">LAND LINE (WITH CODE)</label><br/>
														<label id="lbl_land_with_code_2_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX (WITH CODE)</label><br/>
														<label id="lbl_fax_with_code_2_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (PERSONAL)</label><br/>
														<label id="lbl_mobile_personal_2_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE (WORK) <code>*</code></label><br/>
														<label for="" id="lbl_mobile_work_2_t4"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br/>
														<label id="lbl_email_personal_2_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br/>
														<label id="lbl_email_work_2_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_2_t4"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>COMPANY DATA (BASED ON OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">
														<label for="">COMPANY Name (Arabic)<code>*</code></label><br/>
														<label for="" id="lbl_center_name_arabic_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">COMPANY Name (ENGLISH)<code>*</code></label><br/>
														<label for="" id="lbl_center_name_english_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">License number of the Ministry of Tourism <code>*</code></label><br/>
														<label for="" id="lbl_license_number_ministry_of_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> Membership Number of Diving Tourism  <code>*</code></label><br/>
														<label for="" id="lbl_membership_number_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration No<code>*</code></label><br/>
														<label id="lbl_commercial_reg_no_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Tax card number<code>*</code></label><br/>
														<label id="lbl_tax_card_no_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the Center<code>*</code></label><br/>
														<label for="" id="lbl_address_of_the_center_3_t4"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Landline number</label><br/>
														<label for="" id="lbl_landline_no_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">FAX NO</label><br/>
														<label for="" id="lbl_fax_no_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO1<code>*</code></label><br/>
														<label for="" id="lbl_mobile_no1_3_t4"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">MOBILE NO 2</label><br/>
														<label for="" id="lbl_mobile_no2_3_t4"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br/>
														<label for="" id="lbl_email_3_t4"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_3_t4"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Marine activities to be authorized</label><br/>
														<label for="" id="lbl_marine_activity_authorized_3_t4"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached statement and maps)</label><br/>
														<label for="" id="lbl_unit_area_of_activity_3_t4"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">Payment Fees<code>*</code></label><br />
														<label for="" id="lbl_payment_fees_t4"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox" name="accpet_terms_t4" onclick="accept_terms_t4(this)" value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t4" disabled
											onclick="submit_t4()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz4_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>

			{{-- Section5 Tab (Other entities and individuals) --}}
			<div class="row" id="section5_tab" style="display: none;">
				<div class="col-md-12">
					<form action="" id="regForm_t5" role="form" method="post" accept-charset="utf-8">
						<div id="vertical-wizard_t5" class="vertical-wizard">

							<h3>Applicant data and description</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant data and
													description</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_1_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t5" id="applicant_status_1_t5"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID NUMBER (FULL) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t5" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">PASSPORT NUMBER (FOR NON EGYPTIAN) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t5"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">The actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t5"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t5"
												id="corrs_add_1_t5" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_1_t5" id="land_with_code_ext_1_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_1_t5" id="fax_with_code_ext_1_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t5" id="mobile_personal_ext_1_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t5" id="mobile_work_ext_1_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t5" class="form-control input-sm">
											</div>
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t5"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t5" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t5" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t5" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t5" id="reqtype_1_t5" class="form-control select2">
											<option value="">Select</option>
											@foreach ($reqtype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t5" id="notes_1_t5" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz5_nextbutton()">Next</button>
									</div>
								</div>
							</section>
							<h3>Entity owner / individual data<br />(From official documents)</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Entity owner / individual data<br />
													(From official documents)</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-5</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t5" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t5" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t5"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_2_t5"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_2_t5" id="land_with_code_ext_2_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_2_t5" id="fax_with_code_ext_2_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t5" id="mobile_personal_ext_2_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t5"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t5" id="mobile_work_ext_2_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t5" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t5"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t5" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz5_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz5_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>(From official documents) Entity / Individual data</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>(From official documents) Entity /
													Individual data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-5</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_arabic_3_t5"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_english_3_t5"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for=""> Membership Number of Diving Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="membership_number_3_t5"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t5"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Address of the ENTITY<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_entity_3_t5" id="address_of_the_entity_3_t5"
												cols="30" rows="3"></textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="landline_no_ext_3_t5" id="landline_no_ext_3_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t5" class="form-control input-sm">
											</div>											
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Fax Number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_no_3_ext_t5" id="fax_no_3_ext_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t5" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (1)<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t5" id="mobile_no1_ext_3_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t5" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (2)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t5" id="mobile_no2_ext_3_t5" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t5" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL</label>
										<div class="form-group">
											<input type="email" name="email_3_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t5" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Marine activities to be authorized</label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t5" multiple
												id="marine_activity_authorized_3_t5" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)</label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t5" multiple
												id="unit_area_of_activity_3_t5" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz5_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz5_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees"
													value="250.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz5_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz5_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-5</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Name:</label><br/>
												<label for="" id="lbl5_name"></label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br/>
												<label for="" id="lbl5_email"></label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br/>
												<label for="" id="lbl5_password"></label>
											</div>
											<div class="col-md-4">
												<label for="">Regtype</label><br/>
												<label for="" id="lbl5_regtype"></label>
											</div>	
										</div>
										
										<div class="col-lg-12" id="wrapper_view_t5">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT DATA AND DESCRIPTION</i></b></label>
												</div>

												<div class="col-md-12">
													<label>Full Name <code>*</code></label>
													<div class="form-group">
														<label for="" id="lbl_name_1_t5"></label>
													</div>
												</div>
												<div class="col-md-6 mb-2">
													<label>Applicant Status <code>*</code></label><br />
													<label for="" id="lbl_applicant_status_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>ID number <code>*</code></label><br />
													<label for="" id="lbl_id_number_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Passport number (for non-Egyptians)
														<code>*</code></label><br />
													<label for="" id="lbl_passport_number_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Place of residence IN ID<code>*</code></label><br />
													<label for="" id="lbl_place_of_res_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>The actual place of residence<code>*</code></label><br />
													<label for="" id="lbl_actual_place_of_res_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Correspondence address<code>*</code></label><br />
													<label for="" id="lbl_corrs_add_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_land_with_code_ext_1_t5"></label>)
															</td>
															<td>
																<label>LAND LINE (WITH CODE)<code>*</code></label><br />
																<label for="" id="lbl_land_with_code_1_t5"></label>
															</td>
														</tr>
													</table>
													
												</div>
												<div class="col-lg-4 mb-2">
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_fax_with_code_ext_1_t5"></label>)
															</td>
															<td>
																<label>FAX (WITH CODE)</label><br />
																<label for="" id="lbl_fax_with_code_1_t5"></label>
															</td>
														</tr>
													</table>

													
												</div>
												<div class="col-lg-4 mb-2">
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_mobile_personal_ext_1_t5"></label>)
															</td>
															<td>
																<label>MOBILE (PERSONAL)</label><br />
																<label for="" id="lbl_mobile_personal_1_t5"></label>
															</td>
														</tr>
													</table>

													
												</div>
												<div class="col-lg-4 mb-2">
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_mobile_work_ext_1_t5"></label>)
															</td>
															<td>
																<label>MOBILE (WORK)<code>*</code></label><br />
																<label for="" id="lbl_mobile_work_1_t5"></label>
															</td>
														</tr>
													</table>

													
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (PERSONAL)</label><br />
													<label for="" id="lbl_email_personal_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (WORK)<code>*</code></label><br />
													<label for="" id="lbl_email_work_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>WEB SITE</label><br />
													<label for="" id="lbl_website_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Agency bond number <code>*</code></label><br />
													<label for="" id="lbl_agency_board_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Documentation Office <code>*</code></label><br/>
													<label for="" id="lbl_doc_office_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>REQUEST TYPE <code>*</code></label><br />
													<label for="" id="lbl_reqtype_1_t5"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>NOTES</label><br />
													<label for="" id="lbl_notes_1_t5"></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>ENTITY OWNER / INDIVIDUAL DATA
														(FROM OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t5"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br/>
														<label for="" id="lbl_nick_name_2_t5"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br/>
														<label for="" id="lbl_id_number_2_t5"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians) <code>*</code></label><br/>
														<label for="" id="lbl_passport_number_2_t5"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID <code>*</code></label><br/>
														<label for="" id="lbl_place_of_res_2_t5"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Actual place of residence</label><br/>
														<label id="lbl_actual_place_of_res_2_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_land_with_code_ext_2_t5"></label>)
																</td>
																<td>
																	<label for="">LAND LINE (WITH CODE)</label><br/>
																	<label id="lbl_land_with_code_2_t5"></label>
																</td>
															</tr>
														</table>
														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_fax_with_code_ext_2_t5"></label>)
																</td>
																<td>
																	<label for="">FAX (WITH CODE)</label><br/>
																	<label id="lbl_fax_with_code_2_t5"></label>
																</td>
															</tr>
														</table>

														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_personal_ext_2_t5"></label>)
																</td>
																<td>
																	<label for="">MOBILE (PERSONAL)</label><br/>
																	<label id="lbl_mobile_personal_2_t5"></label>
																</td>
															</tr>
														</table>

														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_work_ext_2_t5"></label>)
																</td>
																<td>
																	<label for="">MOBILE (WORK) <code>*</code></label><br/>
																	<label for="" id="lbl_mobile_work_2_t5"></label>	
																</td>
															</tr>
														</table>	
													</div>

													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br/>
														<label id="lbl_email_personal_2_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br/>
														<label id="lbl_email_work_2_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_2_t5"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>(FROM OFFICIAL DOCUMENTS) ENTITY / INDIVIDUAL DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">

														<label for="">ENTITY Name (Arabic) <code>*</code></label><br/>
														<label for="" id="lbl_entity_name_arabic_3_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">ENTITY Name (ENGLISH) <code>*</code></label><br/>
														<label for="" id="lbl_entity_name_english_3_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> Membership Number of Diving Tourism  <code>*</code></label><br/>
														<label for="" id="lbl_membership_number_3_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration No<code>*</code></label><br/>
														<label id="lbl_commercial_reg_no_3_t5"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the ENTITY<code>*</code></label><br/>
														<label for="" id="lbl_address_of_the_entity_3_t5"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_landline_no_ext_3_t5"></label>)
																</td>
																<td>
																	<label for="">Landline number</label><br/>
																	<label for="" id="lbl_landline_no_3_t5"></label>
																</td>
															</tr>
														</table>

														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_fax_no_3_ext_t5"></label>)
																</td>
																<td>
																	<label for="">FAX NO</label><br/>
																	<label for="" id="lbl_fax_no_3_t5"></label>
																</td>
															</tr>
														</table>
														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_no1_ext_3_t5"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO1<code>*</code></label><br/>
																	<label for="" id="lbl_mobile_no1_3_t5"></label>
																</td>
															</tr>
														</table>
														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_no2_ext_3_t5"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO 2</label><br/>
																	<label for="" id="lbl_mobile_no2_3_t5"></label>
																</td>
															</tr>
														</table>
														
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br/>
														<label for="" id="lbl_email_3_t5"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_3_t5"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Marine activities to be authorized</label><br/>
														<label for="" id="lbl_marine_activity_authorized_3_t5"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached statement and maps)</label><br/>
														<label for="" id="lbl_unit_area_of_activity_3_t5"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">Payment Fees<code>*</code></label><br />
														<label for="" id="lbl_payment_fees_t5"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox" name="accpet_terms_t5" onclick="accept_terms_t5(this)" value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t5" disabled
											onclick="submit_t5()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz5_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>

			{{-- Section6 Tab (Other entities and individuals) --}}
			<div class="row" id="section6_tab" style="display: none;">
				<div class="col-md-12">
					<form action="" id="regForm_t6" role="form" method="post" accept-charset="utf-8">
						<div id="vertical-wizard_t6" class="vertical-wizard">


							

							<h3>Applicant data and description</h3>
							<section data-tab="1">
								<div class="row">

									<div class="col-lg-8 text-left">
										<label for="" class="text-uppercase"><b><i>Applicant data and
													description</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 1-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_1_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t6" id="applicant_status_1_t6"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID NUMBER (FULL) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t6" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">PASSPORT NUMBER (FOR NON EGYPTIAN) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t6"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t6"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t6"
												id="corrs_add_1_t6" cols="5" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_1_t6" id="land_with_code_ext_1_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_1_t6" id="fax_with_code_ext_1_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t6" id="mobile_personal_ext_1_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t6" id="mobile_work_ext_1_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t6" class="form-control input-sm">
											</div>
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t6"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t6" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t6" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t6" class="form-control input-sm">
									</div>

									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t6" id="reqtype_1_t6" class="form-control select2">
											<option value="">Select</option>
											@foreach ($reqtype as $item)
											<option value="{{$item}}">{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t6" id="notes_1_t6" cols="30" rows="2"></textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton()">Next</button>
									</div>
								</div>
							</section>
							<h3>Entity owner / individual data<br />(From official documents)</h3>
							<section data-tab="2">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Entity owner / individual data<br />
													(From official documents)</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 2-5</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t6" value="">Same as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name</label>
										<div class="form-group">
											<input type="text" name="name_2_t6" class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_2_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_2_t6" id="land_with_code_ext_2_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_2_t6" id="fax_with_code_ext_2_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t6" id="mobile_personal_ext_2_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t6"
													class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t6" id="mobile_work_ext_2_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t6" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t6" class="form-control input-sm">
										</div>
									</div>


									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>(From official documents) Entity / Individual data</h3>
							<section data-tab="3">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>(From official documents) Entity /
													Individual data</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 3-5</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_arabic_3_t6"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_english_3_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for=""> Membership Number of Diving Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="membership_number_3_t6"
												class="form-control input-sm">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Address of the ENTITY-PERSON<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_entity_3_t6" id="address_of_the_entity_3_t6"
												cols="30" rows="3"></textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="landline_no_ext_3_t6" id="landline_no_ext_3_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t6" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Fax Number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_no_ext_3_t6" id="fax_no_ext_3_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t6" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (1)<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t6" id="mobile_no1_ext_3_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t6" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (2)</label>
										<div class="form-group">mobile_no2_ext_3_t6
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t6" id="" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}">{{$country->phonecode}} - {{$country->country_name}}</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t6" class="form-control input-sm">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL</label>
										<div class="form-group">
											<input type="email" name="email_3_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t6" class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Activities to be authorized (temporary permit)</label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t6" multiple
												id="marine_activity_authorized_3_t6" class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">The time periods required to carry out the activity</label>
										<div class="form-group">
											<input type="text" class="daterange_picker" name="time_period_3_t6"
												class="form-control input-sm">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">NOTES</label>
										<div class="form-group">
											<textarea name="notes_3_t6" id="notes_3_t6" cols="30" rows="3"
												class="form-control"></textarea>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)</label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t6" multiple
												id="unit_area_of_activity_3_t6" class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item}}">{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Branches & Payment</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches & Payment</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-5</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">Payment Fees<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees_t6" value="10.00">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-5</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Name:</label><br/>
												<label for="" id="lbl6_name"></label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br/>
												<label for="" id="lbl6_email"></label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br/>
												<label for="" id="lbl6_password"></label>
											</div>
											<div class="col-md-4">
												<label for="">Regtype</label><br/>
												<label for="" id="lbl6_regtype"></label>
											</div>	
										</div>
										
										<div class="col-lg-12" id="wrapper_view_t6">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT DATA AND DESCRIPTION</i></b></label>
												</div>

												<div class="col-md-12">
													<label>Full Name <code>*</code></label>
													<div class="form-group">
														<label for="" id="lbl_name_1_t6"></label>
													</div>
												</div>
												<div class="col-md-6 mb-2">
													<label>Applicant Status <code>*</code></label><br />
													<label for="" id="lbl_applicant_status_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>ID NUMBER (FULL) <code>*</code></label><br />
													<label for="" id="lbl_id_number_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Passport number (for non-Egyptians)
														<code>*</code></label><br />
													<label for="" id="lbl_passport_number_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Place of residence IN ID<code>*</code></label><br />
													<label for="" id="lbl_place_of_res_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>The actual place of residence<code>*</code></label><br />
													<label for="" id="lbl_actual_place_of_res_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Correspondence address<code>*</code></label><br />
													<label for="" id="lbl_corrs_add_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<div class="input-group">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_land_with_code_ext_1_t6">563623</label>)
																</td>
																<td>
																	<label>LAND NO<code>*</code></label><br />
																	<label for="" id="lbl_land_with_code_1_t6"></label>	
																</td>
															</tr>
														</table>
														
													</div>
												</div>
												<div class="col-lg-4 mb-2">
													<div class="input-group">
														<table>
															<tr>
																<td>
																	<label>FAX CODE</label><br />
																	(<label for="" id="lbl_fax_with_code_ext_1_t6"></label>)
																</td>
																<td>
																	<label>FAX NO`</label><br />
																	<label for="" id="lbl_fax_with_code_1_t6"></label>	
																</td>
															</tr>
														</table>	
													</div>
												</div>
												<div class="col-lg-4 mb-2">
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_mobile_personal_ext_1_t6"></label>)
															</td>
															<td>
																<label>MOBILE (PERSONAL)</label><br />
																<label for="" id="lbl_mobile_personal_1_t6"></label>
															</td>
														</tr>
													</table>
												</div>
												<div class="col-lg-4 mb-2">
													<table>
														<tr>
															<td>
																<label>CODE<code>*</code></label><br />
																(<label for="" id="lbl_mobile_work_ext_1_t6"></label>)
															</td>
															<td>
																<label>MOBILE (WORK)<code>*</code></label><br />
																<label for="" id="lbl_mobile_work_1_t6"></label>
															</td>
														</tr>
													</table>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (PERSONAL)</label><br />
													<label for="" id="lbl_email_personal_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>EMAIL (WORK)<code>*</code></label><br />
													<label for="" id="lbl_email_work_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>WEB SITE</label><br />
													<label for="" id="lbl_website_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Agency bond number <code>*</code></label><br />
													<label for="" id="lbl_agency_board_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>Documentation Office <code>*</code></label><br/>
													<label for="" id="lbl_doc_office_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>REQUEST TYPE <code>*</code></label><br />
													<label for="" id="lbl_reqtype_1_t6"></label>
												</div>
												<div class="col-lg-4 mb-2">
													<label>NOTES</label><br />
													<label for="" id="lbl_notes_1_t6"></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>ENTITY OWNER / INDIVIDUAL DATA
														(FROM OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t6"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br/>
														<label for="" id="lbl_nick_name_2_t6"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br/>
														<label for="" id="lbl_id_number_2_t6"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians) <code>*</code></label><br/>
														<label for="" id="lbl_passport_number_2_t6"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID <code>*</code></label><br/>
														<label for="" id="lbl_place_of_res_2_t6"></label>														
													</div>
													<div class="col-md-4">
														<label for="">Actual place of residence <code>*</code></label><br/>
														<label for="" id="lbl_actual_place_of_res_2_t6"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<div class="input-group">
															<table>
																<tr>
																	<td>
																		<label>CODE<code>*</code></label><br />
																		(<label for="" id="lbl_land_with_code_ext_2_t6"></label>)
																	</td>
																	<td>
																		<label for="">LAND LINE (WITH CODE)</label><br/>
																		<label id="lbl_land_with_code_2_t6"></label>
																	</td>
																</tr>
															</table>
														</div>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_fax_with_code_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">FAX (WITH CODE)</label><br/>
																	<label id="lbl_fax_with_code_2_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_personal_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (PERSONAL)</label><br/>
																	<label id="lbl_mobile_personal_2_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_work_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (WORK) <code>*</code></label><br/>
																	<label for="" id="lbl_mobile_work_2_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br/>
														<label id="lbl_email_personal_2_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br/>
														<label id="lbl_email_work_2_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_2_t6"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>(FROM OFFICIAL DOCUMENTS) ENTITY / INDIVIDUAL DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">
														<label for="">ENTITY Name (Arabic)<code>*</code></label><br/>
														<label for="" id="lbl_entity_name_arabic_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">ENTITY Name (ENGLISH)<code>*</code></label><br/>
														<label for="" id="lbl_entity_name_english_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> Membership Number of Diving Tourism  <code>*</code></label><br/>
														<label for="" id="lbl_membership_number_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration No<code>*</code></label><br/>
														<label id="lbl_commercial_reg_no_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the ENTITY-PERSON<code>*</code></label><br/>
														<label for="" id="lbl_address_of_the_entity_3_t6"></label>														
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_landline_no_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (WORK) <code>*</code></label><br/>
																	<label for="" id="lbl_landline_no_3_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_fax_no_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">FAX NO</label><br/>
																	<label for="" id="lbl_fax_no_3_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_no1_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO1<code>*</code></label><br/>
																	<label for="" id="lbl_mobile_no1_3_t6"></label>
																</td>
															</tr>
														</table>
													</div>

													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for="" id="lbl_mobile_no2_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO 2</label><br/>
																	<label for="" id="lbl_mobile_no2_3_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br/>
														<label for="" id="lbl_email_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br/>
														<label for="" id="lbl_website_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Activities to be authorized (temporary permit)</label><br/>
														<label for="" id="lbl_marine_activity_authorized_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">The time periods required to carry out the activity</label><br/>
														<label for="" id="lbl_time_period_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">NOTES</label><br/>
														<label for="" id="lbl_notes_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached statement and maps)</label><br/>
														<label for="" id="lbl_unit_area_of_activity_3_t6"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>BRANCHES & PAYMENT</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">Payment Fees<code>*</code></label><br />
														<label for="" id="lbl_payment_fees_t6"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox" name="accpet_terms_t6" onclick="accept_terms_t6(this)" value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t6" disabled
											onclick="submit_t6()">Submit</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							

							
						</div>
					</form>
				</div>
			</div>

			<div class="row" style="display: none;">
				<div class="col-md-12">
					<div class="form-wizard">
						<form action="" id="BookingFrom" role="form" method="post" accept-charset="utf-8">
							<div class="">
								{{-- <div class="form-wizard-steps form-wizard-tolal-steps-7">
									<div class="row">
										<div class="col-md-4">
											<div class="form-wizard-progress">
												<div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
											</div>
											<div class="form-wizard-step active">
												<div class="form-wizard-step-icon"><i class="far fa-user"></i></div>
												<p>Personal Info</p>
											</div>
											<div class="form-wizard-step">
												<div class="form-wizard-step-icon"><i class="far fa-handshake"></i></div>
												<p>Registration Form</p>
											</div>
											<div class="form-wizard-step">
												<div class="form-wizard-step-icon"><i class="far fa-money"></i></div>
												<p>Payment Fess & Branches</p>
											</div>
											<div class="form-wizard-step">
												<div class="form-wizard-step-icon"><i class="far fa-building"></i></div>
												<p>Review Form</p>
											</div>
										</div>
										<div class="col-md-8">
											<fieldset>
												<h4>Registration <span>Step 1 - 4</span></h4>
												<div class="row" style="width: 100%">
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Username</label>
															<input type="text" name="username" class="form-control">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Password</label>
															<input type="password" name="password" class="form-control">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for="">Registration Type</label>
															<select name="reg_type" class="form-control">
																<option value="">Select</option>
																<option value="section1">Marine units</option>
																<option value="section2">Dive centers</option>
																<option value="section3">Marine activity centers</option>
																<option value="section4">Tourist companies a</option>
																<option value="section5">Other entities and individuals</option>
																<option value="section6">Temporary activities (individual entities)</option>
															</select>
														</div>
													</div>
												</div>
												<div id="field1" style="display: none;">
													<div class="row" style="width: 100%;">
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Field 1</label>
																<select name="field_1" class="form-control" >
																	<option value="value1">Value 1</option>
																	<option value="value2">Value 2</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Field 2</label>
																<select name="field_2" class="form-control" >
																	<option value="value1">Value 1</option>
																	<option value="value2">Value 2</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">No. of Branches</label>
																<input type="number" name="no_of_branches" class="form-control" onchange="getFees(this);">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Fees</label>
																<input type="number" name="fees" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div id="field2" style="display: none;">
													<div class="row" style="width: 100%;">
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Field 3</label>
																<input type="text" name="field_2" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Field 4</label>
																<input type="number" name="field_4" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">No. of Branches</label>
																<input type="number" name="no_of_branches" class="form-control" onchange="getFees(this);">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Fees</label>
																<input type="number" name="fees" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="form-wizard-buttons">
													<button type="button" class="btn btn-next">Next</button>
												</div>
											</fieldset>
											<fieldset>
												<h4>Confirmation: <span>Step 2 - 2</span></h4>
												<div class="clearfix"></div>
												<table class="table table-striped table-cust">
													<tr>
														<td> Username</td>
														<td>
															<span>john01</span>
														</td>
													</tr>
													<tr>
														<td> Password </td>
														<td><span>123456</span> </td>
													</tr>
													<tr>
														<td> Registration Type </td>
														<td><span>Value 1</span></td>
													</tr>
													<tr>
														<td> Field 1 </td>
														<td><span>Value 1</span> </td>
													</tr>
													<tr>
														<td> Field 2 </td>
														<td><span>Value 2</span> </td>
													</tr>
													<tr>
														<td> No. of Location </td>
														<td><span>3</span></td>
													</tr>
													<tr>
														<td> Fees </td>
														<td><span>2000</span></td>
													</tr>
													<tr>
														<td colspan="2">
															<input type="checkbox" id="con" name="confirmation">
															<label for="con">I accept <a href="javascript:;" title="">Terms & Conditions</a></label>
														</td>
													</tr>
												</table>
												<div class="form-wizard-buttons">
													<button type="button" class="btn btn-previous">Previous</button>
													<button type="button" onclick="save()" class="btn btn-submit" id="submitBtn">Submit</button>
												</div>
											</fieldset>
										</div>
									</div>
								</div> --}}
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	function getFields(elem){
			if($(elem).val() == 'value1'){
				$('#field1').show();
				$('#field2').hide();
			}else if($(elem).val() == 'value2'){
				$('#field1').hide();
				$('#field2').show();
			}else{
				$('#field1').hide();
				$('#field2').hide();
			}
		}

		function getFees(elem){
			$('[name="fees"]').val('2000');
		}

		function save(){
			window.location.href="http://sites.mobotics.in/eeaa/thank-you";
		}

		
</script>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.steps.min.js') }}" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
	function regTypeChange(elem) {
			// val = $(elem).val();
			// $('#section1_tab').hide();
			// if(val == 'section1') {
			// 	$('#'+val+'_tab').show();
			// 	$('#'+val+'_tab').find('.select2').select2();
			// }
	}

	$(function() {
		$('.select2').select2();
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
		});

		$('.daterange_picker').daterangepicker({
			defaultValue: false,
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
	})

	function personalCred() {
		name = $('[name="name"]').val();
		email = $('[name="email"]').val();
		password = $('[name="password"]').val();
		cpassword = $('[name="cpassword"]').val();
		reg_type = $('[name="reg_type"]').val();
		var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(name != '' && email != '' && password != '' && reg_type !='') {
			if(!pattern.test(email)) {
				toastr['error']('Not a valid email address');
				return false;
			} else if($.trim(password) != $.trim(cpassword)) {
				toastr['error']('Password and confirm password should be same.');
				return false;
			}
			if($.inArray(reg_type, ['section1', 'section2', 'section3', 'section4', 'section5', 'section6']) < 0) {
				toastr['error']('Unable to find the section');
			} else {
				$('#login_section').hide();
				$('#login_section_reedit').show();
				$('#'+reg_type+'_tab').show();
			}
		} else {
			toastr['error']('Name, Email Password & Regtype is required.')
		}
	}

	$.validator.addMethod(
        "cText",
        function(value, element, regexp) {
            var re = new RegExp("^[a-zA-Z ]*$");
            return this.optional(element) || re.test(value);
        },
        "Accept Only Text."
	);

	$.validator.addMethod(
        "cTextNumber",
        function(value, element, regexp) {
            var re = new RegExp("^[a-zA-Z0-9 ]*$");
            return this.optional(element) || re.test(value);
        },
		"Accept Only Text & Number."
	);

	$.validator.addMethod(
        "cNumber",
        function(value, element, regexp) {
            var re = new RegExp("^[0-9]*$");
            return this.optional(element) || re.test(value);
        },
        "Accept Only Number."
	);

	$.validator.addMethod(
        "cArabic",
        function(value, element, regexp) {
            var re = /[\u0600-\u06FF\u0750-\u077F]/;
            return this.optional(element) || re.test(value);
        },
        "Accept Only Arabic Text."
	);

	$.validator.addMethod(
        "cEnglishText",
        function(value, element, regexp) {
            var re = new RegExp("^[a-zA-Z ]*$");
            return this.optional(element) || re.test(value);
        },
        "Accept Only English Text."
	); 


	var $validator_t1 = $("#regForm_t1").validate({
		rules: {
			// Student Details
			name_1_t1: {
				required: true,
				cText: true,
			},
			applicant_status_1_t1: {
				required: true
			},
			nationality_1_t1: {
				required: true
			},
			id_number_1_t1: {
				// required: true
				cNumber: true
			},
			passport_number_1_t1: {
				// required: true
				cTextNumber: true
			},				
			place_of_res_1_t1: {
				required: true,
				cTextNumber: true,
			},				
			actual_place_of_res_1_t1: {
				required: true,
				cTextNumber: true,
			},				
			corrs_add_1_t1: {
				required: true
			},				
			land_with_code_1_t1: {
				number: true,
				cNumber: true
			},				
			fax_with_code_1_t1: {
				number: true,
				cNumber: true
			},				
			mobile_personal_1_t1: {
				number: true,
				cNumber: true
			},			
			mobile_work_1_t1: {
				required: true,
				number: true,
				cNumber: true
			},				
			email_personal_1_t1: {
				email: true
			},	
			email_work_1_t1: {
				required: true,
				email: true
			},
			doctype_1_t1: {
				required: true
			},
			reqtype_1_t1: {
				required: true
			},


			// Section 2
			name_2_t1: {
				required: true,
				cText: true,
			},
			nationality_2_t1: {
				required: true
			},
			id_number_2_t1: {
				cNumber: true,
			},
			passport_number_2_t1: {
				cTextNumber: true
			},
			place_of_res_2_t1: {
				required: true,
				cTextNumber: true,
			},
			actual_place_of_res_2_t1: {
				required: true,
				cTextNumber: true
			},
			partner_ship_rate_by_carat_2_t1: {
				required: true,
			},
			land_with_code_2_t1: {
				number: true,
				cNumber: true
			},
			fax_with_code_2_t2: {
				number: true,
				cNumber: true
			},
			mobile_personal_2_t1: {
				number: true,
				cNumber: true
			},
			mobile_work_2_t1: {
				required: true,
				number: true
			},
			email_work_2_t1: {
				required: true,
				email: true
			},

			// Section 3
			name_of_unit_owner_3_t1: {
				required: true,
				cText: true
			},
			business_attribute_of_3_t1: {
				required: true,
				cText: true
			},
			entity_type_3_t1: {
				required: true,
				cText: true
			},
			commer_reg_no_3_t1: {
				required: true,
				number: true,
				cNumber: true
			},
			tax_card_no_3_t1: {
				required: true,
				number: true,
				cNumber: true,
			},
			corrs_add_3_t1: {
				required: true,
				cTextNumber: true
			},
			carat_quota_3_t1: {
				required: true
			},
			telephone_3_t1: {
				number: true,
				cNumber: true
			},
			fax_with_code_3_t1: {
				number: true,
				cNumber: true
			},
			mobile_number_p_3_t1: {
				number: true,
				cNumber: true
			},
			mobile_work_w_3_t1: {
				required: true,
				number: true,
				cNumber: true
			},
			email_personal_3_t1: {
				email: true
			},
			email_work_3_t1: {
				required: true,
				email: true
			},	


			// Section 4
			maritime_unit_arabic_4_t1: {
				required: true,
				cArabic: true
			},
			maritime_unit_4_t1: {
				required: true,
			},
			reg_number_4_t1: {
				required: true,
				number: true,
				cNumber: true
			},
			port_of_reg_4_t1: {
				required: true,
			},
			date_of_reg_4_t1: {
				required: true
			},
			maritime_license_4_t1: {
				required: true,
				cText: true,
			},
			craft_4_t1: {
				required: true
			},
			number_of_crew_4_t1: {
				required: true,
				number: true,
				cNumber: true
			},
			total_length_of_unit_4_t1: {
				required: true,
			},
			number_of_passenger_4_t1: {
				required: true,
				number: true,
			},
			construction_type_4_t1: {
				required: true
			},
			total_weight_of_vessel_4_t1: {
				required: true
			},
			classifi_unit_4_t1: {
				required: true,
			},
			marine_activity_unit_4_t1: {
				required: true,
			},
			unit_area_of_activity_4_t1: {
				required: true
			},
			getty_marina_4_t1: {
				required: true,
				cText: true
			},
			unit_practice_location_4_t1: {
				cText: true
			},


			// Section 5
			water_unit_in_5_t1: {
				required: true,
			},
			tank_capacity_5_t1: {
				required: true
			},
			daily_consumption_5_t1: {
				required: true
			},
			number_of_tanks_5_t1: {
				required: true
			},

			// Section 6
			vessel_drainage_in_6_t1: {
				required: true,
			},				
			tank_capacity_6_t1: {
				required: true
			},
			daily_exchange_rate_6_t1: {
				required: true
			},
			get_rid_of_drainage_6_t1: {
				required: true
			},

			// Section 7
			vessel_drainage_in_7_t1: {
				required: true
			},
			tank_capacity_7_t1: {
				required: true
			},
			get_rid_of_residues_7_t1: {
				required: true
			},

			// Section 8
			main_motor_per_unit_8_t1: {
				required: true
			},
			motor_brand_8_t1: {
				required: true,
			},
			eng_capacity_1_8_t1: {
				required: true
			},
			type_of_fuel_used_8_t1: {
				required: true
			},


			// Section 9
			waste_collection_in_9_t1: {
				required: true
			},
			tank_capacity_9_t1: {
				required: true
			},
			avg_daily_waste_9_t1: {
				required: true
			},
			get_rid_of_solid_9_t1: {
				required: true
			}
		}
	});	
	

	var verticalWizard_t1 = $("#vertical-wizard").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			$("#regForm_t1").validate().settings.ignore = ":disabled,:hidden";			
			if(currentIndex < newIndex){
				var $valid = $("#regForm_t1").valid();				
				if(!$valid) {
					$validator_t1.focusInvalid();
					return false;
				}
			}

			if(currentIndex == 0) {
				if($('[name="id_number_1_t1"]').val() == '' && $('[name="passport_number_1_t1"]').val() == '') {
					toastr['error']('Please fill atleast one of the two fields ID number or Passport number');
					$('[name="id_number_1_t1"], [name="passport_number_1_t1"]').focus();
					return false;
				}
			} else if (currentIndex == 1) {
				if($('[name="id_number_2_t1"]').val() == '' && $('[name="passport_number_2_t1"]').val() == '') {
					toastr['error']('Please fill atleast one of the two fields ID number or Passport number');
					$('[name="id_number_2_t1"], [name="passport_number_2_t1"]').focus();
					return false;
				}
			}
			// $("#regForm_t1").unbind('validate')

			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('#vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			})
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t1');	
			}
			$("html, body").animate({ scrollTop: 0 }, 600);

			if(currentIndex == 10) {
				$('#lbl_name').text($('[name="name"]').val());
				$('#lbl_email').text($('[name="email"]').val());
				$('#lbl_password').text('xxxxxxxxx');
				$('#lbl_regtype').text($('[name="regtype"]').val());
				$('#lbl_name_1_t1').text($('[name="name_1_t1"]').val());
				$('#lbl_applicant_status_1_t1').text($('[name="applicant_status_1_t1"]').val());
				$('#lbl_nationality_1_t1').text($('[name="nationality_1_t1"]').val());
				$('#lbl_id_number_1_t1').text($('[name="id_number_1_t1"]').val());
				$('#lbl_passport_number_1_t1').text($('[name="passport_number_1_t1"]').val());
				$('#lbl_place_of_res_1_t1').text($('[name="place_of_res_1_t1"]').val());
				$('#lbl_actual_place_of_res_1_t1').text($('[name="actual_place_of_res_1_t1"]').val());
				$('#lbl_corrs_add_1_t1').text($('[name="corrs_add_1_t1"]').val());
				$('#lbl_land_with_code_1_t1').text($('[name="land_with_code_1_t1"]').val());
				$('#lbl_fax_with_code_1_t1').text($('[name="fax_with_code_1_t1"]').val());
				$('#lbl_mobile_personal_1_t1').text($('[name="mobile_personal_1_t1"]').val());
				$('#lbl_mobile_work_1_t1').text($('[name="mobile_work_1_t1"]').val());
				$('#lbl_email_personal_1_t1').text($('[name="email_personal_1_t1"]').val());
				$('#lbl_email_work_1_t1').text($('[name="email_work_1_t1"]').val());
				$('#lbl_website_1_t1').text($('[name="website_1_t1"]').val());
				$('#lbl_doctype_1_t1').text($('[name="doctype_1_t1"]').val());
				$('#lbl_reqtype_1_t1').text($('[name="reqtype_1_t1"]').val());
				$('#lbl_notes_1_t1').text($('[name="notes_1_t1"]').val());
				$('#lbl_name_2_t1').text($('[name="name_2_t1"]').val());
				$('#lbl_nationality_2_t1').text($('[name="nationality_2_t1"]').val());
				$('#lbl_id_number_2_t1').text($('[name="id_number_2_t1"]').val());
				$('#lbl_passport_number_2_t1').text($('[name="passport_number_2_t1"]').val());
				$('#lbl_place_of_res_2_t1').text($('[name="place_of_res_2_t1"]').val());
				$('#lbl_actual_place_of_res_2_t1').text($('[name="actual_place_of_res_2_t1"]').val());
				$('#lbl_partner_ship_rate_by_carat_2_t1').text($('[name="partner_ship_rate_by_carat_2_t1"]').val());
				$('#lbl_land_with_code_2_t1').text($('[name="land_with_code_2_t1"]').val());
				$('#lbl_fax_with_code_2_t1').text($('[name="fax_with_code_2_t1"]').val());
				$('#lbl_mobile_personal_2_t1').text($('[name="mobile_personal_2_t1"]').val());
				$('#lbl_mobile_work_2_t1').text($('[name="mobile_work_2_t1"]').val());
				$('#lbl_email_personal_2_t1').text($('[name="email_personal_2_t1"]').val());
				$('#lbl_email_work_2_t1').text($('[name="email_work_2_t1"]').val());
				$('#lbl_website_2_t1').text($('[name="website_2_t1"]').val());
				$('#lbl_notes_2_t1').text($('[name="notes_2_t1"]').val());
				$('#lbl_name_2_t1').text($('[name="name_2_t1"]').val());
				$('#lbl_nationality_2_t1').text($('[name="nationality_2_t1"]').val());
				$('#lbl_id_number_2_t1').text($('[name="id_number_2_t1"]').val());
				$('#lbl_passport_number_2_t1').text($('[name="passport_number_2_t1"]').val());
				$('#lbl_place_of_res_2_t1').text($('[name="place_of_res_2_t1"]').val());
				$('#lbl_actual_place_of_res_2_t1').text($('[name="actual_place_of_res_2_t1"]').val());
				$('#lbl_partner_ship_rate_by_carat_2_t1').text($('[name="partner_ship_rate_by_carat_2_t1"]').val());
				$('#lbl_land_with_code_2_t1').text($('[name="land_with_code_2_t1"]').val());
				$('#lbl_fax_with_code_2_t1').text($('[name="fax_with_code_2_t1"]').val());
				$('#lbl_mobile_personal_2_t1').text($('[name="mobile_personal_2_t1"]').val());
				$('#lbl_mobile_work_2_t1').text($('[name="mobile_work_2_t1"]').val());
				$('#lbl_email_personal_2_t1').text($('[name="email_personal_2_t1"]').val());
				$('#lbl_email_work_2_t1').text($('[name="email_work_2_t1"]').val());
				$('#lbl_website_2_t1').text($('[name="website_2_t1"]').val());
				$('#lbl_notes_2_t1').text($('[name="notes_2_t1"]').val());
				$('#lbl_name_of_unit_owner_3_t1').text($('[name="name_of_unit_owner_3_t1"]').val());
				$('#lbl_business_attribute_of_3_t1').text($('[name="business_attribute_of_3_t1"]').val());
				$('#lbl_entity_type_3_t1').text($('[name="entity_type_3_t1"]').val());
				$('#lbl_commer_reg_no_3_t1').text($('[name="commer_reg_no_3_t1"]').val());
				$('#lbl_tax_card_no_3_t1').text($('[name="tax_card_no_3_t1"]').val());
				$('#lbl_corrs_add_3_t1').text($('[name="corrs_add_3_t1"]').val());
				$('#lbl_carat_quota_3_t1').text($('[name="carat_quota_3_t1"]').val());
				$('#lbl_telephone_3_t1').text($('[name="telephone_3_t1"]').val());
				$('#lbl_fax_with_code_3_t1').text($('[name="fax_with_code_3_t1"]').val());
				$('#lbl_mobile_number_p_3_t1').text($('[name="mobile_number_p_3_t1"]').val());
				$('#lbl_mobile_work_w_3_t1').text($('[name="mobile_work_w_3_t1"]').val());
				$('#lbl_email_personal_3_t1').text($('[name="email_personal_3_t1"]').val());
				$('#lbl_website_3_t1').text($('[name="website_3_t1"]').val());
				$('#lbl_notes_3_t1').text($('[name="notes_3_t1"]').val());
				$('#lbl_maritime_unit_arabic_4_t1').text($('[name="maritime_unit_arabic_4_t1"]').val());
				$('#lbl_maritime_unit_4_t1').text($('[name="maritime_unit_4_t1"]').val());
				$('#lbl_reg_number_4_t1').text($('[name="reg_number_4_t1"]').val());
				$('#lbl_port_of_reg_4_t1').text($('[name="port_of_reg_4_t1"]').val());
				$('#lbl_date_of_reg_4_t1').text($('[name="date_of_reg_4_t1"]').val());
				$('#lbl_maritime_license_4_t1').text($('[name="maritime_license_4_t1"]').val());
				$('#lbl_craft_4_t1').text($('[name="craft_4_t1"]').val());
				$('#lbl_number_of_crew_4_t1').text($('[name="number_of_crew_4_t1"]').val());
				$('#lbl_total_length_of_unit_4_t1').text($('[name="total_length_of_unit_4_t1"]').val());
				$('#lbl_number_of_passenger_4_t1').text($('[name="number_of_passenger_4_t1"]').val());
				$('#lbl_construction_type_4_t1').text($('[name="construction_type_4_t1"]').val());
				$('#lbl_total_weight_of_vessel_4_t1').text($('[name="total_weight_of_vessel_4_t1"]').val());
				$('#lbl_spec_of_rubber_boat_unit_4_t1').text($('[name="spec_of_rubber_boat_unit_4_t1"]').val());
				$('#lbl_classifi_unit_4_t1').text($('[name="classifi_unit_4_t1"]').val());
				$('#lbl_marine_activity_unit_4_t1').text($('[name="marine_activity_unit_4_t1"]').val());
				$('#lbl_unit_area_of_activity_4_t1').text($('[name="unit_area_of_activity_4_t1"]').val());
				$('#lbl_getty_marina_4_t1').text($('[name="getty_marina_4_t1"]').val());
				$('#lbl_unit_practice_location_4_t1').text($('[name="unit_practice_location_4_t1"]').val());
				$('#lbl_water_unit_in_5_t1').text($('[name="water_unit_in_5_t1"]').val());
				$('#lbl_tank_capacity_5_t1').text($('[name="tank_capacity_5_t1"]').val());
				$('#lbl_daily_consumption_5_t1').text($('[name="daily_consumption_5_t1"]').val());
				$('#lbl_number_of_tanks_5_t1').text($('[name="number_of_tanks_5_t1"]').val());
				$('#lbl_vessel_drainage_in_6_t1').text($('[name="vessel_drainage_in_6_t1"]').val());
				$('#lbl_tank_capacity_6_t1').text($('[name="tank_capacity_6_t1"]').val());
				$('#lbl_daily_exchange_rate_6_t1').text($('[name="daily_exchange_rate_6_t1"]').val());
				$('#lbl_get_rid_of_drainage_6_t1').text($('[name="get_rid_of_drainage_6_t1"]').val());
				$('#lbl_vessel_drainage_in_7_t1').text($('[name="vessel_drainage_in_7_t1"]').val());
				$('#lbl_tank_capacity_7_t1').text($('[name="tank_capacity_7_t1"]').val());
				$('#lbl_get_rid_of_residues_7_t1').text($('[name="get_rid_of_residues_7_t1"]').val());
				$('#lbl_main_motor_per_unit_8_t1').text($('[name="main_motor_per_unit_8_t1"]').val());
				$('#lbl_motor_brand_8_t1').text($('[name="motor_brand_8_t1"]').val());
				$('#lbl_eng_capacity_1_8_t1').text($('[name="eng_capacity_1_8_t1"]').val());
				$('#lbl_eng_capacity_2_8_t1').text($('[name="eng_capacity_2_8_t1"]').val());
				$('#lbl_eng_capacity_3_8_t1').text($('[name="eng_capacity_3_8_t1"]').val());
				$('#lbl_eng_capacity_4_8_t1').text($('[name="eng_capacity_4_8_t1"]').val());
				$('#lbl_type_of_fuel_used_8_t1').text($('[name="type_of_fuel_used_8_t1"]').val());
				$('#lbl_waste_collection_in_9_t1').text($('[name="waste_collection_in_9_t1"]').val());
				$('#lbl_tank_capacity_9_t1').text($('[name="tank_capacity_9_t1"]').val());
				$('#lbl_avg_daily_waste_9_t1').text($('[name="avg_daily_waste_9_t1"]').val());
				$('#lbl_get_rid_of_solid_9_t1').text($('[name="get_rid_of_solid_9_t1"]').val());
				$('#lbl_payment_fees').text($('[name="payment_fees"]').val());

			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		// onTabClick: function(tab,navigation,index){
		// 	return false;
		// },
	});

	var $validator_t2 = $('#regForm_t2').validate({
		rules: {
			// Section 1
			name_1_t2: {
				required: true,
				cText: true,
			},
			applicant_status_1_t2 : {
				required: true
			},
			nationality_1_t2: {
				required: true
			},
			id_number_1_t2: {
				cNumber: true,
			},
			passport_number_1_t2: {
				cTextNumber: true
			},
			place_of_res_1_t2: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_1_t2: {
				required: true,
				cTextNumber: true
			},
			corrs_add_1_t2: {
				required: true
			},
			land_with_code_2_t2: {
				cNumber: true
			},
			fax_with_code_1_t2: {
				cNumber: true
			},
			mobile_personal_1_t2: {
				cNumber: true
			},
			mobile_work_1_t2: {
				required: true,
				cNumber: true
			},
			email_personal_1_t2: {
				email: true
			},
			email_work_1_t2: {
				required: true,
				email: true
			},
			agency_board_1_t2: {
				required: true,
				cTextNumber: true
			},
			doc_office_1_t2: {
				required: true,
				cText: true
			},
			reqtype_1_t2: {
				required: true
			},		

			// Section 2
			name_2_t2: {
				required: true,
				cText: true
			},
			nick_name_2_t2: {
				cText: true
			},
			nationality_2_t2: {
				required: true
			},
			id_number_2_t2: {
				cNumber: true
			},
			passport_number_2_t2: {
				cTextNumber: true
			},
			place_of_res_2_t2: {
				required: true,
				cTextNumber: true
			},
			land_with_code_2_t2: {
				cNumber: true
			},
			fax_with_code_2_t2: {
				cNumber: true
			},
			mobile_personal_2_t2: {
				cNumber: true
			},
			mobile_work_2_t2: {
				required: true,
				cNumber: true
			},
			email_personal_2_t2: {
				email: true
			},
			email_work_2_t2: {
				required: true,
				email: true
			},

			// Section 3
			center_name_arabic_3_t2: {
				required: true,
				cArabic: true
			},
			center_name_english_3_t2: {
				required: true,
				cEnglishText: true
			},
			license_number_ministry_of_3_t2: {
				required: true,
			},
			license_number_ministry_of_membership_3_t2: {
				required: true
			},
			commercial_reg_no_3_t2: {
				required: true,
				cNumber: true
			},
			tax_card_no_3_t2: {
				required: true,
				cNumber: true
			},
			address_of_the_center_3_t2: {
				required: true,
			},
			landline_no_3_t2: {
				cNumber: true
			},
			fax_no_3_t2: {
				cNumber: true
			},
			mobile_no1_3_t2: {
				required: true,
				cNumber: true
			},
			mobile_no2_3_t2: {
				cNumber: true
			},
			email_3_t2: {
				required: true
			},
			marine_activity_authorized_3_t2: {
				required: true
			},
			unit_area_of_activity_3_t2: {
				required: true
			}

		}
	});

	var verticalWizard_t2 = $("#vertical-wizard_t2").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			var $valid = $("#regForm_t2").valid();
			if(!$valid) {
				$validator_t2.focusInvalid();
				return false;
			}
			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			});
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t2');	
			}

			if(currentIndex == 4) {
				$('#lbl2_name').text($('[name="name"]').val());
				$('#lbl2_email').text($('[name="email"]').val());
				$('#lbl2_password').text('xxxxxxxxx');
				$('#lbl2_regtype').text($('[name="reg_type"] option:selected').text());

				$('#lbl_name_1_t2').text($('[name="name_1_t2"]').val());
				$('#lbl_applicant_status_1_t2').text($('[name="applicant_status_1_t2"]').val());
				$('#lbl_nationality_1_t2').text($('[name="nationality_1_t2"]').val());
				$('#lbl_id_number_1_t2').text($('[name="id_number_1_t2"]').val());
				$('#lbl_passport_number_1_t2').text($('[name="passport_number_1_t2"]').val());
				$('#lbl_place_of_res_1_t2').text($('[name="place_of_res_1_t2"]').val());
				$('#lbl_actual_place_of_res_1_t2').text($('[name="actual_place_of_res_1_t2"]').val());
				$('#lbl_corrs_add_1_t2').text($('[name="corrs_add_1_t2"]').val());
				$('#lbl_land_with_code_1_t2').text($('[name="land_with_code_1_t2"]').val());
				$('#lbl_fax_with_code_1_t2').text($('[name="fax_with_code_1_t2"]').val());
				$('#lbl_mobile_personal_1_t2').text($('[name="mobile_personal_1_t2"]').val());
				$('#lbl_mobile_work_1_t2').text($('[name="mobile_work_1_t2"]').val());
				$('#lbl_email_personal_1_t2').text($('[name="email_personal_1_t2"]').val());
				$('#lbl_email_work_1_t2').text($('[name="email_work_1_t2"]').val());
				$('#lbl_website_1_t2').text($('[name="website_1_t2"]').val());
				$('#lbl_agency_board_1_t2').text($('[name="agency_board_1_t2"]').val());
				$('#lbl_doc_office_1_t2').text($('[name="doc_office_1_t2"]').val());
				$('#lbl_reqtype_1_t2').text($('[name="reqtype_1_t2"]').val());
				$('#lbl_notes_1_t2').text($('[name="notes_1_t2"]').val());
				$('#lbl_name_2_t2').text($('[name="name_2_t2"]').val());
				$('#lbl_nick_name_2_t2').text($('[name="nick_name_2_t2"]').val());
				$('#lbl_nationality_2_t2').text($('[name="nationality_2_t2"]').val());
				$('#lbl_id_number_2_t2').text($('[name="id_number_2_t2"]').val());
				$('#lbl_passport_number_2_t2').text($('[name="passport_number_2_t2"]').val());
				$('#lbl_place_of_res_2_t2').text($('[name="place_of_res_2_t2"]').val());
				$('#lbl_land_with_code_2_t2').text($('[name="land_with_code_2_t2"]').val());
				$('#lbl_fax_with_code_2_t2').text($('[name="fax_with_code_2_t2"]').val());
				$('#lbl_mobile_personal_2_t2').text($('[name="mobile_personal_2_t2"]').val());
				$('#lbl_mobile_work_2_t2').text($('[name="mobile_work_2_t2"]').val());
				$('#lbl_email_personal_2_t2').text($('[name="email_personal_2_t2"]').val());
				$('#lbl_email_work_2_t2').text($('[name="email_work_2_t2"]').val());
				$('#lbl_website_2_t2').text($('[name="website_2_t2"]').val());
				$('#lbl_center_name_arabic_3_t2').text($('[name="center_name_arabic_3_t2"]').val());
				$('#lbl_center_name_english_3_t2').text($('[name="center_name_english_3_t2"]').val());
				$('#lbl_license_number_ministry_of_3_t2').text($('[name="license_number_ministry_of_3_t2"]').val());
				$('#lbl_license_number_ministry_of_membership_3_t2').text($('[name="license_number_ministry_of_membership_3_t2"]').val());
				$('#lbl_commercial_reg_no_3_t2').text($('[name="commercial_reg_no_3_t2"]').val());
				$('#lbl_tax_card_no_3_t2').text($('[name="tax_card_no_3_t2"]').val());
				$('#lbl_address_of_the_center_3_t2').text($('[name="address_of_the_center_3_t2"]').val());
				$('#lbl_landline_no_3_t2').text($('[name="landline_no_3_t2"]').val());
				$('#lbl_fax_no_3_t2').text($('[name="fax_no_3_t2"]').val());
				$('#lbl_mobile_no1_3_t2').text($('[name="mobile_no1_3_t2"]').val());
				$('#lbl_mobile_no2_3_t2').text($('[name="mobile_no2_3_t2"]').val());
				$('#lbl_email_3_t2').text($('[name="email_3_t2"]').val());
				$('#lbl_website_3_t2').text($('[name="website_3_t2"]').val());
				$('#lbl_marine_activity_authorized_3_t2').text($('[name="marine_activity_authorized_3_t2"]').val());
				$('#lbl_unit_area_of_activity_3_t2').text($('[name="unit_area_of_activity_3_t2"]').val());
				$('#lbl_payment_fees_t2').text($('[name="payment_fees_t2"]').val());

				
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
			return false;
		},
	});


	var $validator_t3 = $('#regForm_t3').validate({
		rules: {
			// Section 1
			name_1_t3: {
				required: true,
				cText: true,
			},
			applicant_status_1_t3 : {
				required: true
			},
			nationality_1_t3: {
				required: true
			},
			id_number_1_t3: {
				cNumber: true,
			},
			passport_number_1_t3: {
				cTextNumber: true
			},
			place_of_res_1_t3: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_1_t3: {
				required: true,
				cTextNumber: true
			},
			corrs_add_1_t3: {
				required: true
			},
			land_with_code_1_t3: {
				cNumber: true
			},
			fax_with_code_1_t3: {
				cNumber: true
			},
			mobile_personal_1_t3: {
				cNumber: true
			},
			mobile_work_1_t3: {
				required: true,
				cNumber: true
			},
			email_personal_1_t3: {
				email: true
			},
			email_work_1_t3: {
				required: true,
				email: true
			},
			agency_board_1_t3: {
				required: true,
				cTextNumber: true
			},
			doc_office_1_t3: {
				required: true,
				cText: true
			},
			reqtype_1_t3: {
				required: true
			},		

			// Section 2
			name_2_t3: {
				required: true,
				cText: true
			},
			nick_name_2_t3: {
				cText: true
			},
			id_number_2_t3: {
				cNumber: true
			},
			passport_number_2_t3: {
				cTextNumber: true
			},
			place_of_res_2_t3: {
				required: true,
				cTextNumber: true
			},
			land_with_code_2_t3: {
				cNumber: true
			},
			fax_with_code_2_t3: {
				cNumber: true
			},
			mobile_personal_2_t3: {
				cNumber: true
			},
			mobile_work_2_t3: {
				required: true,
				cNumber: true
			},
			email_personal_2_t3: {
				email: true
			},
			email_work_2_t3: {
				required: true,
				email: true
			},

			// Section 3
			center_name_arabic_3_t3: {
				required: true,
				cArabic: true
			},
			center_name_english_3_t3: {
				required: true,
				cEnglishText: true
			},
			license_number_ministry_of_3_t3: {
				required: true,
			},
			lbl_membership_number_3_t3: {
				required: true
			},
			commercial_reg_no_3_t3: {
				required: true,
				cNumber: true
			},
			tax_card_no_3_t3: {
				required: true,
				cNumber: true
			},
			address_of_the_center_3_t3: {
				required: true,
			},
			landline_no_3_t3: {
				cNumber: true
			},
			fax_no_3_t3: {
				cNumber: true
			},
			mobile_no1_3_t3: {
				required: true,
				cNumber: true
			},
			mobile_no2_3_t3: {	
				cNumber: true
			},
			email_3_t3: {
				required: true
			},
			marine_activity_authorized_3_t3: {
				required: true
			},
			unit_area_of_activity_3_t3: {
				required: true
			}

		}
	});

	var verticalWizard_t3 = $("#vertical-wizard_t3").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			var $valid = $("#regForm_t3").valid();
			if(!$valid) {
				$validator_t3.focusInvalid();
				return false;
			}
			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			})
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t3');	
			}

			if(currentIndex == 4) {
				$('#lbl3_name').text($('[name="name"]').val());
				$('#lbl3_email').text($('[name="email"]').val());
				$('#lbl3_password').text('xxxxxxxxx');
				$('#lbl3_regtype').text($('[name="reg_type"] option:selected').text());

				$('#lbl_name_1_t3').text($('[name="name_1_t3"]').val());
				$('#lbl_applicant_status_1_t3').text($('[name="applicant_status_1_t3"]').val());
				$('#lbl_nationality_1_t3').text($('[name="nationality_1_t3"]').val());
				$('#lbl_id_number_1_t3').text($('[name="id_number_1_t3"]').val());
				$('#lbl_passport_number_1_t3').text($('[name="passport_number_1_t3"]').val());
				$('#lbl_place_of_res_1_t3').text($('[name="place_of_res_1_t3"]').val());
				$('#lbl_actual_place_of_res_1_t3').text($('[name="actual_place_of_res_1_t3"]').val());
				$('#lbl_corrs_add_1_t3').text($('[name="corrs_add_1_t3"]').val());
				$('#lbl_land_with_code_1_t3').text($('[name="land_with_code_1_t3"]').val());
				$('#lbl_fax_with_code_1_t3').text($('[name="fax_with_code_1_t3"]').val());
				$('#lbl_mobile_personal_1_t3').text($('[name="mobile_personal_1_t3"]').val());
				$('#lbl_mobile_work_1_t3').text($('[name="mobile_work_1_t3"]').val());
				$('#lbl_email_personal_1_t3').text($('[name="email_personal_1_t3"]').val());
				$('#lbl_email_work_1_t3').text($('[name="email_work_1_t3"]').val());
				$('#lbl_website_1_t3').text($('[name="website_1_t3"]').val());
				$('#lbl_agency_board_1_t3').text($('[name="agency_board_1_t3"]').val());
				$('#lbl_doc_office_1_t3').text($('[name="doc_office_1_t3"]').val());
				$('#lbl_reqtype_1_t3').text($('[name="reqtype_1_t3"]').val());
				$('#lbl_notes_1_t3').text($('[name="notes_1_t3"]').val());
				$('#lbl_name_2_t3').text($('[name="name_2_t3"]').val());
				$('#lbl_nick_name_2_t3').text($('[name="nick_name_2_t3"]').val());

				$('#lbl_id_number_2_t3').text($('[name="id_number_2_t3"]').val());
				$('#lbl_passport_number_2_t3').text($('[name="passport_number_2_t3"]').val());
				$('#lbl_place_of_res_2_t3').text($('[name="place_of_res_2_t3"]').val());
				$('#lbl_land_with_code_2_t3').text($('[name="land_with_code_2_t3"]').val());
				$('#lbl_fax_with_code_2_t3').text($('[name="fax_with_code_2_t3"]').val());
				$('#lbl_mobile_personal_2_t3').text($('[name="mobile_personal_2_t3"]').val());
				$('#lbl_mobile_work_2_t3').text($('[name="mobile_work_2_t3"]').val());
				$('#lbl_email_personal_2_t3').text($('[name="email_personal_2_t3"]').val());
				$('#lbl_email_work_2_t3').text($('[name="email_work_2_t3"]').val());
				$('#lbl_website_2_t3').text($('[name="website_2_t3"]').val());
				$('#lbl_center_name_arabic_3_t3').text($('[name="center_name_arabic_3_t3"]').val());
				$('#lbl_center_name_english_3_t3').text($('[name="center_name_english_3_t3"]').val());
				$('#lbl_license_number_ministry_of_3_t3').text($('[name="license_number_ministry_of_3_t3"]').val());
				$('#lbl_membership_number_3_t3').text($('[name="membership_number_3_t3"]').val());
				$('#lbl_commercial_reg_no_3_t3').text($('[name="commercial_reg_no_3_t3"]').val());
				$('#lbl_tax_card_no_3_t3').text($('[name="tax_card_no_3_t3"]').val());
				$('#lbl_address_of_the_center_3_t3').text($('[name="address_of_the_center_3_t3"]').val());
				$('#lbl_landline_no_3_t3').text($('[name="landline_no_3_t3"]').val());
				$('#lbl_fax_no_3_t3').text($('[name="fax_no_3_t3"]').val());
				$('#lbl_mobile_no1_3_t3').text($('[name="mobile_no1_3_t3"]').val());
				$('#lbl_mobile_no2_3_t3').text($('[name="mobile_no2_3_t3"]').val());
				$('#lbl_email_3_t3').text($('[name="email_3_t3"]').val());
				$('#lbl_website_3_t3').text($('[name="website_3_t3"]').val());
				$('#lbl_marine_activity_authorized_3_t3').text($('[name="marine_activity_authorized_3_t3"]').val());
				$('#lbl_unit_area_of_activity_3_t3').text($('[name="unit_area_of_activity_3_t3"]').val());
				$('#lbl_payment_fees_t3').text($('[name="payment_fees_t3"]').val());

				
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
			return false;
		},
	});

	var $validator_t4 = $('#regForm_t4').validate({
		rules: {
			// Section 1
			name_1_t4: {
				required: true,
				cText: true,
			},
			applicant_status_1_t4 : {
				required: true
			},
			nationality_1_t4: {
				required: true
			},
			id_number_1_t4: {
				cNumber: true,
			},
			passport_number_1_t4: {
				cTextNumber: true
			},
			place_of_res_1_t4: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_1_t4: {
				required: true,
				cTextNumber: true
			},
			corrs_add_1_t4: {
				required: true
			},
			land_with_code_1_t4: {
				cNumber: true
			},
			mobile_personal_1_t4: {
				cNumber: true
			},
			mobile_work_1_t4: {
				required: true,
				cNumber: true
			},
			email_personal_1_t4: {
				email: true
			},
			email_work_1_t4: {
				required: true,
				email: true
			},
			agency_board_1_t4: {
				required: true,
				cTextNumber: true
			},
			doc_office_1_t4: {
				required: true,
				cText: true
			},
			reqtype_1_t4: {
				required: true
			},		

			// Section 2
			name_2_t4: {
				required: true,
				cText: true
			},
			nick_name_2_t4: {
				cText: true
			},
			id_number_2_t4: {
				cNumber: true
			},
			passport_number_2_t4: {
				cTextNumber: true
			},
			place_of_res_2_t4: {
				required: true,
				cTextNumber: true
			},
			land_with_code_2_t4: {
				cNumber: true
			},
			fax_with_code_2_t4: {
				cNumber: true
			},
			mobile_personal_2_t4: {
				cNumber: true
			},
			mobile_work_2_t4: {
				required: true,
				cNumber: true
			},
			email_personal_2_t4: {
				email: true
			},
			email_work_2_t4: {
				required: true,
				email: true
			},

			// Section 3
			company_name_arabic_3_t4: {
				required: true,
				cArabic: true
			},
			company_name_english_3_t4: {
				required: true,
				cEnglishText: true
			},
			license_number_ministry_of_3_t4: {
				required: true,
			},
			membership_number_3_t4: {
				required: true
			},
			commercial_reg_no_3_t4: {
				required: true,
				cNumber: true
			},
			tax_card_no_3_t4: {
				required: true,
				cNumber: true
			},
			address_of_the_center_3_t4: {
				required: true,
			},
			landline_no_3_t4: {
				cNumber: true
			},
			fax_no_3_t4: {
				cNumber: true
			},
			mobile_no1_3_t4: {
				required: true,
				cNumber: true
			},
			mobile_no2_3_t4: {	
				cNumber: true
			},
			email_3_t4: {
				required: true
			},
			marine_activity_authorized_3_t4: {
				required: true
			},
			unit_area_of_activity_3_t4: {
				required: true
			}

		}
	});

	var verticalWizard_t4 = $("#vertical-wizard_t4").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			var $valid = $("#regForm_t4").valid();
			if(!$valid) {
				$validator_t4.focusInvalid();
				return false;
			}
			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			})
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t4');	
			}
			if(currentIndex == 4) {
				$('#lbl4_name').text($('[name="name"]').val());
				$('#lbl4_email').text($('[name="email"]').val());
				$('#lbl4_password').text('xxxxxxxxx');
				$('#lbl4_regtype').text($('[name="reg_type"] option:selected').text());



				$('#lbl_name_1_t4').text($('[name="name_1_t4"]').val());
				$('#lbl_applicant_status_1_t4').text($('[name="applicant_status_1_t4"]').val());
				$('#lbl_nationality_1_t4').text($('[name="nationality_1_t4"]').val());
				$('#lbl_id_number_1_t4').text($('[name="id_number_1_t4"]').val());
				$('#lbl_passport_number_1_t4').text($('[name="passport_number_1_t4"]').val());
				$('#lbl_place_of_res_1_t4').text($('[name="place_of_res_1_t4"]').val());
				$('#lbl_actual_place_of_res_1_t4').text($('[name="actual_place_of_res_1_t4"]').val());
				$('#lbl_corrs_add_1_t4').text($('[name="corrs_add_1_t4"]').val());
				$('#lbl_land_with_code_1_t4').text($('[name="land_with_code_1_t4"]').val());
				$('#lbl_mobile_personal_1_t4').text($('[name="mobile_personal_1_t4"]').val());
				$('#lbl_mobile_work_1_t4').text($('[name="mobile_work_1_t4"]').val());
				$('#lbl_email_personal_1_t4').text($('[name="email_personal_1_t4"]').val());
				$('#lbl_email_work_1_t4').text($('[name="email_work_1_t4"]').val());
				$('#lbl_website_1_t4').text($('[name="website_1_t4"]').val());
				$('#lbl_agency_board_1_t4').text($('[name="agency_board_1_t4"]').val());
				$('#lbl_doc_office_1_t4').text($('[name="doc_office_1_t4"]').val());
				$('#lbl_reqtype_1_t4').text($('[name="reqtype_1_t4"]').val());
				$('#lbl_notes_1_t4').text($('[name="notes_1_t4"]').val());
				$('#lbl_name_2_t4').text($('[name="name_2_t4"]').val());
				$('#lbl_nick_name_2_t4').text($('[name="nick_name_2_t4"]').val());
				$('#lbl_id_number_2_t4').text($('[name="id_number_2_t4"]').val());
				$('#lbl_passport_number_2_t4').text($('[name="passport_number_2_t4"]').val());
				$('#lbl_place_of_res_2_t4').text($('[name="place_of_res_2_t4"]').val());
				$('#lbl_land_with_code_2_t4').text($('[name="land_with_code_2_t4"]').val());
				$('#lbl_fax_with_code_2_t4').text($('[name="fax_with_code_2_t4"]').val());
				$('#lbl_mobile_personal_2_t4').text($('[name="mobile_personal_2_t4"]').val());
				$('#lbl_mobile_work_2_t4').text($('[name="mobile_work_2_t4"]').val());
				$('#lbl_email_personal_2_t4').text($('[name="email_personal_2_t4"]').val());
				$('#lbl_email_work_2_t4').text($('[name="email_work_2_t4"]').val());
				$('#lbl_website_2_t4').text($('[name="website_2_t4"]').val());
				$('#lbl_center_name_arabic_3_t4').text($('[name="company_name_arabic_3_t4"]').val());
				$('#lbl_center_name_english_3_t4').text($('[name="company_name_english_3_t4"]').val());
				$('#lbl_license_number_ministry_of_3_t4').text($('[name="license_number_ministry_of_3_t4"]').val());
				$('#lbl_membership_number_3_t4').text($('[name="membership_number_3_t4"]').val());
				$('#lbl_commercial_reg_no_3_t4').text($('[name="commercial_reg_no_3_t4"]').val());
				$('#lbl_tax_card_no_3_t4').text($('[name="tax_card_no_3_t4"]').val());
				$('#lbl_address_of_the_center_3_t4').text($('[name="address_of_the_center_3_t4"]').val());
				$('#lbl_landline_no_3_t4').text($('[name="landline_no_3_t4"]').val());
				$('#lbl_fax_no_3_t4').text($('[name="fax_no_3_t4"]').val());
				$('#lbl_mobile_no1_3_t4').text($('[name="mobile_no1_3_t4"]').val());
				$('#lbl_mobile_no2_3_t4').text($('[name="mobile_no2_3_t4"]').val());
				$('#lbl_email_3_t4').text($('[name="email_3_t4"]').val());
				$('#lbl_website_3_t4').text($('[name="website_3_t4"]').val());
				$('#lbl_marine_activity_authorized_3_t4').text($('[name="marine_activity_authorized_3_t4"]').val());
				$('#lbl_unit_area_of_activity_3_t4').text($('[name="unit_area_of_activity_3_t4"]').val());
				$('#lbl_payment_fees_t4').text($('[name="payment_fees_t4"]').val());
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
			return false;
		},
	});


	var $validator_t5 = $('#regForm_t5').validate({
		rules: {
			// Section 1
			name_1_t5: {
				required: true,
				cText: true,
			},
			applicant_status_1_t5 : {
				required: true
			},
			id_number_1_t5: {
				cNumber: true,
			},
			passport_number_1_t5: {
				cTextNumber: true
			},
			place_of_res_1_t5: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_1_t5: {
				required: true,
				cTextNumber: true
			},
			corrs_add_1_t5: {
				required: true
			},
			land_with_code_1_t5: {
				cNumber: true
			},
			fax_with_code_1_t5: {
				cNumber: true
			},
			mobile_personal_1_t5: {
				cNumber: true
			},
			mobile_work_1_t5: {
				required: true,
				cNumber: true
			},
			email_personal_1_t5: {
				email: true
			},
			email_work_1_t5: {
				required: true,
				email: true
			},
			agency_board_1_t5: {
				required: true,
				cTextNumber: true
			},
			doc_office_1_t5: {
				required: true,
				cText: true
			},
			reqtype_1_t5: {
				required: true
			},		

			// Section 2
			name_2_t5: {
				required: true,
				cText: true
			},
			nick_name_2_t5: {
				cText: true
			},
			id_number_2_t5: {
				cNumber: true
			},
			passport_number_2_t5: {
				cTextNumber: true
			},
			place_of_res_2_t5: {
				required: true,
				cTextNumber: true
			},
			land_with_code_2_t5: {
				cNumber: true
			},
			fax_with_code_2_t5: {
				cNumber: true
			},
			mobile_personal_2_t5: {
				cNumber: true
			},
			mobile_work_2_t5: {
				required: true,
				cNumber: true
			},
			email_personal_2_t5: {
				email: true
			},
			email_work_2_t5: {
				required: true,
				email: true
			},

			// Section 3
			entity_name_arabic_3_t5: {
				required: true,
				cArabic: true
			},
			entity_name_english_3_t5: {
				required: true,
				cEnglishText: true
			},
			membership_number_3_t5: {
				required: true
			},
			commercial_reg_no_3_t5: {
				required: true,
				cNumber: true
			},
			address_of_the_entity_3_t5: {
				required: true,
			},
			landline_no_3_t5: {
				cNumber: true
			},
			fax_no_3_t5: {
				cNumber: true
			},
			mobile_no1_3_t5: {
				required: true,
				cNumber: true
			},
			mobile_no2_3_t5: {	
				cNumber: true
			},
			email_3_t5: {
				required: true
			},
			marine_activity_authorized_3_t5: {
				required: true
			},
			unit_area_of_activity_3_t5: {
				required: true
			}

		}
	});

	var verticalWizard_t5 = $("#vertical-wizard_t5").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			var $valid = $("#regForm_t5").valid();
			if(!$valid) {
				$validator_t5.focusInvalid();
				return false;
			}
			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			})

			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t5');	
			}
			if(currentIndex == 4) {
				$('#lbl5_name').text($('[name="name"]').val());
				$('#lbl5_email').text($('[name="email"]').val());
				$('#lbl5_password').text('xxxxxxxxx');
				$('#lbl5_regtype').text($('[name="reg_type"] option:selected').text());

				$('#lbl_name_1_t5').text($('[name="name_1_t5"]').val());
				$('#lbl_applicant_status_1_t5').text($('[name="applicant_status_1_t5"]').val());
				$('#lbl_id_number_1_t5').text($('[name="id_number_1_t5"]').val());
				$('#lbl_passport_number_1_t5').text($('[name="passport_number_1_t5"]').val());
				$('#lbl_place_of_res_1_t5').text($('[name="place_of_res_1_t5"]').val());
				$('#lbl_actual_place_of_res_1_t5').text($('[name="actual_place_of_res_1_t5"]').val());
				$('#lbl_corrs_add_1_t5').text($('[name="corrs_add_1_t5"]').val());
				$('#lbl_land_with_code_1_t5').text($('[name="land_with_code_1_t5"]').val());
				$('#lbl_fax_with_code_1_t5').text($('[name="fax_with_code_1_t5"]').val());
				$('#lbl_mobile_personal_1_t5').text($('[name="mobile_personal_1_t5"]').val());
				$('#lbl_mobile_work_1_t5').text($('[name="mobile_work_1_t5"]').val());
				$('#lbl_email_personal_1_t5').text($('[name="email_personal_1_t5"]').val());
				$('#lbl_email_work_1_t5').text($('[name="email_work_1_t5"]').val());
				$('#lbl_website_1_t5').text($('[name="website_1_t5"]').val());
				$('#lbl_agency_board_1_t5').text($('[name="agency_board_1_t5"]').val());
				$('#lbl_doc_office_1_t5').text($('[name="doc_office_1_t5"]').val());
				$('#lbl_reqtype_1_t5').text($('[name="reqtype_1_t5"]').val());
				$('#lbl_notes_1_t5').text($('[name="notes_1_t5"]').val());
				$('#lbl_name_2_t5').text($('[name="name_2_t5"]').val());
				$('#lbl_nick_name_2_t5').text($('[name="nick_name_2_t5"]').val());
				$('#lbl_id_number_2_t5').text($('[name="id_number_2_t5"]').val());
				$('#lbl_passport_number_2_t5').text($('[name="passport_number_2_t5"]').val());
				$('#lbl_place_of_res_2_t5').text($('[name="place_of_res_2_t5"]').val());
				$('#lbl_actual_place_of_res_2_t5').text($('[name="actual_place_of_res_2_t5"]').val());
				$('#lbl_land_with_code_2_t5').text($('[name="land_with_code_2_t5"]').val());
				$('#lbl_fax_with_code_2_t5').text($('[name="fax_with_code_2_t5"]').val());
				$('#lbl_mobile_personal_2_t5').text($('[name="mobile_personal_2_t5"]').val());
				$('#lbl_mobile_work_2_t5').text($('[name="mobile_work_2_t5"]').val());
				$('#lbl_email_personal_2_t5').text($('[name="email_personal_2_t5"]').val());
				$('#lbl_email_work_2_t5').text($('[name="email_work_2_t5"]').val());
				$('#lbl_website_2_t5').text($('[name="website_2_t5"]').val());
				$('#lbl_entity_name_arabic_3_t5').text($('[name="entity_name_arabic_3_t5"]').val());
				$('#lbl_entity_name_english_3_t5').text($('[name="entity_name_english_3_t5"]').val());
				$('#lbl_membership_number_3_t5').text($('[name="membership_number_3_t5"]').val());
				$('#lbl_commercial_reg_no_3_t5').text($('[name="commercial_reg_no_3_t5"]').val());
				$('#lbl_address_of_the_entity_3_t5').text($('[name="address_of_the_entity_3_t5"]').val());
				$('#lbl_landline_no_3_t5').text($('[name="landline_no_3_t5"]').val());
				$('#lbl_fax_no_3_t5').text($('[name="fax_no_3_t5"]').val());
				$('#lbl_mobile_no1_3_t5').text($('[name="mobile_no1_3_t5"]').val());
				$('#lbl_mobile_no2_3_t5').text($('[name="mobile_no2_3_t5"]').val());
				$('#lbl_email_3_t5').text($('[name="email_3_t5"]').val());
				$('#lbl_website_3_t5').text($('[name="website_3_t5"]').val());
				$('#lbl_marine_activity_authorized_3_t5').text($('[name="marine_activity_authorized_3_t5"]').val());
				$('#lbl_unit_area_of_activity_3_t5').text($('[name="unit_area_of_activity_3_t5"]').val());
				$('#lbl_payment_fees_t5').text($('[name="payment_fees_t5"]').val());


				$('#lbl_land_with_code_ext_1_t5').text($('[name="land_with_code_ext_1_t5"]').val());
				$('#lbl_fax_with_code_ext_1_t5').text($('[name="fax_with_code_ext_1_t5"]').val());
				$('#lbl_mobile_personal_ext_1_t5').text($('[name="mobile_personal_ext_1_t5"]').val());
				$('#lbl_mobile_work_ext_1_t5').text($('[name="mobile_work_ext_1_t5"]').val());
				$('#lbl_land_with_code_ext_2_t5').text($('[name="land_with_code_ext_2_t5"]').val());
				$('#lbl_fax_with_code_ext_2_t5').text($('[name="fax_with_code_ext_2_t5"]').val());
				$('#lbl_mobile_personal_ext_2_t5').text($('[name="mobile_personal_ext_2_t5"]').val());
				$('#lbl_mobile_work_ext_2_t5').text($('[name="mobile_work_ext_2_t5"]').val());
				$('#lbl_landline_no_ext_3_t5').text($('[name="landline_no_ext_3_t5"]').val());
				$('#lbl_fax_no_3_ext_t5').text($('[name="fax_no_3_ext_t5"]').val());
				$('#lbl_mobile_no1_ext_3_t5').text($('[name="mobile_no1_ext_3_t5"]').val());
				$('#lbl_mobile_no2_ext_3_t5').text($('[name="mobile_no2_ext_3_t5"]').val());
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
			return false;
		},
	});

	var $validator_t6 = $('#regForm_t6').validate({
		rules: {
			// Section 1
			name_1_t6: {
				required: true,
				cText: true,
			},
			applicant_status_1_t6 : {
				required: true
			},
			id_number_1_t6: {
				cNumber: true,
			},
			passport_number_1_t6: {
				cTextNumber: true
			},
			place_of_res_1_t6: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_1_t6: {
				required: true,
				cTextNumber: true
			},
			corrs_add_1_t6: {
				required: true
			},
			land_with_code_1_t6: {
				cNumber: true
			},
			fax_with_code_1_t6: {
				cNumber: true
			},
			mobile_personal_1_t6: {
				cNumber: true
			},
			mobile_work_1_t6: {
				required: true,
				cNumber: true
			},
			email_personal_1_t6: {
				email: true
			},
			email_work_1_t6: {
				required: true,
				email: true
			},
			agency_board_1_t6: {
				required: true,
				cTextNumber: true
			},
			doc_office_1_t6: {
				required: true,
				cText: true
			},
			reqtype_1_t6: {
				required: true
			},		

			// Section 2
			name_2_t6: {
				required: true,
				cText: true
			},
			nick_name_2_t6: {
				cText: true
			},
			id_number_2_t6: {
				cNumber: true
			},
			passport_number_2_t6: {
				cTextNumber: true
			},
			place_of_res_2_t6: {
				required: true,
				cTextNumber: true
			},
			actual_place_of_res_2_t6: {
				required: true,
				cTextNumber: true
			},
			land_with_code_2_t6: {
				cNumber: true
			},
			fax_with_code_2_t6: {
				cNumber: true
			},
			mobile_personal_2_t6: {
				cNumber: true
			},
			mobile_work_2_t6: {
				required: true,
				cNumber: true
			},
			email_personal_2_t6: {
				email: true
			},
			email_work_2_t6: {
				required: true,
				email: true
			},

			// Section 3
			entity_name_arabic_3_t6: {
				required: true,
				cArabic: true
			},
			entity_name_english_3_t6: {
				required: true,
				cEnglishText: true
			},
			membership_number_3_t6: {
				required: true
			},
			commercial_reg_no_3_t6: {
				required: true,
				cNumber: true
			},
			address_of_the_entity_3_t6: {
				required: true,
			},
			landline_no_3_t6: {
				cNumber: true
			},
			fax_no_3_t6: {
				cNumber: true
			},
			mobile_no1_3_t6: {
				required: true,
				cNumber: true
			},
			mobile_no2_3_t6: {	
				cNumber: true
			},
			email_3_t6: {
				required: true
			},
			marine_activity_authorized_3_t6: {
				required: true
			},
			time_period_3_t6: {
				required: true,
			},			
			unit_area_of_activity_3_t6: {
				required: true
			},

			// Code Extension

			land_with_code_ext_1_t6 : {
				required: true
			},			
			fax_with_code_ext_1_t6 : {
				required: true
			},
			mobile_personal_ext_1_t6: {
				required: true
			},
			mobile_work_ext_1_t6: {
				required: true
			},
			land_with_code_ext_2_t6: {
				required: true
			},
			fax_with_code_ext_2_t6: {
				required: true
			},
			mobile_personal_ext_2_t6: {
				required: true
			},
			mobile_work_ext_2_t6: {
				required: true
			},
			landline_no_ext_3_t6: {
				required: true
			},
			fax_no_ext_3_t6: {
				required: true
			},
			mobile_no1_ext_3_t6: {
				required: true
			},
			mobile_no2_ext_3_t6: {
				required: true
			}

		}
	});
	
	var verticalWizard_t6 = $("#vertical-wizard_t6").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
		enablePagination: false,
		onStepChanging: function (event, currentIndex, newIndex) {
			var $valid = $("#regForm_t6").valid();
			if(!$valid) {
				$validator_t6.focusInvalid();
				return false;
			}
			return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			$('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
				if(i != currentIndex) {
					$(v).removeClass('done');
					$(v).prop('aria-disabled', true);
					$(v).removeAttr('aria-selected');
					$(v).addClass('disabled');
				}
			})
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t6');	
			}

			if(currentIndex == 4) {
				$('#lbl6_name').text($('[name="name"]').val());
				$('#lbl6_email').text($('[name="email"]').val());
				$('#lbl6_password').text('xxxxxxxxx');
				$('#lbl6_regtype').text($('[name="reg_type"] option:selected').text());


				$('#lbl_name_1_t6').text($('[name="name_1_t6"]').val());
				$('#lbl_applicant_status_1_t6').text($('[name="applicant_status_1_t6"]').val());
				$('#lbl_id_number_1_t6').text($('[name="id_number_1_t6"]').val());
				$('#lbl_passport_number_1_t6').text($('[name="passport_number_1_t6"]').val());
				$('#lbl_place_of_res_1_t6').text($('[name="place_of_res_1_t6"]').val());
				$('#lbl_actual_place_of_res_1_t6').text($('[name="actual_place_of_res_1_t6"]').val());
				$('#lbl_corrs_add_1_t6').text($('[name="corrs_add_1_t6"]').val());
				$('#lbl_land_with_code_1_t6').text($('[name="land_with_code_1_t6"]').val());
				$('#lbl_fax_with_code_1_t6').text($('[name="fax_with_code_1_t6"]').val());
				$('#lbl_mobile_personal_1_t6').text($('[name="mobile_personal_1_t6"]').val());
				$('#lbl_mobile_work_1_t6').text($('[name="mobile_work_1_t6"]').val());
				$('#lbl_email_personal_1_t6').text($('[name="email_personal_1_t6"]').val());
				$('#lbl_email_work_1_t6').text($('[name="email_work_1_t6"]').val());
				$('#lbl_website_1_t6').text($('[name="website_1_t6"]').val());
				$('#lbl_agency_board_1_t6').text($('[name="agency_board_1_t6"]').val());
				$('#lbl_doc_office_1_t6').text($('[name="doc_office_1_t6"]').val());
				$('#lbl_reqtype_1_t6').text($('[name="reqtype_1_t6"]').val());
				$('#lbl_notes_1_t6').text($('[name="notes_1_t6"]').val());
				$('#lbl_name_2_t6').text($('[name="name_2_t6"]').val());
				$('#lbl_nick_name_2_t6').text($('[name="nick_name_2_t6"]').val());
				$('#lbl_id_number_2_t6').text($('[name="id_number_2_t6"]').val());
				$('#lbl_passport_number_2_t6').text($('[name="passport_number_2_t6"]').val());
				$('#lbl_place_of_res_2_t6').text($('[name="place_of_res_2_t6"]').val());
				$('#lbl_actual_place_of_res_2_t6').text($('[name="actual_place_of_res_2_t6"]').val());
				$('#lbl_land_with_code_2_t6').text($('[name="land_with_code_2_t6"]').val());
				$('#lbl_fax_with_code_2_t6').text($('[name="fax_with_code_2_t6"]').val());
				$('#lbl_mobile_personal_2_t6').text($('[name="mobile_personal_2_t6"]').val());
				$('#lbl_mobile_work_2_t6').text($('[name="mobile_work_2_t6"]').val());
				$('#lbl_email_personal_2_t6').text($('[name="email_personal_2_t6"]').val());
				$('#lbl_email_work_2_t6').text($('[name="email_work_2_t6"]').val());
				$('#lbl_website_2_t6').text($('[name="website_2_t6"]').val());
				$('#lbl_entity_name_arabic_3_t6').text($('[name="entity_name_arabic_3_t6"]').val());
				$('#lbl_entity_name_english_3_t6').text($('[name="entity_name_english_3_t6"]').val());
				$('#lbl_membership_number_3_t6').text($('[name="membership_number_3_t6"]').val());
				$('#lbl_commercial_reg_no_3_t6').text($('[name="commercial_reg_no_3_t6"]').val());
				$('#lbl_address_of_the_entity_3_t6').text($('[name="address_of_the_entity_3_t6"]').val());
				$('#lbl_landline_no_3_t6').text($('[name="landline_no_3_t6"]').val());
				$('#lbl_fax_no_3_t6').text($('[name="fax_no_3_t6"]').val());
				$('#lbl_mobile_no1_3_t6').text($('[name="mobile_no1_3_t6"]').val());
				$('#lbl_mobile_no2_3_t6').text($('[name="mobile_no2_3_t6"]').val());
				$('#lbl_email_3_t6').text($('[name="email_3_t6"]').val());
				$('#lbl_website_3_t6').text($('[name="website_3_t6"]').val());
				$('#lbl_marine_activity_authorized_3_t6').text($('[name="marine_activity_authorized_3_t6"]').val());
				$('#lbl_time_period_3_t6').text($('[name="time_period_3_t6"]').val());
				$('#lbl_notes_3_t6').text($('[name="notes_3_t6"]').val());
				$('#lbl_unit_area_of_activity_3_t6').text($('[name="unit_area_of_activity_3_t6"]').val());
				$('#lbl_payment_fees_t6').text($('[name="payment_fees_t6"]').val());

				$('#lbl_land_with_code_ext_1_t6').text($('[name="land_with_code_ext_1_t6"]').val());
				$('#lbl_fax_with_code_ext_1_t6').text($('[name="fax_with_code_ext_1_t6"]').val());
				$('#lbl_mobile_personal_ext_1_t6').text($('[name="mobile_personal_ext_1_t6"]').val());
				$('#lbl_mobile_work_ext_1_t6').text($('[name="mobile_work_ext_1_t6"]').val());
				$('#lbl_land_with_code_ext_2_t6').text($('[name="land_with_code_ext_2_t6"]').val());
				$('#lbl_fax_with_code_ext_2_t6').text($('[name="fax_with_code_ext_2_t6"]').val());
				$('#lbl_mobile_personal_ext_2_t6').text($('[name="mobile_personal_ext_2_t6"]').val());
				$('#lbl_mobile_work_ext_2_t6').text($('[name="mobile_work_ext_2_t6"]').val());
				$('#lbl_landline_no_ext_3_t6').text($('[name="landline_no_ext_3_t6"]').val());
				$('#lbl_fax_no_ext_3_t6').text($('[name="fax_no_ext_3_t6"]').val());
				$('#lbl_mobile_no1_ext_3_t6').text($('[name="mobile_no1_ext_3_t6"]').val());
				$('#lbl_mobile_no2_ext_3_t6').text($('[name="mobile_no2_ext_3_t6"]').val());
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
			return false;
		},
	});	


	function wiz_nextbutton(elem) {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t1.steps("next");
	}
	function wiz_prevbutton(elem) {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t1.steps("previous");
	}
	
	function wiz2_nextbutton() {
		$('form').submit(function() {
			return false;
		});
		console.log(verticalWizard_t2);
		verticalWizard_t2.steps("next");
	}
	function wiz2_prevbutton() {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t2.steps("previous");
	}

	function wiz3_nextbutton() {
		$('form').submit(function() {
			return false;
		});
		console.log(verticalWizard_t3);
		verticalWizard_t3.steps("next");
	}
	function wiz3_prevbutton() {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t3.steps("previous");
	}
	
	function wiz4_nextbutton() {
		$('form').submit(function() {
			return false;
		});
		verticalWizard_t4.steps("next");
	}
	function wiz4_prevbutton() {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t4.steps("previous");
	}

	function wiz5_nextbutton() {
		$('form').submit(function() {
			return false;
		});
		verticalWizard_t5.steps("next");
	}
	function wiz5_prevbutton() {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t5.steps("previous");
	}

	function wiz6_nextbutton() {
		$('form').submit(function() {
			return false;
		});
		verticalWizard_t6.steps("next");
	}
	function wiz6_prevbutton() {
		$('form').submit(function() {
			return false;
		});			
		verticalWizard_t6.steps("previous");
	}	

	function login_section_reedit() {
		$('#login_section').show();
		$('#login_section_reedit').hide();
		$('#section1_tab, #section2_tab, #section3_tab, #section4_tab, #section5_tab, #section6_tab').hide();
	}

	$('input[type="checkbox"]').on('change', function() {
		var checked = $(this).prop('checked');
		var _name = $(this).prop('name');
		var field_arr = {};
		same_as_applicant_change(_name);			
	});

	function same_as_applicant_change(_name) {
		var field_arr = {};
		var checked = $('input[name="'+_name+'"]').prop('checked');
		if(checked == false) {
			return false;
		}
		if(_name == 'same_as_applicant_2_t1') {
			field_arr['name_2_t1'] = (checked == true) ? $('[name="name_1_t1"]').val() : '';
			field_arr['nationality_2_t1'] = (checked == true) ? $('[name="nationality_1_t1"]').val() : '';
			field_arr['id_number_2_t1'] = (checked == true) ? $('[name="id_number_1_t1"]').val() : '';
			field_arr['place_of_res_2_t1'] = (checked == true) ? $('[name="place_of_res_1_t1"]').val() : '';
			field_arr['passport_number_2_t1'] = (checked == true) ? $('[name="passport_number_1_t1"]').val() : '';
			field_arr['actual_place_of_res_2_t1'] = (checked == true) ? $('[name="actual_place_of_res_1_t1"]').val() : '';
			field_arr['land_with_code_2_t1'] = (checked == true) ? $('[name="land_with_code_1_t1"]').val() : '';
			field_arr['land_with_ext_2_t1'] = (checked == true) ? $('[name="land_with_ext_1_t1"]').val() : '';
			field_arr['fax_with_code_2_t1'] = (checked == true) ? $('[name="fax_with_code_1_t1"]').val() : '';
			field_arr['fax_with_ext_2_t1'] = (checked == true) ? $('[name="fax_with_ext_1_t1"]').val() : '';
			field_arr['mobile_personal_2_t1'] = (checked == true) ? $('[name="mobile_personal_1_t1"]').val() : '';
			field_arr['mobile_personal_ext_2_t1'] = (checked == true) ? $('[name="mobile_personal_ext_1_t1"]').val() : '';

			field_arr['mobile_work_2_t1'] = (checked == true) ? $('[name="mobile_work_1_t1"]').val() : '';
			field_arr['mobile_work_ext_2_t1'] = (checked == true) ? $('[name="mobile_work_ext_1_t1"]').val() : '';

			field_arr['email_personal_2_t1'] = (checked == true) ? $('[name="email_personal_1_t1"]').val() : '';
			field_arr['email_work_2_t1'] = (checked == true) ? $('[name="email_work_1_t1"]').val() : '';
			field_arr['website_2_t1'] = (checked == true) ? $('[name="website_1_t1"]').val() : '';
			field_arr['notes_2_t1'] = (checked == true) ? $('[name="notes_1_t1"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t1"]').trigger('change');
			$('[name="land_with_ext_2_t1"]').trigger('change');
			$('[name="fax_with_ext_2_t1"]').trigger('change');
			$('[name="mobile_personal_ext_2_t1"]').trigger('change');
			$('[name="mobile_work_ext_2_t1"]').trigger('change');
			
		} 
		else if(_name == 'same_as_applicant_2_t2') {
			field_arr['name_2_t2'] = (checked == true) ? $('[name="name_1_t2"]').val() : '';
			field_arr['nationality_2_t2'] = (checked == true) ? $('[name="nationality_1_t2"]').val() : '';
			field_arr['id_number_2_t2'] = (checked == true) ? $('[name="id_number_1_t2"]').val() : '';
			field_arr['place_of_res_2_t2'] = (checked == true) ? $('[name="place_of_res_1_t2"]').val() : '';
			field_arr['passport_number_2_t2'] = (checked == true) ? $('[name="passport_number_1_t2"]').val() : '';
			field_arr['actual_place_of_res_2_t2'] = (checked == true) ? $('[name="actual_place_of_res_1_t2"]').val() : '';
			field_arr['land_with_code_2_t2'] = (checked == true) ? $('[name="land_with_code_1_t2"]').val() : '';
			field_arr['land_with_ext_2_t2'] = (checked == true) ? $('[name="land_with_ext_1_t2"]').val() : '';
			field_arr['fax_with_code_2_t2'] = (checked == true) ? $('[name="fax_with_code_1_t2"]').val() : '';
			field_arr['fax_with_ext_2_t2'] = (checked == true) ? $('[name="fax_with_ext_1_t2"]').val() : '';
			field_arr['mobile_personal_2_t2'] = (checked == true) ? $('[name="mobile_personal_1_t2"]').val() : '';
			field_arr['mobile_personal_ext_2_t2'] = (checked == true) ? $('[name="mobile_personal_ext_1_t2"]').val() : '';
			field_arr['mobile_work_2_t2'] = (checked == true) ? $('[name="mobile_work_1_t2"]').val() : '';
			field_arr['mobile_work_ext_2_t2'] = (checked == true) ? $('[name="mobile_work_ext_1_t2"]').val() : '';
			field_arr['email_personal_2_t2'] = (checked == true) ? $('[name="email_personal_1_t2"]').val() : '';
			field_arr['email_work_2_t2'] = (checked == true) ? $('[name="email_work_1_t2"]').val() : '';
			field_arr['website_2_t2'] = (checked == true) ? $('[name="website_1_t2"]').val() : '';
			field_arr['notes_2_t2'] = (checked == true) ? $('[name="notes_1_t2"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t2"]').trigger('change');
			$('[name="land_with_ext_2_t2"]').trigger('change');
			$('[name="fax_with_ext_2_t2"]').trigger('change');
			$('[name="mobile_personal_ext_2_t2"]').trigger('change');
			$('[name="mobile_work_ext_2_t2"]').trigger('change');
			
		}
		else if(_name == 'same_as_applicant_2_t3') {
			field_arr['name_2_t3'] = (checked == true) ? $('[name="name_1_t3"]').val() : '';
			field_arr['nationality_2_t3'] = (checked == true) ? $('[name="nationality_1_t3"]').val() : '';
			field_arr['id_number_2_t3'] = (checked == true) ? $('[name="id_number_1_t3"]').val() : '';
			field_arr['place_of_res_2_t3'] = (checked == true) ? $('[name="place_of_res_1_t3"]').val() : '';
			field_arr['passport_number_2_t3'] = (checked == true) ? $('[name="passport_number_1_t3"]').val() : '';
			field_arr['actual_place_of_res_2_t3'] = (checked == true) ? $('[name="actual_place_of_res_1_t3"]').val() : '';
			field_arr['land_with_code_2_t3'] = (checked == true) ? $('[name="land_with_code_1_t3"]').val() : '';
			field_arr['land_with_ext_2_t3'] = (checked == true) ? $('[name="land_with_ext_1_t3"]').val() : '';
			field_arr['fax_with_code_2_t3'] = (checked == true) ? $('[name="fax_with_code_1_t3"]').val() : '';
			field_arr['fax_with_ext_2_t3'] = (checked == true) ? $('[name="fax_with_ext_1_t3"]').val() : '';
			field_arr['mobile_personal_2_t3'] = (checked == true) ? $('[name="mobile_personal_1_t3"]').val() : '';
			field_arr['mobile_personal_ext_2_t3'] = (checked == true) ? $('[name="mobile_personal_ext_1_t3"]').val() : '';
			
			field_arr['mobile_work_2_t3'] = (checked == true) ? $('[name="mobile_work_1_t3"]').val() : '';
			field_arr['mobile_work_ext_2_t3'] = (checked == true) ? $('[name="mobile_work_ext_1_t3"]').val() : '';
			field_arr['email_personal_2_t3'] = (checked == true) ? $('[name="email_personal_1_t3"]').val() : '';
			field_arr['email_work_2_t3'] = (checked == true) ? $('[name="email_work_1_t3"]').val() : '';
			field_arr['website_2_t3'] = (checked == true) ? $('[name="website_1_t3"]').val() : '';
			field_arr['notes_2_t3'] = (checked == true) ? $('[name="notes_1_t3"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t3"]').trigger('change');
			$('[name="land_with_ext_2_t3"]').trigger('change');
			$('[name="fax_with_ext_2_t3"]').trigger('change');
			$('[name="mobile_personal_ext_2_t3"]').trigger('change');
			$('[name="mobile_work_ext_2_t3"]').trigger('change');
			
		}
		else if(_name == 'same_as_applicant_2_t4') {
			field_arr['name_2_t4'] = (checked == true) ? $('[name="name_1_t4"]').val() : '';
			field_arr['nationality_2_t4'] = (checked == true) ? $('[name="nationality_1_t4"]').val() : '';
			field_arr['id_number_2_t4'] = (checked == true) ? $('[name="id_number_1_t4"]').val() : '';
			field_arr['place_of_res_2_t4'] = (checked == true) ? $('[name="place_of_res_1_t4"]').val() : '';
			field_arr['passport_number_2_t4'] = (checked == true) ? $('[name="passport_number_1_t4"]').val() : '';
			field_arr['actual_place_of_res_2_t4'] = (checked == true) ? $('[name="actual_place_of_res_1_t4"]').val() : '';
			field_arr['land_with_code_2_t4'] = (checked == true) ? $('[name="land_with_code_1_t4"]').val() : '';
			field_arr['land_with_ext_2_t4'] = (checked == true) ? $('[name="land_with_ext_1_t4"]').val() : '';
			field_arr['fax_with_code_2_t4'] = (checked == true) ? $('[name="fax_with_code_1_t4"]').val() : '';
			// field_arr['fax_with_code_2_t4'] = (checked == true) ? $('[name="fax_with_code_1_t4"]').val() : '';
			field_arr['mobile_personal_2_t4'] = (checked == true) ? $('[name="mobile_personal_1_t4"]').val() : '';
			field_arr['mobile_personal_ext_2_t4'] = (checked == true) ? $('[name="mobile_personal_ext_1_t4"]').val() : '';
			field_arr['mobile_work_2_t4'] = (checked == true) ? $('[name="mobile_work_1_t4"]').val() : '';
			field_arr['mobile_work_ext_2_t4'] = (checked == true) ? $('[name="mobile_work_ext_1_t4"]').val() : '';
			
			field_arr['email_personal_2_t4'] = (checked == true) ? $('[name="email_personal_1_t4"]').val() : '';
			field_arr['email_work_2_t4'] = (checked == true) ? $('[name="email_work_1_t4"]').val() : '';
			field_arr['website_2_t4'] = (checked == true) ? $('[name="website_1_t4"]').val() : '';
			field_arr['notes_2_t4'] = (checked == true) ? $('[name="notes_1_t4"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t4"]').trigger('change');
			$('[name="land_with_ext_2_t4"]').trigger('change');
			$('[name="mobile_personal_ext_2_t4"]').trigger('change');
			$('[name="mobile_work_ext_2_t4"]').trigger('change');
			
		}
		else if(_name == 'same_as_applicant_2_t5') {
			field_arr['name_2_t5'] = (checked == true) ? $('[name="name_1_t5"]').val() : '';
			field_arr['nationality_2_t5'] = (checked == true) ? $('[name="nationality_1_t5"]').val() : '';
			field_arr['id_number_2_t5'] = (checked == true) ? $('[name="id_number_1_t5"]').val() : '';
			field_arr['place_of_res_2_t5'] = (checked == true) ? $('[name="place_of_res_1_t5"]').val() : '';
			field_arr['passport_number_2_t5'] = (checked == true) ? $('[name="passport_number_1_t5"]').val() : '';
			field_arr['actual_place_of_res_2_t5'] = (checked == true) ? $('[name="actual_place_of_res_1_t5"]').val() : '';
			field_arr['land_with_code_2_t5'] = (checked == true) ? $('[name="land_with_code_1_t5"]').val() : '';
			field_arr['fax_with_code_2_t5'] = (checked == true) ? $('[name="fax_with_code_1_t5"]').val() : '';
			field_arr['mobile_personal_2_t5'] = (checked == true) ? $('[name="mobile_personal_1_t5"]').val() : '';
			field_arr['mobile_work_2_t5'] = (checked == true) ? $('[name="mobile_work_1_t5"]').val() : '';
			field_arr['email_personal_2_t5'] = (checked == true) ? $('[name="email_personal_1_t5"]').val() : '';
			field_arr['email_work_2_t5'] = (checked == true) ? $('[name="email_work_1_t5"]').val() : '';
			field_arr['website_2_t5'] = (checked == true) ? $('[name="website_1_t5"]').val() : '';
			field_arr['notes_2_t5'] = (checked == true) ? $('[name="notes_1_t5"]').val() : '';

			field_arr['land_with_code_ext_2_t5'] = (checked == true) ? $('[name="land_with_code_ext_1_t5"]').val() : '';
			field_arr['fax_with_code_ext_2_t5'] = (checked == true) ? $('[name="fax_with_code_ext_1_t5"]').val() : '';
			field_arr['mobile_personal_ext_2_t5'] = (checked == true) ? $('[name="mobile_personal_ext_1_t5"]').val() : '';
			field_arr['mobile_work_ext_2_t5'] = (checked == true) ? $('[name="mobile_work_ext_1_t5"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t5"]').trigger('change');
			$('[name="land_with_code_ext_2_t5"]').trigger('change');
			$('[name="fax_with_code_ext_2_t5"]').trigger('change');
			$('[name="mobile_personal_ext_2_t5"]').trigger('change');
			$('[name="mobile_work_ext_2_t5"]').trigger('change');
			
		}
		else if(_name == 'same_as_applicant_2_t6') {
			field_arr['name_2_t6'] = (checked == true) ? $('[name="name_1_t6"]').val() : '';
			field_arr['nationality_2_t6'] = (checked == true) ? $('[name="nationality_1_t6"]').val() : '';
			field_arr['id_number_2_t6'] = (checked == true) ? $('[name="id_number_1_t6"]').val() : '';
			field_arr['place_of_res_2_t6'] = (checked == true) ? $('[name="place_of_res_1_t6"]').val() : '';
			field_arr['passport_number_2_t6'] = (checked == true) ? $('[name="passport_number_1_t6"]').val() : '';
			field_arr['actual_place_of_res_2_t6'] = (checked == true) ? $('[name="actual_place_of_res_1_t6"]').val() : '';
			field_arr['land_with_code_2_t6'] = (checked == true) ? $('[name="land_with_code_1_t6"]').val() : '';
			field_arr['land_with_code_ext_2_t6'] = (checked == true) ? $('[name="land_with_code_ext_1_t6"]').val() : '';
			field_arr['fax_with_code_2_t6'] = (checked == true) ? $('[name="fax_with_code_1_t6"]').val() : '';
			field_arr['fax_with_code_ext_2_t6'] = (checked == true) ? $('[name="fax_with_code_ext_1_t6"]').val() : '';
			field_arr['mobile_personal_2_t6'] = (checked == true) ? $('[name="mobile_personal_1_t6"]').val() : '';
			field_arr['mobile_personal_ext_2_t6'] = (checked == true) ? $('[name="mobile_personal_ext_1_t6"]').val() : '';
			field_arr['mobile_work_2_t6'] = (checked == true) ? $('[name="mobile_work_1_t6"]').val() : '';
			field_arr['mobile_work_ext_2_t6'] = (checked == true) ? $('[name="mobile_work_ext_1_t6"]').val() : '';
			field_arr['email_personal_2_t6'] = (checked == true) ? $('[name="email_personal_1_t6"]').val() : '';
			field_arr['email_work_2_t6'] = (checked == true) ? $('[name="email_work_1_t6"]').val() : '';
			field_arr['website_2_t6'] = (checked == true) ? $('[name="website_1_t6"]').val() : '';
			field_arr['notes_2_t6'] = (checked == true) ? $('[name="notes_1_t6"]').val() : '';
			
			$.each(field_arr, function(i, v) {
				$('[name="'+i+'"]').val(v);
			});
			$('[name="nationality_2_t6"]').trigger('change');
			$('[name="land_with_code_ext_2_t6"]').trigger('change');
			$('[name="fax_with_code_ext_2_t6"]').trigger('change');
			$('[name="mobile_personal_ext_2_t6"]').trigger('change');
			$('[name="mobile_work_ext_2_t6"]').trigger('change');
			
		}
	}

	function accept_terms(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t1"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t1"]').prop('disabled', true);
		}
	}
	function accept_terms_t2(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t2"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t2"]').prop('disabled', true);
		}
	}
	function accept_terms_t3(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t3"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t3"]').prop('disabled', true);
		}
	}
	function accept_terms_t4(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t4"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t4"]').prop('disabled', true);
		}
	}
	function accept_terms_t5(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t5"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t5"]').prop('disabled', true);
		}
	}
	function accept_terms_t6(elem) {
		if($(elem).prop('checked') == true) {
			$('[name="btn_submit_t6"]').prop('disabled', false);
		} else {
			$('[name="btn_submit_t6"]').prop('disabled', true);
		}
	}

	function submit_t1() {
		var formData = new FormData($('#regForm_t1')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
      url: location.href,
      type : 'POST',
      dataType: 'json',
      data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t1.steps("setStep_1", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t1"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t1"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section1_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
						// $('[name="btn_submit_t1"]').prop('disabled', false);
					}
				}
			}
            
    });
	}

	function submit_t2() {
		var formData = new FormData($('#regForm_t2')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
			url: location.href,
			type : 'POST',
			dataType: 'json',
			data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t2.steps("setStep_2", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t2"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t2"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section2_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
						// $('[name="btn_submit_t1"]').prop('disabled', false);

					}
				}
			}

		});
	}

	function submit_t3() {
		var formData = new FormData($('#regForm_t3')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
			url: location.href,
			type : 'POST',
			dataType: 'json',
			data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t3.steps("setStep_3", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t3"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t3"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section3_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
					}
					
					// console.log(res);
					// toastr[res.type](res.text);
					// if(res.type == 'success'){
					//     location.reload();
					// }
					// $('[name="btn_submit_t1"]').prop('disabled', false);
				}
			}

		});
	}

	function submit_t4() {
		var formData = new FormData($('#regForm_t4')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
			url: location.href,
			type : 'POST',
			dataType: 'json',
			data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t4.steps("setStep_4", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t4"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t4"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section4_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
						// $('[name="btn_submit_t1"]').prop('disabled', false);
					}
				}
			}

		});
	}

	function submit_t5() {
		var formData = new FormData($('#regForm_t5')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
			url: location.href,
			type : 'POST',
			dataType: 'json',
			data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t5.steps("setStep_5", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t5"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t5"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section5_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
						// $('[name="btn_submit_t1"]').prop('disabled', false);

					}
				}
			}

		});
	}

	function submit_t6() {
		var formData = new FormData($('#regForm_t6')[0]);
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('name', $('[name="name"]').val());
		formData.append('email', $('[name="email"]').val());
		formData.append('password', $('[name="password"]').val());
		formData.append('cpassword', $('[name="cpassword"]').val());
		formData.append('regtype', $('[name="reg_type"] option:selected').val());
		formData.append('regtype_t', $('[name="reg_type"] option:selected').text());

		$.ajax({
			url: location.href,
			type : 'POST',
			dataType: 'json',
			data : formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						tab_index = ($('[name="'+key+'"]').closest('section').data('tab'))-1;
						verticalWizard_t6.steps("setStep_6", tab_index);
						$('[name="'+key+'"]').addClass('error');
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t6"]').prop('disabled', false);
				},
				500: function (error) {
					console.log(error);
					// $.notify({
					//     title: "500 Internal Server Error : ",
					//     message: error.responseJSON.message,
					//     icon: 'fa fa-ban' 
					// },{
					//     type: "danger"
					// });

					$('[name="btn_submit_t6"]').prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						$('#section6_tab').fadeOut();
						$('#errorDiv').fadeOut();
						$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
						// $('[name="btn_submit_t1"]').prop('disabled', false);
					}
				}
			}

		});
	}


	$('#regForm_t1, #regForm_t2, #regForm_t3, #regForm_t4, #regForm_t5, #regForm_t6').submit(function(){
		return false;
	});

	$.fn.steps.setStep_1 = function (step) {
		var currentIndex = verticalWizard_t1.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t1.steps('next');
			}
			else {
				verticalWizard_t1.steps('previous');
			}
		} 
	};

	$.fn.steps.setStep_2 = function (step) {
		var currentIndex = verticalWizard_t2.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t2.steps('next');
			}
			else {
				verticalWizard_t2.steps('previous');
			}
		} 
	};

	$.fn.steps.setStep_3 = function (step) {
		var currentIndex = verticalWizard_t3.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t3.steps('next');
			}
			else {
				verticalWizard_t3.steps('previous');
			}
		} 
	};

	$.fn.steps.setStep_4 = function (step) {
		var currentIndex = verticalWizard_t4.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t4.steps('next');
			}
			else {
				verticalWizard_t4.steps('previous');
			}
		} 
	};

	$.fn.steps.setStep_5 = function (step) {
		var currentIndex = verticalWizard_t5.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t5.steps('next');
			}
			else {
				verticalWizard_t5.steps('previous');
			}
		} 
	};

	$.fn.steps.setStep_6 = function (step) {
		var currentIndex = verticalWizard_t6.steps('getCurrentIndex');
		for(var i = 0; i < Math.abs(step - currentIndex); i++) {
			if(step > currentIndex) {
				verticalWizard_t6.steps('next');
			}
			else {
				verticalWizard_t6.steps('previous');
			}
		} 
	};
</script>

@endpush