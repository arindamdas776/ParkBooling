@extends('common.backend.layout')
@section('title', 'Profile')
@section('product_title', config('app.name'))
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-white">Profile</h3>
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a class="text-white" href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active text-white">Profile</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                </div>
            </div>

            @if($errors->any() || session()->has('message'))
                <div class="row mt-low">
                    <div class="col-lg-12">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="alert-heading font-size-h4 font-w400">Error</h3>
                                <p class="mb-0">{{ $errors->first() }}</p>
                            </div>
                        @endif

                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="alert-heading font-size-h4 font-w400">Success</h3>
                                <p class="mb-0">{{ session()->get('message') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="row">

                {{-- Personal Info Update --}}
                <div class="col-lg-6 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-left mb-3"><i class="mdi mdi-face-profile"></i> Personal Info</h3>

                                    <form action="profile" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name" class="badge badge-primary">Email: {{ $user->email }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <img src="{{$user->photo ? asset('storage/'.$user->photo) : asset('assets/images/dummy-avatar.png')}}" alt="Profile photo" style="width:100px;">
                                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Full name <code>*</code></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Please enter your name" value="{{ $user->name }}">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Mobile No <code>*</code></label>
                                                    <input type="text" class="form-control numeric" id="mobile" name="mobile" placeholder="Please enter your mobile no" maxlength="20" value="{{ $user->mobile }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Password Update --}}
                <div class="col-lg-6 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-12">
                                <div>
                                    <h3 class="card-title text-left mb-3"><i class="mdi mdi-key"></i> Update Password</h3>

                                    <form action="profile" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('patch') }}
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Old Password</label>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="new_password">New Password</label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cnf_new_password">Confirm New Password</label>
                                                    <input type="password" class="form-control" id="cnf_new_password" name="cnf_new_password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('common.backend.footer')

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
@endpush
