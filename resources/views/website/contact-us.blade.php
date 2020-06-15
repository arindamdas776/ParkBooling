@extends('common.layout')
@section('title','Contact Us')
@section('content')
<div class="content-blank">
	<div class="sub-banner black-opacit" style="background: url('http://sites.mobotics.in/eeaa/assets/images/sub-banner.jpg');">
		<div class="container">
			<h2>Contact Us</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a>Home</a></li>
				<li class="breadcrumb-item active">Contact Us</li>
			</ol>
		</div>
	</div>
	<div class="single-page mt-5 mb-5">
		<div class="container">
			<h2 class="text-center text-uppercase">We love to talk</h2>
			<div class="head-line mb-5 "><i class="fab bg-white fa-fly"></i></div>
			<div class="row d-none">
				<div class="col-lg-4 col-md-4">
					<div class="contact-wrap">
						<h3>Cairo, Egypt</h3>
						<ul>
							<li>
								<i class="fa fa-home"></i> Abu Al Feda, Zamalek, Cairo 11211, Egypt
							</li>
							<li><i class="fa fa-phone"></i> +91-00-40XXXXXX</li>
							<li><i class="fa fa-envelope"></i>info@info.com</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="contact-wrap">
						<h3>Cairo, Egypt</h3>
						<ul>
							<li>
								<i class="fa fa-home"></i> Abu Al Feda, Zamalek, Cairo 11211, Egypt
							</li>
							<li><i class="fa fa-phone"></i> +91-00-40XXXXXX</li>
							<li><i class="fa fa-envelope"></i>info@info.com</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="contact-wrap">
						<h3>Cairo, Egypt</h3>
						<ul>
							<li>
								<i class="fa fa-home"></i> Abu Al Feda, Zamalek, Cairo 11211, Egypt
							</li>
							<li><i class="fa fa-phone"></i> +91-00-40XXXXXX</li>
							<li><i class="fa fa-envelope"></i>info@info.com</li>
						</ul>
					</div>
				</div>
			</div>
        <form action="" id="contactForm" method="POST">
            @csrf
                <div id="errorDiv" style="display: none; background: red; color: #fff;">
                </div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="name">Name<code>*</code></label><br/>
							<input type="text" class="form-control" name="name" placeholder="Name" required>
						</div>
						<div class="form-group">
							<label for="name">Email<code>*</code></label><br/>
							<input type="email" class="form-control" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="name">Mobile<code>*</code></label><br/>
							<input type="text" class="form-control numeric" name="mobile" placeholder="Mobile" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="message">Message<code>*</code></label>
							<textarea name="message" id="message" class="form-control" cols="30" rows="4" required placeholder="Enter message"></textarea>
						</div>
						<div class="form-group">
							<label for="captcha">Enter text displayed above <code>*</code></label>
							<div class="row">
								<div class="col-md-5">
									<div class="row">
										<div class="col-xs-6 ml-3">
											<div class="captcha" style="width: 130%;">
												<span></span>
											</div>
										</div>
										<div class="col-xs-6 ml-1">
											<button type="button" class="btn btn-success" id="refresh">⟳</button>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<input type="text" name="captcha" class="form-control input-sm" placeholder="Captcha Text" autocomplete="off" required>
								</div>
							</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
                        <button class="btn btn-primary btn-block">SUBMIT</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function() {
    $(".numeric").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});

    $(function() {
        $('#refresh').trigger('click');
    });
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


    $('#contactForm').ajaxForm({
      dataType:'json',
      statusCode: {
        422: function(errors) {
            var html = '';
            $.each(errors.responseJSON.errors.validation_error, function(key,value){
                if(value == 'validation.captcha') {
                    $('#refresh').trigger('click');
                    value = 'Captcha Mismatched';
                }
                html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
            });
            $('#errorDiv').html(html);
            $('#errorDiv').fadeIn();
        },
        500: function (error) {
            toastr["error"]("Oops! something went wrong.");
        },
        200: function (res) {
            toastr[res.type](res.text);
            if(res.type == 'success'){
                $('#contactForm')[0].reset();
                $('#errorDiv').fadeOut();
            }
        }
    }
  });

</script>
@endpush
