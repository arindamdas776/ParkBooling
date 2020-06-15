@extends('common.backend.layout')
@section('title',__('Review Form'))
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
				<h3 class="text-white">Review Form</h3>
				<ol class="breadcrumb ">
					<li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
					<li class="breadcrumb-item active text-white">Review Form</li>
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
												<b><label for="" class="text-center fw-600"><i>Account
															Info</i></label></b>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="">Company Name:</label>
													<label for="" id="lbl_name"
														class="info">{{$userInfo->name}}</label><br />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="">Email:</label>
													<label for="" id="lbl_email"
														class="info">{{$userInfo->email}}</label>
												</div>
											</div>

											<div class="col-lg-12" id="wrapper_view_t5">
												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>APPLICANT DATA AND
																	DESCRIPTION</i></b></label>
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
																	(<label for=""
																		id="lbl_land_with_code_ext_1_t5"></label>)
																</td>
																<td>
																	<label>LAND LINE (WITH
																		CODE)<code>*</code></label><br />
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
																	(<label for=""
																		id="lbl_fax_with_code_ext_1_t5"></label>)
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
																	(<label for=""
																		id="lbl_mobile_personal_ext_1_t5"></label>)
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
																	(<label for=""
																		id="lbl_mobile_work_ext_1_t5"></label>)
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
														<label>Documentation Office <code>*</code></label><br />
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
														<label for="" class="text-center"><b><i>ENTITY OWNER /
																	INDIVIDUAL DATA
																	(FROM OFFICIAL DOCUMENTS)</i></b></label>
													</div>
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-12">
																<label>Full Name</label><br />
																<label id="lbl_name_2_t5"></label>
															</div>
															<div class="col-lg-12">
																<label>NICK NAME (IF AVILABLE)</label><br />
																<label for="" id="lbl_nick_name_2_t5"></label>
															</div>
															<div class="col-md-4 mt-3">
																<label for="">ID number (full)
																	<code>*</code></label><br />
																<label for="" id="lbl_id_number_2_t5"></label>
															</div>
															<div class="col-md-4">
																<label for="">Passport number (for non-Egyptians)
																	<code>*</code></label><br />
																<label for="" id="lbl_passport_number_2_t5"></label>
															</div>
															<div class="col-md-4">
																<label for="">Place of residence IN ID
																	<code>*</code></label><br />
																<label for="" id="lbl_place_of_res_2_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">Actual place of residence</label><br />
																<label id="lbl_actual_place_of_res_2_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<table>
																	<tr>
																		<td>
																			<label>CODE<code>*</code></label><br />
																			(<label for=""
																				id="lbl_land_with_code_ext_2_t5"></label>)
																		</td>
																		<td>
																			<label for="">LAND LINE (WITH
																				CODE)</label><br />
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
																			(<label for=""
																				id="lbl_fax_with_code_ext_2_t5"></label>)
																		</td>
																		<td>
																			<label for="">FAX (WITH CODE)</label><br />
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
																			(<label for=""
																				id="lbl_mobile_personal_ext_2_t5"></label>)
																		</td>
																		<td>
																			<label for="">MOBILE
																				(PERSONAL)</label><br />
																			<label
																				id="lbl_mobile_personal_2_t5"></label>
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
																				id="lbl_mobile_work_ext_2_t5"></label>)
																		</td>
																		<td>
																			<label for="">MOBILE (WORK)
																				<code>*</code></label><br />
																			<label for=""
																				id="lbl_mobile_work_2_t5"></label>
																		</td>
																	</tr>
																</table>
															</div>

															<div class="col-md-4 mb-2">
																<label for="">EMAIL (PERSONAL)</label><br />
																<label id="lbl_email_personal_2_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">EMAIL (WORK)<code>*</code></label><br />
																<label id="lbl_email_work_2_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">WEB SITE</label><br />
																<label for="" id="lbl_website_2_t5"></label>
															</div>


														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label for="" class="text-center"><b><i>(FROM OFFICIAL
																	DOCUMENTS) ENTITY / INDIVIDUAL DATA</i></b></label>
													</div>
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-4 mb-2">

																<label for="">ENTITY Name (Arabic)
																	<code>*</code></label><br />
																<label for="" id="lbl_entity_name_arabic_3_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">ENTITY Name (ENGLISH)
																	<code>*</code></label><br />
																<label for="" id="lbl_entity_name_english_3_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for=""> Membership Number of Diving Tourism
																	<code>*</code></label><br />
																<label for="" id="lbl_membership_number_3_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">Commercial Registration
																	No<code>*</code></label><br />
																<label id="lbl_commercial_reg_no_3_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<label for="">Address of the
																	ENTITY<code>*</code></label><br />
																<label for=""
																	id="lbl_address_of_the_entity_3_t5"></label>
															</div>
															<div class="col-md-4 mb-2">
																<table>
																	<tr>
																		<td>
																			<label>CODE<code>*</code></label><br />
																			(<label for=""
																				id="lbl_landline_no_ext_3_t5"></label>)
																		</td>
																		<td>
																			<label for="">Landline number</label><br />
																			<label for=""
																				id="lbl_landline_no_3_t5"></label>
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
																				id="lbl_fax_no_3_ext_t5"></label>)
																		</td>
																		<td>
																			<label for="">FAX NO</label><br />
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
																			(<label for=""
																				id="lbl_mobile_no1_ext_3_t5"></label>)
																		</td>
																		<td>
																			<label for="">MOBILE
																				NO1<code>*</code></label><br />
																			<label for=""
																				id="lbl_mobile_no1_3_t5"></label>
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
																				id="lbl_mobile_no2_ext_3_t5"></label>)
																		</td>
																		<td>
																			<label for="">MOBILE NO 2</label><br />
																			<label for=""
																				id="lbl_mobile_no2_3_t5"></label>
																		</td>
																	</tr>
																</table>

															</div>
															<div class="col-lg-4 mb-2">
																<label for="">EMAIL</label><br />
																<label for="" id="lbl_email_3_t5"></label>
															</div>
															<div class="col-lg-4 mb-2">
																<label for="">WEB SITE</label><br />
																<label for="" id="lbl_website_3_t5"></label>
															</div>
															<div class="col-lg-4 mb-2">
																<label for="">Marine activities to be
																	authorized</label><br />
																<label for=""
																	id="lbl_marine_activity_authorized_3_t5"></label>
															</div>
															<div class="col-lg-4 mb-2">
																<label for="">Unit's area of ​​activity (as per the
																	attached statement and maps)</label><br />
																<label for=""
																	id="lbl_unit_area_of_activity_3_t5"></label>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 text-center">
														<label for="" class=""><b><i>BRANCHES</i></b></label><br />
													</div>
													<div class="col-md-12">
														<div class="row">
															<div class="col-lg-12">
																<label for="">No. Of
																	Branches<code>*</code></label><br />
																<label for="" id="lbl_payment_fees"></label>
															</div>
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
												<div class="row d-none">
													<div class="col-lg-12">
														<!-- Default unchecked -->
														<div class="checkbox">
															<label style="margin-left:30px;"><input type="checkbox"
																	name="accpet_terms_t5"
																	onclick="accept_terms_t5(this)" value="">I accept
																the terms & conditions</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									@if ($application->status == 'review' && $group->name == 'Employee')
									<div class="col-lg-12 text-right">
										<button class="btn btn-default btn-danger"
											onclick="reject(this)">Reject</button>&nbsp;&nbsp;
										<button class="btn btn-default btn-primary"
											onclick="approve(this)">Approve</button>
									</div>
									@endif

									@if (($application->status == 'fapprove' && $application->ceo_status == 'review') &&
									$group->name == 'CEO')
									<div class="col-lg-12 text-right">
										<button class="btn btn-default btn-danger"
											onclick="reject(this, 'lreject')">Reject</button>&nbsp;&nbsp;
										<button class="btn btn-default btn-primary"
											onclick="approve(this, 'lapprove')">Approve</button>
									</div>
									@endif
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
				const {data, no_of_branches} = res.application;
				const {doc_list} = res;
				if(data) {
					$('.col-wrapper-doc').html('');
					$('#lbl_payment_fees').html(no_of_branches);
					
					for(var i in data.upload_doc) {
						// console.log(i, data.upload_doc[i], doc_list[i]);
						$('.col-wrapper-doc').append(`<div class="col-lg-6">
																<label for="">${doc_list[i]}</label><br/>
																<a href="{{url('/')}}/${data.upload_doc[i]}" target="_blank">Uploaded File</a>
															</div>
													 </div>`);
					}
					$('#lbl_marine_activity_authorized_3_t5').html(data.center_data.marine_activity_authorized_3_t5);
					$('#lbl_unit_area_of_activity_3_t5').html(data.center_data.unit_area_of_activity_3_t5);
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

	$(function(){
		$.ajax({
			url: '{{route("application.formRegFees", ["application_no" =>$application->application_no])}}',
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

</script>
@endpush