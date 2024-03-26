<style>
    .detail-header {
        background-image: url("{{asset('storage/images/solutionSubCategory/'.$image)}}");
        background-repeat: no-repeat;
        background-size:cover;
        background-position:center center;
    }
</style>
<div class="container text-white p-2 pt-4">
    <x-pill title="{{ucwords($pillTitle)}}" color="{{$pillColor}}"></x-pill>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <h1 class="display-5 text-white">{!!$title!!}</h1>
            <p class="pt-2 col-lg-5 col-12">{!!$description!!}</p>
        </div>
    </div>
</div>