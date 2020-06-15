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
    <link href='{{asset('assets/calender/core/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/calender/daygrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/calender/timegrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/calender/list/main.css')}}' rel='stylesheet' />
    <style>
        .link-none:hover {
            cursor: not-allowed !important;
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
                <div class="col-lg-12">
                    <label for="">{{__('Site')}}</label>
                </div>
                <div class="col-lg-12">
                    <div id='calendar'></div>
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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" crossorigin="anonymous"></script>
<script src='{{asset('assets/calender/core/main.js')}}'></script>
<script src='{{asset('assets/calender/daygrid/main.js')}}'></script>
<script src='{{asset('assets/calender/timegrid/main.js')}}'></script>
<script src='{{asset('assets/calender/list/main.js')}}'></script>
<script src='{{asset('assets/calender/interaction/main.js')}}'></script>
<script>

	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid', 'timeGrid'  ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            // defaultDate: '2019-09-25',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            dateClick: function(info) {
                console.log(info);
                alert('clicked');
            },
            select: function(info) {
                console.log(info);
            },

            // events: function(start, end, timezone, callback) {
            //     console.log(start, end);
            //     $.ajax({
            //         url: '{{route("booking.json_seatlist")}}',
            //         method: "POST",
            //         dataType: 'JSON',
            //         data: {
            //             // our hypothetical feed requires UNIX timestamps
            //             // start: start.unix(),
            //             // end: end.unix()
            //             '_token' : '{{csrf_token()}}'
            //         },
            //         success: function(doc) {
            //             var events = [];
            //             $(doc).find('event').each(function() {
            //             events.push({
            //                 title: $(this).attr('title'),
            //                 start: $(this).attr('start') // will be parsed
            //             });
            //             });
            //             // callback(events);
            //         }
            //     });
            // },

            events: {
                url: '{{route("booking.json_seatlist")}}',
                method: 'POST',
                extraParams: {
                    _token: '{{csrf_token()}}',
                    siteid: '{{$id}}',
                    visit_type: '{{$visit_type}}',
                    // var moment = $('#calendar').fullCalendar('getDate');
                },
                failure: function() {
                    // alert('there was an error while fetching events!');
                },
                // color: 'yellow',   // a non-ajax option
                // textColor: 'black' // a non-ajax option
            },

            // eventSources: [
            //     {
            //         url: '{{route("booking.json_seatlist")}}',
            //         type: 'POST',
            //         // **allDayDefault:false,**
            //     }                    
            // ],
            // eventClick: function(info) {
            // 	edit(info.event.groupId);
            // },
            // select: function(arg) {
            // 	console.log(arg);
            // 	// $('#addForm [name="start_date"]').val(formatDate(arg.start));
            // 	// $('#addEventModal').modal('show');
            // 	calendar.unselect()
            // },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            // events: [{"groupId":1,"title":"Lorem Ipsum","start":"2020-01-26 23:00:00","end":"2020-01-27 06:00:00", "color": "red", "textColor": '#fff'},{"groupId":3,"title":"Lorem Ipsum is a dummy text","start":"2020-01-30 07:00:00","end":"2020-01-30 12:00:00"},{"groupId":4,"title":"Test","start":"2020-01-25 12:00:00","end":"2020-01-25 17:00:00"}],
            // eventColor: '#378006',
            textColor: '#fff', // a non-ajax option,
            eventClick: function(info) {
                // console.log(info.event.extendedProps);
                metaInfo = info.event.extendedProps;
                if(metaInfo.active == false) {
                    return false;
                }
                window.location.href = metaInfo.redirect;
                // console.log(metaInfo);
                // // change the border color just for fun
                info.el.style.borderColor = 'white';
            }
		});

        calendar.render();
	});

	$('input[name="fees"]').keypress(function(event){
		return isNumber(event, this);
	});

	function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57)
           )
            return false;

        return true;
    }

	</script>
@endpush
