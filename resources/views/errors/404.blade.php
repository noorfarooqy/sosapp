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
                <p>You have reached deep into the universe.
                    You can continue with your journey to search,
                    or you can request <a href="/">Spore Drive Jumb</a> from Commanding Officer 
                    Spock of Starship Dumb Enterprise by <a href="https://www.youtube.com/watch?v=Xk6Y79vduEE" target="_blank">Clicking here</a> </p>
                <p>
                    {{$exception && $exception->getMessage() ? $exception->getMessage() : ''}}
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
