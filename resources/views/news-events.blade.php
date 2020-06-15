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
				<li class="breadcrumb-item active">{{__("News Events")}}</li>
			</ol>
		</div>
	</div>
	<div class="single-page mt-5 mb-5">
		<div class="container">
			<h2 class="text-center">{{__("News & Events")}}</h2>
			<div class="head-line mb-5" style="background-color: #fff">
				<i class="fab fa-fly"></i>
			</div>
				@php
					$count = 3;
					$end = 0;
				@endphp
				@foreach ($newsEvent as $item)	
					@php
						$end++;
					@endphp	

					@if ($count%3 == 0)
						<div class="card-group">						
					@endif
						<div class="card">
							<div class="card-body text-center">
								<a href="{{route("single.news-event", $item->id)}}" title="{{__($item->title)}}">
									@php
										$images = json_decode($item->photos);
										// dd($images);
										$imageHas = false;
										if($images) {
											$imageHas = $images[0];
										}									
									@endphp
									@if ($imageHas)
										<img src="{{asset('storage/'.$imageHas)}}" style="width:100%;height:250px" class="img-thumbnail" alt="">
										
									@else
										{{-- <i class="mdi mdi-image-remove"></i> --}}
										<img src="{{asset('assets/images/no_picture.png')}}" style="width:100%;height:250px" class="img-thumbnail" alt="">
										
									@endif
									
								</a>
			
								<a href="{{route("single.news-event", $item->id)}}" title="News & Events"><h3 class="text-center mt-3">{{$item->title}}</h3></a>
								<div class="box b-t text-center">
									<p>
										{{$item->short_description}}
									</p>
									<a href="{{route("single.news-event", $item->id)}}" title="News & Events" class="btn btn-info">Read More</a>
								</div>
							</div>
						</div>	
					@if ($end == 3)
						@php
							$end=0;
						@endphp
						</div>
					@endif
					@php
						$count++;
					@endphp			
				@endforeach

				{{-- <div class="card">
					<div class="card-body text-center">
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5260" title="News & Events"><img src="http://eeaa.gov.eg/Portals/0/eeaaImages/2472018IMG-20180722-WA0006.jpg" style="width:100%;height:250px" class="img-thumbnail" alt=""></a>
	
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5260" title="News & Events"><h3 class="text-center mt-3">Campaign for developing Wadi El Rayan & Quaron</h3></a>
						<div class="box b-t text-center">
							 <p>
								Within the framework of Egyptian-Italian Environmental Cooperation project III and in cooperation with Nature conservation sector (NCS) and Fayoum protectorates, Ministry of Environment organized a massive cleanliness campaign at Wadi El Rayan protectorate in El Fayoum so as to raise the awareness on the importance of natural protectorates in maintaining natural resources and biodiversity by activating the principle of shared management of natural resources between natural protectorates and the local community.
							</p>
							<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5260" title="News & Events" class="btn btn-info">Read More</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body text-center">
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=3917" title="News & Events"><img src="http://eeaa.gov.eg/Portals/0/eeaaImages/322016DSC01525.JPG" style="width:100%;height:250px" class="img-thumbnail" alt=""></a>
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=3917" title="News & Events"><h3 class="text-center mt-3">A new start for the transformation towards the concept of nature conservation</h3></a>
						<div class="box b-t text-center">
							<p>
								Dr. Khaled Fahmy, Minister of Environment has assured that the inauguration of Wadi Al-Hitan and climate change museum in El Rayyan valley is considered the beginning of a new phase of transformation towards nature conservation concept which is based on the economic usage of resources by environmentally compatible methods, which generates economic revenues that opens the door for the natural protected areas to be self managing of its resources and covering its needs by getting rid of the centralized administration and adopting a private financial sustainable activities with the availability of the necessary expertise in the natural protected areas.
							</p>
							<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=3917" title="News & Events" class="btn btn-info">Read More</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body text-center">
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5585" title="News & Events"><img src="http://eeaa.gov.eg/Portals/0/eeaaImages/2412201817212FB_IMG_1545541254978.jpg" style="width:100%;height:250px" class="img-thumbnail" alt=""></a>
						<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5585" title="News & Events"><h3 class="text-center mt-3">completes her tours to follow up the solid waste system</h3></a>
						<div class="box b-t text-center">
							 <p>
								Within the framework of the series of visits by Dr. Yasmine Fouad, Minister of Environment to a number of governorates to determine the conditions of the solid waste system, within the directives of President Abdel Fattah al-Sisi to take urgent actions to address waste problem . the minister will visit Elgharbyia and Kafr Elshiekh governorates to follow up the the work plan and investments of the National Waste Management Program of the Ministry of Environment in both governorates.
							</p>
							<a href="http://eeaa.gov.eg/en-us/mediacenter/newscenter.aspx?articleID=5585" title="News & Events" class="btn btn-info">Read More</a>
						</div>
					</div>
				</div> --}}
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection

@push('scripts')
	<script src="{{asset('assets/js/slick.js')}}" "></script>
@endpush