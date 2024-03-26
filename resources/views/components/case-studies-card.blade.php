<div class="item portfolio technology">
    <div class="portfolio-wrapper m-2">
        <div class="card card-edges">
            <div class="project_img d-inline-block image-edges">
                <img src="{{asset('assets/img/'. $image)}}" class="w-100 card-img-top">
            </div>
            <div class="card-body">
                <h5 class="card-title text-dark">{{$title}}</h5>
                <x-pill color="{{$pillcolor}} " title="{{$pilltitle}}"></x-pill>
                <p class="card-text text-dark pt-4 pb-3">{{$content}}</p>
                <a href="{{$pagelink}}" class="text-start text-dark text-decoration-none "><span>Explore Case Study</span><i class="icon-arrow-right2"></i></a>
            </div>
        </div>
    </div>
</div>