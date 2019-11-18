<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Scripts -->
        <!--<script src="{{ secure_asset('js/app.js') }}" defer></script>-->
        
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" -->
        <!--integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>-->
        
        <!--fontawesome-->
        <script src="https://kit.fontawesome.com/23bd8e9c43.js" crossorigin="anonymous"></script>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <!--<link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">-->
        <!--<link href="{{ secure_asset('css/anime.css') }}" rel="stylesheet">-->
        
      
        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<!--認証クラス-->
<div>
@auth<small>{{Auth::user()->name}} はログイン済みです</small>
@else<small>ログインしていません</small> 
@endauth
</div>
<div id="app"></div>
<script src="{{ mix('js/app.js') }} "></script>
</body>
</html>
