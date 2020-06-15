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
			<h2>{{$page->title}}</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a>Home</a></li>
				<li class="breadcrumb-item active">{{$page->title}}</li>
			</ol>
		</div>
	</div>
	<div class="single-page mt-5 mb-5">
		<div class="container">
			{!! $page->content!!}
			@php
				$banner = json_decode($page->banner, true);
			@endphp
			@if ($banner && sizeof($banner) > 0)
				<h2 class="text-center text-uppercase">Images</h2>
				<div class="head-line mb-5 "><i class="fab bg-white fa-fly"></i></div>
				<div class="slider">
					@foreach ($banner as $item)
						<img src="{{asset('storage/'.$item)}}" />
					@endforeach
				</div>
			@endif

			@php
				$videos = json_decode($page->videos, true);
			@endphp

			@if ($videos && sizeof($videos) > 0)
			<h2 class="text-center text-uppercase">Videos</h2>
			<div class="head-line mb-5 "><i class="fab bg-white fa-fly"></i></div>
			<div class="slider">
				@foreach ($videos as $item)
				{{-- <iframe width="727" height="409" src="https://www.youtube.com/embed/O5NS9CBxVCM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
				{{-- {!! $item !!} --}}
					<iframe src="{!! $item !!}" width="300" height="300" frameborder="0"></iframe>
				@endforeach
			</div>
			@endif
			
		</div>
	</div>
</div>
@endsection

@push('scripts')
	<script src="{{asset('assets/js/slick.js')}}" "></script>
@endpush