@extends('layouts.admin_layout')
@section('title')
Resent publications
@endsection

@section('content')

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
            <div class="card-header bg-warning text-dark">

                Resent Submissions
            </div>
            <div class="card-body row">
                @foreach ($resent_submissions as $sub)
                @php
                $files = $sub->subFiles;

                @endphp
                <div class="col-4">
                    <div class="card">
                        <a href="{{Auth::user()->IsAdmin() ? '/admin' : '/profile'}}/submission/view/{{$sub->id}}">
                            <img src="{{$files[0]->submission_file}}" height="200" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="{{Auth::user()->IsAdmin() ? '/admin' : '/profile'}}/submission/view/{{$sub->id}}">
                                    <strong>
                                        <i class="bx bx-edit mr-1"></i>{{substr($sub->submission_title, 0,35)}}...
                                    </strong>
                                </a>
                            </h6>
                            <p class="card-text">
                                <i class="bx bx-comment mr-1"></i>{{substr($sub->submission_abstract, 0,55)}}...
                            </p>
                            <p class="card-text"><small class="text-muted">
                                    <i class="bx bx-calendar mr-1"></i> {{$sub->updated_at->format('Y-m-d H:m:s')}}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>

                
                @endforeach
                @if ($resent_submissions->count() <= 0) 
                There are no resent submissions at the moment 
                @endif
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