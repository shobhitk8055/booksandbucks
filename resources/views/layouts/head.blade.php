    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/favicon.png">
    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<div id="app">
    <avored-layout inline-template>
       @yield('content')
    </avored-layout>
</div>

@if(file_exists(public_path('mix-manifest.json')))
    <script src="{{ mix('js/avored.js') }}"></script>
@else
    <script src="{{ asset('js/avored.js') }}"></script>
@endif

@stack('scripts')

@if(file_exists(public_path('mix-manifest.json')))
    <script src="{{ mix('js/app.js') }}"></script>
@else
    <script src="{{ asset('js/app.js') }}"></script>
@endif
</body>
</html>