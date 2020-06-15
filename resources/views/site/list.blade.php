@extends('common.backend.layout')
@section('title', 'Site')
@section('product_title', config('app.name'))
@section('content')
@push('style')
<link rel="stylesheet"
    href="{{ asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />

<style>
    .box-image-pop-up {
        width: 100%;
        margin: 10px 0px;
        position: relative
    }

    .pop-close-image {
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

    [name="green_to"]:focus,
    [name="yellow_to"]:focus,
    [name="red_to"]:focus {
        box-shadow: none;
    }
</style>
@endpush
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Site</h3>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Site</li>
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
                                @if ($permission->c)
                                <div class="pull-right" style="float:right;">
                                    <button class="btn waves-effect waves-light btn-rounded btn-info"
                                        data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>
                                        Add</button>
                                </div>
                                    
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Sites Daily capacity</th>
                                        <th>Annual capacity</th>
                                        {{-- <th>Geographical location type</th> --}}
                                        {{-- <th>{{__("Geographical location coefficient")}} {{__("(USD)")}}</th> --}}

                                        <th>Adult Ticket Price USD</th>
                                        <th>Adult Ticket Price EGP</th>
                                        <th>Child Ticket Price USD</th>
                                        <th>Child Ticket Price EGP</th>

                                        <th>Slots</th>
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

        <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Add New Site</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="addModalCloseButton">×</button>
                    </div>
                    <form action="{{route('sites.store')}}" id="addForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row" style="font-size: 14px;">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">
                                        <p>
                                            Image Mime type Should be jpg,jpeg,png
                                            <br/>
                                            Image Size maximum 10 M.B
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="errorDiv" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Site Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Activities <code>*</code></label>
                                        <select autocomplete="off" id="addFormActivities" name="activities[]"
                                            multiple="multiple" class="form-control" style="width: 100%;" required>
                                            @foreach ($activities as $activity)
                                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites Daily capacity <code>*</code></label>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control numeric"
                                                name="daily_capacity" placeholder="Enter Sites Daily capacity" value=""
                                                required>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Geographical location type <code>*</code></label>
                                        <select name="geo_location_type" class="form-control" required>
                                            <option value="" selected disabled>Geographical location type</option>
                                            <option value="Special protected sites">Special protected sites</option>
                                            <option value="Protected areas">Protected areas</option>
                                            <option value="Environmental management areas">Environmental management
                                                areas</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Location latitude <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="loc_lat"
                                                placeholder="Enter Location latitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location longitude <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="loc_lng"
                                                placeholder="Enter Location longitude" value="" required>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="">Video</label>
                                        <textarea name="video" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites Annual capacity <code>*</code></label>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control numeric"
                                                name="annual_capacity" placeholder="Enter Sites Annual capacity"
                                                value="" required>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">{{__("Geographical location coefficient")}} {{__("(USD)")}}
                                            <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="geo_location_fees"
                                                placeholder="{{__("Geographical location coefficient")}}"
                                                onkeypress="return isNumberKey(this, event);" value="" required>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="form-label">Adult Ticket price (in USD)</label>
                                        <input class="form-control numeric" type="tel" name="adult_ticket_price_usd">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Adult Ticket price (in EGP)</label>
                                        <input class="form-control numeric" type="tel" name="adult_ticket_price_egp">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Child ticket price (in USD)</label>
                                        <input class="form-control numeric" type="tel" name="child_tikcet_price_usd">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Child ticket price (in EGP)</label>
                                        <input class="form-control numeric" type="tel" name="child_tikcet_price_egp">
                                    </div>


                                    <div class="form-group">
                                        <label for="">Images/Photos </label>
                                        <input type="file" name="photos[]" class="form-control" multiple
                                            accept="image/*" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" id="saveBtn" class="btn btn-info waves-effect">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Edit Site</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="editModalCloseButton">×</button>
                    </div>
                    <form action="" id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivEdit"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Site Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Activities <code>*</code></label>
                                        <select autocomplete="off" id="editFormActivities" name="activities[]"
                                            multiple="multiple" class="form-control" style="width: 100%;" required>
                                            @foreach ($activities as $activity)
                                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites Daily capacity <code>*</code></label>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control numeric"
                                                name="daily_capacity" placeholder="Enter Sites Daily capacity" value=""
                                                required>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Geographical location type <code>*</code></label>
                                        <select name="geo_location_type" class="form-control" required>
                                            <option value="" selected disabled>Geographical location type</option>
                                            <option value="Special protected sites">Special protected sites</option>
                                            <option value="Protected areas">Protected areas</option>
                                            <option value="Environmental management areas">Environmental management
                                                areas</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Location latitude <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="loc_lat"
                                                placeholder="Enter Location latitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location longitude <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="loc_lng"
                                                placeholder="Enter Location longitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Video</label>
                                        <textarea name="video" class="form-control" rows="6"></textarea>
                                    </div>                                  
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites Annual capacity <code>*</code></label>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control numeric"
                                                name="annual_capacity" placeholder="Enter Sites Annual capacity"
                                                value="" required>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Geographical location fees(EGP) <code>*</code></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="geo_location_fees"
                                                placeholder="Enter Geographical location fees" value=""
                                                onkeypress="return isNumberKey(this, event);" required>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="form-label">Adult Ticket price (in USD)</label>
                                        <input class="form-control numeric" type="tel" name="adult_ticket_price_usd">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Adult Ticket price (in EGP)</label>
                                        <input class="form-control numeric" type="tel" name="adult_ticket_price_egp">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Child ticket price (in USD)</label>
                                        <input class="form-control numeric" type="tel" name="child_tikcet_price_usd">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Child ticket price (in EGP)</label>
                                        <input class="form-control numeric" type="tel" name="child_tikcet_price_egp">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" id="editBtn" class="btn btn-info waves-effect">Edit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div id="manageImageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">                    
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Manage Images</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="manageImageModalCloseButton">×</button>
                    </div>
                    <form action="{{route('sites.upload_photos')}}" id="imageUploadForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row" style="font-size: 14px;">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">
                                        <p>
                                            Image Mime type Should be jpg,jpeg,png
                                            <br/>
                                            Image Size maximum 10 M.B
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="imageCountDiv">
                            </div>
                            <div class="row" id="manageImagesDiv">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivUploadPhotos"></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 25px;justify-content: center;align-items: flex-end;">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="managePhotoIdHidden">
                                    <div class="form-group">
                                        <label for="">Upload new images <code>*</code></label>
                                        <input type="file" name="photos[]" class="form-control" id="managePhotosFile"
                                            multiple required accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="imageUploadBtn"
                                            class="btn btn-info waves-effect">Upload</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
                            {{-- <button type="submit" id="manageImageBtn" class="btn btn-info waves-effect">Save</button> --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="manageSlotModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Manage Slot</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="manageSlotModalCloseButton">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 text-left" id="slotCountDiv">
                            </div>
                            <div class="col-lg-6 text-right">
                                <button class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal"
                                    data-target="#addSlotModal"> <i class="fa fa-plus"></i> Add New Slot</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="errorDivUploadSlots"></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 25px;justify-content: center;align-items: flex-end;">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Slot name</th>
                                    <th>Booking time span</th>
                                    <th>Booking slot capacity</th>
                                    <th>Green limit</th>
                                    <th>Yellow limit</th>
                                    <th>Red limit</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody id="slot-table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                        {{-- <button type="submit" id="manageImageBtn" class="btn btn-info waves-effect">Save</button> --}}
                    </div>

                </div>
            </div>
        </div>
        <div id="addSlotModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Add Slot</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="addSlotModalCloseButton">×</button>
                    </div>
                    <form action="{{route('sites.upload_slots')}}" id="addSlotForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivUploadSlots"></div>
                                </div>
                                <input type="hidden" name="site_id" id="manageSiteIdHidden">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time from <code>*</code></label>
                                        <input type="text" name="time_from" id="time_from_add"
                                            class="form-control time_from" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time to <code>*</code></label>
                                        <input type="text" name="time_to" id="time_to_add" class="form-control time_to"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Slot name <code>*</code></label>
                                        <input type="text" name="slot_name" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Booking time span <code>*</code></label>
                                        <input type="number" name="booking_time_span" class="form-control" required
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Booking slot capacity <code>*</code></label>
                                        <input type="number" name="booking_slot_capacity" class="form-control"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-success">Green limit </label><code>*</code>
                                        <input type="number" name="green_to" class="form-control" required
                                            style="border-color: #26C6DA;color: #26C6DA;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-warning">Yellow limit </label><code>*</code>
                                        <input type="number" name="yellow_to" class="form-control" required
                                            style="border-color: #FFB22B;color: #FFB22B;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-danger">Red limit </label><code>*</code>
                                        <input type="number" name="red_to" class="form-control" required
                                            style="border-color: #FC4B6C;color: #FC4B6C;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="editSlotModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Edit Slot</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            id="editSlotModalCloseButton">×</button>
                    </div>
                    <form action="{{route('sites.edit_slot_save')}}" id="editSlotForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivEditSlots"></div>
                                </div>
                                <input type="hidden" name="site_id" id="manageSiteIdHidden">
                                <input type="hidden" name="slot_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time from <code>*</code></label>
                                        <input type="text" name="time_from" id="time_from_edit"
                                            class="form-control time_from" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time to <code>*</code></label>
                                        <input type="text" name="time_to" id="time_to_edit" class="form-control time_to"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Slot name <code>*</code></label>
                                        <input type="text" name="slot_name" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Booking time span <code>*</code></label>
                                        <input type="number" name="booking_time_span" class="form-control" required
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Booking slot capacity <code>*</code></label>
                                        <input type="number" name="booking_slot_capacity" class="form-control"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-success">Green limit </label><code>*</code>
                                        <input type="number" name="green_to" class="form-control" required
                                            style="border-color: #26C6DA;color: #26C6DA;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-warning">Yellow limit </label><code>*</code>
                                        <input type="number" name="yellow_to" class="form-control" required
                                            style="border-color: #FFB22B;color: #FFB22B;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="badge badge-danger">Red limit </label><code>*</code>
                                        <input type="number" name="red_to" class="form-control" required
                                            style="border-color: #FC4B6C;color: #FC4B6C;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            © 2019 Admin
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
    integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script>
    var update = '<?php echo $permission->u; ?>';
    // console.log(update);
    // function isNumberKey(txt, evt) {
//     var charCode = (evt.which) ? evt.which : evt.keyCode;
//     if (charCode == 46) {
//       //Check if the text already contains the . character
//       if (txt.value.indexOf('.') === -1) {
//         return true;
//       } else {
//         return false;
//       }
//     } else {
//       if (charCode > 31 &&
//         (charCode < 48 || charCode > 57))
//         return false;
//     }
//     return true;
//   }

    $(document).ready(function() {
        $('input').attr('autocomplete', 'off')
        $('#addFormActivities, #editFormActivities').select2();
        $('.time_to').datetimepicker({
            format: 'HH:mm',
            icons:
            {
                up: 'fa fa-angle-up',
                down: 'fa fa-angle-down'
            },
        });
        $('.time_from').datetimepicker({
            format: 'HH:mm',
            icons:
            {
                up: 'fa fa-angle-up',
                down: 'fa fa-angle-down'
            },
        });
    });

    $('#time_from_add').focusout(function(){
        getSlotNameAdd();
    })
    $('#time_to_add').focusout(function(){
        getSlotNameAdd();
    })

    function getSlotNameAdd(){
        var name = `${moment($('#time_from_add').val(), "h:m").format('hh:mm a')} - ${moment($('#time_to_add').val(), "h:m").format('hh:mm a')}`;
        $('[name="slot_name"]').val(name);
        $('[name="booking_time_span"]').val($('#time_to_add').val().split(':')[0]-$('#time_from_add').val().split(':')[0])

    }

    $('#time_from_edit').focusout(function(){
        getSlotNameEdit();
    })
    $('#time_to_edit').focusout(function(){
        getSlotNameEdit();
    })

    function getSlotNameEdit(){
        var name = `${moment($('#time_from_edit').val(), "h:m").format('hh:mm a')} - ${moment($('#time_to_edit').val(), "h:m").format('hh:mm a')}`;
        $('[name="slot_name"]').val(name);
        $('[name="booking_time_span"]').val($('#time_to_edit').val().split(':')[0]-$('#time_from_edit').val().split(':')[0])

    }

    function edit(id) {
        
        $('#editForm').attr('action',location.href + '/' + id)
        $.ajax({
            url: location.href + '/' + id + '/edit',
            type : 'get',
            dataType: 'json',
            success: function(arg) {
                activitis = arg.activitis.split(',');
                $('#editModal [name="activities[]"]').val(activitis).trigger('change');

                $('#editModal [name="name"]').val(arg.name);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="daily_capacity"]').val(arg.daily_capacity);
                // $('#editModal [name="geo_location_type"]').val(arg.geo_location_type);
                $('#editModal [name="loc_lat"]').val(arg.loc_lat);
                $('#editModal [name="loc_lng"]').val(arg.loc_lng);
                $('#editModal [name="reg_fees"]').val(arg.reg_fees);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="annual_capacity"]').val(arg.annual_capacity);
                // $('#editModal [name="geo_location_fees"]').val(arg.geo_location_fees);
                $('#editModal [name="video"]').val(arg.video);
                $('#editModal [name="ticket_price"]').val(arg.ticket_price);
                
                $('#editModal [name="adult_ticket_price_usd"]').val(arg.adult_ticket_price_usd);
                $('#editModal [name="adult_ticket_price_egp"]').val(arg.adult_ticket_price_egp);
                $('#editModal [name="child_tikcet_price_usd"]').val(arg.child_tikcet_price_usd);
                $('#editModal [name="child_tikcet_price_egp"]').val(arg.child_tikcet_price_egp);

                $('#editModal [name="id"]').val(arg.id);
            }
        });
        $('#editModal').modal('show');
    }

    function changeStatus(id) {
        if(confirm("Are You Sure to Change status of this Status?"))
        {
            $.ajax({
                url: "{{ route('sites.change_status') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
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
                        toastr['error'](errorMsg["500"]);
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

    function managePhotos(id){
        
        window.managePhotosId = id;
        $('#managePhotoIdHidden').val(id)
        $.ajax({
                url: "{{ route('sites.manage_photos') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        // $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        if(res.length > 0){
                            html = ``;
                            $.each(res, function(key, value){
                                html += `<div class="col-md-3">
                                            <div class="box-image-pop-up">
                                                <div class="pop-close-image" onclick="del_image(${id}, ${key})">X</div>
                                                <a href="{{asset('storage')}}/${value}" target="_blank" title="View image"><img src="{{asset('storage')}}/${value}" width="100%" height="110px"></a>
                                            </div>
                                        </div>`;
                            })
                            $('#manageImagesDiv').html(html)
                        } else {
                            $('#manageImagesDiv').html('')
                        }
                        $('#imageCountDiv').html(`<h6 style='margin-left: 20px;font-style: italic;color: cornflowerblue;'>You have total ${res.length} image(s)</h6>`)
                        $('#manageImageModal').modal('show');
                    }
                }
            });
    }

    function del_image(id, key){
        if(confirm("Are You Sure to Delete this image? remember after this you will not get it back"))
        {
            $.ajax({
                url: "{{ route('sites.delete_photo') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, key: key, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        managePhotos(id)
                    }
                }
            });
        }
    }

    function del(id) {
        if(confirm("Are You Sure to Delete this Site? remember after this you will not get it back"))
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
                            html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        });
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

    function manageSlots(id){
        if(update == 0) {
            return false;
        }
        window.manageSiteId = id;
        $('#manageSiteIdHidden').val(id)
        $.ajax({
                url: "{{ route('sites.manage_slots') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        if(res.length > 0){
                            html = ``;
                            $.each(res, function(key, value){
                                html += `<tr>
                                            <td>${value.slot_name}</td>
                                            <td>${value.booking_time_span}</td>
                                            <td>${value.booking_slot_capacity}</td>
                                            <td>${value.green_to}</td>
                                            <td>${value.yellow_to}</td>
                                            <td>${value.red_to}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm white" title="Edit" onclick="editSlot(${value.id})">Edit</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm white" title="Delete" onclick="delSlot(${value.id})">Delete</a>
                                                </div>
                                            </td>
                                        </tr>`;
                            })
                            $('#slot-table-body').html(html)
                        } else {
                            $('#slot-table-body').html('')
                        }
                        $('#slotCountDiv').html(`<h6 style='margin-left: 20px;font-style: italic;color: cornflowerblue;'>You have total ${res.length} slot(s)</h6>`)
                        $('#manageSlotModal').modal('show');
                    }
                }
            });
    }

    $("#addSlotForm").submit(function(){
        var time_from = $('#addSlotForm [name="time_from"]').val();
        var time_to = $('#addSlotForm [name="time_to"]').val();
        if(time_to <= time_from){
            toastr['error']("Time to should be greater than time from");
            return false;
        }

        var capacity = parseInt($("#addSlotForm [name='booking_slot_capacity']").val());
        var green = parseInt($("#addSlotForm [name='green_to']").val());
        var yellow = parseInt($("#addSlotForm [name='yellow_to']").val());
        var red = parseInt($("#addSlotForm [name='red_to']").val());

        // if(red > capacity){
        //     toastr['error']("Red limit should less or equal to booking slot capacity");
        //     return false
        // }
        if(green < yellow && yellow < red && green < red){
            return true;
        } else {
            toastr['error']("limits should be Green < Yellow < Red");
            return false;
        }


    });

    $("#editSlotForm").submit(function(){
        var time_from = $('#editSlotForm [name="time_from"]').val();
        var time_to = $('#editSlotForm [name="time_to"]').val();
        if(time_to <= time_from){
            toastr['error']("Time to should be greater than time from");
            return false;
        }

        var capacity = parseInt($("#editSlotForm [name='booking_slot_capacity']").val());
        var green = parseInt($("#editSlotForm [name='green_to']").val());
        var yellow = parseInt($("#editSlotForm [name='yellow_to']").val());
        var red = parseInt($("#editSlotForm [name='red_to']").val());

        // if(red > capacity){
        //     toastr['error']("Red limit should less or equal to booking slot capacity");
        //     return false
        // }
        if(green < yellow && yellow < red && green < red){
            return true;
        } else {
            toastr['error']("limits should be Green < Yellow < Red");
            return false;
        }


    });

    function editSlot(id){
        $.ajax({
            url: "{{ route('sites.edit_slot') }}",
            type: "POST",
            dataType: "JSON",
            data : { id:id, _token : '{{ csrf_token() }}' },
            statusCode: {
                422: function(errors) {

                },
                500: function (error) {
                    toastr['error'](errorMsg[500]);
                },
                200: function (res) {
                    $('#editSlotModal [name="booking_time_span"]').val(res.booking_time_span);
                    $('#editSlotModal [name="booking_slot_capacity"]').val(res.booking_slot_capacity);
                    $('#editSlotModal [name="slot_name"]').val(res.slot_name);
                    $('#editSlotModal [name="time_from"]').val(res.time_from).trigger('change');
                    $('#editSlotModal [name="time_to"]').val(res.time_to).trigger('change');
                    $('#editSlotModal [name="green_to"]').val(res.green_to);
                    $('#editSlotModal [name="yellow_to"]').val(res.yellow_to);
                    $('#editSlotModal [name="red_to"]').val(res.red_to);
                    $('#editSlotModal [name="slot_id"]').val(res.id);
                    $('#editSlotModal [name="site_id"]').val(res.site_id);

                    $('#editSlotModal').modal('show');
                }
            }
        });
    }

    function delSlot(id) {
        if(confirm("Are You Sure to Delete this Site? remember after this you will not get it back")){
            $.ajax({
                url: "{{ route('sites.del_slot') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {

                    },
                    500: function (error) {
                        toastr['error'](errorMsg[500]);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        if(res.type == "success"){
                            manageSlots(manageSiteId);
                        }
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
                data: 'name',
                name : 'name',
                orderable:false

            },
            {
                data: 'daily_capacity',
                name : 'daily_capacity',
                orderable:false

            },
            {
                data: 'annual_capacity',
                name : 'annual_capacity',
                orderable:false

            },
            // {
            //     data: 'geo_location_type',
            //     name : 'geo_location_type',
            //     orderable:false

            // },
            // {
            //     data: 'geo_location_fees',
            //     name : 'geo_location_fees',
            //     orderable:false

            // },
            {
                data: 'adult_ticket_price_usd',
                name : 'adult_ticket_price_usd',
                orderable:false

            },
            {
                data: 'adult_ticket_price_egp',
                name : 'adult_ticket_price_egp',
                orderable:false

            },
            {
                data: 'child_tikcet_price_usd',
                name : 'child_tikcet_price_usd',
                orderable:false

            },
            {
                data: 'child_tikcet_price_egp',
                name : 'child_tikcet_price_egp',
                orderable:false

            },
            {
                data: 'slots',
                name : 'slots',
                orderable:false

            },
            {
                data: 'is_active',
                name : 'is_active',
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

    $('#imageUploadForm').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';

                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDivUploadPhotos').html(html);
                $('#errorDivUploadPhotos').fadeIn();
            },
            500: function (error) {
                toastr['error'](errorMsg[500]);
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    managePhotos(managePhotosId);
                    $("#managePhotosFile").val('');
                }
            }
        }
    });

    $('#addSlotForm').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';
                var msg = '';
                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                    msg= value;

                });
                $('#errorDivUploadSlots').html(html);
                $('#errorDivUploadSlots').fadeIn();
                toastr['error'](msg);

            },
            500: function (error) {
                toastr['error'](errorMsg[500]);
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    manageSlots(manageSiteId);
                    $("#addSlotModalCloseButton").trigger('click');
                    $('#addSlotForm')[0].reset();

                }
            }
        }
    });

    $('#editSlotForm').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';

                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDivEditSlots').html(html);
                $('#errorDivEditSlots').fadeIn();
            },
            500: function (error) {
                toastr['error'](errorMsg[500]);
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    manageSlots(manageSiteId);
                    $("#editSlotModalCloseButton").trigger('click');
                    $('#editSlotForm')[0].reset();

                }
            }
        }
    });


</script>
@endpush