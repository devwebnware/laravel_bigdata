<style>
    .pills {
        color: #333;
        padding: 8px 16px 4px 16px;
        text-transform: uppercase;
        line-height: 1.5 !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        letter-spacing: 2px;
        padding: 0px;
    }
</style>
<div class="row">
    <div class="col-lg-5 col-12 {{$class}}  d-flex align-items-center justify-content-center">
        <img src="assets/img/{{$image}}" width="100%" alt="{{$imageAlt}}" title="{{$imageTitle}}">
    </div>
    <div class="col-lg-7 col-12 d-flex align-items-center justify-content-center">
        <div class="col-11 text-md-start">
            <span class="badge rounded-pill pills" style="background-color: {{$pillColor}};">{{$pillTitle}}</span>
            <h3 class="mt-3 display-5">{{$title}}</h3>
            <p class="mt-3 mb-4">{{$content}}</p>
            {{$slot}}
        </div>
    </div>
</div>