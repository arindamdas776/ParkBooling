@extends('common.layout')
@section('title','SIGN UP')
@push('styles')
<link href="{{ asset('assets/css/blue.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
@endpush
@section('content')
<div class="bg-image" style="background-image:url(assets/images/background/login-register.jpg);">
	<div class="container">
		<div class="form-box">
			<h2 class="text-center text-white mb-3">Application Submitted</h2>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="form-wizard">
						<form action="" id="BookingFrom" role="form" method="post" accept-charset="utf-8">
							<div class="main-border">
								<div class="form-wizard-steps form-wizard-tolal-steps-7">
									<div class="row">
										<div class="col-md-12">
											<i class="fa fa-check-circle mt-5" style="font-size: 30px; color: green;"></i>
											<h3 class="mt-3 mb-3">Thank you for registering with us!</h3>
											<h5>We will Review your application and notify you shortly!</h5>
											<a href="" class="btn btn-info mt-3 mb-5">Sign In</a>
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
