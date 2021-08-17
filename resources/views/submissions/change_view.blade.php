@extends('layouts.admin_layout')

@section('title')
Submission changes
@endsection

@section('content')
<div class="row">
    <div class="card mm-active col-7">
        <div class="card-header has-arrow row" aria-expanded="true">The publication has been
            {{$change->Submission->submissionStatus()}}</div>
        <div class="card-body mm-collapse mm-show" style="">
            <h6 class="card-title" style="text-decoration: ">
                <a href="{{Auth::user()->IsAdmin() ? '/admin' : '/profile'}}/submission/view/{{$change->submission_id}}">
                    <i class="bx bx-file mr-1"></i> {{$change->Submission->submission_title}}
                </a>
            </h6>
            <p class="card-text text-justify">
                <strong style="text-decoration: underline">
                    <i class="bx bx-comment mr-1"></i>
                    Peer review
                </strong><br>
                {{$change->comment ?? 'No peer review was given'}}
            </p>
            <p class="card-text text-justify">
                <strong style="text-decoration: underline">
                    <i class="bx bx-calendar mr-1"></i>
                    Date
                </strong><br>
                {{$change->updated_at->format('Y-m-d  -- H:m:s')}}
            </p>
            <p class="card-text text-justify">
                <strong style="text-decoration: underline">
                    <i class="bx bx-copy-alt mr-1"></i>
                    Attached file </strong><br>

                @if ($change->target_file)
                <a href="{{$change->target_file}}" download="" target="_blank"> <i class="bx bx-download mr-a"></i>
                    Download attached file</a>
                @else
                No file was attached 
                @endif
            </p>
            <p class="card-text text-justify">
                <strong style="text-decoration: underline">
                    <i class="bx bx-user-check mr-1"></i>
                    Moderated by </strong><br>

                <a href="/members/{{$change->Moderator->id}}" target="_blank"> <i class="bx bx-user mr-a"></i>
                    {{$change->Moderator->name}}
                </a>
            </p>
        </div>
    </div>
    <div class="card col ml-2">
        <div class="card-header row">
            Other status changes
        </div>
        <div class="card-body row">
            @foreach ($change->Submission->SubmissionChanges as $key=> $ch)
            <a class="dropdown-item d-flex align-items-center mb-3"
                href="{{Auth::user()->IsAdmin() ? '/admin' : '/profile'}}/submission/changes/{{$ch->id}}"
                style="white-space: unset">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{$ch->updated_at}}</div>
                    <div class="text">
                        {{$key+1}} - Submission status has been changed from
                        <span class="font-weight-bold">
                            {{$change->Submission->submissionStatus($ch->source_status)}}
                        </span>
                        to
                        <span class="font-weight-bold">
                            {{$change->Submission->submissionStatus($ch->target_status)}}
                        </span>
                    </div>

                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
