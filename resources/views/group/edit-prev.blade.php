@extends('common.backend.layout')
@section('title', 'Change Group Previleges')
@section('product_title', config('app.name'))

@section('content')
@push('style')
    <style>
        ul li {
            list-style-type: none;
        }
        [type=checkbox]:checked,
        [type=checkbox]:not(:checked) {
            left: -5px;
            opacity: 1;
            position: relative;
        }
    </style>
    
@endpush

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-white">Groups Prev Edit</h3>
                <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('my-company') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('admin/groups') }}">Groups</a></li>
                    <li class="breadcrumb-item active text-white">Groups Prev Edit</li>
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
                                <h4 class="card-title">Group Privileges</h4>
                            </div>
                            <div class="col-md-6">
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="check-module">
                                    @foreach ($parentModules as $key => $item)
                                        <li class="p">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="pcheck checkitem" value="{{$item->id}}" {{in_array($item->id, $prevpermissionRole) ? 'checked' : ''}}>{{$item->title}}</label>
                                                <div class="col-md-4 crud">
                                                <label><input type="checkbox" class="acl" value="{{$aclListArr[$key]['c']}}" {{($aclListArr[$key]['c'] == 1) ? 'checked' : ''}}>Create</label><br/>
                                                    <label><input type="checkbox" class="acl"  value="{{$aclListArr[$key]['r']}}" {{($aclListArr[$key]['r'] == 1) ? 'checked' : ''}}>Read</label><br/>
                                                    <label><input type="checkbox" class="acl"  value="{{$aclListArr[$key]['u']}}" {{($aclListArr[$key]['u'] == 1) ? 'checked' : ''}}>Update</label><br/>
                                                    <label><input type="checkbox" class="acl"  value="{{$aclListArr[$key]['d']}}" {{($aclListArr[$key]['d'] == 1) ? 'checked' : ''}}>Delete</label><br/>
                                                </div>
                                            </div>
                                            @if (sizeof($childModules[$item->slug][0]) > 0)
                                                <ul class="check-module ml-5 inner-ul">
                                                    @foreach ($childModules[$item->slug][0] as $key => $rec)
                                                        <li>
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" class="checkitem" value="{{$rec['id']}}" {{in_array($rec['id'], $prevpermissionRole) ? 'checked' : ''}}>{{$rec['title']}}</label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif     
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary" onclick="submit()">Submit</button>
                            </div>
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
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>
    function edit(id) {
        // $('#editModal').modal('show');

        $('#editForm').attr('action',location.href + '/' + id)
        $.ajax({
            url: location.href + '/' + id + '/edit',
            type : 'get',
            dataType: 'json',
            success: function(arg) {
                $('#editModal input[name="name"]').val(arg.name);
                $('#editModal [name="description"]').val(arg.description);
                $('#editModal [name="id"]').val(arg.id);
                // $.each(arg, function(i, row) {
                //     var elem = $('#editForm [name="' + i + '"]');
                //     elem.val(row);
                // });
            }
        });
        $('#editModal').modal('show');
    }

    function changeStatus(id) {
        if(confirm("Are You Sure to Change status of this Status?"))
        {
            $.ajax({
                url: "{{ route('groups.change_status') }}",
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
                        toastr['error'](error);
                    },
                    200: function (res) {
                        toastr[res.type](res.text);
                        if(res.type == 'success'){
                            location.reload();
                        }
                    }
                }
            });
        }
    }
    
    function del(id, elem) {
        if (confirm('Are you sure want to perform this action?')) {
            $(elem).closest('tr').remove();
            toastr['success']('Deleted');
        }
    }  

    function del(id) {
        if(confirm("Are You Sure to Delete this Group? remember after this you will not get it back"))
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
                            location.reload();
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
                data: 'is_active',
                name : 'is_active',
                orderable:false
            },
            {
                data: 'rolechange',
                name : 'rolechange',
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
                $.each(errors.responseJSON.errors.validation_error, function(key,value){
                    html += `${value}<br/>`;
                });
                toastr['error'](html);
            },
            500: function (error) {
                toastr['error'](error.responseJSON.message);
            },
            200: function (res) {
                // console.log('asasas');
                toastr[res.type](res.text);
                if(res.type == 'success'){
                    location.reload();
                    // window.location.href = `{{url('/my-company')}}`;
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
                    location.reload();
                }
            }
        }
    });

    $(function() {
        $('.inner-ul .checkitem').click(function() {
            var pCheckbox = $(this).closest('.p').find('.pcheck');
            if(!$(pCheckbox).is(':checked')) {
                $(pCheckbox).prop('checked', true);
            }
        });
        $('.pcheck').click(function() {
            pCheckbox = $(this);
            innerCheckbox = $(this).closest('.p').find('.inner-ul li');
            if($(pCheckbox).is(":checked")) {
                $(innerCheckbox).each(function(i, v) {
                    checkbox = $(v).find('.checkitem');
                    if(!$(checkbox).is(":checked")) {
                        $(checkbox).prop('checked', true);
                    }
                })
            } else {
                $(innerCheckbox).each(function(i, v) {
                    checkbox = $(v).find('.checkitem');
                    $(checkbox).prop('checked', false);
                })
            }            
        })
    });

    function submit() {
        if(!confirm("Are you sure want to perform this action?")) {
            return false;
        }
        var checkbox = $('.checkitem');
        var idlist = [];
        var permissionArr = [];
        $(checkbox).each(function(i, v) {
            if($(v).is(":checked")) {
                idlist.push($(v).val())
                /**
                * Inner ACL Checked
                */
                var aclList = [];
                $(v).closest('.checkbox').find('.crud .acl').each(function(k,l) {
                    let permission = 0;
                    if($(l).is(':checked')) {
                        permission = 1
                    }
                    aclList.push(permission);
                });
                permissionArr.push(aclList);
            }
        })
        if(idlist.length < 1) {
            alert("Please select atleast one module name");
            return false;
        }

        var formData = new FormData();
        formData.append('idlist', JSON.stringify(idlist));
        formData.append('acllist', JSON.stringify(permissionArr));
        formData.append('_token', "{{csrf_token()}}");
        formData.append('groupid', <?php echo $groupid; ?>);
        $.ajax({
            url : "{{route('groups.update_prev')}}",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            statusCode: {
                422: function(errors) {
                    var html = '';
                    $.each(errors.responseJSON.errors.validation_error, function(key,value){
                        html += `${value}<br/>`;
                    });
                    toastr['error'](html);
                },
                500: function (error) {
                    toastr['error'](error.responseJSON.message);
                },
                200: function (res) {
                    // console.log('asasas');
                    toastr[res.type](res.text);
                    if(res.type == 'success'){
                        // location.reload();
                        window.location.href = `{{url('/admin/groups')}}`;
                    }
                }
            }
        })


    }
</script>
@endpush