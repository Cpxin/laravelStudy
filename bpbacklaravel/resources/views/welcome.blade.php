<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                width: 950px;
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
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            {{--<block  style="width:100%;height:500px;position: absolute;top: 50px">--}}
                <div style="background:url({{asset('img/chicago_large_change.jpg')}}) center center / cover no-repeat;width:100%;height:500px;margin-top: 50px">
                    <div class="links">
                        <a href="https://laravel.com/docs">Documentation</a>
                        <a href="https://laracasts.com">Laracasts</a>
                        <a href="https://laravel-news.com">News</a>
                        <a href="https://forge.laravel.com">Forge</a>
                        <a href="https://github.com/laravel/laravel">GitHub</a>
                    </div>
                </div>
            {{--</block>--}}
            <div class="content" style="background-color:#23272b;height:500px;width: 100%;">
                <div class="container">
                    <div class="container-item">
                        <div class="nav-title">关于公司</div>
                        <ul class="nav" >
                            <li class="nav-item" ><p>公司介绍</p></li>
                            <li class="nav-item" ><p>发展历程</p></li>
                            <li class="nav-item" ><p>管理团队</p></li>
                            <li class="nav-item" ><p>文化和价值观</p></li>
                            <li class="nav-item" ><p>企业荣誉</p></li>
                        </ul>
                    </div>
                    <div class="container-item">
                        <div class="nav-title">业务体系</div>
                        <ul class="nav" >
                            <li class="nav-item" ><p>业务体系</p></li>
                        </ul>
                    </div>
                    <div class="container-item">
                        <div class="nav-title">新闻及媒体资源</div>
                        <ul class="nav" >
                            <li class="nav-item" ><p>新闻发布</p></li>
                            <li class="nav-item" ><p>媒体资料库</p></li>
                        </ul>
                    </div>
                    <div class="container-item">
                        <div class="nav-title">联系我们</div>
                        <ul class="nav" >
                            <li class="nav-item" ><p>商务合作</p></li>
                            <li class="nav-item" ><p>公司地址</p></li>
                            <li class="nav-item" ><p>廉政举报</p></li>
                        </ul>
                    </div>
                </div>


            </div>
        {{--</div>--}}

    </body>
    {{--<body>--}}
    {{--<div id="app_container">--}}
        {{--<header class="sc-dxgOiQ SUDvc">--}}
            {{--<div class="sc-bxivhb roSuK">--}}
                {{--<div class="sc-ifAKCX coWWXk">--}}
                    {{--<div class="sc-htpNat jLRMUG">--}}
                        {{--<div class="sc-bwzfXH bUXzwj">--}}
                            {{--<a class="sc-ckVGcZ PXuvl " href="/">Tidewater</a>--}}
                            {{--<div class="sc-kpOJdX cQGAxk">--}}
                                {{--<a class="sc-cSHVUG gogjpJ sc-bZQynM hbyLHV" href="/acquire">Acquire</a>--}}
                                {{--<a class="sc-cSHVUG gogjpJ sc-bZQynM hbyLHV" href="/documentation">Developer</a>--}}
                                {{--<a class="sc-cSHVUG gogjpJ sc-bZQynM hbyLHV" href="/mail">Address Enhance</a>--}}
                                {{--<a class="sc-cSHVUG gogjpJ sc-bZQynM hbyLHV" href="/enhance">Model Enhance</a>--}}
                                {{--<a class="sc-cSHVUG gogjpJ sc-bZQynM hbyLHV" href="/login">Log in</a>--}}
                                {{--<div class="sc-kAzzGY goVgju">--}}
                                    {{--<div type="button" class="sc-dnqmqq cEpLgy" aria-haspopup="true" aria-expanded="false">--}}
                                        {{--<span class="sc-iwsKbI hWKaaF">--}}
                                            {{--<svg aria-hidden="true" data-prefix="far" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">--}}
                                                {{--<path fill="currentColor" d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"></path>--}}
                                            {{--</svg></span><svg aria-hidden="true" data-prefix="fas" data-icon="caret-down" class="svg-inline--fa fa-caret-down fa-w-10 tw-dropdown-caret sc-gZMcBi hxhDol" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>--}}
                                        {{--</svg>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@if (Route::has('login'))--}}
                                {{--<div class="top-right links">--}}
                                    {{--@auth--}}
                                        {{--<a href="{{ url('/home') }}">Home</a>--}}
                                    {{--@else--}}
                                        {{--<a href="{{ route('login') }}">Login</a>--}}
                                        {{--<a href="{{ route('register') }}">Register</a>--}}
                                    {{--@endauth--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</header>--}}

        {{--<div class="sc-kkGfuU ddhdRc">--}}
            {{--<div class="sc-ifAKCX coWWXk">--}}
                {{--<div class="sc-htpNat ijVufC">--}}
                    {{--<section class="sc-hzDkRC gPoPUW">--}}
                        {{--<div class="sc-jhAzac jZNiiP">--}}
                            {{--<div class="sc-ifAKCX coWWXk">--}}
                                {{--<div class="sc-htpNat kCSHSq">--}}
                                    {{--<h1 class="sc-fBuWsC euUHPQ">The Direct Mail Platform for Digital Marketers</h1>--}}
                                    {{--<h2 class="sc-fMiknA jHtDKp">We make acquiring customers with direct mail as easy as creating a Facebook campaign.</h2>--}}
                                    {{--<a class="" href="/signup"><button class="sc-iAyFgw gQSWqU">Create a Campaign</button></a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="sc-EHOje iLSuqh"><div class="sc-dVhcbM pCYKq">--}}
                                {{--<div class="sc-ifAKCX coWWXk">--}}
                                    {{--<div class="sc-htpNat elqVqX">--}}
                                        {{--<strong class="sc-eqIVtm fNqsed">--}}
                                            {{--<div class="sc-kEYyzF hUHiHZ"><svg aria-hidden="true" data-prefix="fas" data-icon="sync-alt" class="svg-inline--fa fa-sync-alt fa-w-16 fa-spin fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                                                    {{--<path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z">--}}

                                                    {{--</path>--}}
                                                {{--</svg>--}}
                                            {{--</div>--}}
                                        {{--</strong>--}}
                                        {{--<p class="sc-fAjcbJ elXJea">Data Points Analyzed Last 90 Days</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="sc-htpNat elqVqX">--}}
                                        {{--<strong class="sc-eqIVtm fNqsed">--}}
                                            {{--<div class="sc-kEYyzF hUHiHZ">--}}
                                                {{--<svg aria-hidden="true" data-prefix="fas" data-icon="sync-alt" class="svg-inline--fa fa-sync-alt fa-w-16 fa-spin fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                                                    {{--<path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z">--}}

                                                    {{--</path>--}}
                                                {{--</svg>--}}
                                            {{--</div>--}}
                                        {{--</strong>--}}
                                        {{--<p class="sc-fAjcbJ elXJea">Small Business Updates Last 90 Days</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</section>--}}
                    {{--<div class="sc-gPEVay iuXfiJ">--}}
                        {{--<div class="sc-bxivhb roSuK">--}}
                            {{--<div class="sc-iRbamj jcgqAX">--}}
                                {{--<div class="sc-jlyJG kgRmkD">--}}
                                    {{--<header class="sc-gipzik eUnEIy">--}}
                                        {{--<h3 class="sc-csuQGl fskAed">Lookalikes for Direct Mail</h3>--}}
                                    {{--</header>--}}
                                    {{--<p class="sc-Rmtcm dewKyV">Tidewater leverages machine learning to find similar businesses to your customers--}}
                                        {{--based on 200+ signals for your direct mail campaigns. You can also create a custom--}}
                                        {{--audience or use your own lists.</p>--}}
                                    {{--<a class="" href="/signup">--}}
                                        {{--<button class="sc-iAyFgw eFRfPo" type="primary">Create a Lookalike Audience</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="sc-jlyJG kgRmkD">--}}
                                    {{--<img class="sc-bRBYWo hfvkHh" src="https://tidewater.io/cta_image_2.png" alt="Lookalikes for Direct Mail">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="sc-gPEVay fGdWMY">--}}
                        {{--<div class="sc-bxivhb roSuK">--}}
                            {{--<div class="sc-iRbamj cymTgn">--}}
                                {{--<div class="sc-jlyJG kgRmkD">--}}
                                    {{--<header class="sc-gipzik eUnEIy">--}}
                                        {{--<h3 class="sc-csuQGl fskAed">Simple, Accurate Tracking</h3>--}}
                                    {{--</header>--}}
                                    {{--<p class="sc-Rmtcm dewKyV">Track conversions from your direct mail campaign right in the Tidewater--}}
                                        {{--interface just like you would with a digital campaign.</p>--}}
                                    {{--<a class="" href="/acquire">--}}
                                        {{--<button class="sc-iAyFgw eFRfPo" type="primary">Create a Campaign</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="sc-jlyJG kgRmkD">--}}
                                    {{--<img class="sc-bRBYWo hfvkHh" src="https://tidewater.io/cta_image_1.png" alt="Simple, Accurate Tracking">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="sc-EHOje hdgwCQ">--}}
                        {{--<div class="sc-bxivhb roSuK">--}}
                            {{--<header class="sc-caSCKo kCZgeU">--}}
                                {{--<h3 class="sc-gisBJw kgbogC">Clients</h3>--}}
                            {{--</header>--}}
                            {{--<div class="sc-ifAKCX coWWXk">--}}
                                {{--<div class="sc-htpNat EJznk">--}}
                                    {{--<div class="sc-EHOje cTtKAy">--}}
                                        {{--<img class="sc-kjoXOD elIQJX" src="https://tidewater.io/square-logo.png" alt="Square">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="sc-htpNat EJznk">--}}
                                    {{--<div class="sc-EHOje cTtKAy">--}}
                                        {{--<img class="sc-kjoXOD elIQJX" src="https://tidewater.io/google-logo.png" alt="Google">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="sc-htpNat EJznk">--}}
                                    {{--<div class="sc-EHOje cTtKAy">--}}
                                        {{--<img class="sc-kjoXOD elIQJX" src="https://tidewater.io/box-logo.png" alt="Box">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="sc-htpNat EJznk">--}}
                                    {{--<div class="sc-EHOje cTtKAy">--}}
                                        {{--<img class="sc-kjoXOD elIQJX" src="https://tidewater.io/intuit-logo.png" alt="Intuit">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<footer>--}}
                        {{--<div class="sc-jWBwVP bDqMXe">--}}
                            {{--<div class="sc-bxivhb roSuK">--}}
                                {{--<div class="sc-brqgnP JfUqE">--}}
                                    {{--<div class="sc-htpNat fwAuqS">--}}
                                        {{--<h4 class="sc-cMljjf hzziwZ">Partner with us</h4>--}}
                                        {{--<p class="sc-jAaTju bOrtSx">We partner with data providers and marketing execution platforms to make marketing &amp; sales teams lives easier.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="sc-jDwBTQ jDeEza">--}}
                                        {{--<a class="" href="/signup">--}}
                                            {{--<button class="sc-iAyFgw gQSWqU">Get in touch</button>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="sc-hSdWYo Mpqfz">--}}
                            {{--<div class="sc-bxivhb roSuK">--}}
                                {{--<div class="sc-ifAKCX coWWXk">--}}
                                    {{--<div class="sc-htpNat kTcweV">--}}
                                        {{--<a class="sc-eHgmQL kLaodM" href="/optout">Opt out</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="sc-cvbbAY uKqkB">--}}
                                        {{--<span>©2017 Tidewater</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</footer>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div id="documentation"></div>--}}
    {{--</body>--}}
</html>
