@extends('common.layouts')
@section('content')
    <!--自定义内容区域-->
    <div class="panel panel-default">
        <div class="panel-heading">员工详情</div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td width="50%">ID</td>
                <td>{{$staff->id}}</td>
            </tr>
            <tr>
                <td>姓名</td>
                <td>{{$staff->name}}</td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>{{$staff->age}}</td>
            </tr>
            <tr>
                <td>职位</td>
                <td>{{$staff->position}}</td>
            </tr>
            <tr>
                <td>性别</td>
                <td>{{$staff->sex($staff->sex)}}</td>
            </tr>
            <tr>
                <td>添加日期</td>
                <td>{{$staff->created_at}}</td>
            </tr>
            <tr>
                <td>最后修改</td>
                <td>{{$staff->updated_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop