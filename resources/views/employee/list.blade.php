@extends('common.backend.layout')
@section('title', 'Employee')
@section('product_title', config('app.name'))
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Employees</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Employees</li>
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
                                <h4 class="card-title">Records</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right" style="float:right;">
                                    <button class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Add New Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{route('employees.store')}}" id="addForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number <code>*</code></label>
                                        <div class="input-group">
                                            {{-- <input type="number" class="form-control required extension" style="max-width: 100px; width:15%;" minlength="1" maxlength="3" min="0" name="extension" value="" readonly="true">
                                            <span class="input-group-addon" style="width:85%;"> --}}
                                                <input type="text" minlength="4" maxlength="12" class="form-control numeric" name="mobile" placeholder="Enter Mobile Number" value="">
                                            {{-- </span> --}}
                                        </div>
                                        <span class="errmsg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <code>*</code></label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Role <code>*</code></label>
                                        <select name="emp_role" class="form-control" required>
                                            <option value="other" selected="">Select</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Edit Employee</h4>
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
                                <div class="col-md-6">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number <code>*</code></label>
                                        <div class="input-group">
                                            {{-- <input type="number" class="form-control required extension" style="max-width: 100px; width:15%;" minlength="1" maxlength="3" min="0" name="extension" value="" readonly="true">
                                            <span class="input-group-addon" style="width:85%;"> --}}
                                                <input type="text" minlength="4" maxlength="12" class="form-control numeric" name="mobile" placeholder="Enter Mobile Number" value="">
                                            {{-- </span> --}}
                                        </div>
                                        <span class="errmsg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <code>*</code></label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Role <code>*</code></label>
                                        <select name="emp_role" class="form-control" required>
                                            <option value="other" selected="">Select</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
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
            © 2019 Admin
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
                $('#editModal input[name="email"]').val(arg.email);
                $('#editModal input[name="mobile"]').val(arg.phone);
                $('#editModal select[name="emp_role"]').val(arg.role_id);
                $('#editModal [name="id"]').val(arg.id);
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
                url: "{{ route('employees.change_status') }}",
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
        if(confirm("Are You Sure to Delete this Employee? remember after this you will not get it back"))
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
                            location.reload();
                        }
                    }
                }
            });
        }
    }      
</script> 


<script>
    window.DT = $('#dt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": location.href,
        columns:[
            {
                data: 'id',
                name : 'id',
            },
            {
                data: 'name',
                name : 'name',
                orderable:false

            },
            {
                data: 'email',
                name : 'email',
                orderable:false

            },
            {
                data: 'phone',
                name : 'phone',
                orderable:false

            },
            {
                data: 'role_name',
                name : 'role_name',
                orderable:false

            },
            {
                data: 'is_active',
                name : 'is_active',
                orderable:false
            },
            {
                data: 'action',
                name : 'action',
                orderable:false
            }
        ]
    });

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