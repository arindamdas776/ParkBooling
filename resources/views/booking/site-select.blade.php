@extends('common.layout')
@section('title', __('Booking'))
@section('product_title', config('app.name'))
@section('content')
@push('style')
<style>
    .box-image-pop-up{
        width:100%;
        margin: 10px 0px;
        position: relative
    }
    .pop-close-image{
        position: absolute;
        right: 0;
        top: 0;
        background: rgba(255, 255, 255, .8);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        line-height: 25px;
        text-align: center;
        color: red;
        cursor: pointer;
    }
    </style>
@endpush

@push('styles')
    <style>
        .link:hover {
            cursor: pointer;
        }
    </style>
@endpush


<div class="content-blank">
	<div class="sub-banner black-opacit"  style="background: url('{{asset('assets/images/sub-banner.jpg')}}');">
		<div class="container">
			<h2>{{__('Booking')}}</h2>
			{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{__('Home')}}</a></li>
				<li class="breadcrumb-item active">{{__('Booking')}}</li>
			</ol> --}}
		</div>
	</div>
	<div class="single-page mt-5 mb-5">
		<div class="container">
			<div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                    <label for="">{{__('Visit Type')}}</label><br/>
                        <select name="visit_type" id="visit_type" class="form-control">
                            <option value="{{encrypt('safari')}}">{{__('Safari')}}</option>
                            <option value="{{encrypt('marine')}}">{{__('Marine')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="">{{__('Site')}}</label>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($sites as $site)
                            <div class="col-md-4">
                                <a class="link" data-siteid="{{encrypt($site->id)}}">
                                <div class="card">
                                    <div class="card-body text-center" style="min-height: 100px;">
                                        <span  class="" style="font-size: 22px;
                                        display: inline-block;
                                        padding: 10px 20px;
                                        border-radius: 32px;
                                        border: 0.7px solid #ecececd9;"> {{$site->name}}</span>
                                    </div>
                                  </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{-- <ul>
                        @foreach ($sites as $site)
                            <li><a class="link" data-siteid="{{encrypt($site->id)}}">{{$site->name}}</a></li>
                        @endforeach
                    </ul> --}}
                </div>
            </div>
		</div>
	</div>
</div>


@endsection

@push('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>

    $(document).ready(function() {
        $('#addFormSites, #editFormSites').select2();
    });
    $('.link').click(function() {
        $visit_type = $('[name="visit_type"]').find('option:selected').val();
        if($visit_type == '' || typeof $visit_type == 'undefined') {
            toastr['error']('{{__("Please select atleast one visit type")}}');
            return false;
        }
        site_id = $(this).data('siteid');
        url = "{{url('booking-seatlist')}}"+"/"+site_id+"/"+$visit_type;
        window.location.href = url;
    })
</script>


<script>
</script>
@endpush
