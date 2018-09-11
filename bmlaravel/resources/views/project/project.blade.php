@extends('common.layouts')

@section('content')
    @include('common.message')
    <!--自定义内容区域-->
    <div class="panel panel-default">

        <div class="panel panel-heading">项目列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>项目名称</th>
                <th>项目内容</th>
                <th>项目人员需求</th>
                <th>项目成本</th>
                <th>项目预期利润</th>
                <th>项目进度</th>
                <th>创建时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($project as $pro)
                <tr>
                    <th scope="row">{{$pro->id}}</th>
                    <th>{{$pro->name}}</th>
                    <th>{{$pro->content}}</th>
                    <th>{{$pro->personnel}}</th>
                    <th>{{$pro->cost}}</th>
                    <th>{{$pro->profit}}</th>
                    @if($pro->speed=='未启动')
                    <th style="color: red">{{$pro->speed}}</th>
                    @else
                        <th style="color:green">{{$pro->speed}}</th>
                    @endif
                    <th>{{date($pro->created_at)}}</th>
                    <th>
                        <a href="{{url('bm/projectdetail',['id'=>$pro->id])}}">详情</a>
                        <a href="{{url('bm/projectupdate',['id'=>$pro->id])}}">修改</a>
                        <a href="{{url('bm/projectdelete',['id'=>$pro->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--分页-->
    <div>
        <div class="pull-right">
            {{$project->render()}}
        </div>
    </div>
@stop