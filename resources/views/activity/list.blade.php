@extends('common.backend.layout')
@section('title', 'Activity')
@section('product_title', config('app.name'))
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Activities</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">{{__("Activities")}}</li>
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
                                @if ($permission->c)
                                    <div class="pull-right" style="float:right;">
                                        <button class="btn waves-effect waves-light btn-rounded btn-info"
                                            data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>
                                            Add</button>
                                    </div>
                                    
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Description</th>
                                        <th>Type</th>
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
                        <h4 class="modal-title" id="vcenter">Add New Activity</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{route('activities.store')}}" id="addForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row" style="font-size: 14px;">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">
                                        <p>
                                            Image Mime type Should be jpg,jpeg,png
                                            <br/>
                                            Image Size maximum 10 M.B
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-danger" id="errorDiv" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Name (Arabic)")}} <code>*</code></label>
                                        <input type="text" name="name_arabic" class="form-control" placeholder="{{__("Name (Arabic)")}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Choose Logo </label>
                                        <div class="input-group">
                                            <input type="file" name="logo" class="form-control"
                                                placeholder="Enter the  Logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Type <code>*</code></label>
                                        <input type="text" name="type" class="form-control" placeholder="Type">
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="">{{__("The average annual value of the environmental impact of a single activity")}}
                                            {{__("(USD)")}}
                                            <code>*</code></label>
                                        <input type="text" name="annual_average" class="form-control"
                                            onkeypress="return isNumberKey(this, event);"
                                            placeholder="{{__("The average annual value of the environmental impact of a single activity")}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Environmental Impact Coefficient")}}
                                            {{__("(USD)")}}<code>*</code></label>
                                        <input type="text" name="environmental_effect" class="form-control"
                                            onkeypress="return isNumberKey(this, event);"
                                            placeholder="{{__("Environmental Impact Coefficient")}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__("Description")}}</label>
                                        <textarea class="form-control" name="description" id="" cols="30" rows="8"
                                            placeholder="{{__("Description")}}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Description (Arabic)")}}</label>
                                        <textarea class="form-control" name="description_arabic" id="" cols="30" rows="8"
                                            placeholder="{{__("Description (Arabic)")}}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">SEO Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="SEO Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">SEO Description </label>
                                        <input type="text" name="meta_description" class="form-control"
                                            placeholder="SEO Description">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
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
                        <h4 class="modal-title" id="vcenter">Edit Activities</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="" id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row" style="font-size: 14px;">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">
                                        <p>
                                            Image Mime type Should be jpg,jpeg,png
                                            <br/>
                                            Image Size maximum 10 M.B
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivEdit"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Name (Arabic)")}} <code>*</code></label>
                                        <input type="text" name="name_arabic" class="form-control" placeholder="{{__("Name (Arabic)")}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Edit Logo </label>
                                        <div class="input-group">
                                            <input type="file" name="logo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Type <code>*</code></label>
                                        <input type="text" name="type" class="form-control" placeholder="Type">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("The average annual value of the environmental impact of a single activity")}}
                                            {{__("(USD)")}} <code>*</code></label>
                                        <input type="text" name="annual_average" class="form-control"
                                            onkeypress="return isNumberKey(this, event);" placeholder="{{__("The average annual value of the environmental impact of a single activity")}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Environmental Impact Coefficient")}}
                                            {{__("(USD)")}}<code>*</code></label>
                                        <input type="text" name="environmental_effect" class="form-control"
                                            onkeypress="return isNumberKey(this, event);"
                                            placeholder="{{__("Environmental Impact Coefficient")}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">SEO Title </label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="SEO Title">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Previous Uploaded Image</label><br />
                                        <img id="editImage" src="" alt="" width="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Description")}}</label>
                                        <textarea class="form-control" name="description" id="" cols="30" rows="5"
                                            placeholder="{{__("Enter the description...")}}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__("Description (Arabic)")}}</label>
                                        <textarea class="form-control" name="description_arabic" id="" cols="30" rows="5"
                                            placeholder="{{__("Description (Arabic)")}}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">SEO Description</label>
                                        <textarea class="form-control" name="meta_description" id="" cols="30" rows="5"
                                            placeholder="Enter the SEO Description..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
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
{{-- <script src="http://malsup.github.com/jquery.form.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
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
                $('#editModal input[name="name_arabic"]').val(arg.name_arabic);
                $('#editModal [name="type"]').val(arg.type);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="description_arabic"]').val(arg.description_arabic);
                $('#editModal [name="id"]').val(arg.id);
                $('#editModal [name="meta_title"]').val(arg.meta_title);
                $('#editModal [name="meta_description"]').val(arg.meta_description);
                $('#editModal [name="annual_average"]').val(arg.annual_average);
                $('#editModal [name="environmental_effect"]').val(arg.environmental_effect);

                $('#editImage').attr('src', '{!! asset("storage/'+arg.logo+'") !!}')
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
                url: "{{ route('activities.change_status') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        var msg = '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                            msg = value;
                        });
                        toastr['error'](msg);
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
        if(confirm("Are You Sure to Delete this Activity? remember after this you will not get it back"))
        {
            $.ajax({
                url: location.href+'/'+id,
                type: "DELETE",
                dataType: "JSON",
                data : { _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        var msg=  '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                            msg = value;
                        });
                        toastr['error'](msg);
                        $('#errorDiv').html(html);
                        $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](errorMsg["500"]);
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
                data: 'logo_image',
                name : 'Logo',
                orderable:false

            },
            {
                data: 'description',
                name : 'description',
                orderable:false

            },
            {
                data: 'type',
                name : 'type',
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
                toastr['error'](errorMsg["500"]);
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
                $('#errorDivEdit').html(errorMsg["500"]);
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