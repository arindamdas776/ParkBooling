@extends('common.backend.layout')
@section('title', 'Entities')
@section('product_title', config('app.name'))
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Entities</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Entities</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center"> </div>
        </div>
        <div class="row mt-low">`
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Records</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right" style="float:right;">
                                    @if ($permission->c)
                                        <button class="btn waves-effect waves-light btn-rounded btn-info"
                                            onclick="window.location.href='{{route('entities.create')}}'"><i
                                                class="fa fa-plus"></i> Add</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Type")}}</th>
                                        <th>{{__("Name")}}</th>
                                        <th>{{__("Usage rights fees")}} {{__("(USD)")}}</th>
                                        <th>{{__("Average Annual")}} {{__("(USD)")}}</th>
                                        <th>{{__("Protection cost coefficient of natural resources")}} {{__("(USD)")}}
                                        </th>
                                        <th>{{__("Annual Allowed Tickets")}}</th>
                                        <th>{{__("Extra Ticket Category")}}</th>
                                        <th>{{__("Date/Time")}}</th>
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
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
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
            data: 'fees',
            name : 'Fees',
            orderable:false

        },{
            data: 'annual_average',
            name : 'Annual Average',
            orderable:false

        },{
            data: 'annual_protection_fees',
            name : 'Annual Protection Fees',
            orderable:false

        },{
            data: 'annual_allowed_tickets',
            name : 'Annual Allowed Tickets',
            orderable:false

        },{
            data: 'extra_ticket_category',
            name : 'Extra Ticket Category',
            orderable:false

        },{
            data: 'created_at',
            name : 'Date/Time',
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
    function changeStatus(id) {
        if(confirm("Are You Sure to do this action?"))
        {
            $.ajax({
                url: location.href+'/change_status/'+id,
                type: "PUT",
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
            window.location.href = `${location.href}/${id}/edit`;
        }
    }

    function del(id) {
        if(confirm("Are You Sure to delete this action?"))
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