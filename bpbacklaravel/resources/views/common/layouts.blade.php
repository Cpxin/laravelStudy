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
        {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}

        <!-- Styles -->
        {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
        @endif
    @show
</head>
@if($_SERVER['REQUEST_URI']=='/bpbacklaravel/public/project/add')
    <body onbeforeunload="checkLeave()">
@else
    <body>
@endif
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
                        <p id="userName">当前用户：{{ Auth::user()->name }}</p>
                        <div class="sj">
                            <span></span>年
                            <span></span>月
                            <span></span>日<br>
                            <span></span>时
                            <span></span>分
                            <span></span>秒
                        </div>
                        {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                           {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                        <a class="dropdown-item" href="{{ url('admin/logout') }}">
                            {{ __('退出') }}
                        </a>
                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--@csrf--}}
                        {{--</form>--}}
                        {{--<p>--}}
                            {{--<a>退出登录</a>--}}
                        {{--</p>--}}
                    </div>
                    <div id="Lstaff" class="meun-title btn" ><img src="{{asset('img/员工信息.png')}}">员工管理</div><br>
                    <a id="Lstaff1" class="meun-item btn-link" href="{{url('staff/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">员工管理</a>

                    {{--<div id="Lstaff" class="meun-title btn" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">员工管理</div><br>--}}
                    {{--<div class="collapse well" id="collapseExample">员工管理</div>--}}

                    <div id="Lproject"  class="meun-title btn"><img src="{{asset('img/项目.png')}}">项目管理</div><br>
                    <a id="Lproject1" class="meun-item btn-link" href="{{url('project/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">项目管理</a>

                    <div id="Lwage" class="meun-title btn"><img src="{{asset('img/企业.png')}}">作业规划</div><br>
                    <a id="Lwage1" class="meun-item btn-link" href="{{url('wages/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">作业规划</a>
                    <div id="Ladmin" class="meun-title btn"><img src="{{asset('img/管理员.png')}}">管理员</div><br>
                    <a id="Ladmin1" class="meun-item btn-link" href="{{url('admin/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">管理员规划</a>
                    <div id="Lhomepage" class="meun-title btn"><img src="{{asset('img/管理员.png')}}">主页管理</div><br>
                    <a id="Lhomepage1" class="meun-item btn-link" href="{{url('homepage/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">管理员规划</a>
                    <div id="Lcord" class="meun-title btn"><img src="{{asset('img/操作管理.png')}}">操作记录</div><br>
                    <a id="Lcord1" class="meun-item btn-link" href="{{url('record/over')}}" style="display: none"><img src="{{asset('img/组织管理.png')}}">操作记录</a>
                </div>
                    @show
        <!--右侧内容区域-->
        <div id="rightContent" style="background:url({{asset('img/中秋国庆纹理.png')}});width:100px;height:100%;">
            @if($_SERVER['REQUEST_URI']=='/bpbacklaravel/public/layouts')
                <div class="panel col-sm-4 col-sm-offset-4" style="margin-top: 200px">
                    <div class="panel-heading">
                        登录成功
                    </div>
                    <div class="panel-body" style="padding:50px 50px ">
                        <h3>欢迎登录企业人力资源管理系统！！！</h3>
                    </div>
                </div>
                <div class="panel col-lg-4 col-lg-offset-4" style="margin-top: 50px">
                    <div class="panel-heading">
                        当前用户：{{ Auth::user()->name }}
                    </div>
                    <div class="panel-body" style="padding:10px 50px ">
                        权限等级：{{$admin->rank}}
                        <ul class="nav nav-list"><li class="divider"></li></ul>
                    </div>
                </div>
                @endif
            @yield('content')
            <img id="toback" src="{{asset('img/后退.png')}}" style="position: fixed;bottom:20px;right: 20px;height: 50px;width: 50px" >
        </div>
        {{--<div style="background: url(/public/img/中秋国庆纹理.png) no-repeat 400px 500px;">--}}
            {{--<p>123456</p>--}}
        {{--</div>--}}

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
        var pdf=false;
        $('#logoP').on('click',function () {
            {{--$.get('{{url('/home')}}',function () {--}}
                    {{--//验证成功后实现跳转--}}
                    window.location.href = '{{url('layouts')}}';
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
        $('#Ladmin').on('click',function () {
            if($('#Ladmin1').css('display')=='none'){
                $('#Ladmin1').css('display','block');
                $('#Ladmin1').css('background','#F3F3FA');
            }else {
                $('#Ladmin1').css('display','none');
            }
        });
        $('#Lcord').on('click',function () {
            if($('#Lcord1').css('display')=='none'){
                $('#Lcord1').css('display','block');
                $('#Lcord1').css('background','#F3F3FA');
            }else {
                $('#Lcord1').css('display','none');
            }

        });
        $('#Lhomepage').on('click',function () {
            if($('#Lhomepage1').css('display')=='none'){
                $('#Lhomepage1').css('display','block');
                $('#Lhomepage1').css('background','#F3F3FA');
            }else {
                $('#Lhomepage1').css('display','none');
            }

        });
        function checkLeave() {      //当离开/刷新添加项目界面时，服务器删除临时上传的pdf文件
            var pdfUrl=$('#pPdfUrl').val();
            if (pdfUrl!=null&&pdf===false){
                $.get('{{url("project/word_save")}}',{'delete':pdf,'pdfUrl':pdfUrl});
            }
        }
        $('#toback').on('click',function () {
            history.go(-1);
        });
        {{--function logout() {--}}
            {{--$.get('{{url('admin/logout')}}');--}}
        {{--}--}}
    </script>
@show
</body>
</html>