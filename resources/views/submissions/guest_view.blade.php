@extends('layouts.base_template')
@section('custom-links')


@endsection

@section('content')

<errormodal v-on:dis-miss-error-modal="Error.resetErrorModal()" v-if="Error.visible" v-bind="Error"></errormodal>
<subsuccess v-if="Success.visible" v-bind="Success" v-on:dis-miss-subsuccess-modal="Success.resetSuccessModal()">
</subsuccess>
<div class="row text-dark mt-4">
    <div class="col-md-1 col-lg-1"></div>
    <div class="col-md-10 col-lg-10">
        

        @if (Session::has('success'))
       
        <div class="alert alert-success">

            {{Session::get('success')}}
        </div>

        @endif
        @if ($errors->any())
            <div class="alert alert-danger">

                {{$errors-first()}}
            </div>
        @endif
        <div class="card">
            @php
            $authors = $publication->subAuthors;
            $files = $publication->subFiles;
            if($publication->submission_status == 0 ) {$bg = "bg-info text-white"; $btn="btn-info";}
            else if($publication->submission_status == 1){ $bg = "bg-info text-white"; $btn="btn-info";}
            else if($publication->submission_status == 2 ) {$bg ="bg-warning text-dark"; $btn="btn-warning"; }
            else if($publication->submission_status == 3) {$bg = "bg-danger text-white"; $btn="btn-danger";}
            else if($publication->submission_status == 4) {$bg = "bg-primary text-white"; $btn="btn-primary";}
            else $bg = 'bg-none';
            @endphp
            <div class="card-header {{$bg}}">

                <span>
                    {{$publication->submission_title}}
                </span>
                
                
                
                <span class="float-right">
                    {{$publication->publishInformation[0]->updated_at}}
                </span>



            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <img src="{{$publication->subFiles[0]->submission_file}}" height="200" width="100%"
                            class="ml-2 mt-2 border" alt="">
                    </div>
                    <div class="col-md-1 col-lg-1"></div>
                    <div class="col-md-7 col-lg-7">
                        <h3 class="mb-2" style="text-decoration: underline"> 
                            <i class="fa fa-pencil-alt mr-3"></i>
                            {{$publication->submission_title}}
                        </h3>
                        <p class="text-justify">
                            {!! str_replace("\n", '<br>' , $publication->submission_abstract) !!}
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
                                
                                <i class="fa fa-2x fa-file-pdf"></i>
                                <span class="fa fa-2x ml-3">
                                    <a href="{{$publication->publishInformation[0]->target_file}}" target="_blank">
                                        View PDF
                                    </a>
                                </span>
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

    </div>
</div>

@endsection


@section('custom_scripts')


@endsection
