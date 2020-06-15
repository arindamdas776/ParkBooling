@extends('common.backend.layout')
@section('title', __('Booked Ticket'))
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
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">{{__('Booked Ticket')}}</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active text-white">{{__('Booked Ticket')}}</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>



        <div class="row mt-low">
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">{{__('Records')}}</h4>
                            </div>
                            <div class="col-md-6">
                                @if (session('usertype') == 'owner')
                                    <div class="pull-right" style="float:right;">
                                        <button class="btn waves-effect waves-light btn-rounded btn-info" onclick="window.location.href='{{route('booking.index')}}'"><i class="fa fa-plus"></i> {{__('Add')}}</button>
                                    </div>                                    
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Booking No')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Person Name')}}</th>
                                        <th>{{__('Person Number')}}</th>
                                        <th>{{__('Guide Name')}}</th>
                                        <th>{{__('Guide Number')}}</th>
                                        <th>{{__('Visit Type')}}</th>
                                        <th>{{__('Total Fees')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <footer class="footer">
            © {{date('Y')}} {{__('Admin')}}
        </footer>
    </div>
</div>

<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">{{__('Ticket Details')}} <span id="ticket_no"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="editModalCloseButton">×</button>
            </div>
            <form action="" id="editForm" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errorDivEdit"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            Total Booked Ticket: <label for="" class="badge badge-primary" id="lbl_booked_ticket"></label>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-stripped" id="infoTable">
                                <thead style="background: #ccc;">
                                    <tr>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Nationality</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>                        
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
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>

    $(document).ready(function() {
        $('#addFormActivities, #editFormActivities').select2();
    });

    function info(id) {
        var formData = new FormData();
        formData.append('id', id);
        formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: '{{url("booking/ticket")}}/'+id,
            type : 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(arg) {
                $('#infoTable tbody').html('');
                var tr = '';
                $.each(arg.booking_metas, function(i, v) {
                    console.log(v);
                    if(v.gender == 'm') {
                        $gender = 'Male';
                    } else if(v.gender == 'f') {
                        $gender = 'Female';
                    } else if(v.gender == 'o') {
                        $gender = 'Other';
                    } else {
                        $gender = '';
                    }
                    tr += `<tr>
                            <th>${v.name}</th>
                            <th>${v.passport}</th>
                            <th>${v.nationality}</th>
                            <th>${(v.age == 'c') ? 'Child' : 'Adult'}</th>
                            <th>${$gender}</th>
                        </tr>`;
                    
                });
                $('#ticket_no').html('#'+arg.booking_no);
                $('#lbl_booked_ticket').html(arg.booking_metas.length);
                $('#infoTable tbody').html(tr);
            }
        });
        $('#editModal').modal('show');
    }

    function changeStatus(id) {
        if(confirm("Are You Sure to Change status of this Status?"))
        {
            $.ajax({
                url: "{{ route('sites.change_status') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        });
                        $('#errorDiv').html(html);
                        $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](errorMsg["500"]);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        if(res.type == 'success'){
                            DT.ajax.reload();
                        }
                    }
                }
            });
        }
    }

    function managePhotos(id){
        window.managePhotosId = id;
        $('#managePhotoIdHidden').val(id)
        $.ajax({
                url: "{{ route('sites.manage_photos') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        // $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        if(res.length > 0){
                            html = ``;
                            $.each(res, function(key, value){
                                html += `<div class="col-md-3">
                                            <div class="box-image-pop-up">
                                                <div class="pop-close-image" onclick="del_image(${id}, ${key})">X</div>
                                                <a href="{{asset('storage')}}/${value}" target="_blank" title="View image"><img src="{{asset('storage')}}/${value}" width="100%" height="110px"></a>
                                            </div>
                                        </div>`;
                            })
                            $('#manageImagesDiv').html(html)
                        } else {
                            $('#manageImagesDiv').html('')
                        }
                        $('#imageCountDiv').html(`<h6 style='margin-left: 20px;font-style: italic;color: cornflowerblue;'>You have total ${res.length} image(s)</h6>`)
                        $('#manageImageModal').modal('show');
                    }
                }
            });
    }

    function del_image(id, key){
        if(confirm("Are You Sure to Delete this image? remember after this you will not get it back"))
        {
            $.ajax({
                url: "{{ route('sites.delete_photo') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, key: key, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        managePhotos(id)
                    }
                }
            });
        }
    }

    function del(id) {
        if(confirm("Are You Sure to Delete this Site? remember after this you will not get it back"))
        {
            $.ajax({
                url: location.href+'/'+id,
                type: "DELETE",
                dataType: "JSON",
                data : { _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        $.each(errors.responseJSON.errors, function(key,value){
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
                            DT.ajax.reload();
                        }
                    }
                }
            });
        }
    }

    function manageSlots(id){
        window.manageSiteId = id;
        $('#manageSiteIdHidden').val(id)
        $.ajax({
                url: "{{ route('sites.manage_slots') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        if(res.length > 0){
                            html = ``;
                            $.each(res, function(key, value){
                                html += `<tr>
                                            <td>${value.slot_name}</td>
                                            <td>${value.booking_time_span}</td>
                                            <td>${value.booking_slot_capacity}</td>
                                            <td>${value.green_to}</td>
                                            <td>${value.yellow_to}</td>
                                            <td>${value.red_to}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="editSlot(${value.id})">Edit</a>
                                                    </div>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm white d-none" title="Delete" onclick="delSlot(${value.id})">Delete</a>
                                            </td>
                                        </tr>`;
                            })
                            $('#slot-table-body').html(html)
                        } else {
                            $('#slot-table-body').html('')
                        }
                        $('#slotCountDiv').html(`<h6 style='margin-left: 20px;font-style: italic;color: cornflowerblue;'>You have total ${res.length} slot(s)</h6>`)
                        $('#manageSlotModal').modal('show');
                    }
                }
            });
    }

    $("#addSlotForm").submit(function(){
        var capacity = parseInt($("[name='booking_slot_capacity']").val());
        var green = parseInt($("[name='green_to']").val());
        var yellow = parseInt($("[name='yellow_to']").val());
        var red = parseInt($("[name='red_to']").val());

        if((green+yellow+red) > capacity){
            toastr['error']("3 limits should less or equal to booking slot capacity");
            return false
        }
        if(green < yellow && yellow < red && green < red){
            return true;
        } else {
            toastr['error']("limits should be Green < Yellow < Red");
            return false;
        }

    });

    function editSlot(id){
        $.ajax({
            url: "{{ route('sites.edit_slot') }}",
            type: "POST",
            dataType: "JSON",
            data : { id:id, _token : '{{ csrf_token() }}' },
            statusCode: {
                422: function(errors) {

                },
                500: function (error) {
                    toastr['error'](errorMsg[500]);
                },
                200: function (res) {
                    $('#editSlotModal [name="booking_time_span"]').val(res.booking_time_span);
                    $('#editSlotModal [name="booking_slot_capacity"]').val(res.booking_slot_capacity);
                    $('#editSlotModal [name="slot_name"]').val(res.slot_name);
                    $('#editSlotModal [name="green_to"]').val(res.green_to);
                    $('#editSlotModal [name="yellow_to"]').val(res.yellow_to);
                    $('#editSlotModal [name="red_to"]').val(res.red_to);
                    $('#editSlotModal [name="slot_id"]').val(res.id);
                    $('#editSlotModal [name="site_id"]').val(res.site_id);

                    $('#editSlotModal').modal('show');
                }
            }
        });
    }

    function delSlot(id) {

    }

</script>


<script>
    window.incIndex = 0;
    window.DT = $('#dt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": location.href,
        columns:[
            {
                data: 'id',
                name : 'id',
                render: function(data, type, full, meta) {
                    return meta.settings._iDisplayStart+meta.row+1;

                }
            },
            {
                data: 'booking_no',
                name : 'booking_no',
                orderable:false

            },
            {
                data: 'date',
                name : 'date',
                orderable:false

            },
            {
                data: 'person_name',
                name : 'person_name',
                orderable:false

            },
            {
                data: 'person_number',
                name : 'person_number',
                orderable:false

            },
            {
                data: 'guide_name',
                name : 'guide_name',
                orderable:false

            },
            {
                data: 'guide_number',
                name : 'guide_number',
                orderable:false

            },
            {
                data: 'visit_type',
                name : 'visit_type',
                orderable:false
            },
            {
                data: 'totalFees',
                name : 'totalFees',
                orderable:false
            },
            {
                data: 'action',
                name : 'action',
                orderable:false
            }
        ]
    });

    DT.on('preDraw', function() {
        incIndex = 0;
    })

    


</script>
@endpush
