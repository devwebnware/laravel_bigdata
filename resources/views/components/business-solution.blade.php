<div class="row">
    <div class="col-lg-6 col-12 p-0 {{$class}}">
        <img src="assets/img/{{$image}}" class="w-100" alt="">
    </div>
    <div class="col-lg-6 col-12 pt-lg-0 pb-lg-0 pt-5 pb-5 blue-bg-solutions d-flex align-items-center justify-content-lg-center">
        <div class="col-lg-9 col-12 text-md-start">
            {{$slot}}
            <h3 class="fw-bold mt-3 text-white">{{$title}}</h3>
            <p class="mt-3 mb-4">{{$content}}</p>
            <a href="{{$link}}" class="learn-more-btn">LEARN MORE &nbsp;<i class="icon-arrow-right2 pe-2"></i></a>
        </div>
    </div>
</div>