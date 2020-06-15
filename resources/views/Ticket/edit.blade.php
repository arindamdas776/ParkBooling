@extends('common.backend.layout')
@section('title', 'TicketS Edit')
@section('product_title', config('app.name'))
@section('content')
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="buttonLoader.css" rel="stylesheet">

@endpush
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Ticket Create</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('Vehicles.index') }}">Vehicles</a>
                    </li>
                    <li class="breadcrumb-item active text-white">Create New</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="errorDiv" style="width:100%;"></div>
            </div>
            <div class="col-lg-12">
                <form   id="addForm" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{__("Name")}}</label>
                                <input class="form-control" type="text" name="name" value="{{$result->name}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__(" Name (Arabic)")}}</label>
                                <input class="form-control" type="text" name="name_arabic" value="{{$result->name_arabic}}" required>
                            </div>
                            
                          
                            <div class="form-group">
                                <label class="form-label">{{__("Protected Area")}}</label>
                                <select class="form-control select2" name="protect_area">
                                    <option></option>
                                    @foreach ($protected_area as $item)
                                    <option value="{{ $item->id }}" selected >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
        

                            <div class="form-group">
                                <label class="form-label">{{__("Daily Ticket price (in USD)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->daily_ticket_price_usd}}" name="daily_ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__(" Daily Ticket price (in EGP)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->daily_ticket_price_egp}}" name="daily_ticket_price_egp">
                            </div>
                             <div class="form-group">
                                <label class="form-label"> {{_("Safari ticket price (in USD)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->safari_ticket_price_usd}}" name="Safari_ticket_price_usd">
                            </div> <div class="form-group">
                                <label class="form-label"> {{_("Safari ticket price (in EGP)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->safari_ticket_price_egp}}" name="Safari_ticket_price_egp">
                            </div>

                              <div class="form-group">
                                <label class="form-label">{{__("Visit Type")}}</label>
                                
                    <select class="form-control select2"  name="visit_type">
                                   <option >Select</option> 
                                <option value="marine_safari">marine safari</option> 
                                   <option value="land_faily">land daily</option> 
                                   <option value="lanf_safari">land safari</option> 
                                    
                                </select>    
                                
                            </div>

                             <div class="form-group">
                                <label class="form-label">{{__("Adult Ticket price (in USD)")}}</label>
                                <input class="form-control numeric" value="{{$result->adult_ticket_price_usd}}" type="tel" name="adult_ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Adult Ticket price (in EGP)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->adult_ticket_price_egp}}" name="adult_ticket_price_egp">
                            </div>
                         
                            <div class="form-group">
                                <label class="form-label">{{__("Child ticket price (in USD)")}}</label>
                                <input class="form-control numeric" type="tel" value="{{$result->child_ticket_price_usd}}" name="child_ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Child ticket price (in EGP)")}}</label>
                                <input class="form-control numeric" type="tel"  value="{{$result->child_ticket_price_egp}}" name="child_tikcet_price_egp">
                            </div> 
                           <!--  <div class="form-group">
                                <label class="form-label">{{__("Vessel type")}}</label>
                                <select class="form-control" name="construction_type">
                                    <option value="Safari">Safari</option>
                                    <option value="Marine">Marine</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="btn-group">
                                <button class="btn btn-warning" type="button" onclick="window.location.href='{{url('Ticket')}}'">
                                    <i class="fa fa-fw fa-lg fa-times"></i>Close
                                </button>
                                &nbsp;&nbsp;
                                <input type="hidden" value="{{$result->id}}" id="input_id">
                                <button class="btn btn-primary" type="submit" id="create_ticket">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer">
            © {{date('Y')}} Admin
        </footer>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="jquery.buttonLoader.js"></script>

<script>
 $(document).ready(function(){
    $('#addForm').on('submit', function(event){
        event.preventDefault();
        
        var formData = new FormData(this);
         formData.append('token','{{csrf_token()}}');
        var id = $('#input_id').val();
        

        $.ajax({
            url:"/Ticket/"+id,
           method:'POST',
           data:formData,
           dataType:'JSON',
           contentType:false,
           processData:false,
           cache:false,

           success:function(data){
            if(data.success){
                setTimeout(function(){
                    window.location.href = "{{route('Ticket.index')}}";
                },2000);
            }
           }
        })
    });
 });
</script>

<script type="text/javascript">
      $('.select2').select2();
</script>
@endpush