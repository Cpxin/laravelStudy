@extends('common.layouts')

@section('content')
    <!--自定义内容区域-->
    <div class="panel panel-default">

        <div class="panel panel-heading">修改信息列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>员工id</th>
                <th>修改信息</th>
                <th>添加时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record as $rec)
                <tr>
                    <th scope="row">{{$rec->id}}</th>
                    <th>{{$rec->staffId}}</th>
                    <th>{{$rec->cord}}</th>
                    <th>{{date($rec->created_at)}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--分页-->
    <div>
        <div class="pull-right">
            {{$record->render()}}
        </div>
    </div>
@stop