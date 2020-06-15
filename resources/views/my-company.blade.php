@extends('common.backend.layout')
@section('title', __('Dashboard'))
@section('product_title', config('app.name'))
@section('content')
@push('style')
    <style>
        /* .topbar.is_stuck {
            width: 100%;
        }
        #main-wrapper {
            width: 107% !important;
        }

        .mini-sidebar .page-wrapper {
            margin-left: 10px !important;
        } */
        /* @media (min-width: 768px) {
            .mini-sidebar .page-wrapper {
                margin-left: 150px !important;
            }
        } */
        .select2 {
            width: 100% !important;
        }
    </style>
@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" crossorigin="anonymous" />
    <!-- Modal -->
    <div id="addCompanyModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">{{__('ADD Application')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="errorDiv" class="bg-danger text-white" style="display: none; width: 100%;"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{__('Registration Type')}} <code>*</code></label> <br/>
                            <select name="reg_type" class="form-control select2">
                            <option value="">{{__('Select')}}</option>
                            <option value="section1">{{__('Marine units')}}</option>
                            <option value="section2">{{__('Dive centers')}}</option>
                            <option value="section3">{{__('Marine activity centers')}}</option>
                            <option value="section4">{{__('Tourist companies a')}}</option>
                            <option value="section5">{{__('Other entities and individuals')}}</option>
                                <option value="section6">{{__('Temporary activities (individual entities)')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-primary" id="appCreateBtn" onclick="addAppForm()">{{__('Submit')}}</button>
            </div>
        </div>

        </div>
    </div>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-white">{{__('Dashboard')}}</h3>
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a class="text-white" href="javascript:void(0)">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active text-white">{{__('Dashboard')}}</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                </div>
            </div>
            <div class="row mt-low">

                <div class="col-lg-3 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                            <h1 class=" text-center">23</h1>
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-center text-uppercase">{{__('Employees')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h1 class=" text-center">34</h1>
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-center text-uppercase">{{__('Permits')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h1 class=" text-center">100</h1>
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-center text-uppercase">{{__('Branches')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h1 class=" text-center">20</h1>
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-center text-uppercase">{{__('Tickets')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @if (Auth::guard('org')->check())
                <div class="row ">
                    <div class="col-lg-8">
                        <p>{{__('Applied Application No')}}</p>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-primary" onclick="addCompany()">{{__('ADD Application')}}</button>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Application No')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($application as $item)
                                    <tr>
                                        <td>
                                            @if($item->status == 'draft')
                                                <a target="_blank" href="{{url('/application/no')}}/{{$item->application_no}}">{{$item->application_no}}</a>
                                            @else
                                                <a target="_blank"  href="{{route('form.review', $item->application_no)}}">{{$item->application_no}}</a>
                                            @endif

                                        </td>
                                        <td>
                                            @if($item->status == 'review')
                                                {!! '<label for="" class="badge bg-danger text-white">'.ucwords(__($item->status)).'</label>' !!}
                                            @elseif($item->status == 'freject')
                                                {!! '<label for="" class="badge bg-danger text-white">'.ucwords(__('Rejected')).'</label>' !!}
                                            @elseif($item->ceo_status == 'lreject')
                                                {!! '<label for="" class="badge bg-danger text-white">'.ucwords(__('Rejected')).'</label>' !!}
                                            @elseif($item->status == 'fapprove')
                                                {!! '<label for="" class="badge bg-danger text-white">'.ucwords(__('Approved')).'</label>' !!}
                                            @elseif($item->ceo_status == 'lapprove')
                                                {!! '<label for="" class="badge bg-danger text-white">'.ucwords(__('Approved')).'</label>' !!}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 'draft')
                                                <a target="_blank"  class="btn btn-sm btn-primary" href="{{url('/application/no')}}/{{$item->application_no}}">{{__('EDIT')}}</a>
                                            @else
                                                <a target="_blank"  class="btn btn-sm btn-primary" href="{{route('form.review', $item->application_no)}}">{{__('REVIEW')}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Monthly Report')}}</h4>
                            <div id="bar-chart" style="height:400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                © {{date('Y')}} {{__('Admin')}}
            </footer>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3-master/c3.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/plugins/echarts/echarts-all.js') }}"></script>
    <script src="{{ asset('assets/plugins/echarts/echarts-init.js') }}"></script>
    <script>
        $(function() {
			$('.select2').select2();
		});

        function addCompany() {

            $('#addCompanyModal').modal('show');

        }

        function addAppForm() {
            if(confirm('{{__("Are you sure you want to perform the action, It will create the application form?")}}')) {
                $('#appCreateBtn').prop('disabled', true);
                var formData = new FormData();
                formData.append('regtype', $('[name="reg_type"]').find('option:selected').val());
                formData.append('regtype_text', $('[name="reg_type"]').find('option:selected').text());
                formData.append('_token', "{{csrf_token()}}");
                $.ajax({
                    url: "{{route('application.add')}}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    statusCode: {
                        422: function(errors) {
                            var html = '';

                            $.each(errors.responseJSON.errors.validation_error, function(key,value){
                                html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div >'+value+'</div></div>';
                            });

                            $('#errorDiv').html(html);
                            $('#errorDiv').fadeIn();
                            $('#successDiv').fadeOut();
                            $('#appCreateBtn').prop('disabled', false);
                            window.changeNext = false;
                        },
                        500: function (error) {
                            console.log(error);
                            window.changeNext = false;
                            $('#appCreateBtn').prop('disabled', false);
                        },
                        200: function (res) {
                            console.log(res.appno);
                            toastr['success'](res.text);
                            $('[name="reg_type"]').val("");
                            $('#appCreateBtn').prop('disabled', false);
                            $('#addCompanyModal').modal('hide');

                            window.location.href=  '{{url('application/no')}}'+'/'+res.appno;
                        }
                    }
                });
            }

        }
    </script>
@endpush
