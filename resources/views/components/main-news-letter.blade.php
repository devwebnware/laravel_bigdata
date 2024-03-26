<div class="newsletter">
    <div class="container animatedParent animateOnce">
        <div class="row pt-5 pb-5">
            <div class="col-12 col-lg-5 col-md-12 animated growIn">
                <img src="{{asset('assets/img/Newsletter.png')}}" class="w-100 main-form-image" alt="">
            </div>
            <div class="col-12 col-lg-7 col-md-12 text-center mt-5 pt-2">
                <h6 class="display-5 mt-5 mt-lg-0">Transform Your Business</h6>
                <p class="text-muted mb-4">Take a step to make the Shift to Digital with Custom Tech Solutions.</p>
                <div class="">
                    <div class="form-submit col-12 mt-2 pt-0">
                        <a href="javascript:void(Tawk_API.toggle())" class="col-12 col-lg-5 btn white-btn me-md-3 me-1 text-dark">Live Chat with Us</a>
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>