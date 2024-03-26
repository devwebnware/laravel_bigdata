<style>
    .owl-item{
        border-radius: 50px !important;
        border: none !important;
}
</style>
<div class="industry-carousel">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="text-center align-items-center">
                    <h1 class="text-dark display-5">Industry Expertise</h1>
                    <p class="col-lg-8 col-12 text-muted m-auto p-2">With in-depth industry knowledge, we infuse intelligence, insights, and information to build custom digital solutions for you to enjoy an edge over others.
                    </p>
                </div>
            </div>
        </div>
        <!-- industry card pt-1-->
        <div class="row">
            <div class="owl-carousel owl-theme p-0 pt-3">
                {{$slot}}
            </div>
        </div>
    </div>
</div>