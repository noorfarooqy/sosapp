@extends('layouts.base_template')

@section('title')
Archive
@endsection

@section('content')

<div class="container">
    <div class="row m-3">
        @foreach ($volumes as $volume)
        <div class="card col-md-4 col-lg-4 mt-3">
            <div class="card-header row bg-primary text-white">
                 Volume - {{$volume["volume_name"]}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="ml-3">
                            @foreach ($volume["issues"] as $issue)
                            <li>
                                <span data-toggle="collapse"
                                    href="#multiCollapseExample{{$volume["volume_name"].$issue["issue_name"]}}">
                                    <i class="fa fa-list-ol"></i>
                                    {{-- {{print_r($issue)}}? July --}}
                                    Issue - {{$issue["issue_name"]}}
                                </span>

                                @foreach ($issue["articles"] as $article)
                                <ul class="collapse multi-collapse ml-2"
                                    id="multiCollapseExample{{$volume["volume_name"].$issue["issue_name"]}}">
                                    <li class="">
                                        <i class="fa fa-leaf"></i>
                                        {{-- {{print_r($article)}} --}}
                                        <a href="/submission/{{$article["id"].'/'.$article["token"]}}" target="_blank">
                                            {{$article["title"]}}
                                        </a>
                                    </li>
                                </ul>
                                @endforeach
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        
        @endforeach


    </div>
</div>

@endsection

@section('vue-script')
{{-- @php $hash = hash('md5', file_get_contents('js/archive.js')); @endphp --}}
{{-- <script src="{{'/js/archive.js?'.$hash??1}}" type="text/javascript"></script> --}}
@endsection
