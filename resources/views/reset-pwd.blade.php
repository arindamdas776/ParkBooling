@extends('common.layout')
@section('title', __('Reset Password'))
@section('content')


{{-- Login Wrapper starts --}}

<div class="login-register" style="background-image: url({{url('assets/images/background/login-register.jpg')}})">
    <div class="login-box card mt-3 mb-2">
        <div class="card-body ">
            <form id="SubmitForm" method="POST" action="{{ route('reset.pwd.verify') }}">
                @csrf
                <h3 class="box-title m-b-20 text-center">{{ __('Reset Password') }}</h3>
                <div id="errorDiv" style="display: none; background: red; color: #fff;">                    
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="hidden" name="email" value="{{$email}}">
                        <label for="username">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control required" name="password" placeholder="Password" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="username">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control required" name="cpassword" placeholder="Confirm Password" required="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="captcha">Enter text displayed above</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">                                
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="captcha" class="form-control input-sm" placeholder="Captcha Value" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group d-none">
                    <div class="d-flex no-block align-items-center">
                        <div class="ml-auto">
                            <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot Password</a>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" id="signupBtn"  type="submit">{{ __('Reset Password') }}</button>
                    </div>
                </div>
                <div class="form-group m-b-20">
                    <div class="col-sm-12 text-center">
                        Don't have an account? <a href="{{ url('sign-up') }}" class="text-info m-l-5"><b>Sign Up</b></a>
                    </div>
                </div>
            </form>
            <form action="" class="d-none">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3 class="text-center">Recover Password</h3>
                        <p class="text-blcck">
                            Enter your Email/Mobile No and instructions will be sent to you!
                        </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control required" name="username" type="text" required="" placeholder="Email/Mobile No." />
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
{{-- Login Wrapper ends --}}
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    $('#SubmitForm').ajaxForm({
      dataType:'json',
      statusCode: {
        422: function(errors) {
            $('#refresh').trigger('click');
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
            $.notify({
                title: "500 Internal Server Error : ",
                message: error.responseJSON.message,
                icon: 'fa fa-ban' 
            },{
                type: "danger"
            });
        },
        200: function (res) {
            toastr[res.type](res.text);
            if(res.type == 'success'){
                $('#errorDiv').fadeOut();
                $('input').val('');
                setTimeout(()=> {
                    window.location.href = '{{route("sign-in")}}';
                }, 3000)
                // location.reload();
                // window.location.href = `{{url('/my-company')}}`;
            }
        }
    }
  });
</script>
<script type="text/javascript">
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
</script>
@endpush