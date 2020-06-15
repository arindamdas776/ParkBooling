@extends('common.layout')
@section('title',$page->meta_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)

@push('styles')	
<link rel="stylesheet" href="{{asset('assets/css/slick.css')}}" />
@endpush

@section('content')
<div class="content-blank">
	<div class="sub-banner black-opacit" style="background: url('http://sites.mobotics.in/eeaa/assets/images/sub-banner.jpg');">
		<div class="container">
			<h2>{{__("News Events")}}</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a>{{__("Home")}}</a></li>
				<li class="breadcrumb-item"><a href="{{url('news-events')}}">{{__("News Events")}}</a></li>
				<li class="breadcrumb-item active">{{__($newsEvent->title)}}</li>
			</ol>
		</div>
	</div>
	<div class="single-page mt-5 mb-5">
		<div class="container">
			<h2 class="text-center">{{__("News & Events")}}</h2>
			<div class="head-line mb-5" style="background-color: #fff">
				<i class="fab fa-fly"></i>
			</div>
			<div class="row">
				<div class="col-lg-12">
					@php
						$images = json_decode($newsEvent->photos);
						$imageHas = false;
						if($images && $images[0]) {
							$imageHas = $images[0];
						}									
					@endphp
					@if ($imageHas)
						<img src="{{asset('storage/'.$imageHas)}}" style="width:100%;height:auto;" class="img-thumbnail" alt="">
		
					@else
						{{-- <img src="{{asset('assets/images/no_picture.png')}}" style="width:100%;height:250px" class="img-thumbnail" alt=""> --}}

						{{-- <i class="mdi mdi-image-remove"></i> --}}
						
					@endif
				</div>
			</div>

			<div class="card-group">
				<div class="card">
					<div class="card-body text-center">
						<h3>
							{{$newsEvent->title}}
						</h3>
						<div class="card-body text-center">
							<?php echo $newsEvent->body ?>
						</div>
					</div>
				</div>				
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection

@push('scripts')
	<script src="{{asset('assets/js/slick.js')}}" "></script>
@endpush