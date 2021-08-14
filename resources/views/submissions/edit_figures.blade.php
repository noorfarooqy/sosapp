@extends('profile.layout.main')
@section('custom-links')


@endsection

@section('content')

<errormodal v-on:dis-miss-error-modal="Error.resetErrorModal()" v-if="Error.visible" v-bind="Error"></errormodal>
<subsuccess v-if="Success.visible" v-bind="Success" v-on:dis-miss-subsuccess-modal="Success.resetSuccessModal()">
</subsuccess>
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
        <div class="card">
            @php
            $authors = $submission->subAuthors;
            $files = $submission->subFiles;
            if($submission->submission_status == 0 ) {$bg = "bg-info text-white"; $btn="btn-info";}
            else if($submission->submission_status == 1){ $bg = "bg-info text-white"; $btn="btn-info";}
            else if($submission->submission_status == 2 ) {$bg ="bg-warning text-dark"; $btn="btn-warning"; }
            else if($submission->submission_status == 3) {$bg = "bg-danger text-white"; $btn="btn-danger";}
            else if($submission->submission_status == 4) {$bg = "bg-primary text-white"; $btn="btn-primary";}
            else $bg = 'bg-none';
            @endphp
            <div class="card-header {{$bg}}">

                <span>
                    {{$submission->submission_title}} 
                </span>
                <a href="/profile/submission/view/{{$submission->id}}" class="btn btn-primary float-right">Go back</a>

            </div>
            <div class="card-body">
                
                @error('error')
                <div class="row">
                    <div class="alert alert-danger">
                        
                        {{$message}}
                    </div>
                </div>
                @enderror
                
                
                
                    
                    @csrf

                    <div class="card-body">
                        <div class="box">
                            <div class="box-head">
                                File requirements
                            </div>
                            <div class="box-content">
                                <ol>
                                    <li>File size does not exceed more than 10 MB</li>
                                    <li>File type must be jpg, jpeg or png</li>
                                </ol>
                            </div>
                        </div>
                        <div class="box">
                            @if (isset($successmessage))
                            @foreach ($successmessage as $success)
                            <div class="row">
                                <div class="alert alert-success">
                                    
                                    {{$success}}
                                </div>
                            </div>
                            @endforeach
                            
                            @endif
                            <div class="row">
                                <button class="btn btn-info col-md-3 col-lg-3"
                                @click.prevent="$refs.figures_uploader.click()">
                                    <i class="fas fa-fw fa-camera"></i>
                                    Upload Figures
                                </button>
                            </div>

                            @error('submission_figures')
                            <div class="row">
                                <div class="alert alert-danger">
                                    
                                    {{$message}}
                                </div>
                            </div>
                            @enderror
                            <div class="row">
                                
                                <form method="POST" action="{{'/profile/submission/edit/figures/'.$submission->id}}" class="row mt-1"
                                    enctype="multipart/form-data" id="submission_figures">
                                    @csrf
                                    <input type="file" style="display:none" ref="figures_uploader"  name="submission_figures"
                                    onchange="document.querySelector('form#submission_figures').submit()" 
                                    accept="image/jpeg,image/png,image/jpeg">
                                </form>
                                
                                
                            </div>
                        </div>
                        <div class="box mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">File</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($files as $figure)
                                    <tr >
                                        <td scope="row">
                                            <a href="{{$figure->submission_file}}" target="_blank">
                                                <img src="{{$figure->submission_file}}" alt="" height="40">
                                            </a>
                                        </td>
                                        <td>{{$figure->submission_file_type  === 0 ? " Figure " : " Other "}}</td>
                                        <td>
                                            <a href="/profile/submission/re/figure/{{$submission->id}}/{{$figure->id}}" class="btn btn-danger">-Remove</a>
                                        </td>
                                      </tr>
                                    @endforeach
                                     
                                    </tbody>
                                </table>
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
