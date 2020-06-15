@extends('common.backend.layout')
@section('title', 'Vessels')
@section('product_title', config('app.name'))
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Vessels</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Vessels</li>
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
                                @if ($permission->c)
                                    <div class="pull-right" style="float:right;">
                                        <button class="btn waves-effect waves-light btn-rounded btn-info"
                                            onclick="window.location.href='{{route('vessels.create')}}'"><i
                                                class="fa fa-plus"></i> Add</button>
                                    </div>
                                    
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Safary Ticket Price (in USD)</th>
                                        <th>Ticket Price (in USD)</th>
                                        <th>Ticket Price (in EGP)</th>
                                        {{-- <th>Child Ticket Price (in USD)</th>
                                        <th>Child Ticket Price (in EGP)</th> --}}
                                        
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

        <footer class="footer">
            © {{date('Y')}} Admin
        </footer>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
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
            data: 'type',
            name : 'Type',
            orderable:false

        },{
            data: 'name',
            name : 'Name',
            orderable:false

        },{
            data: 'logo',
            name : 'Logo',
            orderable:false

        },{
            data:'Safari_ticket_price_usd',
            name:'Safari_ticket_price_usd',
            orderable:false
        },{
            data: 'ticket_price_usd',
            name : 'ticket_price_usd',
            orderable:false

        },{
            data: 'ticket_price_egp',
            name : 'ticket_price_egp',
            orderable:false

        },{
            data: 'status',
            name : 'status',
            orderable:false
        },{
            data: 'action',
            name : 'action',
            orderable:false
        }]
    });
    DT.on('preDraw', function() {
        incIndex = 0;
    })
</script>
<script>
    function del(id) {
        if(confirm("Are You Sure to Delete this Vessel? remember after this you will not get it back"))
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
                            html  =value;
                            // html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        });
                        toastr['error'](html);
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
                            DT.ajax.reload();
                        }
                    }
                }
            });
        }
    }
</script>
@endpush