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
                    {{$submission->submission_title}} - {{count($authors)}}
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
                @error('error')
                <div class="row">
                    <div class="alert alert-danger">
                        
                        {{$message}}
                    </div>
                </div>
                @enderror
                
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
                
                <form method="POST" action="{{'/profile/submission/edit/authors/'.$submission->id}}" class="row mt-1"
                    enctype="multipart/form-data">
                    


                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Institution</th>
                                <th scope="col">Location</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                <tr >
                                    <td>{{$author->author_firstname .' '.$author->author_secondname}}</td>
                                    <td>{{$author->author_email}}</td>
                                    <td>{{$author->author_institute}}</td>
                                    <td>{{$author->author_location}}</td>
                                    <td>
                                        <a href="/profile/submission/re/{{$submission->id}}/{{$author->id}}" class="btn btn-danger" > - Delete </a >
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

                        <hr>
                        <div class="form-group row">
                            <div class="col-md-6 col-lg-6">
                                <input type="text" class="form-control" name="author_firstname"
                                placeholder="Enter Author first name" >
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <input type="text" class="form-control" name="author_secondname"
                                placeholder="Enter Author second name">
                            </div>

                            
                        </div>


                        <div class="form-group">
                            <input type="email" class="form-control" name="author_email"
                                placeholder="Enter Author email">
                        </div>
                        <div class="form-group row">

                            <div class="col-md-8 col-lg-8">
                                <input type="text" class="form-control" name="author_institution"
                                placeholder="Enter Author institution">
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <input type="text" class="form-control" name="author_location"
                                placeholder="Enter Author country">
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="author_sex">
                                <option value="-1">Select author sex</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>

                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success"> Add author</button>
                        </div>

                    </div>

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
