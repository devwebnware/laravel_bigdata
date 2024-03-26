<style>
    .career-card-btn {
        background-color: #13cad2;
        padding: 10px 16px 10px 32px;
        border-radius: 50px;
        font-weight: 600;
        border: 1px solid #13cad2;
        letter-spacing: 1px;
    }
</style>
<div class="col-lg-4 col-md-6 col-12 mt-4">
    <div class="job-box blue-side-mark card p-4 h-100 border">
        <div class="card-body text-start h-100">
            <h4 class="card-title pt-2 pb-2">{{$title}}</h4>
            <h4 class="p-0 m-0">
                <x-pill color="{{$pillColor}}" title="{{$pillTitle}}"></x-pill>
                <x-pill color="{{$pillColor1}}" title="{{$pillTitle1}}"></x-pill>
            </h4>
            <p class="card-text text-secondary mt-4 mb-4" style="text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; -webkit-line-clamp: 4; display: -webkit-box;">{!!$description!!}
            </p>
            <a href="/career-details/{{$slug}}" class="white-btn seeFullPositionBtn text-start text-decoration-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" name="{{$slug}}" data-vacancy_id="{{$vacancyId}}"><span>See Full Position</span><span class="ps-2 icon-arrow-right2"></span></a>
        </div>
    </div>
</div>