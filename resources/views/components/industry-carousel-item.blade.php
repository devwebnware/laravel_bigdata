<div class="item border-0">
    <div class="card industries-card img-scale industry-imgbox">
        <img class="card-img" src="{{asset('storage/images/industries/'.$bgImageUrl)}}" alt="{{$imageAlt}}">
        <div class="card-img-overlay text-white d-flex flex-column justify-content-end p-5 text-box">
            <div class="industry_hover mb-4">
                <i class="{{$iconClass}} text-start text-white display-5"></i>
            </div>
            <small class="card-title mb-3 text-white ">{{$subTitle}}</small>
            <h4 class="card-subtitle mb-2 fw-bold text-white">{{$title}}</h4>
        </div>
    </div>
</div>