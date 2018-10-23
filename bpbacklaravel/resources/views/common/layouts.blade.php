<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    {{--<meta content="text/html; charset=UTF-8"  http-equiv="Content-Type">  --}}
    {{--<meta name="_token" content="{!! csrf_token() !!}" >--}}
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>企业管理-@yield('title')</title>

    <link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/commonCopy.css')}}">
    @section('style')
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
                        <p> </p>
                        <p>
                            <a>退出登录</a>
                        </p>
                    </div>
                    <div class="meun-title">员工管理</div>
                    <a class="meun-item btn-link" href="{{url('staff/over')}}"><img src="">员工管理</a>

                    {{--<a class="meun-item" href="#char" aria-controls="char" role="tab" data-toggle="tab"><img src="images/icon_chara_grey.png">权限管理</a>--}}
                    {{--<a class="meun-item meun-item-active" href="#user" aria-controls="user" role="tab" data-toggle="tab"><img src="images/icon_user.png">用户管理</a>--}}
                    {{--<a class="meun-item" href="#chan" aria-controls="chan" role="tab" data-toggle="tab"><img src="images/icon_change_grey.png">修改密码</a>--}}
                    <div class="meun-title">项目管理</div>
                    <a class="meun-item btn-link" href="{{url('project/over')}}" ><img src="">项目管理</a>
                    {{--<div class="meun-item" href="#regu" aria-controls="regu" role="tab" data-toggle="tab"><img src="images/icon_rule_grey.png">规则管理</div>--}}
                    {{--<div class="meun-item" href="#stud" aria-controls="stud" role="tab" data-toggle="tab"><img src="images/icon_card_grey.png">人员信息</div>--}}
                    {{--<div class="meun-item" href="#sitt" aria-controls="sitt" role="tab" data-toggle="tab"><img src="images/icon_char_grey.png">座位管理</div>--}}
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
@show
</body>
</html>