<a href="{{asset('storage/images/gallery/' . $image)}}" class="ad-card lightbox m-2">
    <div class="content d-grid align-content-center w-100">
        <span class="title text-center text-white fw-bold">{!!$title!!}</span>
    </div>
    <div class="image">
        <img src="{{asset('storage/images/gallery/' . $image)}}" class="w-100 h-100" alt="{{$alt}}" />
    </div>
</a>