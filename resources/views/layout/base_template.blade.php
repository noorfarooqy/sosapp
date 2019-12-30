<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon_white.png">
    @php $hash = hash('md5', file_get_contents("css/main.css")); @endphp
    <link href="{{'/css/main.css?'.$hash}}" rel="stylesheet" />

</head>

<body>

    <div id="app">
        <errormodal v-if="Error.visible" v-bind="Error"
            v-on:close-error-modal="Error.resetModal()"></errormodal>
        <successmodal v-if="Success.visible" v-bind="Success"
        v-on:close-success-modal="Success.resetModal()"></successmodal>
        <div class="container is-fluid">
            @include('layout.nav_bar')
        </div>
        <div class="container body-container is-fluid">
            @yield('body-content')
        </div>

        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    <strong>Somali Studies Centre</strong> by <a href="https://soscentre.org">Noor A.</a>
                    is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
                </p>
            </div>
        </footer>
    </div>
    <script src="/js/import_files.js" type="text/javascript"></script>
    @yield('vue-script')
</body>

</html>
