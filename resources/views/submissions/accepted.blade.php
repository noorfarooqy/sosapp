@extends('profile.layout.main')
@section('custom-links')


@endsection

@section('page-content')

<errormodal v-on:dis-miss-error-modal="Error.resetErrorModal()" v-if="Error.visible" v-bind="Error"></errormodal>
<subsuccess v-if="Success.visible" v-bind="Success" v-on:dis-miss-subsuccess-modal="Success.resetSuccessModal()"></subsuccess>
<div class="row">
    <div class="col-md-1 col-lg-1"></div>
    <div class="col-md-10 col-lg-10">
        @if (!$has_profile)
        <div class="card">
            <div class="card-header alert alert-danger">

                Incomplete profile

            </div>
            <div class="card-body">
                Please complete your profile first, before submitting a new paper
            </div>
            <div class="card-footer">
                <a href="/profile/details" class="btn btn-primary">Complete profile</a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header bg-primary text-white">

                Accepted Submissions
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($accepted_submissions as $sub)
                        <div class="col-md-4 col-lg-3 col-sm-12 mt-2 col-xs-12 text-center" style="border-bottom:thin solid gray">
                            @php
                                $files = $sub->subFiles;
                               
                            @endphp
                            <div class="row">
                                <a href="/profile/submission/view/{{$sub->id}}">
                                    <img src="{{$files[0]->submission_file}}" alt="" height="200" class="col-md-12 col-lg-12">
                                </a>
                                
                            </div>
                            <div class="row justify-content-center">
                                @php
                                    $title = substr($sub->submission_title, 0,35)
                                @endphp
                                <a href="/profile/submission/view/{{$sub->id}}">
                                    {{$title}}
                                    @if (strlen($title) > 35)
                                        ...
                                    @endif
                                </a>
                            </div>
                            <div class="row justify-content-center">
                                {{$sub->updated_at}}
                            </div>
                            
                        </div>
                    @endforeach
                    @if ($accepted_submissions->count() <= 0)
                        There are no accepted submissions at the moment
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection


@section('custom_scripts')

<script>
    window.api_token = "{{Auth::user()->api_token}}"
    
</script>
@php 
$hash = hash('md5', file_get_contents(public_path('js/new_submission.js')));
@endphp
<script src="/js/new_submission.js?{{$hash}}"></script>

@endsection