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
                                            onclick="window.location.href='{{route('Vehicles.create')}}'"><i
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
                                        <th>Safary Ticket Price (in EGP)</th>
                                        <th>Protected Area</th>
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
            data: 'vehicle_name',
            name : 'vehicle_name',
            orderable:false

        },{
            data: 'logo',
            name : 'Logo',
            orderable:false

        },{
            data:'safari_ticket_price_USD',
            name:'safari_ticket_price_USD',
            orderable:false
        },{
            
            data:'safari_ticket_price_ESD',
            name:'safari_ticket_price_ESD',
            orderable:false
        },{
            
             data:'protected_area',
            name:'protected_area',
            orderable:false
        },{
            data: 'daily_ticket_price_ESD',
            name : 'daily_ticket_price_ESD',
            orderable:false

        },{
            data:'daily_ticket_price_usd',
            name:'daily_ticket_price_usd',
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
    function changeStatus(self){
        var id = self.getAttribute('data-id');
     // alert(id);
     // return;
        $.ajax({
            url:"/Vehicles/"+id,
            method:'GET',
            dataType:'JSON',

            success:function(data){
                if(data.success){
                    setTimeout(function() {
                         toastr['success'](data.messages);
                    }, 2000);
                    $('#dt').DataTable().ajax.reload();
                }else{
                    setTimeout(function(){
                         toastr['success'](data.messages);
                     }, 2000);
                    $('#dt').DataTable().ajax.reload();
                }
            }
        })
    }

    function editVehicles(self){
        var id = self.getAttribute('data-id');
        
        window.location.href="Vehicles/"+id+"/edit";        
    }

    function DeleteVehicles(self){
        var id = self.getAttribute('data-id');

        $.ajax({
            url:"/Vehicles/"+id,
            method:'DELETE',
            data:{_token:'{{csrf_token()}}'},
            dataType:'JSON',

            success:function(data){
                if(data.success){
                    toastr['success'](data.messages);

                    $('#dt').DataTable().ajax.reload();
                }
            }
        })
    }
    </script>
@endpush