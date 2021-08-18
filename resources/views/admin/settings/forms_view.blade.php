@extends('layouts.admin_layout')

@section('title')
Settings
@endsection

@section('content')
<div class="row">
    <div class="card col-md-6">
        <div class="card-header">
            Application settings
        </div>
        <div class="card-body">
            <form id="logoFaviconToken">
                @csrf
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Application favicon</label>
                                <input id="application-favicon-upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" >
                            </div>
                        </div>
                        <div class="col">

                        <div class="form-group">
                            <label for="">Application logo</label>
                            <input id="application-logo-upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" >
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')

<link href="/admin/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
<link href="/admin/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
@endsection

@section('scripts')

<script src="/admin/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="/admin/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="/admin/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="/admin/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script>
    $(document).ready(function () {
        var token;
        $('#application-logo-upload').FancyFileUpload({
            url: '/admin/settings/file?type=logo',
            params: {
                _token : $('#logoFaviconToken').find("input[name='_token']").first().val()
            },
            maxfilesize: 60000000,
            startupload : function(SubmitUpload, e, data) {
                SubmitUpload();
            },
            continueupload : function(e, data) {
                var ts = Math.round(new Date().getTime() / 1000);

                // Alternatively, just call data.abort() or return false here to terminate the upload but leave the UI elements alone.
                if (token.expires < ts)  data.ff_info.RemoveFile();
            },
            uploadcompleted : function(e, data) {
                data.ff_info.RemoveFile();
            }
        });
        $('#application-favicon-upload').FancyFileUpload({
            url: '/admin/settings/file?type=favicon',
            params: {
                _token : $('#logoFaviconToken').find("input[name='_token']").first().val()
            },
            maxfilesize: 60000000,
            startupload : function(SubmitUpload, e, data) {
                SubmitUpload();
            },
            continueupload : function(e, data) {
                var ts = Math.round(new Date().getTime() / 1000);

                // Alternatively, just call data.abort() or return false here to terminate the upload but leave the UI elements alone.
                if (token.expires < ts)  data.ff_info.RemoveFile();
            },
            uploadcompleted : function(e, data) {
                data.ff_info.RemoveFile();
            }
        });
    });

</script>
@endsection
