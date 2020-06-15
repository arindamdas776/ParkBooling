@extends('common.backend.layout')
@section('title', 'News & Events')
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
                <h3 class="text-white">News & Events</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">News & Events</li>
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
                                <button class="btn waves-effect waves-light btn-rounded btn-info" onclick="window.location.href='{{route('newsevents.create')}}'"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Title")}}</th>
                                        <th>{{__("Description")}}</th>
                                        <th>{{__("Image")}}</th>
                                        <th>{{__("Type")}}</th>
                                        <th>{{__("Status")}}</th>
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

        
        <footer class="footer">
            © {{ date('Y') }} Admin
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

    $(document).ready(function() {
        $('#addFormSites, #editFormSites').select2();
    });


	function del(slug) {
		if(confirm("Are You Sure to Delete this Page? remember after this you will not get it back")){
			$.ajax({
				url: location.href+'/'+slug,
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
						toastr["error"]("500 Internal Server Error", error.responseJSON.message);
					},
					200: function (res) {
						toastr["success"](res.text);
						location.reload();
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
                data: 'title',
                name : 'title',
                orderable:false

            },
            {
                data: 'short_description',
                name : 'short_description',
                orderable:false

            },
            {
                data: 'image',
                name : 'image',
                orderable:false

            },
            {
                data: 'type',
                name : 'type',
                orderable:false

            },
            {
                data: 'status',
                name : 'status',
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

                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDiv').html(html);
                $('#errorDiv').fadeIn();
            },
            500: function (error) {
                toastr['error'](error.responseJSON.message);
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    DT.ajax.reload();
                    $("#addModalCloseButton").trigger('click');
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
                    DT.ajax.reload();
                    $("#editModalCloseButton").trigger('click');
                }
            }
        }
    });


</script>

<script>
    function changeStatus(id) {
        if(confirm("Are You Sure to do this action?"))
        {
            $.ajax({
                url: location.href+'/change_status/',
                type: "POST",
                dataType: "JSON",
                data : { id: id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = value;
                        });
                        toastr['error'](html);
                        $('#errorDiv').html(html);
                        $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](error);
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

    function del(id, elem) {
        if(confirm("Are you sure want to delete, this action cannot be undone?")) {
            $.ajax({
                url: location.href+"/"+id,
                type: "DELETE",
                dataType: "JSON",
                data : { id: id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = value;
                        });
                        toastr['error'](html);
                        $('#errorDiv').html(html);
                        $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](error);
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

    function edit(id, elem) {
        if(confirm('Are you sure want to edit?')) {
            window.location.href=`${location.href}/${id}/edit`;
        }
    }
    
</script>
@endpush
