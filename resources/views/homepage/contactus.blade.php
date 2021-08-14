@extends('layouts.base_template')

@section('title')
Contact us
@endsection

@section('content')
<!-- Home Page Banner Area Start -->
<section id="banner" class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="banner-info">
                <div class="col-12">
                    <span> We listen and we improve </span>
                    <h1>Contact us</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Page Banner Area End -->

<!-- brows hyip Area Start -->
<section id="contactUs">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="box">
                    <i class="fas fa-exchange-alt"></i>
                    <h3>Why contact us?</h3>
                    <p>
                        We believe in the value of sincere feedback and understand that an extra mind is a gold mine
                        that will enable us to get richer in the knowledge we possess. So please give us your
                        sincere feedback.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="box">
                    <i class="fas fa-headphones-alt"></i>
                    <h3>Will I get a reply?</h3>
                    <p>
                        Yes. You will definitely get a reply. At first you will receive an auto-email to acknowledge that 
                        we have recieved your feedback and one of our staff members will be looking into your feedback.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="box">
                    <i class="fas fa-recycle"></i>
                    <h3>How long to reply?</h3>
                    <p>
                        Usually it won't take more than 3 working days. In the
                        case of emergency feedback, you might contact us at the given email and phone numbers, and we'll
                        prioritize your feedback.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="google_map_wrapper">
        <div id="map"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 form_relative">
                <div class="contact_form_wrappre">
                    <div class="title">
                        <h2>
                            Get In Touch
                        </h2>
                    </div>
                    <livewire:contact-us-form/>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

	<!--    map js -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7eALQrRUekFNQX71IBNkxUXcz-ALS-MY&sensor=false"></script>
	<script src="/assets/js/plugins/gmap.js"></script>
@endsection