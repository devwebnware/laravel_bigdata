<div class="newsletter">
    <div class="container animatedParent animateOnce">
        <div class="row pb-5">
            <div class="col-12 col-lg-5 col-md-12 animated growIn">
                <img src="{{asset('assets/img/Newsletter.png')}}" class="w-100 main-form-image" alt="Newsletter" title="Newsletter">
            </div>
            <div class="col-12 col-lg-7 col-md-12 text-center mt-4">
                <h2 class="display-5 mt-5 pt-3 mt-lg-0">Transform Your Business</h2>
                <p class="text-muted mb-4">Take a step to make the Shift to Digital with Custom Tech Solutions.</p>
                <form id="newsletter-form">
                    @csrf
                    <div class="mb-3 d-lg-flex">
                        <input name="email" class="form-control border-0 bg-white text-secondary no-border border-dark p-3 mt-3 newsletter-shadow " id="subscriber-email" type="email" placeholder="Enter Your Email Address" required>
                        <div class="form-submit col-lg-5 col-12">
                            <div class="d-grid">
                                <button class="btn form-button border-0 p-3 mt-3 no-border text-white newsletter-shadow newsletter-button" type="submit">Subscribe
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subscriberThanksModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered border-rounded" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center p-4">
                    <span class="las la-check-circle text-success display-4"></span>
                    <h2 class="mt-3">Thank you for subscribing!</h2>
                    <p>You will be the first to know about the latest technological transformation, updates on the newsletter and more.</p>
                    <button type="button" id="closesubscriberThanksModal" class="white-btn close" data-dismiss="modal" aria-label="Close">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>