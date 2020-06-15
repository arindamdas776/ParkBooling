@extends('common.backend.layout')
@section('title', __("Group"))
@section('product_title', config('app.name'))

@push('style')
    <style>
        
	.checkbox input[type=checkbox],
	.checkbox-inline input[type=checkbox],
	.radio input[type=radio],
	.radio-inline input[type=radio],
	[type=radio]:not(:checked),
	[type=radio]:checked {
		position: initial;
		left: 0px;
		opacity: 11;
	}

    .modal-sm {
        max-width: 365px;
    }    

    </style>
@endpush
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">{{__("Groups")}}</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">{{__("Home")}}</a></li>
                    <li class="breadcrumb-item active text-white">{{__("Groups")}}</li>
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
                                <h4 class="card-title">{{__("Records")}}</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right" style="float:right;">
                                    <button class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> {{__("Add")}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("Description")}}</th>
                                        <th>{{__("Status")}}</th>
                                        <th></th>
                                        <th>{{__("Action")}}</th>
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

        <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">{{__("Add Group")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{route('groups.store')}}" id="addForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__("Name")}} <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="{{__("Enter Full Name")}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__("Description")}}</label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="{{__("Enter Description")}}"></textarea>
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__("Approval Status")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="radio" name="employee_status" value="0"> {{__("	Committee")}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" name="employee_status" value="1"> {{__("CEO")}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" name="employee_status" value=""> {{__("None")}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="saveBtn" class="btn btn-info waves-effect">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">{{__("Edit Group")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="" id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivEdit"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="">{{__("Name")}} <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__("Description")}}</label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__("Approval Status")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="radio" id="employee_status" name="employee_status" value="0"> {{__("	Committee")}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" id="ceo_status" name="employee_status" value="1"> {{__("CEO")}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" id="none_status" name="employee_status" value=""> {{__("None")}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="editBtn" class="btn btn-info waves-effect">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        
        <footer class="footer">
            © {{date('Y')}} Admin
        </footer>
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
    function edit(id) {
        // $('#editModal').modal('show');

        $('#editForm').attr('action',location.href + '/' + id)
        $.ajax({
            url: location.href + '/' + id + '/edit',
            type : 'get',
            dataType: 'json',
            success: function(arg) {
                $('#editModal input[name="name"]').val(arg.name);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="id"]').val(arg.id);
                if(arg.employee_status) {
                    $('#employee_status').prop('checked', true);
                } else if(arg.ceo_status) {
                    $('#ceo_status').prop('checked', true);
                } else {
                    $('#employee_status').prop('checked', false);
                    $('#ceo_status').prop('checked', false);
                    $('#none_status').prop('checked', true);

                }
                // $.each(arg, function(i, row) {
                //     var elem = $('#editForm [name="' + i + '"]');
                //     elem.val(row);
                // });
            }
        });
        $('#editModal').modal('show');
    }

    function changeStatus(id) {
        if(confirm("Are You Sure to Change status of this Status?"))
        {
            $.ajax({
                url: "{{ route('groups.change_status') }}",
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
                        toastr['error'](error);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        if(res.type == 'success'){
                            location.reload();
                        }
                    }
                }
            });
        }
    }
    
    function del(id, elem) {
        if (confirm('Are you sure want to perform this action?')) {
            $(elem).closest('tr').remove();
            toastr['success']('Deleted');
        }
    }  

    function del(id) {
        if(confirm("Are You Sure to Delete this Group? remember after this you will not get it back"))
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
                            html = value;
                        });
                        toastr['error'](html);

                        // console.log(html);
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
                            location.reload();
                        }
                    }
                }
            });
        }
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
                data: 'name',
                name : 'name',
                orderable:false

            },
            {
                data: 'description',
                name : 'description',
                orderable:false

            },
            {
                data: 'is_active',
                name : 'is_active',
                orderable:false
            },
            {
                data: 'rolechange',
                name : 'rolechange',
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
    $('#addForm').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';
                $.each(errors.responseJSON.errors.validation_error, function(key,value){
                    html += `${value}<br/>`;
                });
                toastr['error'](html);
            },
            500: function (error) {
                toastr['error'](error.responseJSON.message);
            },
            200: function (res) {
                // console.log('asasas');
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    location.reload();
                    // window.location.href = `{{url('/my-company')}}`;
                }
            }
        }
    });

    $('#editForm').ajaxForm({
        statusCode: {
            422: function(errors) {
                var html = '';
                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDivEdit').html(html);
                $('#errorDivEdit').fadeIn();
            },
            500: function (error) {
                $('#errorDivEdit').html(error);
                $('#errorDivEdit').fadeIn();
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    location.reload();
                }
            }
        }
    });
</script>
@endpush