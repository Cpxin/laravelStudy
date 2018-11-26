<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    {{--<meta content="text/html; charset=UTF-8"  http-equiv="Content-Type">  --}}
    {{--<meta name="_token" content="{!! csrf_token() !!}" >--}}
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title >企业管理-@yield('title')</title>

    <link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/commonCopy.css')}}">
    @section('style')
        @if($_SERVER['REQUEST_URI']=='/bpbacklaravel/public/home')
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @endif
    @show
</head>
<body>
<!-- 头部-->
{{--@section('header')--}}
    {{--<div class="jumbotron">--}}
        {{--<div class="container">--}}
            {{--<h2>企业管理</h2>--}}
            {{--<p>表单</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@show--}}

<!--中间内容区域-->
<div id="wrap">

        <!--左侧菜单区域-->
            @section('leftmenu')
                <div class="leftMeun" id="leftMeun">
                    <div id="logoDiv">
                        <p id="logoP"><span>企业管理系统</span></p>
                    </div>
                    <div id="personInfor">
                        <p id="userName">cpx</p>
                        <div class="sj">
                            <span></span>年
                            <span></span>月
                            <span></span>日<br>
                            <span></span>时
                            <span></span>分
                            <span></span>秒
                        </div>
                        <p>
                            <a>退出登录</a>
                        </p>
                    </div>
                    <div id="Lstaff" class="meun-title btn" >员工管理</div><br>
                    <a id="Lstaff1" class="meun-item btn-link" href="{{url('staff/over')}}" style="display: none"><img src="">员工管理</a>

                    {{--<div id="Lstaff" class="meun-title btn" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">员工管理</div><br>--}}
                    {{--<div class="collapse well" id="collapseExample">员工管理</div>--}}

                    <div id="Lproject"  class="meun-title btn">项目管理</div><br>
                    <a id="Lproject1" class="meun-item btn-link" href="{{url('project/over')}}" style="display: none"><img src="">项目管理</a>
                    <div id="Lwage" class="meun-title btn">作业规划</div><br>
                    <a id="Lwage1" class="meun-item btn-link" href="{{url('wages/over')}}" style="display: none"><img src="">作业规划</a>
                    <div id="Lcord" class="meun-title btn">操作记录</div><br>
                    <a id="Lcord1" class="meun-item btn-link" href="{{url('record/over')}}" style="display: none"><img src="">操作记录</a>
                </div>
                    @show
        <!--右侧内容区域-->
        <div id="rightContent">
            @yield('content')
        </div>

</div>

{{--<!--尾部-->--}}
{{--@section('footer')--}}
    {{--<div class="jumbotron navbar-fixed-bottom" style="margin: 0 " >--}}
        {{--<div class="container">--}}
            {{--<span>@2018 stan</span>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@show--}}

@section('javascript')
    <script src="{{asset('static/bootstrap/js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            function time() {
                var date = new Date();
                var n = date.getFullYear();
                var y = date.getMonth()+1;
                var t = date.getDate();
                var h = date.getHours();
                var m = date.getMinutes();
                var s = date.getSeconds();

                $('.sj span').eq(0).html(n);
                $('.sj span').eq(1).html(y);
                $('.sj span').eq(2).html(t);
                $('.sj span').eq(3).html(h);
                $('.sj span').eq(4).html(m);
                $('.sj span').eq(5).html(s);
                for (var i = 0; i < $('div').length; i++) {
                    if ($('div').eq(i).text().length == 1) {
                        $('div').eq(i).html(function(index, html) {
                            return 0 + html;
                        });
                    }
                }
            }
            time();
            setInterval(time, 1000);
        });
        $('#logoP').on('click',function () {
            {{--$.get('{{url('/home')}}',function () {--}}
                    {{--//验证成功后实现跳转--}}
                    window.location.href = '{{url('home')}}';
            // });
        });
        $('#Lstaff').on('click',function () {
            if($('#Lstaff1').css('display')=='none'){
                $('#Lstaff1').css('display','block');
                $('#Lstaff1').css('background','#F3F3FA');
            }else {
                $('#Lstaff1').css('display','none');
            }
        });
        $('#Lproject').on('click',function () {
            if($('#Lproject1').css('display')=='none'){
                $('#Lproject1').css('display','block');
                $('#Lproject1').css('background','#F3F3FA');
            }else {
                $('#Lproject1').css('display','none');
            }
        });
        $('#Lwage').on('click',function () {
            if($('#Lwage1').css('display')=='none'){
                $('#Lwage1').css('display','block');
                $('#Lwage1').css('background','#F3F3FA');
            }else {
                $('#Lwage1').css('display','none');
            }
        });
        $('#Lcord').on('click',function () {
            if($('#Lcord1').css('display')=='none'){
                $('#Lcord1').css('display','block');
                $('#Lcord1').css('background','#F3F3FA');
            }else {
                $('#Lcord1').css('display','none');
            }

        })
    </script>
@show
</body>
</html>