@extends('common.layout')
@section('title', __('Booking Success'))
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
    .link-none:hover {
        cursor: none !important;
    }
    </style>
@endpush

<div class="content-blank">
    <div class="sub-banner black-opacit" style="background: url('{{asset('assets/images/sub-banner.jpg')}}');">
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
                <div class="col-lg-12 text-center">
                    <h3 class="text-center">{{__('Booking Successfull')}} !!</h3>
                    <div class="row">
                        <div class="col-md-12 text-center p-10">
                            @php
                                $text = 'Ticket No: '.$booking->booking_no.' | Booked Date: '.$booking->date.' | No Of Seat: '.$booking->booking_metas_count.' | Visit Type: '.ucwords($booking->visit_type).' | Site Name: '.ucwords($site->name).' | Slot: '.ucwords($slot->slot_name).' | Unit: '.ucwords($booking->unit_name);
                            @endphp
                            {{-- <img src="data:image/png;base64, {{ base64_encode(QrCode::encoding('UTF-8')->format('png')->merge('/public/storage/logo/logo.png')->margin(1)->size(150)->generate($text)) }}"> --}}
                            <img src="data:image/png;base64, {{ base64_encode(QrCode::encoding('UTF-8')->format('png')->margin(1)->size(150)->generate($text)) }}">
                        </div>
                    </div>
                    <table class="table table-bordered" style="width: 60%; margin: 0 auto;">
                        <thead>
                            <tr>
                                <th colspan="5"></th>
                                <th colspan="5"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <h5>{{__('Ticket No')}}:</h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>#{{$booking->booking_no}}</strong></h5>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <h5>{{__('Booked Date')}}:</h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>{{$booking->date}}</strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5>{{__('No Of Seat')}}:</h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>{{$booking->booking_metas_count}}</strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5>
                                        {{__('Visit Type')}}:
                                    </h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>
                                        {{ucwords($booking->visit_type)}}
                                    </strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5>
                                        {{__('Site Name')}}:
                                    </h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>
                                        {{ucwords($site->name)}}
                                    </strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5>
                                        {{__('Slot')}}:
                                    </h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>
                                        {{ucwords($slot->slot_name)}}
                                    </strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5>
                                        {{__('Unit')}}:
                                    </h5>
                                </td>
                                <td colspan="5">
                                    <h5><strong>
                                        {{ucwords($booking->unit_name)}}
                                    </strong></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table  style="width: 60%; margin: 0 auto;">
                        <tr>
                            <td colspan="10">
                                {{__('Country Wise Ticket Breakup')}}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered"  style="width: 70%; margin: 0 auto;">
                        <thead   style="background:#ccc;">
                            <tr>
                                <th>{{__('Country')}}</th>
                                <th>{{__('Adult')}}</th>
                                <th>{{__('Child')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketCountryWise as $item)
                            <tr>
                                <td>
                                    <strong>{{$item['Country']}}</strong>
                                </td>
                                <td>
                                    <strong>{{$item['Adult']}}</strong>
                                </td>
                                <td>
                                    <strong>{{$item['Child']}}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>
                        <a href="{{route('booking.view_ticket_summary', encrypt($booking->id))}}">{{__('View Details')}}</a>
                    </p>
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
        site_id = $(this).data('siteid');
        url = "{{url('booking-seatlist')}}"+"/"+site_id+"/"+$visit_type;
        window.location.href = url;
    })
</script>


<script>
</script>
@endpush
