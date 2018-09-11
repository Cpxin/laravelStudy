<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>企业管理-@yield('title')</title>

    <link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}">
    @section('style')
    @show
</head>
<body>
<!-- 头部-->
@section('header')
    <div class="jumbotron">
        <div class="container">
            <h2>企业管理</h2>
            <p>表单</p>
        </div>
    </div>
@show

<!--中间内容区域-->
<div class="container">
    <div class="row">
        <!--左侧菜单区域-->
        <div class="col-md-3">
            @section('leftmenu')
                <div class="list-group">
                    <a href="{{url('bm/index')}}" class="list-group-item {{Request::getPathInfo()=='/bm/index' ? 'active':''}}" >员工列表</a>
                    <a href="{{url('bm/add')}}" class="list-group-item {{Request::getPathInfo()=='/bm/add' ? 'active':''}}">新增职员</a>
                    <a href="{{url('bm/record')}}" class="list-group-item {{Request::getPathInfo()=='/bm/record' ? 'active':''}}" >人事变动</a>
                    <a href="{{url('bm/project')}}" class="list-group-item {{Request::getPathInfo()=='/bm/project' ? 'active':''}}" >项目列表</a>
                    <a href="{{url('bm/projectadd')}}" class="list-group-item {{Request::getPathInfo()=='/bm/projectadd' ? 'active':''}}" >新建项目</a>
                    @show
                </div>
        </div>
        <!--右侧内容区域-->
        <div class="col-md-9">

            @yield('content')

        </div>

    </div>
</div>

<!--尾部-->
@section('footer')
    <div class="jumbotron navbar-fixed-bottom" style="margin: 0 " >
        <div class="container">
            <span>@2018 stan</span>
        </div>
    </div>
@show

<script src="{{asset('static/bootstrap/js/jquery-3.3.1.js')}}"></script>
<script src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>

@section('javascript')
@show
</body>
</html>