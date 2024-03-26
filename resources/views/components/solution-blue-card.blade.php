<div class="col-lg-4 col-md-6 col-12 mt-md-0 mt-lg-0 mb-4" style="cursor: pointer;">
    <!-- <a href="solution/{{$slug}}"> -->
        <div class="card p-4 blue-solution-card h-100 col-12 ">
            <div class="card-body text-center text-md-start">
                @if($icon)
                <i class="{{$icon}} mobile-icon display-2" alt="Tech"></i>
                <h4 class="card-title mt-4 pt-2 text-white text-center text-md-start">{{$title}}</h4>
                @else
                <h4 class="card-title mt-2 text-white text-center text-md-start">{{$title}}</h4>
                @endif
                <p class="card-text mt-4">{{$content}}
                </p>
            </div>
        </div>
    <!-- </a> -->
</div>