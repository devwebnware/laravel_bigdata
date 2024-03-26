<div class="container" style="z-index: 9;">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="display-5">{{$title}}</h2>
            <h5 class="pt-4" style="line-height: 1.5 !important;">{{$subtitle}}</h5>
            @if($subtitle == "")
            <p class="pt-0 m-0">{{$content}}</p>
            @else
            <p class="pt-4 m-0">{{$content}}</p>
            @endif
        </div>
    </div>
</div>