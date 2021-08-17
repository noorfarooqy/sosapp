@extends('layouts.admin_layout')
@section('title')
Published
@endsection

@section('content')

<div class="row text-dark">
    <div class="col-md-1 col-lg-1"></div>
    <div class="col-md-10 col-lg-10">

        @if (Session::has('success'))
        
        <div class="alert alert-success">

            {{Session::get('success')}}
        </div>
       

        @endif
        @if ($errors->any())
        <div class="alert alert-danger">

            {{$errors->first()}}
        </div>
        @endif
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
                <div class="row">
                    <form action="/admin/submission/status/update/{{$submission->id}}/4"
                        enctype="multipart/form-data" method="post" class=" col-md-10 col-lg-10">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Comment*</label>
                            <textarea name="comment" style="resize: none"
                            class="form-control" id="" cols="30" rows="10">{{old('comment')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="updateFile">Resend Reason file *</label>
                            <input type="file" class="form-control" name="updateFile">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Resend submission" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@section('custom_scripts')

@endsection
