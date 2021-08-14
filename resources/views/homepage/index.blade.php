@extends('layouts.base_template')

@section('title')

@endsection

@section('content')

<!-- Home Page Banner Area Start -->
<section class="home_main_content" style="padding-bottom: 0;">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="box breadcumb" id="banner" style="min-height:350px; color:white">

                            <div class="p-5">
                                <span>Think Big & Get Rewards</span>
                                <h1 style="color:white">Somali Studies Centre</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="box" style="min-height:350px;border: thin solid gray;background-color: aliceblue;">
                            <div class="header d-flex justify-content-between" style="background-color:#47b502">
                                <p style="line-height: 40px;padding-left: 10px;color: white;">
                                    <i class="fas fa-star"></i>
                                    Somali Studies Centre
                                </p>
                            </div>
                            <div class="list">
                                <img src="/assets/images/open_access.png" height="130" alt="">
                                <hr>
                                <img src="/assets/images/cc_license.png" height="130" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</section>
<!-- Home Page Banner Area End -->

<!-- Home Page Main Content Area Start -->
<section class="home_main_content">
    <div class="container">
        <div class="row top_chart">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="header d-flex justify-content-between">
                                <p>
                                    <i class="fas fa-chart-line"></i>
                                    Top Trending Papers
                                </p>
                            </div>
                            <div class="list">
                                <ul>
                                    @php
                                    $limit = $trendingPublications->count() ;
                                    if($limit > 2)
                                    $limit =2;
                                    @endphp
                                    @foreach ($trendingPublications as $publication)
                                    <li>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" 
                                            class="d-flex justify-content-between">
                                            <p>
                                                <i class="fa fa-user"></i>
                                                {{$publication->Submitter->name}}
                                            </p>
                                            <p>
                                                <i class="fa fa-date"></i>
                                                {{$publication->updated_at}}
                                            </p>

                                        </a>
                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" >
                                            <strong>{{substr($publication->submission_title,0,45)}}</strong>
                                        </a>

                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" class=" justify-content-between">
                                            <div>
                                                {{substr($publication->submission_abstract,0,150)}}...

                                            </div>
                                            <div class="mt-3">
                                                <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}"
                                                 class="mr_btn_solid mt-3 text-white"><i class="fa fa-home"></i>
                                                    View</a>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box social_area">
                            <div class="header d-flex justify-content-between" style="background-color:#47b502">
                                <p>
                                    <i class="fas fa-star"></i>
                                    Latest papers
                                </p>
                            </div>
                            <div class="list">
                                <ul>
                                    @foreach ($trendingPublications as $publication)
                                    <li>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" 
                                            class="d-flex justify-content-between">
                                            <p>
                                                <i class="fa fa-user"></i>
                                                {{$publication->Submitter->name}}
                                            </p>
                                            <p>
                                                <i class="fa fa-date"></i>
                                                {{$publication->updated_at}}
                                            </p>

                                        </a>
                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" >
                                            <strong>{{substr($publication->submission_title,0,45)}}</strong>
                                        </a>

                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" class=" justify-content-between">
                                            <div>
                                                {{substr($publication->submission_abstract,0,150)}}...

                                            </div>
                                            <div class="mt-3">
                                                <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}"
                                                 class="mr_btn_solid mt-3 text-white"><i class="fa fa-home"></i>
                                                    View</a>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box scam_area">
                            <div class="header d-flex justify-content-between bg2">
                                <p>
                                    <i class="fas fa-eye"></i>
                                    Most viewed
                                </p>
                            </div>
                            <div class="list">
                                <ul>
                                    @foreach ($trendingPublications as $publication)
                                    <li>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" 
                                            class="d-flex justify-content-between">
                                            <p>
                                                <i class="fa fa-user"></i>
                                                {{$publication->Submitter->name}}
                                            </p>
                                            <p>
                                                <i class="fa fa-date"></i>
                                                {{$publication->updated_at}}
                                            </p>

                                        </a>
                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" >
                                            <strong>{{substr($publication->submission_title,0,45)}}</strong>
                                        </a>

                                        <hr>
                                        <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}" class=" justify-content-between">
                                            <div>
                                                {{substr($publication->submission_abstract,0,150)}}...

                                            </div>
                                            <div class="mt-3">
                                                <a href="/submission/{{$publication->id}}/{{$publication->submssion_token}}"
                                                 class="mr_btn_solid mt-3 text-white"><i class="fa fa-home"></i>
                                                    View</a>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row top_info">
            <div class="col-12 text-center">
                <h2 class="title">Join Highly Qualified Somali Researchers <span> </span></h2>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div class="box-1 d-flex">
                    <div class="item text-center align-self-center">
                        <h2>Access to thousands</h2>
                        <h5>Of Research papers</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="box-2 d-flex">
                    <div class="item text-center align-self-center">
                        <h5>Unlimited</h5>
                        <span>Article submission</span>
                        <a href="#">JOIN NOW</a>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="box-3 d-flex">
                    <div class="item text-center align-self-center">
                        <h5>Forum Discussions</h5>
                        <a href="#">JOIN NOW</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row rating_overview">
            <div class="col-lg-6">
                <div class="box">
                    <div class="header">
                        <i class="fas fa-star"></i>
                        Forum
                    </div>
                    <ul>
                        <li>
                            <div class="body d-flex">
                                <div class="left_content">
                                    <div class="info_box d-flex">
                                        <div class="emo">
                                            <img src="/assets/img/emoje/smile.png" alt="">
                                        </div>
                                        <div class="info">
                                            <span>Tomas Alva,....</span>
                                            <p>Jan 3rd, 2018, 07:50 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="Right_content">
                                    <p>
                                        It is a long established fact that a read
                                        er will be distracted.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="body d-flex">
                                <div class="left_content">
                                    <div class="info_box d-flex">
                                        <div class="emo">
                                            <img src="/assets/img/emoje/smile.png" alt="">
                                        </div>
                                        <div class="info">
                                            <span>Tomas Alva,....</span>
                                            <p>Jan 3rd, 2018, 07:50 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="Right_content">
                                    <p>
                                        It is a long established fact that a read
                                        er will be distracted.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="body d-flex">
                                <div class="left_content">
                                    <div class="info_box d-flex">
                                        <div class="emo">
                                            <img src="/assets/img/emoje/smile.png" alt="">
                                        </div>
                                        <div class="info">
                                            <span>Tomas Alva,....</span>
                                            <p>Jan 3rd, 2018, 07:50 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="Right_content">
                                    <p>
                                        It is a long established fact that a read
                                        er will be distracted.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="body d-flex">
                                <div class="left_content">
                                    <div class="info_box d-flex">
                                        <div class="emo">
                                            <img src="/assets/img/emoje/smile.png" alt="">
                                        </div>
                                        <div class="info">
                                            <span>Tomas Alva,....</span>
                                            <p>Jan 3rd, 2018, 07:50 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="Right_content">
                                    <p>
                                        It is a long established fact that a read
                                        er will be distracted.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="body d-flex">
                                <div class="left_content">
                                    <div class="info_box d-flex">
                                        <div class="emo">
                                            <img src="/assets/img/emoje/smile.png" alt="">
                                        </div>
                                        <div class="info">
                                            <span>Tomas Alva,....</span>
                                            <p>Jan 3rd, 2018, 07:50 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="Right_content">
                                    <p>
                                        It is a long established fact that a read
                                        er will be distracted.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <div class="header">
                        <i class="fas fa-star"></i>
                        Publications
                    </div>
                    <div class="graph">
                        <img class="img-fluid" src="/assets/img/graph.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Page Main Content Area End -->
@endsection

@section('vue-script')
@php $hash = hash('md5', file_get_contents('js/homepage.js')); @endphp
<script src="{{'/js/homepage.js?'.$hash}}" type="text/javascript"></script>
@endsection
