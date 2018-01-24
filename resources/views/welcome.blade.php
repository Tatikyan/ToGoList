<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjsUCu9TfXeAuJmwnSA3nximCb0fZ8vR0"></script>
        <title>ToGoList</title>
    </head>
    <body>
        <div id="app">
            <left-sidebar></left-sidebar>
            <toGoList-places></toGoList-places>
            <edit-markers v-if="showModal"></edit-markers>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
    </body>
</html>
