@extends('profile.layout.main')
@section('custom-links')


@endsection

@section('page-content')

<errormodal v-on:dis-miss-error-modal="Error.resetErrorModal()" v-if="Error.visible" v-bind="Error"></errormodal>
<subsuccess v-if="Success.visible" v-bind="Success" v-on:dis-miss-subsuccess-modal="Success.resetSuccessModal()"></subsuccess>
<div class="row text-dark">
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

        @if (isset($successmessage))
        @foreach ($successmessage as $success)
        <div class="row">
            <div class="alert alert-success">
                
                {{$success}}
            </div>
        </div>
        @endforeach
        
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            
        <div class="row">
            <div class="alert alert-danger">
                
                {{$error}}
            </div>
        </div>
        @endforeach
        @endif
        <div class="card">
            @php
                $authors = $submission->subAuthors;
                $files = $submission->subFiles;
                if($submission->submission_status == 0 ) {$bg = "bg-info text-white"; $btn="btn-info";}  
                else if($submission->submission_status == 1){ $bg =  "bg-info text-white"; $btn="btn-info";}  
                else if($submission->submission_status == 2 ) {$bg ="bg-warning text-dark"; $btn="btn-warning"; }
                else if($submission->submission_status == 3) {$bg = "bg-danger text-white";  $btn="btn-danger";}  
                else if($submission->submission_status == 4) {$bg =  "bg-primary text-white";  $btn="btn-primary";} 
                else $bg = 'bg-none';
            @endphp
            <div class="card-header {{$bg}}">

                <span >
                    {{$submission->submission_title}} 
                </span>
                @if ($submission->submission_status === 0 || $submission->submission_status === 2)
                <span class="dropdown mb-4 float-right mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Choose action
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="/profile/submission/edit/manuscript/{{$submission->id}}">Edit manuscript</a>
                      <a class="dropdown-item" href="/profile/submission/edit/authors/{{$submission->id}}">Edit Authors</a>
                      <a class="dropdown-item" href="/profile/submission/edit/figures/{{$submission->id}}">Edit figures</a>
                      @if ($submission->submission_status === 2)
                      <form action="/profile/submission/resubmit/{{$submission->id}}" method="POST">
                        @csrf
                        <input type="text" value="{{$submission->id}}" name="submission" style="display:none">
                        <input type="submit" class="btn btn-primary col-md-12" value="Resubmit">
                    </form>
                      @endif
                      
                    </div>
                </span>
                @else
                <span class="float-right" >
                    {{$submission->submissionStatus()}}
                </span>
                @endif
                
                
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <img src="{{$submission->subFiles[0]->submission_file}}" height="200" width="100%"
                        class="ml-2 mt-2 border" alt="">
                    </div>
                    <div class="col-md-1 col-lg-1"></div>
                    <div class="col-md-7 col-lg-7">
                        <p class="text-justify">
                            {!! str_replace("\n", '<br>' , $submission->submission_abstract) !!}
                        </p>
                    </div>
                    
                </div>
                <div class="row mt-4">

                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header {{$bg}}">
                                Manuscript files
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead">
                                        <tr>
                                            <th>
                                                File Type
                                            </th>
                                            <th>
                                                View file
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody  text-dark">
                                        <tr>
                                            <td>
                                                Manuscript
                                            </td>
                                            <td>
                                                <a href="{{$submission->submission_manuscript}}"  style="width:100%"
                                                    class="btn {{$btn}}" download="">View Manuscript</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Cover
                                            </td>
                                            <td>
                                                <a href="{{$submission->submission_cover}}"  style="width:100%"
                                                    class="btn {{$btn}}" download="">View Cover</a>
                                            </td>
                                        </tr>
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>
                                                    {{$file->submission_file_type === 0 ? "Figure" : "Other"}}
                                                </td>
                                                <td>
                                                    <a href="{{$file->submission_file}}" style="width:100%"
                                                    class="btn {{$btn}}" download="">View File</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header {{$bg}}">
                                Authors
                            </div>
                            <div class="card-body">
                                <table class="table  text-dark">
                                    <thead class="thead ">
                                        <tr>
                                            <th>Author name</th>
                                            <th>Institute</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                        <tr>
                                            <td>
                                                {{$author->author_firstname. " "}} 
                                                {{$author->author_secondname}}
                                            </td> 
                                            <td>
                                                {{$author->author_institute}}
                                            </td>
                                            <td>
                                                {{$author->author_location}}
                                            </td>
                                             
                                        </tr>
                                @endforeach
                                    </tbody>
                                
                                </table class="table">
                            </div>
                        </div>
                    </div>
                    
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