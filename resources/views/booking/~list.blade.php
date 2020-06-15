@extends('common.backend.layout')
@section('title', 'Protected Areas')
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
    </style>
@endpush
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Protected Areas</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white">Protected Areas</li>
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
                                <div class="pull-right" style="float:right;">
                                    <button class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="dt" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
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
                        <h4 class="modal-title" id="vcenter">Add New Protected Area</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="addModalCloseButton">×</button>
                    </div>
                    <form action="{{route('protected-areas.store')}}" id="addForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div id="errorDiv" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <code>*</code></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Protected Area Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites <code>*</code></label>
                                        <select autocomplete="off" id="addFormSites" name="sites[]" multiple="multiple" class="form-control" style="width: 100%;" required>
                                            @foreach ($sites as $site)
                                                <option value="{{$site->id}}">{{$site->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location latitude <code>*</code></label>
                                        <div class="input-group">
                                                <input type="text" class="form-control" name="loc_lat" placeholder="Enter Location latitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location longitude <code>*</code></label>
                                        <div class="input-group">
                                                <input type="text" class="form-control" name="loc_lng" placeholder="Enter Location longitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Images/Photos <code>*</code></label>
                                        <input type="file" name="photos[]" class="form-control" multiple required accept="image/*" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Attach documents (PDF)<code>*</code></label>
                                        <input type="file" name="documents[]" class="form-control" multiple required accept=".pdf" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Video</label>
                                        <textarea name="video" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Website Slug <code>*</code></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter Website Slug" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
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
                        <h4 class="modal-title" id="vcenter">Edit Protected Area</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="editModalCloseButton">×</button>
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
                                        <input type="text" name="name" class="form-control" placeholder="Enter Protected Area Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sites <code>*</code></label>
                                        <select autocomplete="off" id="editFormSites" name="sites[]" multiple="multiple" class="form-control" style="width: 100%;" required>
                                            @foreach ($sites as $site)
                                                <option value="{{$site->id}}">{{$site->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location latitude <code>*</code></label>
                                        <div class="input-group">
                                                <input type="text" class="form-control" name="loc_lat" placeholder="Enter Location latitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location longitude <code>*</code></label>
                                        <div class="input-group">
                                                <input type="text" class="form-control" name="loc_lng" placeholder="Enter Location longitude" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Website Slug <code>*</code></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter Website Slug" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Video</label>
                                        <textarea name="video" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="editBtn" class="btn btn-info waves-effect">Edit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div id="manageImageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Manage Images</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="manageImageModalCloseButton">×</button>
                    </div>
                    <form action="{{route('protected-areas.upload_photos')}}" id="imageUploadForm" method="POST">
                        @csrf
                        <div class="modal-body">
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
                                        <input type="file" name="photos[]" class="form-control" id="managePhotosFile" multiple required accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="imageUploadBtn" class="btn btn-info waves-effect">Upload</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                            {{-- <button type="submit" id="manageImageBtn" class="btn btn-info waves-effect">Save</button> --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div id="manageDocModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Manage Documents</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="manageDocModalCloseButton">×</button>
                    </div>
                    <form action="{{route('protected-areas.upload_docs')}}" id="docUploadForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row" id="docCountDiv">
                            </div>
                            <div class="row" id="manageDocsDiv">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="errorDivUploadDocs"></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 25px;justify-content: center;align-items: flex-end;">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="manageDocIdHidden">
                                    <div class="form-group">
                                        <label for="">Upload new documents <code>*</code></label>
                                        <input type="file" name="documents[]" class="form-control" id="manageDocFile" multiple required accept=".pdf"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="docUploadBtn" class="btn btn-info waves-effect">Upload</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Close</button>
                            {{-- <button type="submit" id="manageImageBtn" class="btn btn-info waves-effect">Save</button> --}}
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
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>

    $(document).ready(function() {
        $('#addFormSites, #editFormSites').select2();
    });


    function edit(id) {
        $('#editForm').attr('action',location.href + '/' + id)
        $.ajax({
            url: location.href + '/' + id + '/edit',
            type : 'get',
            dataType: 'json',
            success: function(arg) {
                sites = arg.sites.split(',');
                $('#editModal [name="sites[]"]').val(sites).trigger('change');

                $('#editModal [name="name"]').val(arg.name);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="loc_lat"]').val(arg.loc_lat);
                $('#editModal [name="loc_lng"]').val(arg.loc_lng);
                $('#editModal [name="video"]').val(arg.video);
                $('#editModal [name="slug"]').val(arg.slug);

                $('#editModal [name="id"]').val(arg.id);
            }
        });
        $('#editModal').modal('show');
    }

    function changeStatus(id) {
        if(confirm("Are You Sure to Change status of this Status?"))
        {
            $.ajax({
                url: "{{ route('protected-areas.change_status') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
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
                url: "{{ route('protected-areas.manage_photos') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        // var html = '';
                        // $.each(errors.responseJSON.errors, function(key,value){
                        //     html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        // });
                        // $('#errorDiv').html(html);
                        // $('#errorDiv').fadeIn();
                    },
                    500: function (error) {
                        toastr['error'](error);
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
                url: "{{ route('protected-areas.delete_photo') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, key: key, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                    },
                    500: function (error) {
                        toastr['error'](error);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        managePhotos(id)
                    }
                }
            });
        }
    }
    function manageDocs(id){
        window.manageDocsId = id;
        $('#manageDocIdHidden').val(id)
        $.ajax({
                url: "{{ route('protected-areas.manage_docs') }}",
                type: "POST",
                dataType: "JSON",
                data : { id:id, _token : '{{ csrf_token() }}' },
                statusCode: {
                    422: function(errors) {
                        // var html = '';
                        // $.each(errors.responseJSON.errors, function(key,value){
                        //     html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                        // });
                        // $('#errorDiv').html(html);
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
                                                <div class="pop-close-image" onclick="del_doc(${id}, ${key})">X</div>
                                                <object data="{{asset('storage')}}/${value}" width="100%" height="110px"></object>
                                                <a href="{{asset('storage')}}/${value}" target="_blank" title="View this document" style="color: cornflowerblue;font-size: 12px;">View</a>
                                            </div>
                                        </div>`;
                            })
                            $('#manageDocsDiv').html(html)
                        } else {
                            $('#manageDocsDiv').html('')
                        }
                        $('#docCountDiv').html(`<h6 style='margin-left: 20px;font-style: italic;color: cornflowerblue;'>You have total ${res.length} document(s)</h6>`)
                        $('#manageDocModal').modal('show');
                    }
                }
            });
    }

    function del_doc(id, key){
        if(confirm("Are You Sure to Delete this document? remember after this you will not get it back"))
        {
            $.ajax({
                url: "{{ route('protected-areas.delete_doc') }}",
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
                        manageDocs(id)
                    }
                }
            });
        }
    }

    function del(id) {
        if(confirm("Are You Sure to Delete this Protected Area? remember after this you will not get it back"))
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
</script>


<script>
    window.DT = $('#dt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": location.href,
        columns:[
            {
                data: 'id',
                name : 'id',
            },
            {
                data: 'name',
                name : 'name',
                orderable:false

            },
            {
                data: 'description',
                name : 'description',
                orderable:false

            },
            {
                data: 'slug',
                name : 'slug',
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

    $('#docUploadForm').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';

                $.each(errors.responseJSON.errors, function(key,value){
                    html = html + '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div ></div>'+value+'</div>';
                });
                $('#errorDivUploadDocs').html(html);
                $('#errorDivUploadDocs').fadeIn();
            },
            500: function (error) {
                toastr['error'](errorMsg[500]);
            },
            200: function (res) {
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    manageDocs(manageDocsId);
                    $("#manageDocFile").val('');
                }
            }
        }
    });


</script>
@endpush
