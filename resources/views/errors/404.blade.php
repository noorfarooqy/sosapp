@extends('layouts.errors_layout')

@section('title')
404 - Not found
@endsection

@section('content')
<div class="card radius-15 shadow-none bg-transparent">
    <div class="row no-gutters">
        <div class="col-lg-6">
            <div class="card-body">
                <h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span
                        class="text-success">4</span></h1>
                <h2 class="font-weight-bold display-4">Lost in Space</h2>
                <p>You have reached the edge of the universe.
                    <br>The page you requested could not be found.
                    <br>Dont'worry and return to the previous page.</p>
                <p>
                    {{$exception && $exception->getMessage() ? $$exception->getMessage() : ''}}
                </p>
                <div class="mt-5"> <a href="/" class="btn btn-lg btn-primary px-md-5 radius-30">Go Home</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="/admin/assets//images/errors-images/404-error.png" class="card-img" alt="">
        </div>
    </div>
    <!--end row-->
</div>
@endsection
