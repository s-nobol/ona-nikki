<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <a class="navbar-brand" href="#">おな日記</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> 08:15 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <span class="navbar-text">
                @auth
                    <form class="d-inline-block" action="/logs" method="POST" >
                        @csrf
                        <input type="submit" value="送信" class="btn btn-danger"/>
                    </form> 
                    <form class="d-inline-block" action="/logout" method="POST" >
                        @csrf
                        <input type="submit" value="ログアウト" class="btn btn-light"/>
                    </form>
                @else
                    <a class="" href="/login">ログイン</a>
                    <a class="" href="/register">サインアップ</a>
                @endauth
                </span>
            </div>
        </nav>
    </header>
    

    <!--<h1>ホームです</h1>-->
    <div class="row">
        
        
        <!--サイドバー（Left）-->
        <div class="col-2 p-0 m-0">
        
        <!--もしログインしていたらプロフィールを表示-->
        @auth
        <div>
            <div class="bg_red p-4"><b>てすと</b>　Lv.105 (エロ仙人)</div>
            <ul class="list-group">
              <li class="list-group-item">
                  <a href="/">年代</a>
              
              </li>
              <li class="list-group-item">
                  <a href="/logs/year/2018">2019</a>
              </li>
              <li class="list-group-item">
                  <a href="/logs/year/2018">2018</a>
              </li>
              <li class="list-group-item">
                  <a href="/logs">Log</a>
              </li>
              
              <li class="list-group-item">
                  <a href="{{ url('users', Auth::user()) }}">プロフィール</a>
              </li>
            </ul>
        </div>
        
        @else
            
        <div>
            <!--<img src="{{ asset('image/ona-nikki3.jpg') }}" style="width:100%;"></img>-->
        </div>
        
        <div class="bg_red p-4"><b>2018年版</b></div>
        <ul class="list-group">
            <li class="list-group-item">お知らせ</li>
            <li class="list-group-item">年代</li>
            <li class="list-group-item">2019</li>
            <li class="list-group-item">2018</li>
            <li class="list-group-item">2017</li>
            <li class="list-group-item">都道府県</li>
            <li class="list-group-item">カテゴリー</li>
            <li class="list-group-item">ランキング</li>
            <li class="list-group-item">探す</li>
            <li class="list-group-item">おな日記について</li>
            <li class="list-group-item">プライバシーポリシー</li>
        </ul>
            
          
        @endauth
        </div>
        <style type="text/css">
        .bg_red{
            background-color: #ff6768;
            background-color: rgba(250,98,95,0.7);
            background-color: rgba(255,95,95,1); /*候補1*/            
            background-color: #ff4a4a; /*候補2*/
            color: white; 
            }
        </style>
        
        <div class="col-8 pl-5 pr-5">
            <main class="">
                @yield('content')
            </main>
        </div>
    
        
         
        <!--サイドバー（Right）-->
        <div class="col-2">
            <div class="card p-3">
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
                <span>大阪府XXX氏が1円貢献しました。</span>
            </div>
        
        </div>
    </div>
        
    
    <!--サブフッター-->
    <div>
    </div>
    
    <!--フッター-->
    <footer>
        <div class="p-3 text-center">日本全国オワこん・プロジェクト</div>
    </footer>
</body>
</html>
