@extends('profile.layout.main')

@section('page-content')
    

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
        <div class="card-header">

            New Submission
        </div>
        <div class="card-body"></div>
    </div>
    @endif
     
    </div>
</div>
@endsection