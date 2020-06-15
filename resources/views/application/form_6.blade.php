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

	.blink_me {
		animation: blinker 1.5s linear;


	}

	@keyframes blinker {

		50% {
			color: #fff !important;
			background-color: #eb6f7b;
		}
	}

	h4#blinkDiv.blink_me {
		color: #fff !important;
	}
</style>
@endpush
@section('content')
<div class="bg-image" style="background-image: url({{url('assets/images/background/login-register.jpg')}})">
	<div class="container">
		<div class="form-box">
			<h2 class="text-center text-white mb-3"></h2>

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

			{{-- Section6 Tab (Other entities and individuals) --}}
			<div class="row" id="section6_tab" style="{{($regtype == 'section6') ? "" : "display: none;"}}">
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
										<label for="" class="text-uppercase"><b><i>Step 1-6</i></b></label>
									</div>
									<div class="col-lg-12">
										<label>Full Name<code>*</code></label>
										<div class="form-group">
											<input type="text" name="name_1_t6" class="form-control input-sm"
												value="{{$tab1['name_1_t6']}}">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label>Applicant Status <code>*</code></label>
										<select name="applicant_status_1_t6" id="applicant_status_1_t6"
											class="form-control select2">
											<option value="">Select</option>
											@foreach ($applicant_status as $item)
											<option value="{{$item}}"
												{{($tab1['applicant_status_1_t6'] == $item) ? 'selected' : ''}}>
												{{$item}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID NUMBER (FULL) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_1_t6" class="form-control input-sm"
												value="{{$tab1['id_number_1_t6']}}">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">PASSPORT NUMBER (FOR NON EGYPTIAN) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_1_t6" class="form-control input-sm"
												value="{{$tab1['passport_number_1_t6']}}">
										</div>
									</div>
									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_1_t6" class="form-control input-sm"
												value="{{$tab1['place_of_res_1_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_1_t6"
												class="form-control input-sm"
												value="{{$tab1['actual_place_of_res_1_t6']}}">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Correspondence address <code>*</code></label>
										<div class="form-group">
											<textarea class="form-ccontrol" style="width: 100%;" name="corrs_add_1_t6"
												id="corrs_add_1_t6" cols="5"
												rows="3">{{$tab1['corrs_add_1_t6']}}</textarea>
										</div>
									</div>
									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_1_t6" id="land_with_code_ext_1_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab1['land_with_code_ext_1_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_1_t6"
													class="form-control input-sm"
													value="{{$tab1['land_with_code_1_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_1_t6" id="fax_with_code_ext_1_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab1['fax_with_code_ext_1_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_1_t6"
													class="form-control input-sm"
													value="{{$tab1['fax_with_code_1_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_1_t6"
														id="mobile_personal_ext_1_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab1['mobile_personal_ext_1_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_1_t6"
													class="form-control input-sm"
													value="{{$tab1['mobile_personal_1_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_1_t6" id="mobile_work_ext_1_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab1['mobile_work_ext_1_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_1_t6"
													class="form-control input-sm" value="{{$tab1['mobile_work_1_t6']}}">
											</div>
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_1_t6" class="form-control input-sm"
												value="{{$tab1['email_personal_1_t6']}}">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_1_t6" class="form-control input-sm"
												value="{{$tab1['email_work_1_t6']}}">
										</div>
									</div>


									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_1_t6" class="form-control input-sm"
												value="{{$tab1['website_1_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label>Agency bond number <code>*</code></label>
										<input type="text" name="agency_board_1_t6" class="form-control input-sm"
											value="{{$tab1['agency_board_1_t6']}}">
									</div>

									<div class="col-lg-4 mb-2">
										<label>Documentation Office <code>*</code></label>
										<input type="text" name="doc_office_1_t6" class="form-control input-sm"
											value="{{$tab1['doc_office_1_t6']}}">
									</div>

									<div class="col-lg-4 mb-2">
										<label>REQUEST TYPE <code>*</code></label>
										<select name="reqtype_1_t6" id="reqtype_1_t6" class="form-control select2">
											<option value="">Select</option>
											@foreach ($reqtype as $item)
											<option value="{{$item}}"
												{{($tab1['reqtype_1_t6'] == $item) ? 'selected' : ''}}>{{$item}}
											</option>
											@endforeach
										</select>
									</div>

									<div class="col-lg-4 mb-2">
										<label>NOTES</label>
										<textarea name="notes_1_t6" id="notes_1_t6" cols="30"
											rows="2">{{$tab1['notes_1_t6']}}</textarea>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Save & Next</button>
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
										<label for="" class="text-uppercase"><b><i>Step 2-6</i></b></label>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<!-- Default unchecked -->
											<div class="checkbox">
												<label style="margin-left:30px;"><input type="checkbox"
														name="same_as_applicant_2_t6"
														value="{{($tab2['same_as_applicant_2_t6'] == "y") ? 'y' : ''}}"
														{{($tab2['same_as_applicant_2_t6'] == "y") ? 'checked' : ''}}>Same
													as applicants
													data</label>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Full Name<code>*</code></label>
										<div class="form-group">
											<input type="text" name="name_2_t6" class="form-control input-sm"
												value="{{$tab2['name_2_t6']}}">
										</div>
									</div>
									<div class="col-lg-12">
										<label>NICK NAME (IF AVILABLE)</label>
										<div class="form-group">
											<input type="text" name="nick_name_2_t6" class="form-control input-sm"
												value="{{$tab2['nick_name_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mt-3">
										<label for="">ID number (full) <code>*</code></label>
										<div class="form-group">
											<input type="number" name="id_number_2_t6" class="form-control input-sm"
												value="{{$tab2['id_number_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Passport number (for non-Egyptians) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="passport_number_2_t6" class="form-control input-sm"
												value="{{$tab2['passport_number_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Place of residence IN ID <code>*</code></label>
										<div class="form-group">
											<input type="text" name="place_of_res_2_t6" class="form-control input-sm"
												value="{{$tab2['place_of_res_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4">
										<label for="">Actual place of residence <code>*</code></label>
										<div class="form-group">
											<input type="text" name="actual_place_of_res_2_t6"
												class="form-control input-sm"
												value="{{$tab2['actual_place_of_res_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">LAND LINE (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="land_with_code_ext_2_t6" id="land_with_code_ext_2_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab2['land_with_code_ext_2_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="land_with_code_2_t6"
													class="form-control input-sm"
													value="{{$tab2['land_with_code_2_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">FAX (WITH CODE)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_with_code_ext_2_t6" id="fax_with_code_ext_2_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab2['fax_with_code_ext_2_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_with_code_2_t6"
													class="form-control input-sm"
													value="{{$tab2['fax_with_code_2_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (PERSONAL)</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_personal_ext_2_t6"
														id="mobile_personal_ext_2_t6" class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab2['mobile_personal_ext_2_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_personal_2_t6"
													class="form-control input-sm"
													value="{{$tab2['mobile_personal_2_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE (WORK) <code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_work_ext_2_t6" id="mobile_work_ext_2_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab2['mobile_work_ext_2_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_work_2_t6"
													class="form-control input-sm" value="{{$tab2['mobile_work_2_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (PERSONAL)</label>
										<div class="form-group">
											<input type="email" name="email_personal_2_t6" class="form-control input-sm"
												value="{{$tab2['email_personal_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL (WORK)<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_work_2_t6" class="form-control input-sm"
												value="{{$tab2['email_work_2_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_2_t6" class="form-control input-sm"
												value="{{$tab2['website_2_t6']}}">
										</div>
									</div>


									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Save & Next</button>
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
										<label for="" class="text-uppercase"><b><i>Step 3-6</i></b></label>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (Arabic) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_arabic_3_t6"
												class="form-control input-sm"
												value="{{$tab3['entity_name_arabic_3_t6']}}">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">ENTITY Name (ENGLISH) <code>*</code></label>
										<div class="form-group">
											<input type="text" name="entity_name_english_3_t6"
												class="form-control input-sm"
												value="{{$tab3['entity_name_english_3_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for=""> Membership Number of Diving Tourism <code>*</code></label>
										<div class="form-group">
											<input type="text" name="membership_number_3_t6"
												class="form-control input-sm"
												value="{{$tab3['membership_number_3_t6']}}">
										</div>
									</div>
									<div class="col-lg-4 mb-2">
										<label for="">Commercial Registration No<code>*</code></label>
										<div class="form-group">
											<input type="number" name="commercial_reg_no_3_t6"
												class="form-control input-sm"
												value="{{$tab3['commercial_reg_no_3_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Address of the ENTITY-PERSON<code>*</code></label>
										<div class="form-group">
											<textarea name="address_of_the_entity_3_t6" id="address_of_the_entity_3_t6"
												cols="30" rows="3">{{$tab3['address_of_the_entity_3_t6']}}</textarea>
										</div>
									</div>


									<div class="col-lg-6 mb-2">
										<label for="">Landline number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="landline_no_ext_3_t6" id="landline_no_ext_3_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab3['landline_no_ext_3_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="landline_no_3_t6"
													class="form-control input-sm" value="{{$tab3['landline_no_3_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">Fax Number</label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="fax_no_ext_3_t6" id="fax_no_ext_3_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab3['fax_no_ext_3_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="fax_no_3_t6" class="form-control input-sm"
													value="{{$tab3['fax_no_3_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (1)<code>*</code></label>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no1_ext_3_t6" id="mobile_no1_ext_3_t6"
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab3['mobile_no1_ext_3_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no1_3_t6"
													class="form-control input-sm" value="{{$tab3['mobile_no1_3_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-6 mb-2">
										<label for="">MOBILE NUMBER (2)</label>
										<div class="form-group">mobile_no2_ext_3_t6
											<div class="input-group">
												<div class="input-group-prepend country_ext">
													+<select name="mobile_no2_ext_3_t6" id=""
														class="form-control select2">
														<option value="">Select</option>
														@foreach ($countries as $country)
														<option value="{{$country->phonecode}}"
															{{($tab3['mobile_no2_ext_3_t6'] == $country->phonecode) ? 'selected' : ''}}>
															{{$country->phonecode}} - {{$country->country_name}}
														</option>
														@endforeach
													</select>
												</div>
												<input type="number" name="mobile_no2_3_t6"
													class="form-control input-sm" value="{{$tab3['mobile_no2_3_t6']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">EMAIL<code>*</code></label>
										<div class="form-group">
											<input type="email" name="email_3_t6" class="form-control input-sm"
												value="{{$tab3['email_3_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">WEB SITE</label>
										<div class="form-group">
											<input type="text" name="website_3_t6" class="form-control input-sm"
												value="{{$tab3['website_3_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Activities to be authorized (temporary
											permit)<code>*</code></label>
										<div class="form-group">
											<select name="marine_activity_authorized_3_t6" multiple
												id="marine_activity_authorized_3_t6" onchange="regFees()"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($marine_activity as $item)
												<option value="{{$item->id}}"
													{{(in_array($item->id, explode(',', $tab3['marine_activity_authorized_3_t6']))) ? 'selected' : ''}}>
													{{$item->name}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">The time periods required to carry out the
											activity<code>*</code></label>
										<div class="form-group">
											<input type="text" class="daterange_picker" name="time_period_3_t6"
												class="form-control input-sm" value="{{$tab3['time_period_3_t6']}}">
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">NOTES</label>
										<div class="form-group">
											<textarea name="notes_3_t6" id="notes_3_t6" cols="30" rows="3"
												class="form-control">{{$tab3['notes_3_t6']}}</textarea>
										</div>
									</div>

									<div class="col-lg-4 mb-2">
										<label for="">Unit's area of ​​activity (as per the attached statement and
											maps)<code>*</code></label>
										<div class="form-group">
											<select name="unit_area_of_activity_3_t6" multiple
												id="unit_area_of_activity_3_t6" onchange="regFees()"
												class="form-control select2">
												<option value="">Select</option>
												@foreach ($unit_area_of_activity as $item)
												<option value="{{$item->id}}"
													{{(in_array($item->id, explode(',', $tab3['unit_area_of_activity_3_t6']))) ? 'selected' : ''}}>
													{{$item->name}}</option>
												@endforeach
											</select>
										</div>
									</div>



									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-4">
												<h4 id="blinkDiv" style="padding:5px;">
													<b>Total:</b><span id="totalFees"></span>
													(USD)
												</h4>
											</div>
											<div class="col">
												<button class="btn btn-default float-right ml-2"
													onclick="wiz6_nextbutton(this)">Save & Next</button>
												<button class="btn btn-default float-right"
													onclick="wiz6_prevbutton(this)">Previous</button>
											</div>
										</div>
									</div>
								</div>
							</section>

							<h3>Branches</h3>
							<section data-tab="4">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Branches</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 4-6</i></b></label>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">No. Of Branches<code>*</code></label>
											<div class="form-group">
												<input type="number" class="form-control" name="payment_fees"
													value="{{$tab4['payment_fees']}}">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Save & Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Upload Documents</h3>
							<section data-tab="5">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Upload Documents</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 5-6</i></b></label>
									</div>

									<div class="col-lg-12 content-wrapper" style="align-items: center;">
										@foreach ($upload_doc_name as $key => $item)
										<div class="row align-items-lg-center">
											<div class="col-lg-5">
												<label for="">Document Name{!! ($upload_doc_required[$key] ==
													'required') ? '<code>*</code>' : '' !!}</label>
												<div class="form-group">
													<label for="" name="">{{$item}}</label> ({{$upload_doc_type[$key]}})
													<input type="hidden" name="select_doc_name[]" value="{{$key}}">
												</div>
											</div>
											<div class="col-lg-5">
												@if (array_key_exists($key, $tab5))
												<a href="{{asset($tab5[$key])}}" class="pre_up" target="_blank">Previous
													Uploaded File</a> <button class="removeDoc"
													onclick="removeDoc(this)">🗑</button><br />
												@endif
												<div class="form-group">
													<input type="hidden" name="pre_image[]"
														value="{{array_key_exists($key, $tab5) ? $tab5[$key] : ''}}">
													<input type="file" name="upload_file[]">
												</div>
											</div>
										</div>
										@endforeach
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2"
											onclick="wiz6_nextbutton(this)">Save & Next</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

							<h3>Review Form</h3>
							<section data-tab="6">
								<div class="row">
									<div class="col-lg-8">
										<label for="" class="text-uppercase"><b><i>Review Form</i></b></label>
									</div>
									<div class="col-lg-4 text-right">
										<label for="" class="text-uppercase"><b><i>Step 6-6</i></b></label>
									</div>
									<div class="col-lg-12">

										<div class="row">
											<div class="col-lg-12">
												<label for="" class="text-center"><b><i>Account Info</i></b></label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label for="">Company Name:</label><br />
												<label for="" id="lbl6_name">{{Auth::user()->name}}</label>
											</div>
											<div class="col-md-4">
												<label for="">Email:</label><br />
												<label for="" id="lbl6_email">{{Auth::user()->email}}</label>
											</div>
											<div class="col-md-4">
												<label for="">Password</label><br />
												<label for="" id="lbl6_password"></label>
											</div>
											<div class="col-md-4 d-none">
												<label for="">Regtype</label><br />
												<label for="" id="lbl6_regtype"></label>
											</div>
										</div>

										<div class="col-lg-12" id="wrapper_view_t6">
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>APPLICANT DATA AND
																DESCRIPTION</i></b></label>
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
																	(<label for=""
																		id="lbl_land_with_code_ext_1_t6">563623</label>)
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
																	(<label for=""
																		id="lbl_fax_with_code_ext_1_t6"></label>)
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
																(<label for=""
																	id="lbl_mobile_personal_ext_1_t6"></label>)
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
													<label>Documentation Office <code>*</code></label><br />
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
													<label for="" class="text-center"><b><i>ENTITY OWNER / INDIVIDUAL
																DATA
																(FROM OFFICIAL DOCUMENTS)</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Full Name</label><br />
														<label id="lbl_name_2_t6"></label>
													</div>
													<div class="col-lg-12">
														<label>NICK NAME (IF AVILABLE)</label><br />
														<label for="" id="lbl_nick_name_2_t6"></label>
													</div>
													<div class="col-md-4 mt-3">
														<label for="">ID number (full) <code>*</code></label><br />
														<label for="" id="lbl_id_number_2_t6"></label>
													</div>
													<div class="col-md-4">
														<label for="">Passport number (for non-Egyptians)
															<code>*</code></label><br />
														<label for="" id="lbl_passport_number_2_t6"></label>
													</div>
													<div class="col-md-4">
														<label for="">Place of residence IN ID
															<code>*</code></label><br />
														<label for="" id="lbl_place_of_res_2_t6"></label>
													</div>
													<div class="col-md-4">
														<label for="">Actual place of residence
															<code>*</code></label><br />
														<label for="" id="lbl_actual_place_of_res_2_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<div class="input-group">
															<table>
																<tr>
																	<td>
																		<label>CODE<code>*</code></label><br />
																		(<label for=""
																			id="lbl_land_with_code_ext_2_t6"></label>)
																	</td>
																	<td>
																		<label for="">LAND LINE (WITH
																			CODE)</label><br />
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
																	(<label for=""
																		id="lbl_fax_with_code_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">FAX (WITH CODE)</label><br />
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
																	(<label for=""
																		id="lbl_mobile_personal_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (PERSONAL)</label><br />
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
																	(<label for=""
																		id="lbl_mobile_work_ext_2_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (WORK)
																		<code>*</code></label><br />
																	<label for="" id="lbl_mobile_work_2_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (PERSONAL)</label><br />
														<label id="lbl_email_personal_2_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">EMAIL (WORK)<code>*</code></label><br />
														<label id="lbl_email_work_2_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">WEB SITE</label><br />
														<label for="" id="lbl_website_2_t6"></label>
													</div>


												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="" class="text-center"><b><i>(FROM OFFICIAL DOCUMENTS)
																ENTITY / INDIVIDUAL DATA</i></b></label>
												</div>
												<div class="row">
													<div class="col-md-4 mb-2">
														<label for="">ENTITY Name (Arabic)<code>*</code></label><br />
														<label for="" id="lbl_entity_name_arabic_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">ENTITY Name (ENGLISH)<code>*</code></label><br />
														<label for="" id="lbl_entity_name_english_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for=""> Membership Number of Diving Tourism
															<code>*</code></label><br />
														<label for="" id="lbl_membership_number_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Commercial Registration
															No<code>*</code></label><br />
														<label id="lbl_commercial_reg_no_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<label for="">Address of the
															ENTITY-PERSON<code>*</code></label><br />
														<label for="" id="lbl_address_of_the_entity_3_t6"></label>
													</div>
													<div class="col-md-4 mb-2">
														<table>
															<tr>
																<td>
																	<label>CODE<code>*</code></label><br />
																	(<label for=""
																		id="lbl_landline_no_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE (WORK)
																		<code>*</code></label><br />
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
																	<label for="">FAX NO</label><br />
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
																	(<label for=""
																		id="lbl_mobile_no1_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO1<code>*</code></label><br />
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
																	(<label for=""
																		id="lbl_mobile_no2_ext_3_t6"></label>)
																</td>
																<td>
																	<label for="">MOBILE NO 2</label><br />
																	<label for="" id="lbl_mobile_no2_3_t6"></label>
																</td>
															</tr>
														</table>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">EMAIL</label><br />
														<label for="" id="lbl_email_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">WEB SITE</label><br />
														<label for="" id="lbl_website_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Activities to be authorized (temporary
															permit)</label><br />
														<label for="" id="lbl_marine_activity_authorized_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">The time periods required to carry out the
															activity</label><br />
														<label for="" id="lbl_time_period_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">NOTES</label><br />
														<label for="" id="lbl_notes_3_t6"></label>
													</div>
													<div class="col-lg-4 mb-2">
														<label for="">Unit's area of ​​activity (as per the attached
															statement and maps)</label><br />
														<label for="" id="lbl_unit_area_of_activity_3_t6"></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<label for="" class=""><b><i>Branches</i></b></label>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label for="">No. Of Branches<code>*</code></label><br />
														<label for="" id="lbl_payment_fees"></label>
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
													<label for="" class="text-center"><b><i>Attached
																Documents</i></b></label>
												</div>
												<div class="col-lg-12">
													<div class="row col-wrapper-doc">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<!-- Default unchecked -->
													<div class="checkbox">
														<label style="margin-left:30px;"><input type="checkbox"
																name="accpet_terms_t6" onclick="accept_terms_t6(this)"
																value="">I accept the terms & conditions</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<button class="btn btn-default float-right ml-2" name="btn_submit_t6" disabled
											onclick="submit_t6()">Confirm</button>
										<button class="btn btn-default float-right"
											onclick="wiz6_prevbutton(this)">Previous</button>
									</div>
								</div>
							</section>

						</div>
					</form>
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
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
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
        window.lastSave = true;
        window.manualTrigger = true;
        $last_tab = '{{intval($application->last_tab)}}';
        click_tab_name = '#vertical-wizard_t3-t-'+$last_tab;
        $(click_tab_name).trigger('click');

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
		window.upload_doc_name = JSON.parse('<?php echo json_encode($upload_doc_name); ?>');
		window.upload_doc_type = JSON.parse('<?php echo json_encode($upload_doc_type); ?>');
		window.tab5 = JSON.parse('<?php echo json_encode($tab5); ?>');
		if(window.tab5 != '') {
			var clength = 0;
			var cilength = 0;
			for(var i in tab5){
				clength += 1;
			}
			for(var i in tab5){
				cilength +=1;
				$('.content-wrapper .row:last-child select').val(i).trigger('change');
				$('.content-wrapper .row:last-child input[name="pre_image[]"]').val(tab5[i]);
				link = "/"+tab5[i];
				$('.content-wrapper .row:last-child a.pre_up').attr('href', "{{url('/')}}"+link).removeClass('d-none');
				if(cilength < clength) {
					$('.content-wrapper .row:last-child button').trigger('click');
				}
			}
			// $(window.tab5).each(function(i, v) {
			// 	console.log(i);
			// })
		}
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
				cNumber: true
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

	window.changeNext = false;
	var verticalWizard_t6 = $("#vertical-wizard_t6").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		stepsOrientation: "vertical",
        enablePagination: false,
        enableAllSteps: true,
		onStepChanging: function (event, currentIndex, newIndex) {
			$('#errorDiv, #successDiv').fadeOut();
			var $valid = $("#regForm_t6").valid();
			if(!$valid) {
				$validator_t6.focusInvalid();
				return false;
			}


			if(currentIndex == 0) {
				if($('[name="id_number_1_t6"]').val() == '' && $('[name="passport_number_1_t6"]').val() == '') {
					toastr['error']('Please fill atleast one of the two fields ID number or Passport number');
					$('[name="id_number_1_t6"], [name="passport_number_1_t6"]').focus();
					return false;
				}
			} else if (currentIndex == 1) {
				if($('[name="id_number_2_t6"]').val() == '' && $('[name="passport_number_2_t6"]').val() == '') {
					toastr['error']('Please fill atleast one of the two fields ID number or Passport number');
					$('[name="id_number_2_t6"], [name="passport_number_2_t6"]').focus();
					return false;
				}
			}

			if(window.changeNext == true) {
				return true;
			}


            if(manualTrigger == false) {
				currentIndexVal = currentIndex;
				// if(currentIndexVal == 3) {
				// 	currentIndexVal++;
				// }
				save_tab1_t6(currentIndex+1);
			} else {
				return true;
			}
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			// $('.vertical-wizard ul[role="tablist"] li').each(function(i, v) {
			// 	if(i != currentIndex) {
			// 		$(v).removeClass('done');
			// 		$(v).prop('aria-disabled', true);
			// 		$(v).removeAttr('aria-selected');
			// 		$(v).addClass('disabled');
			// 	}
			// })
			if(currentIndex == 1) {
				same_as_applicant_change('same_as_applicant_2_t6');
			}

			if(currentIndex == 5) {
				// $('#lbl6_name').text($('[name="name"]').val());
				// $('#lbl6_email').text($('[name="email"]').val());
				$('#lbl6_password').text('xxxxxxxxx');
				// $('#lbl6_regtype').text($('[name="reg_type"] option:selected').text());


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
				$('#lbl_payment_fees').text($('[name="payment_fees"]').val());

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

				t1_json_data();
			}
			// console.log($('ul[role="tablist"] li').index(priorIndex))
		},
		onTabClick: function(tab,navigation,index){
            manualTrigger = true;
			return false;
		},
	});

	function wiz6_nextbutton(elem) {
		$('form').submit(function() {
			return false;
		});
		window._button = $(elem);
        window.changeNext = false;
        manualTrigger = false;
		verticalWizard_t6.steps("next");
	}

	function save_tab1_t6(tab_index) {
		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', "{{ $application->application_no }}");
		section = $(window._button).closest('section');
		nameArr = $(section).find('input');
		$(nameArr).each(function(i, element) {
			name = $(element).attr('name');
			if(name == 'same_as_applicant_2_t6') {
				if($("input[name='same_as_applicant_2_t6']").is(':checked')) {
					formData.append('same_as_applicant_2_t6', "y");
				} else {
					formData.append('same_as_applicant_2_t6', "");
				}
			} else {
				formData.append($(element).attr('name'), $(element).val());
			}

		});
		textareaArr = $(section).find('textarea');
		$(textareaArr).each(function(i, element) {
			formData.append($(element).attr('name'), $(element).val());
		});
		selectArr = $(section).find('select');
		$(selectArr).each(function(i, element) {
			formData.append($(element).attr('name'), $(element).val());
		});

		formData.delete('upload_file[]');
		// Read selected files
		var totalfiles = $('input[name="upload_file[]"]');
		for (var index = 0; index < totalfiles.length; index++) {
			if(typeof totalfiles[index].files[0] != 'undefined')
				formData.append("upload_file_"+index, totalfiles[index].files[0]);
			else
				formData.append("upload_file_"+index, "");
		}

		$.ajax({
			url: "{{url('application')}}/tab6_t"+tab_index,
			// url: "{{url('application')}}/tab2_t5",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				413: function(errors) {
					var html = 'File size id too large, Limit to 10MB';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t6"]').prop('disabled', false);
				},

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
					$(window._button).prop('disabled', false);
					window.changeNext = false;
				},
				500: function (error) {
					console.log(error);
					window.changeNext = false;

					var html = '';
					html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >Oops! some error occured</div></div>';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);

					$(window._button).prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						toastr[res.type](res.text);
						window.changeNext = true;
						verticalWizard_t6.steps("next");
					}
				}
			}
		});
	}

	function wiz6_prevbutton(elem) {
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

	function submit_t6() {
		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', "{{ $application->application_no }}");

		$.ajax({
			url: "{{url('application')}}/confirm_tab6",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				413: function(errors) {
					var html = 'File size id too large, Limit to 10MB';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t6"]').prop('disabled', false);
				},
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
					$(window._button).prop('disabled', false);
					window.changeNext = false;
				},
				500: function (error) {
					console.log(error);
					window.changeNext = false;

					var html = '';
					html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >Oops! some error occured</div></div>';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);


					$(window._button).prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						toastr[res.type](res.text);
						window.changeNext = true;
						// verticalWizard_t3.steps("next");
						window.location.href="{{url('/dashboard')}}";

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



	function removeRow(elem) {
		if(confirm("Are you sure want to delete?")) {
			var _this = $(elem);
			var row = $(elem).closest('.row');
			$(row).remove();
		}
	}

	function addRow(elem) {
		var _this = $(elem);
		var content_wrapper = $(elem).closest('.content-wrapper');

		var row = '';
		row += `<div class="row align-items-lg-center">
					<div class="col-lg-5">
						<label for="">Document Name<code>*</code></label>
						<div class="form-group">
							<select class="form-control select2" name="select_doc_name[]" onchange="doc_name_change(this)">
								<option value="">Select</option>`;
								@foreach ($upload_doc_name as $key => $item)
								row +=`<option value="{{$key}}">{{$item}}</option>`;
								@endforeach
							row += `</select>
						</div>
					</div>
					<div class="col-lg-5">
						<label for="">Upload File <span></span> <code>*</code></label><br/>
						<a href="" class="pre_up d-none" target="_blank">Previous Uploaded File</a><br/>
						<div class="form-group">
							<input type="hidden" name="pre_image[]">
							<input type="file" name="upload_file[]">
						</div>
					</div>
					<div class="col-lg-2">
						<button class="btn btn-success" onclick="addRow(this)">+</button>
					</div>
				</div>`;
		$(content_wrapper).find('.row:last-child button').html('<i class="fa fa-trash"></i>');
		$(content_wrapper).find('.row:last-child button').removeClass('btn-success');
		$(content_wrapper).find('.row:last-child button').attr('onclick', 'removeRow(this)');
		$(content_wrapper).append(row);
		$(content_wrapper).find('.row:last-child select').select2();
	}

	function doc_name_change(elem) {
		var row = $(elem).closest('.row');
		val = $(elem).find('option:selected').val();
		uptype = window.upload_doc_type[val];
		$(row).find('.col-lg-5:nth-child(2) span').html(`(${window.upload_doc_type[val]})`);
	}

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
					$('#lbl_payment_fees').text(data.no_of_branches);
					for(var i in data.upload_doc) {
						// console.log(i, data.upload_doc[i], doc_list[i]);
						$('.col-wrapper-doc').append(`<div class="col-lg-6">
																<label for="">${doc_list[i]}</label><br/>
																<a href="{{url('/')}}/${data.upload_doc[i]}" target="_blank">Uploaded File</a>
															</div>
													 </div>`);
					}

					$('#lbl_marine_activity_authorized_3_t6').html(data.center_data.marine_activity_authorized_3_t6);
					$('#lbl_unit_area_of_activity_3_t6').html(data.center_data.unit_area_of_activity_3_t6);
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

    function removeDoc(elem) {
		if(!confirm('Are you sure want to delete?')) {
			return false;
		}
		var formData = new FormData();

		doc_name = $(elem).closest('.row').find('[name="select_doc_name[]"]').val();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', "{{ $application->application_no }}");
		formData.append('docname', doc_name);

		$.ajax({
			url: "{{url('application')}}/remove_doc",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			statusCode: {
				413: function(errors) {
					var html = 'File size id too large, Limit to 10MB';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);
					$('[name="btn_submit_t6"]').prop('disabled', false);
				},
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
					$(window._button).prop('disabled', false);
					window.changeNext = false;
				},
				500: function (error) {
					console.log(error);
					window.changeNext = false;

					var html = '';
					html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >Oops! some error occured</div></div>';
					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
					$("html, body").animate({ scrollTop: 0 }, 600);


					$(window._button).prop('disabled', false);
				},
				200: function (res) {
					if(res.text) {
						toastr[res.type](res.text);
						location.reload();
						// window.changeNext = true;
						// verticalWizard_t3.steps("next");
					}
				}
			}
		});
	}

	$(document).ready(function() {
		$("input[type='number']").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$(".errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
		regFees();
	});

	function regFees($entitySum = 0) {
		$.LoadingOverlay("show");

		let activityId = [];
		let protectedAreaId = [];
		$('#marine_activity_authorized_3_t6 option').each(function() {
			if ($(this).is(':selected')) {
				activityId.push($(this).val());
			}
		});
		$('#unit_area_of_activity_3_t6 option').each(function() {
			if ($(this).is(':selected')) {
				protectedAreaId.push($(this).val());
			}
		});

		var formData = new FormData();
		formData.append('_token', "{{ csrf_token() }}");
		formData.append('application_no', "{{ $application->application_no }}");
		formData.append("entitySum", $entitySum);
		formData.append("activityId", activityId);
		formData.append("frm_type", 6);
		formData.append("protectedAreaId", protectedAreaId);

		$.ajax({
			url: '{{route("application.formRegFees", ["application_no" =>$application->application_no])}}',
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
						html +=value;
					});

					toastr["error"](html);
					$.LoadingOverlay("hide");

				},
				500: function (error) {
					$.LoadingOverlay("hide");
					
				},
				200: function (res) {
					$('#totalFees, #lbl_reg_fees').text(res.payment_fees);
					$.LoadingOverlay("hide");

					$('#blinkDiv').addClass('blink_me');
					timeout = setTimeout(()=> {
						if($('#blinkDiv').hasClass('blink_me')) {
							$('#blinkDiv').removeClass('blink_me');
						}
					},1501)

				}
			}

		});



	}

	
</script>

@endpush