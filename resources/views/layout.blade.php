<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" media="all">

    {{--Additional Styles--}}
    @stack('styles')

</head>
<body>
@include('header')
<div class="container bg-light text-dark rounded">
    <div class="container-fluid w-100 p-2">
        @include('errors')
        <div id="app">
            {{-- Content--}}
            @yield('content')
        </div>
    </div>
</div>

    @include('javascript')
    <script src="{{ mix('js/app.js') }}" ></script>
    {{-- Additional Scripts--}}
    @stack('scripts')

</body>
</html>
