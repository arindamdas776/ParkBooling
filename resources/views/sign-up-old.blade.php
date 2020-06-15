@extends('common.layout')
@section('title',__('SIGN UP'))
@push('styles')
<link href="{{ asset('assets/css/blue.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
@endpush
@section('content')
<div class="bg-image" style="background-image:url(assets/images/background/login-register.jpg);">
	<div class="container">
		<div class="form-box">
			<h2 class="text-center text-white mb-3">SIGN UP</h2>
			<div class="row">
				<div class="col-md-12">
					<div class="form-wizard">
						<form action="http://b4going.com/sites/booking" id="BookingFrom" role="form" method="post" accept-charset="utf-8">
							<div class="main-border">
								<div class="form-wizard-steps form-wizard-tolal-steps-7">
									<div class="row">
										<div class="col-md-4">
											<div class="form-wizard-progress">
												<div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
											</div>
											<div class="form-wizard-step active">
												<div class="form-wizard-step-icon"><i class="far fa-handshake"></i></div>
												<p>Registration Form</p>
											</div>
											<div class="form-wizard-step">
												<div class="form-wizard-step-icon"><i class="far fa-building"></i></div>
												<p>Review Form</p>
											</div>
										</div>
										<div class="col-md-8">
											<fieldset>
												<h4>Registration <span>Step 1 - 2</span></h4>
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
															<select name="reg_type" class="form-control" onchange="getFields(this)">
																<option value="">Select</option>
																<option value="value1">Value 1</option>
																<option value="value2">Value 2</option>
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
								</div>
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