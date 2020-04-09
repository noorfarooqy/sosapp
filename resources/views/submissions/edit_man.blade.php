@extends('profile.layout.main')
@section('custom-links')


@endsection

@section('page-content')

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

            </div>
            <div class="card-body">
                @if (isset($successmessage))
                @foreach ($successmessage as $success)
                <div class="row">
                    <div class="alert alert-success">
                        
                        {{$success}}
                    </div>
                </div>
                @endforeach
                @endif
                
                @error('submission_manuscript')
                <div class="row">
                    <div class="alert alert-danger">
                        
                        {{$message}}
                    </div>
                </div>
                @enderror
                @error('submission_cover')
                <div class="row">
                    <div class="alert alert-danger">
                        
                        {{$message}}
                    </div>
                </div>
                @enderror
                
                
                <form method="POST" action="{{'/profile/submission/edit/manuscript/'.$submission->id}}" class="row mt-1"
                    enctype="multipart/form-data">
                    <div class="col-md-7 col-lg-7">
                        <div class="row ml-1"><strong>Abstract</strong></div>
                        <div class="row border">
                            @if (old('submission_abstract'))
                            <textarea class="col-md-12" name="submission_abstract" style="resize:none"
                            rows="10">{{ old('submission_abstract') }}</textarea>
                            @else

                            <textarea class="col-md-12" name="submission_abstract" style="resize:none"
                            rows="10">{{ $submission->submission_abstract}}</textarea>
                            @endif
                            
                        </div>
                        <div class="row mt-3 ml-1"><strong>Keywords</strong></div>
                        <div class="row border">
                            @if (old('submission_keywords'))
                            <input type="text" class="form-control text-dark" name="submission_keywords"
                            value="{{  old('submission_keywords')}}">
                            @else
                            <input type="text" class="form-control text-dark" name="submission_keywords"
                            value="{{  $submission->submission_keywords}}">
                            @endif
                            
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">

                        <div class="row ml-1"><strong>Edit manuscript / cover</strong></div>
                        <div class="row" >
                                <table class="table text-dark">
                                    <thead class="thead {{$bg}}">
                                        <tr>
                                            <th>File</th>
                                            <th>View</th>
                                            <th>Change</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Manuscript</td>
                                            <td>
                                                <a href="{{$submission->submission_manuscript}}" download="">Open File</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-info" @click.prevent="$refs.man_uploader.click()" >
                                                    Change
                                                </button>
                                                <div style="display:none">
                                                    <input type="file" ref="man_uploader" name="submission_manuscript">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cover file</td>
                                            <td>
                                                <a href="{{$submission->submission_cover}}" download=""> Open File</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-info" @click.prevent="$refs.cover_uploader.click()" >
                                                    Change
                                                </button>
                                                <div style="display:none">
                                                    <input type="file" ref="cover_uploader" name="submission__cover">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @csrf
                                <div class=" mt-3">
                                    <button type="submit" style="width:100%" class="ml-3 btn btn-success"> Update manuscript</button>
                                </div>
                        </div>
                        
                    </form>
                </form>


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
