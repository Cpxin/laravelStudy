<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;

        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .container{
            margin: 0 auto;
            width: 1000px;
            padding: 50px 100px 80px;
        }
        .container-item{
            float: left;
            margin: 0 94px 0 0;
            font-weight: 400;
            font-size: 18px;
            line-height: 1.5;
        }
        .nav-title{
            margin-bottom: 19px;
            color: #a7adaf;
            font-size: 20px;

        }
        .nav{
            list-style: none;
        }
        .nav-item{
            margin-bottom: 5px;
            /*display: inline;*/
            /*float: right;*/
        }
        .nav-item p{

            text-align: left;
        }
    </style>
</head>
<body>
{{--<div class="flex-center position-ref full-height">--}}
@if (Route::has('login'))
    <div class="top-right links" style="">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">登录</a>
            {{--<a href="{{ route('register') }}">注册</a>--}}
        @endauth
    </div>
@endif

{{--<block  style="width:100%;height:500px;position: absolute;top: 50px">--}}
<div style="background:url({{asset('img/chicago_large_change.jpg')}}) center center / cover no-repeat;width:100%;height:500px;margin-top: 50px">
    {{--<div class="links">--}}
    {{--<a href="https://laravel.com/docs">Documentation</a>--}}
    {{--<a href="https://laracasts.com">Laracasts</a>--}}
    {{--<a href="https://laravel-news.com">News</a>--}}
    {{--<a href="https://forge.laravel.com">Forge</a>--}}
    {{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
    {{--</div>--}}
    <div class="jumbotron" style="background-color: #c7ddef;margin:0 auto ;position:relative;top:100px;width: 700px;height: 300px;opacity:0.8;">
        <h1 style="text-align: center">XXX公司</h1>
        <p style="float: right;margin-top: 20px">本公司提供专业的互联网服务</p>
        {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>
</div>
{{--</block>--}}
<div class="content" style="background-color:#23272b;height:500px;width: 100%;">
    <div class="container">
        {{--@foreach($article as $zt=>$t)--}}
            {{--<div class="container-item">--}}
                {{--<div class="nav-title">{{$zt}}</div>--}}
                {{--<ul class="nav">--}}
                    {{--@foreach($t as $k=>$v)--}}
                        {{--<li class="nav-item" onclick="" ><p>{{$v}}</p></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    </div>

</div>
{{--</div>--}}

<script src="{{asset('static/bootstrap/js/jquery-3.3.1.js')}}"></script>
<script src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>

<script>

</script>

</body>
</html>
