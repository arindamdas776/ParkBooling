@extends('common.backend.layout')
@section('title', 'Entities Create')
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
    .topbar{
        z-index: 1000 !important;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css"/>
@endpush
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Entities</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('entities.index') }}">Entities</a></li>
                    <li class="breadcrumb-item active text-white">Create New</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12" >
                <div id="errorDiv" style="width:100%;"></div>
            </div>
            <div class="col-lg-12">
                <form action="{{route('entities.store')}}" id="addForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <input class="form-control" type="text" name="type" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fees (ﻗﯿﻤﺔ اﻟﺤﻖ اﻟﺴﻨﻮي)</label>
                                <input class="form-control numeric" type="tel" placeholder="Enter Fees" name="fees" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Average Annual (اﻟﻤﺘﻮﺳﻂ اﻟﺴﻨﻮي ﻟﻘﯿﻤﺔ ﺗﻜﺎﻟﯿﻒ اﻟﺤﻤﺎﯾﺔ ﻟﻠﻤﻮارد اﻟﻄﺒﯿﻌﯿﺔ)</label>
                                <input class="form-control" onkeypress="return isNumberKey(this, event);" type="tel" placeholder="Enter Annual average" name="annual_average" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Annual protection fees (ﻣﻌﺎﻣﻞ ﺗﻜﺎﻟﯿﻒ اﻟﺤﻤﺎﯾﺔ اﻟﺴﻨﻮﯾﺔ ﻟﻠﻤﻮارد)</label>
                                <input class="form-control numeric" type="tel" placeholder="Enter annual protection fees" name="annual_protection_fees" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Annual allowed tickets (اﻷﺳﺎﺳﯿﺔ اﻟﺸﺮاﺋﺢ)</label>
                                <input class="form-control numeric" type="tel" placeholder="Enter annual allowed tickets" name="annual_allowed_tickets" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Extra ticket category (Range of number of tickets) (اﻹﺿﺎﻓﯿﺔ اﻟﺸﺮاﺋﺢ)</label>
                                <input class="form-control numeric" type="tel" placeholder="Enter extra ticket category" name="extra_ticket_category" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Extra Ticket category fees (Range of number of tickets) (اﻹﺿﺎﻓﯿﺔ اﻟﺸﺮاﺋﺢ)</label>
                                <input class="form-control numeric" type="tel" placeholder="Extra Ticket category fees" name="extra_ticket_category_fees" required>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="btn-group">
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
<script>
    
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
                window.location.href= '{{ route('entities.index') }}';
            }
        }
    });

</script>
@endpush
