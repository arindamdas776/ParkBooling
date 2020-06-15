@extends('common.backend.layout')
@section('title', 'Vessels Create')
@section('product_title', config('app.name'))
@section('content')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Vessels</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('vessels.index') }}">Vessels</a>
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
                <form action="{{route('vessels.store')}}" id="addForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{__("Name")}}</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Name (Arabic)")}}</label>
                                <input class="form-control" type="text" name="name_arabic" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Logo")}}</label>
                                <input class="form-control" type="file" accept="image/*" name="logo" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Description")}}</label>
                                <input class="form-control" type="text" name="description" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Description (Arabic)")}}</label>
                                <input class="form-control" type="text" name="description_arabic" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Type")}}</label>
                                <input class="form-control" type="text" name="type" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Port")}}</label>
                                <select class="form-control select2" name="port">
                                    <option></option>
                                    @foreach ($ports as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Craft")}}</label>
                                <select class="form-control select2" name="craft">
                                    <option></option>
                                    @foreach ($crafts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Length")}}</label>
                                <select class="form-control select2" name="length">
                                    <option></option>
                                    @foreach ($lengths as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label class="form-label">{{__("Ticket price (in USD)")}}</label>
                                <input class="form-control numeric" type="tel" name="ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Ticket price (in EGP)")}}</label>
                                <input class="form-control numeric" type="tel" name="ticket_price_egp">
                            </div>
                             <div class="form-group">
                                <label class="form-label"> {{_("Safari ticket price (in USD)")}}</label>
                                <input class="form-control numeric" type="tel" name="Safari_ticket_price_usd">
                            </div>

                            {{-- <div class="form-group">
                                <label class="form-label">Adult Ticket price (in USD)</label>
                                <input class="form-control numeric" type="tel" name="adult_ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Adult Ticket price (in EGP)</label>
                                <input class="form-control numeric" type="tel" name="adult_ticket_price_egp">
                            </div>
                             <div class="form-group">
                                <label class="form-label"> Safari ticket price (in USD)</label>
                                <input class="form-control numeric" type="tel" name="Safari_ticket_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Child ticket price (in USD)</label>
                                <input class="form-control numeric" type="tel" name="child_tikcet_price_usd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Child ticket price (in EGP)</label>
                                <input class="form-control numeric" type="tel" name="child_tikcet_price_egp">
                            </div> --}}
                            <div class="form-group">
                                <label class="form-label">{{__("Vessel type")}}</label>
                                <select class="form-control" name="construction_type">
                                    <option value="Safari">Safari</option>
                                    <option value="Marine">Marine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="btn-group">
                                <button class="btn btn-warning" type="button" onclick="window.location.href='{{url('vessels')}}'">
                                    <i class="fa fa-fw fa-lg fa-times"></i>Close
                                </button>
                                &nbsp;&nbsp;
                                <button class="btn btn-primary" type="submit">
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
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select item",
            allowClear: true
        });
    });

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
                $('html,body').scrollTop(0);
            },
            500: function (error) {
                toastr['error'](error.responseJSON.message);
            },
            200: function (res) {
                $('#errorDiv').fadeOut();
                toastr[res.type](res.text);
                window.location.href= '{{ route('vessels.index') }}';
            }
        }
    });
</script>
@endpush