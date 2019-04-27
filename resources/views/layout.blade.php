<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" media="all">
</head>
<body>
@include('header')
<div id="app" class="container bg-light text-dark rounded">
    <div class="container-fluid w-100 p-2">
        @include('errors')
        @yield('content')
    </div>
</div>
<script src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
