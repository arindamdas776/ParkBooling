@extends('common.backend.layout')
@section('title', 'Organization')
@section('product_title', config('app.name'))
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Organization</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Organization</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center"> </div>
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
                                    {{-- <button class="btn waves-effect waves-light btn-rounded btn-info" onclick="window.location.href='{{route('entities.create')}}'"><i class="fa fa-plus"></i> Add</button> --}}
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
                                        <th>Date/Time</th>
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

        <footer class="footer">
            © {{date('Y')}} Admin
        </footer>
    </div>
</div>

<div id="changeStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Change Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                    id="changeStatusCloseButton">×</button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errorDiv"></div>
                        </div>
                        <input type="hidden" name="site_id" id="manageSiteIdHidden">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Comment<code>*</code></label>
                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="6" placeholder="Enter Comments..." required></textarea>
                            </div>
                        </div>                                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning waves-effect"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn waves-effect" onclick="changeStatusFn(this)" id="changeStatusBtn">Save</button>
                </div>
        </div>
    </div>
</div>

<div id="logStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Status History</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                    id="logStatusCloseButton">×</button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errorDiv"></div>
                        </div>
                        
                        <div class="col-md-12">
                            <div id="logInfo"></div>
                        </div>                                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning waves-effect"
                        data-dismiss="modal">Close</button>                    
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
    window.incIndex = 0;
    window.DT = $('#dt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": location.href,
        columns:[{
            data: 'id',
            name : 'id',
            render: function(data, type, full, meta) {
                return meta.settings._iDisplayStart+meta.row+1;

            }
        },{
            data: 'name',
            name : 'Name',
            orderable:false

        },{
            data: 'email',
            name : 'Email',
            orderable:false

        },{
            data: 'created_at',
            name : 'created_at',
            orderable:false
        },{
            data: 'action',
            name : 'action',
            orderable:false
        }],
    });
    DT.on('preDraw', function() {
        incIndex = 0;
    })
</script>
<script>
    function changeStatusFn(elem) {
        if(confirm("Are You Sure to do this action?"))
        {
            comment = $('#comment').val();
            $(elem).attr('disabled', true);
            $.ajax({
                url: location.href+'/change_status/',
                type: "POST",
                dataType: "JSON",
                data : { id: id, comment, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        var html = '';
                        $.each(errors.responseJSON.errors, function(key,value){
                            html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        });
                        $('#errorDiv').html(html);
                        $('#errorDiv').fadeIn();
                        $(elem).attr('disabled', false);

                    },
                    500: function (error) {
                        toastr['error'](error);
                        $(elem).attr('disabled', false);

                    },
                    403: function(error) {
                        toastr['error']('Oops! Access is forbidden');

                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        if(res.type == 'success'){
                            DT.ajax.reload();
                        }
                        $(elem).attr('disabled', false);
                        $('#changeStatus').modal('hide');
                    }
                }
            });
        }
    }
    function changeStatus(id,active,elem) {
        window.id = id;
        $('#comment').val('');
        $('#errorDiv').html('');
        if(active == 1) {
            $('#changeStatusBtn').removeClass('btn-success').addClass('btn-warning').text('Inactive');
        } else {
            $('#changeStatusBtn').removeClass('btn-warning').addClass('btn-success').text('Active');
        }
        $('#changeStatus').modal('show');
        
    }

    function statusLog(id) {
        $('#logStatus').modal('show');
        $.ajax({
            url: location.href+'/status_logs/'+id,
            type: "GET",
            dataType: "JSON",
            statusCode: {
                422: function(errors) {
                    var html = '';
                    $.each(errors.responseJSON.errors, function(key,value){
                        html = value;
                    });
                    toastr['error'](html);
                    // $('#errorDiv').html(html);
                    // $('#errorDiv').fadeIn();
                    $(elem).attr('disabled', false);

                },
                403: function(error) {
                    $('#logInfo').html('<h3>Oops! Access is Forbidden.</h3>');

                },
                500: function (error) {
                    toastr['error'](error);
                    $(elem).attr('disabled', false);

                },
                200: function (res) {
                    console.log(res);
                    $('#logInfo').html(res.data);
                }
            }
        });
    }
</script>
@endpush
