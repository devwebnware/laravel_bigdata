<section class="animatedParent">
    <header class="animated">
        <div class="container top-header d-lg-block d-none">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-white m-0 p-0" style="padding: 5px !important;">
                    <ul class="navbar-nav ml-auto ps-3">
                        <li class="nav-item nav-link pe-3" style="padding:0px !important"><i class="icon-phone pe-1" style="color:#13cad2;"></i><a href="tel:9529708616" target="_blank" class="p-0 m-0" style="background-color:#fff !important;">+91 95297 08616</a>
                        </li>
                        <li class="nav-item nav-link ms-4 d-flex align-items-center" style="padding:0px !important">
                            <i class="icon-GL_message_1 pe-1 fw-bolder" style="color:#13cad2;"></i><a href="mailto:info@lancersglobal.com" target="_blank" class="p-0 m-0" style="background-color:#fff !important; ">info@lancersglobal.com</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item ps-1 pe-1">
                            <a href="https://twitter.com/lancersglobal" class="nav-link-icon" target="_blank">
                                <i class="icon-twitter"></i>
                            </a>
                        </li>
                        <li class="nav-item ps-1 pe-1">
                            <a href="https://www.facebook.com/lancersglobal" class="nav-link-icon" target="_blank">
                                <i class="icon-facebook"></i>
                            </a>
                        </li>
                        <li class="nav-item ps-1 pe-1">
                            <a href="https://www.linkedin.com/company/globallancers/" class="nav-link-icon" target="_blank">
                                <i class="icon-linkedin2"></i>
                            </a>
                        </li>
                        <li class="nav-item ps-1 pe-1">
                            <a href="https://www.instagram.com/globallancers" class="nav-link-icon" target="_blank">
                                <i class="icon-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item ps-1 pe-1">
                            <a href="https://www.youtube.com/lancersglobal" class="nav-link-icon" target="_blank">
                                <i class="icon-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <hr class="m-0" />
        </div>
        <!--second navbar-->
        <nav id="navbar_top" class="navbar navbar-expand navbar-light bg-white pb-1 pt-1 ">
            <div class="container">
                <div class="row w-100 justify-content-md-center">
                    <a class="navbar-brand col-lg-3 col-md-7 col-10 m-0" href="/">
                        <img src="{{asset('assets/img/logo-rectangle.png')}}" class="w-100 p-2" alt="Admin Dashboard logo" title="Admin Dashboard logo">
                    </a>
                    <button class="navbar-toggler col-1 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
                        <span class="navbar-toggler-icon m-auto"></span>
                    </button>
                    <div class="collapse col-lg-9 ps-lg-5 ps-lg-0 ps-md-0 pt-md-0 pb-md-0 pt-2 pb-2 main-menu navbar-collapse text-lg-end text-center footer-zindex" id="main_nav">
                        <ul class="navbar-nav ms-auto nav-link-size">
                            <li class="nav-item">
                                <a class="nav-link menuhvr" href="{{route('solutions')}}">Solutions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuhvr" href="{{route('process')}}">Process</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menuhvr" href="{{route('insights.blogs')}}">Insights</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menuhvr" href="{{route('career')}}">Careers</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menuhvr" href="{{route('contactUs')}}">Contact </a>
                            </li>

                            <li class="nav-item text-white">
                                <span>
                                    <x-consultation-button title="Free Consultation" />
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @php $countryCodes = \App\Models\Country::orderBy('name','asc')->select('name','phonecode')->get(); @endphp
    <div class="modal fade text-start" id="appointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="border-radius: 10px !important;">
                <div class="modal-body p-0">
                    <div class="cross-button">
                        &times;
                    </div>
                    <div class="container-fluid p-0">
                        <div>
                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-6 bg-popup form-sidebar p-3 p-lg-5 pt-md-5 p-md-4 form-corner-left">
                                    <div class="d-md-none d-block text-end p-3 cross-button text-white">
                                        &times;
                                    </div>
                                    <div>
                                        <h4 class="text-white">ON A MISSION TO EMPOWER YOUR BUSINESS
                                        </h4>
                                        <p class="text-white pt-4">Embracing the innovation you need to reinvent your brand, revamp your processes and reimagine your industry. We are here to meet challenges & capture opportunities with Intelligence, Insights, & Information.</p>
                                    </div>
                                </div>
                                <!-- form -->
                                <div class="col-12 col-lg-8 col-md-6 p-3 p-lg-4 p-md-4 pe-md-3 ps-md-3 bg-md-transparent bg-white  form-corner-right">
                                    <div class="pt-md-0 pt-5">
                                        <p class="text-secondary mb-0">Schedule a free 15-30 minutes call and speak with our representative to find out how we can add value to your business. We would love to connect with you and know more about your business.</p>
                                    </div>
                                    <form class="mt-2" id="appointmentForm">
                                        @csrf
                                        <div class="form-group mt-4 row">
                                            <div class="col-6">
                                                <input type="text" id="name" class="form-control" name="full_name" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                                <label class="form-control-placeholder" for="name" style="display: block; width: 100%;">Full Name <span class="float-end full-name-error text-danger me-4"></span></label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" id="company_name" class="form-control" name="company_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' required>
                                                <label class="form-control-placeholder" for="company_name" style="display: block; width: 100%;">Company Name<span class="float-end company-name-error text-danger me-4"></span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12 mt-3">
                                                <div class="row d-flex">
                                                    <div class="col-5">
                                                        <div class="form-floating">
                                                            <select class="form-control form-select" id="country_code" name="country_code" required style="height: auto;padding: 11px 0;border-radius: 0px;">
                                                                <option selected value="">--</option>
                                                                @foreach($countryCodes as $countryCode)
                                                                @if($countryCode->phonecode != NULL)
                                                                <option value="{{$countryCode->phonecode}}">+{{$countryCode->phonecode}} ({{$countryCode->name}})</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            <!-- <label class="form-control-placeholder" for="country_code" style="display: block; width: 100%;"><span class="float-end country-code-error text-danger me-4"></span></label> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <input type="text" id="phone_number" class="form-control" name="phone" required maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress='return (event.charCode >= 48 && event.charCode <= 57 && event.charCode !=190)'>
                                                        <label class="form-control-placeholder" for="phone_number" style="display: block; width: 100%;">Phone Number<span class="phone-number-error text-danger me-4"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3 col-md-6 col-12">
                                                <input type="text" id="email" class="form-control" name="email" required>
                                                <label class="form-control-placeholder" for="email" style="display: block; width: 100%;">Email<span class="float-end email-error text-danger me-4"></span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mt-2 col-md-6 col-12">
                                                <label class="form-control-placeholder always-top" for="date" style="display: block; width: 100%;">Appointment Date<span class="float-end date-error text-danger me-4"></span></label>
                                                <input type="date" id="date" class="form-control mt-2" name="date" required>
                                            </div>
                                            <div class="form-group mt-2 col-md-6 col-12">
                                                <label class="form-control-placeholder always-top" for="time" style="display: block; width: 100%;">Appointment Time<span class="float-end time-error text-danger me-4"></span></label>
                                                <input type="time" id="time" class="form-control mt-2" name="time" min="05:00" max="00:00" step="900" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label class="form-control-placeholder mt-2" for="details" style="display: block; width: 100%;"><span class="float-end details-error text-danger me-4"></span></label>
                                                <textarea name="details" id="details" class="form-control" placeholder="How we can help you?" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row col-12 align-items-center">
                                            <div class="col-6">
                                                <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ config('variable.nocaptcha_sitekey')}}">
                                                </div>
                                                <span class="recaptcha-error text-danger"></span>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <button type="button" id="schedulebtn" class="btn default-btn text-white">BOOK AN APPOINTMENT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="thanksModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered border-rounded modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center p-4">
                        <span class="las la-check-circle text-success display-4"></span>
                        <h2 class="mt-3">Thank you for Connecting with Us!</h2>
                        <p>Your appointment has been scheduled.<br />Our team will get in touch with you soon.</p>
                        <button type="button" id="closeThanksModal" class="white-btn close" data-dismiss="modal" aria-label="Close">Keep Exploring!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('custom-js')
<script>
    $(document).ready(function() {
        var date = new Date().toISOString().slice(0, 10);
        //To restrict past date
        $('#date').attr('min', date);
    });
</script>
<script>
    $(document).ready(function() {
        $("#appointmentModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
</script>
<script>
    $('.nav-item a').each(function() {
        if (this.href.indexOf(location.pathname) > -1) {
            if (location.pathname != "/") {
                $(this).parents('li').addClass('active-menu');
            }
        }
    });
    $('#schedulebtn').click(function() {
        let flag = 0;
        if ($('#name').val() == "") {
            $('.full-name-error').html(' *Enter Full Name');
            flag += 1;
        } else {
            $('.full-name-error').html('');
        }

        let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if ($('#email').val() == "") {
            flag += 1;
            $('.email-error').html(' *Enter Email Address');
        } else if (!($('#email').val().match(mailformat))) {
            flag += 1;
            $('.email-error').html(' *Enter Valid Email Address');
        } else {
            $('.email-error').html("");
        }
        if ($('#country_code').val() == "") {
            flag += 1;
            $('.country-code-error').html(' *Select Country Code');
        } else {
            $('.country-code-error').html('');
        }

        if ($('#phone_number').val() == "") {
            flag += 1;
            $('.phone-number-error').html(' *Enter Phone Number');
        } else {
            $('.phone-number-error').html('');
        }

        if ($('#date').val() == "") {
            flag += 1;
            $('.date-error').html(' *Select Appointment Date');
        } else {
            $('.date-error').html('');
        }

        if ($('#time').val() == "") {
            flag += 1;
            $('.time-error').html(' *Select Appointment Time');
        } else {
            $('.time-error').html('');
        }

        if ($('#details').val() == "") {
            flag += 1;
            $('.details-error').html(' *Let Us know some details.');
        } else {
            $('.details-error').html('');
        }

        if (!(grecaptcha.getResponse())) {
            $('.recaptcha-error').html(' *reCAPTCHA is required');
            flag += 1;
        } else {
            $('.recaptcha-error').html('');
        }

        if (flag > 0) {
            event.preventDefault();
        } else {
            $('#schedulebtn').attr('disabled', 'true');
            $.ajax({
                type: "POST",
                url: "{{route('appointment.store')}}",
                data: $("#appointmentForm").serialize(),
                success: function(response) {
                    if (response.data) {
                        $('#appointmentModal').modal('hide');
                        $('#appointmentForm').trigger('reset');
                        $('#thanksModal').modal('show');
                    } else {
                        $('#appointmentModal').modal('show');
                    }
                    $('#schedulebtn').prop("disabled", false);
                },
                error: function(response) {
                    $('#appointmentModal').modal('show');
                }
            });
        }
    });
    $('#closeThanksModal').click(function() {
        $('#thanksModal').modal('hide');

    });
    $('#appointmentModal').on('hidden.bs.modal', function() {
        $('#appointmentForm').trigger('reset');
    });
    $('.cross-button').click(function() {
        $('#appointmentModal').modal('hide');
    });
</script>
@endpush