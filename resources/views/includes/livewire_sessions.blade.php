@if ($error_message)
<div class="form-row">
    <div class="alert alert-danger col">
        {{$error_message}}
    </div>
</div>
@endif

@if ($success_message)
<div class="row">
    <div class="alert alert-success col">
        {{$success_message}}
    </div>
</div>
@endif