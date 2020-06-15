@extends('common.backend.layout')
@section('title', __("Edit News & Events"))
@section('product_title', config('app.name'))
@section('content')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
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
                <h3 class="text-white">{{__("News/Events")}}</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('dashboard') }}">{{__("Home")}}</a></li>
                    <li class="breadcrumb-item active text-white">{{__("News/Events")}}</li>
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
                <form action="{{route('newsevents.update', [$newsevent->id])}}" id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                                <p>
                                    Image Mime type Should be jpg,jpeg,png
                                    <br>
                                    Image Size maximum 10 M.B
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{__("Title")}}</label>
                                <input class="form-control" type="text" name="title" value="{{$newsevent->title}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Slug")}}</label>
                                <input class="form-control" type="text" name="slug" value="{{$newsevent->slug}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Short Description")}}</label>
                                <textarea class="form-control" rows="3" cols="3" type="text" name="short_description" required>{{$newsevent->short_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Image")}}</label>
                                <input type="file" accept="image/*" class="form-control" name="banners[]">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Videos Link")}}<small>{{__("(Ex. https://www.youtube.com/embed/O5NS9CBxVCM)")}}</small></label>
                                <div id="video-links">                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Body")}}</label>
                                <textarea id="summernote" name="body" rows="5" cols="10" class="form-control">{{$newsevent->body}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__("Type")}}</label>
                                <select class="form-control select2" name="type">
                                    <option value="Event" {{($newsevent->type == 'Event') ? 'selected' : ''}}>Event</option>
                                    <option value="Auction" {{($newsevent->type == 'Auction') ? 'selected' : ''}}>Auction</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="btn-group">
                                <button class="btn btn-warning" type="button" onclick="window.location.href='{{url('newsevents')}}'">
                                    <i class="fa fa-fw fa-lg fa-times"></i>Close
                                </button>
                                &nbsp;&nbsp;
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script> 
	$('#summernote').summernote({
		height: 200,
		stripTags: ['style'],
	});
</script>
<script>
    window.videoLinkArr = JSON.parse('<?php echo $newsevent->videos; ?>');
    console.log(videoLinkArr);
    window.arrIndex = 0;
    $(document).ready(function() {
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select item",
                allowClear: true
            });
        });

        videoLinkArr.forEach((item, i) => {
            if(i == 0) {
                $('#video-links').html(HTML(arrIndex));
                $('#video-links').find('.items:last-child .videos').val(item);
            } else {
                $('.btn-add-row').trigger('click');
                $('#video-links').find('.items:last-child .videos').val(item);
            }
        })
        // $('#video-links').html(HTML(arrIndex));
        $('#editFormSites, #editFormSites').select2();
        
        $('#editform [name="title"]').keyup(function(){
            var name = $('#editform [name="title"]').val();
            if(name){
                var slug = convertToSlug(name);
                $('#editform [name="slug"]').val(slug);
            }
        })

        function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }
    });    
</script>

<script>
    function HTML(i=0) {
        return `
        <div class="row items">
        <div class="col-md-1">
            <item-count>1</item-count>
        </div>
        <div class="col-md-10">
            <textarea class="form-control videos" placeholder="Enter Link" name="videos[]"></textarea>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-success btn-add-row" onclick="addItem(this);"><i class="fa fa-plus"></i></button>
        </div>
        </div>
        `;

    }
    function addItem(el) {
        $(el).find('i').removeClass('fa fa-plus');
        $(el).find('i').addClass('fa fa-times');
        $(el).removeClass('btn-success');
        $(el).removeClass('btn-add-row');
        $(el).addClass('btn-danger');
        $(el).attr('onclick', 'delItem(this)');
        $('#video-links').append(HTML(arrIndex));
        arrangeCount();
    }

    function delItem(el) {
        // console.log(el);
        if(! confirm('Are you sure ?')) {
            return false;
        }
        $(el).closest('.items').remove();       

        arrangeCount();
    }

    function arrangeCount() {
        n = 0;
        $('item-count').each(function() {
            $(this).text(++n);
        });
    }
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
                window.location.href= '{{ route('newsevents.index') }}';
            }
        }
    });

    $('[name="title"]').keyup(function(){
		var name = $('[name="title"]').val();
		if(name){
			var slug = convertToSlug(name);
			$('[name="slug"]').val(slug);
		}
	})

    $('[name="slug"]').change(function(){
		var name = $('[name="slug"]').val();
		if(name){
			var slug = convertToSlug_(name);
			$('[name="slug"]').val(slug);
		}
	})

    function convertToSlug(Text)
	{
		return Text
		.toLowerCase()
		.replace(/[^\w ]+/g,'')
		.replace(/ +/g,'-')
		;
	}
    function convertToSlug_(Text)
	{
		return Text
		.toLowerCase()
		.replace(/[^a-zA-Z0-9-]+/g,'-')
		.replace(/ +/g,'-')
		;
	}

    
</script>
@endpush
