@extends('common.layout')
@section('title', __('Booking Success'))
@section('product_title', config('app.name'))
@section('content')
@push('style')
<style>
    .box-image-pop-up {
        width: 100%;
        margin: 10px 0px;
        position: relative
    }

    .pop-close-image {
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


<!-- The Modal -->
<div class="modal" id="paymentModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment Mode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div>
                    <p>
                        <a href="" class="text-primary" style="font-size: 18px;">Pay by Offline</a>
                    </p>
                </div>
                <div>
                    <p>
                        <a href="" class="text-info" style="font-size: 18px;">Pay by Online</a>
                    </p>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

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
                <div class="col-lg-12 text-right">
                    <input type="button" id="noprint" class="noprint printbtn" onclick="printDiv('printableArea')"
                        value="{{__('Print')}}" />
                </div>
                @php
                $text = 'Ticket No: '.$booking->booking_no.' | Booked Date: '.$booking->date.' | No Of Seat(s):
                '.$booking->booking_metas_count.' | Visit Type: '.ucwords($booking->visit_type).' | Site Name:
                '.ucwords($site->name).' | Slot: '.ucwords($slot->slot_name).' | Unit: '.ucwords($booking->unit_name);
                @endphp
            </div>
            <div class="row">
                <div class="col-lg-12 text-center" id="printableArea">
                    <h3 class="text-center">{{__('Booking Detail')}}</h3>
                    <div class="row">
                        <div class="col-md-12 text-center p-10">
                            {{-- <img src="data:image/png;base64, {{ base64_encode(QrCode::encoding('UTF-8')->format('png')->merge('/public/storage/logo/logo.png')->margin(1)->size(150)->generate($text)) }}">
                            --}}
                            <img
                                src="data:image/png;base64, {{ base64_encode(QrCode::encoding('UTF-8')->format('png')->margin(1)->size(150)->generate($text)) }}">
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
                                    <h5>{{__('No Of Seat(s)')}}:</h5>
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
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    {{__('Vessel Type')}}: <strong>{{ucwords($vessel->name)}}</strong>
                                </td>
                                <td colspan="5">
                                    {{__('Activity')}}: <strong>{{ucwords($activity->name)}}</strong>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                    <table style="width: 60%; margin: 0 auto;">
                        <tr>
                            <td colspan="10">
                                {{__('Country Wise Ticket Breakup')}}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="width: 70%; margin: 0 auto;">
                        <thead style="background:#ccc;">
                            <tr>
                                <th>{{__('Country')}}</th>
                                <th>{{__('Adult')}}</th>
                                <th>{{__('Child')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $adultEgp = 0;
                            $childEgp = 0;
                            $adultOther = 0;
                            $childOther = 0;
                            @endphp
                            @foreach ($ticketCountryWise as $item)
                            @php
                            if($item['Country'] == 'Egyptian') {
                            $adultEgp += $item['Adult'];
                            $childEgp += $item['Child'];
                            } else {
                            $adultOther += $item['Adult'];
                            $childOther += $item['Child'];
                            }
                            @endphp
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
                    <table style="width: 60%; margin: 0 auto;">
                        <tr>
                            <td>
                                {{__('Detail Ticket Breakup')}}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="width: 70%; margin: 0 auto;">
                        <thead style="background:#ccc;">
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Last Name')}}</th>
                                <th>{{__('Passport Number')}}</th>
                                <th>{{__('Nationality')}}</th>
                                <th>{{__('Age')}}</th>
                                <th>{{__('Gender')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking->booking_metas as $item)
                            <tr>
                                <td>
                                    <strong>{{ucwords($item->name)}}</strong>
                                </td>
                                <td>
                                    <strong>{{ucwords($item->lname)}}</strong>
                                </td>
                                <td>
                                    <strong>{{ucwords($item->passport)}}</strong>
                                </td>
                                <td>
                                    <strong>{{ucwords($item->nationality)}}</strong>
                                </td>
                                <td>
                                    <strong>{{ucwords(($item->age == 'a') ? 'Adult' : 'Child')}}</strong>
                                </td>
                                <td>
                                    <strong>{{ucwords($item->gender)}}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered" style="width: 70%; margin: 0 auto;">
                        <tbody>
                            <tr colspan="5">
                                @if ($booking->visit_type == 'marine')
                                <td align="left">
                                    <h3><strong>{{__('Captain')}}</strong></h3>
                                </td>
                                @elseif ($booking->visit_type == 'safari')
                                <td align="left">
                                    <h3><strong>{{__('Agent')}}</strong></h3>
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <td align="left">{{__('Name')}}</td>
                                <td align="left"></td>
                            </tr>
                            <tr>
                                <td align="left">{{$booking->person_name}}</td>
                                <td align="left">{{$booking->person_number}}</td>
                            </tr>
                            <tr colspan="5">
                                <td align="left">
                                    <h3><strong>{{__('Guide')}}</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">{{__('Name')}}</td>
                                <td align="left">{{__('Phone Number')}}</td>
                            </tr>
                            <tr>
                                <td align="left">{{$booking->guide_name}}</td>
                                <td align="left">{{$booking->guide_number}}</td>
                            </tr>
                            {{-- <tr >
                                <td colspan="5"align="right"><h3><strong>{{__('Total Fees')}}: {{$booking->totalFees}}
                            EGP</strong></h3>
                            </td>
                            </tr> --}}
                        </tbody>
                    </table>


                    <p>
                        <h3><strong>INV EGP</strong></h3>
                    </p>
                    <table class="table table-bordered" style="width: 70%; margin: 0 auto;">
                        <tbody>

                            <tr>
                                <td>
                                    <strong>Adult</strong>
                                </td>
                                <td>
                                    <strong>{{$adultEgp.' * '.$booking->adult_ticket_price_egp}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($adultEgp*$booking->adult_ticket_price_egp)}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Child</strong>
                                </td>
                                <td>
                                    <strong>{{$childEgp.' * '.$booking->child_ticket_price_egp}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($childEgp*$booking->child_ticket_price_egp)}}</strong>
                                </td>
                            </tr>
                            @if ($booking->inv_usd == 'false')
                            <tr>
                                <td>
                                    <strong>Ticket Price</strong>
                                </td>
                                <td>
                                    <strong>{{$booking->vessel_ticket_price_egp}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($booking->vessel_ticket_price_egp)}}</strong>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <strong></strong>
                                </td>
                                <td align="center">
                                    <h4>
                                        <strong>{{number_format($booking->totalFees_egp)}} EGP</strong>
                                        @if (intval($booking->totalFees_egp) > 0)
                                        &nbsp;&nbsp;<button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#paymentModal">
                                            Pay Now
                                        </button>
                                        @endif
                                    </h4>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    @if ($booking->inv_usd == 'true')
                    <p>
                        <h3><strong>INV USD</strong></h3>
                    </p>
                    <table class="table table-bordered" style="width: 70%; margin: 0 auto;">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Adult</strong>
                                </td>
                                <td>
                                    <strong>{{$adultOther.' * '.$booking->adult_ticket_price_usd}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($adultOther*$booking->adult_ticket_price_usd)}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Child</strong>
                                </td>
                                <td>
                                    <strong>{{$childOther.' * '.$booking->child_ticket_price_usd}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($childOther*$booking->child_ticket_price_usd)}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Ticket Price</strong>
                                </td>
                                <td>
                                    <strong>{{$booking->vessel_ticket_price_usd}} = </strong>
                                </td>
                                <td>
                                    <strong>{{number_format($booking->vessel_ticket_price_usd)}}</strong>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <strong></strong>
                                </td>
                                <td align="center">
                                    <h4>
                                        <strong>{{number_format($booking->totalFees_usd)}} USD</strong>
                                        @if (intval($booking->totalFees_usd) > 0)
                                        &nbsp;&nbsp;<button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#paymentModal">
                                            Pay Now
                                        </button>
                                        @endif
                                    </h4>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif

                    <p>
                        {{-- <a href="{{route('booking.tickets')}}">View Details</a> --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
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
    function printDiv(divName) {
		// document.getElementById('noprint').style.visibility = 'hidden';
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endpush