@extends('common.layout')
@section('title', __('Booking'))
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
</style>
@endpush
@push('styles')
<style>
    .fw-600 {
        font-weight: 600;
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
                    <div id="errorDiv" style="display:none;"></div>
                </div>
            </div>
            <form action="{{route('booking.book_ticket')}}" method="POST" id="bookTicketForm">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">{{__('Vessel Type')}}</label><br />
                            <select name="vessel_type" id="vessel_type" class="form-control"
                                onchange="vesselChange(this)">
                                <option value="" disabled selected>{{__('Vessel Type')}}</option>
                                @foreach ($vessel as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">{{__('Select Unit')}}</label><br />
                            <select name="unit_list" id="unit_list" class="form-control" onchange="">
                                <option value="" disabled selected>{{__('Unit')}}</option>
                                @foreach ($unitList as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">{{__('Activity')}}</label><br />
                            <select name="activity" id="activity" class="form-control">
                                <option value="" selected disabled>{{__('Activity')}}</option>
                                @foreach ($activities as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="fw-600">{{__('No. Tickets')}}</label>
                    </div>
                </div>
                <div class="content-wrapper" id="no-tickets-wrapper">
                    <div class="row">
                        <input type="hidden" name="ticket-count[]">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">{{__('First Name')}}</label><br />
                                <input type="text" name="name[]" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">{{__('Last Name')}}</label><br />
                                <input type="text" name="lname[]" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 15%;">
                            <div class="form-group">
                                <label for="">{{__('Passport Number')}}</label><br />
                                <input type="text" name="passport[]" id="passport" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">{{__('Nationality')}}</label><br />
                                <select name="nationality[]" id="nationality" onchange="calFees()" class="form-control">
                                    @foreach ($nationality as $item)
                                    <option value="{{$item}}" {{($item == 'Egyptian') ? 'selected': ''}}>{{$item}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 13%;">
                            <div class="form-group">
                                <label for="">{{__('Age')}}</label><br />
                                <select name="adult[]" id="adult" onchange="calFees()" class="form-control">
                                    <option value="">{{__('Select')}}</option>
                                    <option value="a">{{__('Adult')}}</option>
                                    <option value="c">{{__('Child')}}</option>
                                </select>
                                {{-- <input type="number" name="adult[]" id="adult" onchange="calFees()" class="form-control" placeholder="Adult"/> --}}
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 13%;">
                            <div class="form-group">
                                <label for="">{{__('Gender')}}</label><br />
                                <select name="gender[]" id="gender" onchange="calFees()" class="form-control">
                                    <option value="">{{__('Select')}}</option>
                                    <option value="m">{{__('Male')}}</option>
                                    <option value="f">{{__('Female')}}</option>
                                </select>
                                {{-- <input type="number" name="child[]" id="child" onchange="calFees()" class="form-control" placeholder="Child"/> --}}
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-sm bg-danger text-white mt-4"
                                onclick="removeRow(this)"><i class="fa fa-trash" data-toogle="tooltip"
                                    data-title="Click to remove" title=""></i></button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-sm bg-primary text-white" onclick="addRow()"
                            style="margin-right:125px;">{{__('Add')}} <i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-lg-12">
                        <label for=""
                            class="fw-600"><b>{{(strtolower($visit_type) == 'safari') ? __('Agent') : __('Captain')}}</b></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">{{__('Name')}}</label><br />
                            <input type="text" name="person_name" id="person_name" class="form-control"
                                placeholder="{{__('Name')}}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">{{__('Phone Number')}}</label><br />
                            <input type="number" name="person_number" id="person_number" class="form-control"
                                placeholder="{{__('Phone Number')}}" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="fw-600">{{__('Guide')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">{{__('Name')}}</label><br />
                            <input type="text" name="guide_name" id="guide_name" class="form-control"
                                placeholder="{{__('Name')}}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">{{__('Phone Number')}}</label><br />
                            <input type="number" name="guide_number" id="guide_number" class="form-control"
                                placeholder="{{__('Phone Number')}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="" style="font-size: 18px;" class="fw-600">{{__('Invoice USD')}}: <span
                                id="totalFees_usd">0</span> USD</label>
                        <br>
                        <label for="" style="font-size: 18px;" class="fw-600">{{__('Invoice EGP')}}: <span
                                id="totalFees_egp">0</span> EGP</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-block btn-primary">{{__('Book')}}</button>
                    </div>
                </div>
            </form>
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
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<script>
    var vessel;
    window.adult_ticket_price_usd = 0;
    window.adult_ticket_price_egp = 0;
    window.child_tikcet_price_usd = 0;
    window.child_tikcet_price_egp = 0;

    vessel_ticket_price_usd = 0;
    vessel_ticket_price_egp = 0;
    var totalFees_usd = 0;
    var totalFees_egp = 0;
    $(document).ready(function() {
        vessel = JSON.parse('<?php echo json_encode($vessel); ?>');
        sites = JSON.parse('<?php echo json_encode($sitesArr); ?>');

        adult_ticket_price_usd = sites['adult_ticket_price_usd'];
        adult_ticket_price_egp = sites['adult_ticket_price_egp'];
        child_tikcet_price_usd = sites['child_tikcet_price_usd'];
        child_tikcet_price_egp = sites['child_tikcet_price_egp'];

    });

    function removeRow(elem) {
		if(confirm("{{__('Are you sure want to delete')}}?")) {
			var _this = $(elem);
			var row = $(elem).closest('.row');
			$(row).remove();
        }
        calFees();
	}

    $('#bookTicketForm').submit(function() {
        if($("[name='ticket-count[]']").length > 0){
            return true;
        } else {
            toastr['error']("{{__('Add at least one ticket')}}");
            return false;
        }
    })

    function addRow(elem) {
        $('#bookTicketForm').submit(function(event) {
            event.preventDefault();
            return false;
        })
		var content_wrapper = $('#no-tickets-wrapper');

		var row = '';
        row += `<div class="row">
                    <input type="hidden" name="ticket-count[]">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">{{__('Name')}}</label><br/>
                            <input type="text" name="name[]" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">{{__('Last Name')}}</label><br/>
                            <input type="text" name="lname[]" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-2" style="max-width: 15%;">
                        <div class="form-group">
                            <label for="">{{__('Passport Number')}}</label><br/>
                            <input type="text" name="passport[]" id="passport" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">{{__('Nationality')}}</label><br/>
                            <select name="nationality[]" id="nationality" onchange="calFees()" class="form-control">`;
                                @foreach ($nationality as $item)
                                    row +=`<option value="{{$item}}" {{($item == 'Egyptian') ? 'selected': ''}}>{{$item}}</option>`;
                                @endforeach
                            row +=`</select>
                        </div>
                    </div>
                    <div class="col-lg-2" style="max-width: 13%;">
                        <div class="form-group">
                            <label for="">{{__('Age')}}</label><br/>
                            <select name="adult[]" id="adult" onchange="calFees()" class="form-control">
                                <option value="">{{__('Select')}}</option>
                                <option value="a">{{__('Adult')}}</option>
                                <option value="c">{{__('Child')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2" style="max-width: 13%;">
                        <div class="form-group">
                            <label for="">{{__('Gender')}}</label><br/>
                            <select name="gender[]" id="gender" onchange="calFees()" class="form-control">
                                <option value="">{{__('Select')}}</option>
                                <option value="m">{{__('Male')}}</option>
                                <option value="f">{{__('Female')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <br/>
                        <button type="button" class="btn btn-sm bg-danger text-white" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                    </div>
                </div>`;
		$(content_wrapper).find('.row:last-child button').html('<i class="fa fa-trash"></i>');
		$(content_wrapper).find('.row:last-child button').removeClass('btn-success');
		$(content_wrapper).find('.row:last-child button').attr('onclick', 'removeRow(this)');
		$(content_wrapper).append(row);
    }
    function vesselChange(elem) {
        index  = $(elem)[0].selectedIndex -1;
        vessel_ticket_price_usd = vessel[index].ticket_price_usd;
        vessel_ticket_price_egp = vessel[index].ticket_price_egp;       

        calFees();
    }

    function calFees() {
        totalFees_usd = 0;
        totalFees_egp = 0;
        window.invUSD = false;
        $('.content-wrapper .row').each(function(i,v) {
            nationality = $(v).find('[name="nationality[]"] option:selected').val();
            if(nationality != "Egyptian"){
                invUSD = true;
                return false;
            }
        });

        $('.content-wrapper .row').each(function(i,v) {
            age = $(v).find('[name="adult[]"] option:selected').val();
            nationality = $(v).find('[name="nationality[]"] option:selected').val();
            if(age == 'a') {
                adultNo = 1;
                childNo = 0;
            } else if(age == 'c') {
                adultNo = 0;
                childNo = 1;
            } else {
                adultNo = childNo = 0;
            }
            // adultNo = getNum(parseInt($(v).find('[name="adult[]"]').val()));
            // childNo = getNum(parseInt($(v).find('[name="child[]"]').val()));

            if(nationality == "Egyptian") {
                totalFees_egp += (adult_ticket_price_egp * adultNo) + (child_tikcet_price_egp * childNo) - 0;
            } else {
                totalFees_usd += (adult_ticket_price_usd * adultNo) + (child_tikcet_price_usd * childNo) - 0;
            }
        });

        // if(invUSD == true) {
        //     totalFees_usd = getNum(totalFees_usd) + (vessel_ticket_price_usd - 0);
        // } else {
        //     totalFees_egp = getNum(totalFees_egp) + (vessel_ticket_price_egp - 0);
        // }

        if(invUSD == true) {
            totalFees_usd = getNum(totalFees_usd);
        } else {
            totalFees_egp = getNum(totalFees_egp);
        }
        // if(invUSD == false){
        // }
        // console.log(vessel_ticket_price_usd, vessel_ticket_price_egp);

        totalFees_usd = (totalFees_usd - 0) + (vessel_ticket_price_usd - 0);

        $('#totalFees_egp').html(totalFees_egp);
        $('#totalFees_usd').html(totalFees_usd);
    }

    function getNum(val) {
        if (isNaN(val)) {
            return 0;
        }
        return val;
    }
</script>


<script>
    $('#bookTicketForm').ajaxForm({
        dataType:'json',
        beforeSubmit:  function(formData, jqForm, options) {
            formData.push({ name: 'visit_type', value: '{{$visit_type}}' });
            formData.push({ name: 'totalFees_usd', value: totalFees_usd });
            formData.push({ name: 'totalFees_egp', value: totalFees_egp });
            formData.push({ name: 'siteid', value: '{{$siteid}}' });
            formData.push({ name: 'slotid', value: '{{$slotid}}' });
            formData.push({ name: 'date', value: '{{$date}}' });

            formData.push({ name: 'inv_usd', value: invUSD });
            formData.push({ name: 'vessel_ticket_price_usd', value: vessel_ticket_price_usd });
            formData.push({ name: 'vessel_ticket_price_egp', value: vessel_ticket_price_egp });

            formData.push({ name: 'adult_ticket_price_usd', value: adult_ticket_price_usd });
            formData.push({ name: 'adult_ticket_price_egp', value: adult_ticket_price_egp });
            formData.push({ name: 'child_ticket_price_usd', value: child_tikcet_price_usd });
            formData.push({ name: 'child_ticket_price_egp', value: child_tikcet_price_egp });
        },
        statusCode: {
            422: function(errors) {
                var html = '';
                $.each(errors.responseJSON.errors.validation_error, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDiv').html(html);
                $('#errorDiv').fadeIn();
            },
            500: function (error) {
                $.notify({
                    title: "{{__('500 Internal Server Error')}} : ",
                    message: error.responseJSON.message,
                    icon: 'fa fa-ban'
                },{
                    type: "danger"
                });
                $('#errorDiv').html("{{__('Oops! some error occured')}}!");
                $('#errorDiv').fadeIn();
            },
            200: function (res) {
                $('#errorDiv').html('');
                $('#errorDiv').fadeOut();
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    // location.reload();
                    window.location.href = `${res.redirect_url}`;
                }
            }
        }
  });
</script>
@endpush