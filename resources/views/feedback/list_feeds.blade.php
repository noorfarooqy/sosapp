@extends('profile.layout.main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <div class="card shadow mb-4 p-2">
        <div class="card header p-3">
            <h6 class="m-0 font-weight-bold text-primary">Contact feedbacks</h6>
        </div>
        <div class="card body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>#</th>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $fkey => $feed)
                        <tr>
                            <td>{{$fkey+1}}</td>
                            <td>{{$feed->getFullName()}} - {{$feed->email}}</td>
                            <td>{{$feed->subject}}</td>
                            <td>{{substr($feed->message, 0,120)}}...</td>
                            <td>
                                <div class="dropdown no-arrow mb-4">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <a class="dropdown-item" href="#">View</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                        @if (!$feed->is_viewed)
                                        <a class="dropdown-item" href="">Mark as read</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
