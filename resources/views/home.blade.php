@extends('common.layout')
@section('title','HOME')
@section('content')
<style type="text/css">
	.best-staff img {
		height: 265px;
	}
	.video{
		position: relative;
		padding-bottom: 56.25%;
		padding-top: 30px; height: 0; overflow: hidden;
		}

		.video-container iframe,
		.video-container object,
		.video-container embed {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		}
</style>
<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1" class=""></li>
        <li data-target="#demo" data-slide-to="2" class=""></li>
        <li data-target="#demo" data-slide-to="3" class=""></li>
    </ul>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://sites.mobotics.in/eeaa/assets/images/slider1.jpg" alt="Los Angeles" width="100%" />

        </div>
        <div class="carousel-item">
            <img src="http://sites.mobotics.in/eeaa/assets/images/slider2.jpg" alt="Los Angeles" width="100%" />

        </div>
        <div class="carousel-item">
            <img src="http://sites.mobotics.in/eeaa/assets/images/slider3.jpg" alt="Los Angeles" width="100%" />
            <div class="carousel-caption">
                <div class="container">
                    <div class="col-md-6">
                        <!-- <h1 class="">ALL-IN-ONE ONLINE SCHEDULING SOFTWARE</h1>
                        <p class="mt-3 mb-4">Trusted by 130,000+ customers worldwide<div class="clearfix"></div></p>
                        <a href="javascript:;" class="tri-btn btn btn-outline-light mr-3"> Button 1 </a>
                        <a href="javascript:;" class="tri-btn btn btn-info">Button 2</a> -->
                    </div>
                </div>
            </div>
        </div>
         <div class="carousel-item">
            <img src="http://sites.mobotics.in/eeaa/assets/images/slider4.jpg" alt="Los Angeles" width="100%" />

        </div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<div class="main-video mt-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h2>المحميات الطبيعية
</h2>
        <p class="mt-4">
لتوفير الحماية للموارد الطبيعية والتنوع البيولوجي وللحفاظ على الاتزان البيئي ظهرت فكرة إعلان ما يسمى بالمحميات الطبيعية التي تعكس جمال الطبيعية كعنصر من الموارد الطبيعية, ولصيانة تلك الموارد فقد صدر القانون رقم 102 لسنة 1983 في شأن المحميات الطبيعية ثم صدر القانون رقم 4 لسنة 1994 بإصدار قانون فى شأن حماية البيئة ليكون مؤيدا لما جاء بالقانون رقم 102 لسنة 1983. هذا وقد صدرت قرارات من السيد رئيس مجلس الوزراء بإعلان عدد 30 محمية طبيعية حتى 2012 بنسبة تزيد على 15% من اجمالى مساحة مصر.</p>
        <a class="btn btn-info tri-btn mt-4" href="javascript:;">Read More</a></div>
        <div class="col-md-5">
          <div class="video">
          	<iframe width="420" height="300" src="https://www.youtube.com/embed/fK621HibYxQ?controls=0&amp;start=34" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
      </div>
  </div>
</div>
</div>
<div class="timer-main pt-5 pb-5">
    <div class="container">
        <h2 class="text-center">Gallery</h2>
        <div class="head-line mb-5">
            <i class="fab fa-fly"></i>
        </div>
        <div class="col-md-12">
            <div class="best-staff">
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery1.jpg" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery2.jpg" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery3.JPG" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery4.jpg" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery5.JPG" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery6.JPG" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery7.JPG" class="img-thumbnail" width="100%" alt=""></a>
                </div>
                <div>
                     <a href="#" title="News & Events"><img src="http://sites.mobotics.in/eeaa/assets/images/gallery8.jpg" class="img-thumbnail" width="100%" alt=""></a>
                </div>
            </div>
        <div class="best-staff-nav">
            <div class="best-staff-left"><i class="fa fa-angle-left"></i></div>
            <div class="best-staff-right"><i class="fa fa-angle-right"></i></div>
        </div>
  </div>
</div>
<div class="main-video mt-5 mb-4 pt-4 pb-4" style="background-color: #fff">
    <div class="container">
        <h2 class="text-center">News & Events</h2>
        <div class="head-line mb-5" style="background-color: #fff">
            <i class="fab fa-fly"></i>
        </div>

        @php
            $count = 3;
            $end = 0;
            $newsEvent = \App\Models\NewsEvents::where('type', 'Event')->orderBy('id', 'desc')->limit(3)->get();
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
        
        {{-- <div class="card-group">
            <div class="card">
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
            </div>
        </div> --}}
    </div>
    <div class="clearfix"></div>
</div>

<div class="clients Subscrib pb-5 mb-2">
        <div class="container">
            <h2 class="section-title bold600 text-center mb-3">Get Our Latest News Delivered Right to You</h2>
            <form action="{{route('page.news_subscribed')}}" method="post" id="newsletter-form">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3  booking-form-item name">
                        <input class="form-control"  type="text" name="name" placeholder="Your name">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3  booking-form-item phone">
                        <input class="form-control"   type="tel" name="phone" placeholder="Phone">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3  booking-form-item email">
                        <input class="form-control"   type="text" name="email" placeholder="E-mail">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                        <div id="alert" style="display: none;"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
     $('#newsletter-form').ajaxForm({
        dataType:'json',
        statusCode: {
            422: function(errors) {
                var html = '';

                $.each(errors.responseJSON.errors, function(key,value){
                    html = value;
                });
                toastr['error'](html);

                // $('#errorDiv').html(html);
                // $('#errorDiv').fadeIn();
                // $('html,body').scrollTop(0);
            },
            500: function (error) {
                toastr['error'](error.responseJSON.message);
            },
            200: function (res) {
                $('#errorDiv').fadeOut();
                toastr['success'](res.text);
                $('#newsletter-form')[0].reset()
                // window.location.href= '{{ route('vessels.index') }}';
            }
        }
    });
</script>
@endpush
