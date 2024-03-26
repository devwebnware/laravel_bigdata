<div class="col-md-3 industry-project-item carousel-sections" style="cursor: pointer;">
    <div class="carousel-box d-block">
        <div class="carousel-box-thumb" style="border-radius:10px;">
            <a href="{{$route}}">
                <img src="{{asset('assets/img/' . $image)}}" class="w-100" alt="">
                <span class="overlay"></span>
            </a>
        </div>
        <div class="portfolio-info fostering-info" style="border-radius:10px;">
            <div class="portfolio-info-inner">
                <a class="btn-link" href="{{$route}}"><i class="icon-arrow-right2"></i></a>
                <a href="{{$route}}">
                    <h6 class="text-white mb-1">{{$title}}</h6>
                    <p class="portfolio-cates text-white mb-0" style="z-index: 100 !important;">
                        {{$subtitle}}
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>