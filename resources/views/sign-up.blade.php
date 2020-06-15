@extends('common.layout')
@section('title',__('SIGN UP'))
@push('styles')
<link href="{{ asset('assets/css/blue.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" crossorigin="anonymous" />
<style>
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		margin: 0;
	}
	label {
		color: #000;
	}

	label.error {
		color: #ff006a;
	}
	.select2 {
		display: block;
		width: 100%;
	}
	.info-warpper {
		background: #fff;
		width: 500px;
		padding: 30px;
		margin: 0 auto;
	}
</style>
@endpush
@section('content')
<div class="bg-image" style="background-image: url({{url('assets/images/background/diver.jpg')}})">
	<div class="container">
		<div class="form-box">
			<div class="row">
				<div class="col-lg-12">
					<div class="info-warpper" style="display: none;">
                    <h3 class="text-center">{{__('Registration Successfull')}}</h3>
						<p class="text-center">
							{{__('Please check the email to complete registration process and activate the account.')}}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action="{{route('sign-up')}}" id="SignUpForm" method="POST">
						@csrf
						<div class="row justify-content-md-center" id="signup_section">
							<div class="col-md-7 p-5" style="border: 1px solid #ccc; background: rgba(255,255,255,0.9);border-radius: 5px;">
								<div class="row mb-5">
									<div class="col-md-12 text-center mb-5">
                                    <h2 for="">{{__('Registration')}}</h2>
									</div>

									<div class="col-md-12">
										<div id="errorDiv"></div>
									</div>
									<div class="col-md-12">
										<div id="successDiv"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label for="name">{{__('Company Name')}}</label>
											<input type="text" name="name" class="form-control input-sm" placeholder="{{__('Company Name')}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
											<input type="email" name="email" class="form-control input-sm" placeholder="{{__('Email')}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label for="password">{{__('Password')}}</label>
											<input type="password" name="password" class="form-control input-sm"
												placeholder="{{__('Password')}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label for="cpassword">{{__('Confirm Password')}}</label>
											<input type="password" name="cpassword" class="form-control input-sm"
												placeholder="{{__('Confirm Password')}}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
                                        <label for="">{{__('Registration Type')}}</label>
											<select name="reg_type" class="form-control select2">
                                            <option value="">{{__('Select')}}</option>
                                            <option value="section1">{{__('Marine units')}}</option>
                                            <option value="section2">{{__('Dive centers')}}</option>
                                            <option value="section3">{{__('Marine activity centers')}}</option>
                                            <option value="section4">{{__('Tourist companies a')}}</option>
                                            <option value="section5">{{__('Other entities and individuals')}}</option>
                                            <option value="section6">{{__('Temporary activities (individual entities)')}}</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										@php
											$rand1 = mt_rand(1, 9);
											$rand2 = mt_rand(1, 9);
											$sum = $rand1 + $rand2;
										@endphp
										<div class="form-group col-md-8">
                                        <label for="captcha">{{__('Enter text displayed above')}}</label><br/>
											<div class="captcha" style="width: 130%;">
											  <span></span>
											  <button type="button" class="btn btn-success" id="refresh">⟳</button>
										   </div>
									   </div>
										{{-- <div class="form-group">
											<label for="captcha">Enter the sum of the nos</label><br/>
											<label style="font-size: 24px; color: #000;" for="">{{$rand1}} + {{$rand2}} = </label>
										</div> --}}
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="captcha"> </label><br/>
											<input type="text" name="captcha" class="form-control input-sm"
                                        placeholder="{{__('Captcha Value')}}" autocomplete="off">
											<input type="hidden" name="captcha_val" value="{{$sum}}" class="form-control input-sm">
										</div>
									</div>
									<div class="col-md-12">
                                    <button style="color: #fff;" class=" btn btn-sm btn-default float-right btn-block btn-lg mt-3">{{__('Sign Up')}}</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection

	@push('scripts')
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
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

		$(function() {
			$('.select2').select2();
			$('#refresh').trigger('click');
		});

		function save(){
			window.location.href="http://sites.mobotics.in/eeaa/thank-you";
		}

		var $validator_t1 = $("#SignUpForm").validate({
			rules: {
				// Sign Up form
				name: {
					required: true,
				},
				email: {
					required: true,
					email: true
				},
				password: {
					required: true
				},
				cpassword: {
					required: true
				},
				captcha: {
					required: true
				},
				reg_type: {
					required: true
				}
			}
		});

		$('#SignUpForm').submit(function(e){
			var $valid = $("#SignUpForm").valid();
				if(!$valid) {
					$validator_t1.focusInvalid();
					return false;
				}

			return true;
		});


		$('#SignUpForm').ajaxForm({
			dataType:'json',
			beforeSubmit: function(formData, jqForm, options) {
				formData.push({name: 'regtype_text', value: $('[name="reg_type"]').find('option:selected').text()})
			},
			statusCode: {
				422: function(errors) {
					var html = '';

					$.each(errors.responseJSON.errors.validation_error, function(key,value){
						if(value == 'validation.captcha') {
							$('#refresh').trigger('click');
							value = 'Captcha Mismatched';
						}
						html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
					});

					$('#errorDiv').html(html);
					$('#errorDiv').fadeIn();
					$('#successDiv').fadeOut();
				},
				500: function (error) {
					console.log(error);
					$('[name="btn_submit_t5"]').prop('disabled', false);
				},
				200: function (res) {
					toastr['success'](res.text);
					$('#SignUpForm').fadeOut();
					$('.info-warpper').fadeIn();
					// if(res.text) {
					// 	$('#section5_tab').fadeOut();
					// 	$('#errorDiv').fadeOut();
					// 	$('#successDiv').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+res.text+'</div></div>');
					// 	// $('[name="btn_submit_t1"]').prop('disabled', false);

					// }
				}
			}
		});
	</script>
	<script type="text/javascript">
		$('#refresh').click(function(){
			$.ajax({
				type:'GET',
				url: "{{url('gencaptcha')}}",
				success:function(data){
					$(".captcha span").html(data);
					$('[name="captcha"]').val('');
				}
			});
		});
	</script>
	@endpush
