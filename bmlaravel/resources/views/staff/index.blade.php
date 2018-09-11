@extends('common.layouts')

@section('content')
    @include('common.message')
    <!--自定义内容区域-->
    <div class="panel panel-default">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown1" data-toggle="dropdown">
                选择职位
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="{{url('bm/index')}}">All</a> </li>
                @foreach($position as $val)
                    <li><a href="{{url('bm/index',['pos'=>$val->position])}}">{{$val->position}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="panel panel-heading">职员列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>职位</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staff as $sta)
                <tr>
                    <th scope="row">{{$sta->id}}</th>
                    <th>{{$sta->name}}</th>
                    <th>{{$sta->age}}</th>
                    <th>{{$sta->sex($sta->sex)}}</th>
                    <th>{{$sta->position}}</th>
                    <th>{{date($sta->created_at)}}</th>
                    <th>
                        <a href="{{url('bm/detail',['id'=>$sta->id])}}">详情</a>
                        <a href="{{url('bm/update',['id'=>$sta->id])}}">修改</a>
                        <a href="{{url('bm/delete',['id'=>$sta->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--分页-->
    <div>
        <div class="pull-right">
            {{$staff->render()}}
        </div>
    </div>
@stop