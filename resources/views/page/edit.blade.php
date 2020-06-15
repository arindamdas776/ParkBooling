@extends('common.backend.layout')
@section('title', 'Edit Page')
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
                <h3 class="text-white">Edit Page</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('pages.index') }}">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Edit Page</li>
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
                <form action="{{ route('pages.update',$page->slug) }}" id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input class="form-control" type="text" placeholder="Enter Page name" name="title" required value="{{ $page->title }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slug</label>
                                <input class="form-control" type="text" placeholder="Enter Page slug" name="slug" required value="{{ $page->slug }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Meta-Title</label>
                                <input class="form-control" type="text" placeholder="Enter Meta-Title" name="meta_title" value="{{ $page->meta_title }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Meta-Keywords</label>
                                <input class="form-control" type="text" placeholder="Enter Meta-Keywords" name="meta_keywords" value="{{ $page->meta_keywords }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Meta-Description</label>
                                <input type="text" class="form-control" placeholder="Enter Meta-Description" name="meta_description" value="{{ $page->meta_description }}">
                            </div>
                            {{-- <div class="form-group">
                                <label class="form-label">Banner</label>
                                <input type="file" accept="image/*" class="form-control" placeholder="Enter Banner" name="banner">
                                @if($page->banner !== null)
                                    <a href="{{ env('APP_URL').'storage/'.$page->banner }}" target="_blank"><small>Click to check</small></a>
                                @endif
                            </div> --}}
                            <div class="form-group">
                                <label class="form-label">Content</label>
                                <textarea id="summernote" name="content">{{ $page->content }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="btn-group">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Edit
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
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.min.js"></script>
<script> 
	$('#summernote').summernote({
		height: 400,
		stripTags: ['style'],
	});
</script>
<script>
    $(document).ready(function() {
        $('#addFormSites, #editFormSites').select2();
    });    
</script>


<script>
    
    $('#editForm').ajaxForm({
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
                window.location.href= '{{ route('pages.index') }}';
                // if(res.type == 'success'){
                //     $("#addModalCloseButton").trigger('click');
                // }
            }
        }
    });  

</script>
@endpush
