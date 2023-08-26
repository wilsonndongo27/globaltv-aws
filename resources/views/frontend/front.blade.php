<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Global TV au coeur de l'actualité.">
        <meta name="keywords" content="TV, Chaîne de télévision, Afrique, Cameroun, Télévision">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>Global TV</title>


        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->

        <link rel="icon" type="image/png" sizes="100x100" href="{{ asset ('images/logo.png') }}">
        <meta name="theme-color" content="#ffffff">

        <title>Global TV</title>
        <link rel="stylesheet" type="text/css" href="{{ asset ('css/app.css') }}"/>
    </head>
    <body>
        <div id="app"></div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
