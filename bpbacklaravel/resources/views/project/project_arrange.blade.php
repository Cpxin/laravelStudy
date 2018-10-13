@extends('common.layouts')

@section('style')
    @parent
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <link href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link  href="{{asset('static/bootstrap-table/dist/bootstrap-table.css')}}" rel="stylesheet">
    @stop

@section('content')

    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addUser">添加用户 </button>
            </div>
            <div class="col-xs-4">
                <input type="text" class="form-control input-sm" placeholder="输入文字搜索" >
                <button class="btn btn-white btn-xs ">查 询 </button>
            </div>
            <div class="col-lg-3 col-lg-offset-2 col-xs-4" style=" padding-right: 40px;text-align: right;">
                <label for="paixu">排序:&nbsp;</label>
                <select class=" form-control">
                    <option>地区</option>
                    <option>地区</option>
                    <option>班期</option>
                    <option>性别</option>
                    <option>年龄</option>
                    <option>份数</option>
                </select>
            </div>
        </div>

        <div class="row">

        <div class="data-div col-xs-8">
            {{--{{csrf_field()}}--}}
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-1" style="margin-right: -20px"><strong >职位：</strong></div>
                    <div class="col-sm-2">
                        <ul class="list-inline" >
                            <a class="btn btn-dark" onclick="edit('后端工程师')">后端工程师</a>
                            <li>2</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{--<div class="row tableHeader">--}}
                {{--<div class="col-xs-1 ">--}}
                    {{--Id--}}
                {{--</div>--}}
                {{--<div class="col-xs-2">--}}
                    {{--姓名--}}
                {{--</div>--}}
                {{--<div class="col-xs-1">--}}
                    {{--性别--}}
                {{--</div>--}}
                {{--<div class="col-xs-3">--}}
                    {{--职位--}}
                {{--</div>--}}
                {{--<div class="col-xs-1">--}}
                    {{--状态--}}
                {{--</div>--}}
                {{--<div class="col-xs-2">--}}
                    {{--操作--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@include('common.vaildator')--}}
            {{--@include('common.message')--}}
            {{--<div class="tablebody" id="itable">--}}
                {{--@foreach($staff as $sta)--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-1 " id="id">--}}
                            {{--{{$sta->id}}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-2" id="name">--}}
                            {{--{{$sta->name}}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-1" id="sex">--}}
                            {{--{{$sta->sex}}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-3" id="position">--}}
                            {{--{{$sta->position}}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-1" >--}}
                            {{--{{$sta->state}}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-2">--}}
                            {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseUser">详情</button>--}}
                            {{--<a class="btn btn-success btn-xs" href="{{url('staff/detail',['id'=>$sta->id])}}">详情</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}

            <table class="table" id="table1">

            </table>

            <!--分页-->
            <div>
                <div class="pull-right">
                    {{$staff->render()}}
                </div>
            </div>

        </div>

        <div class="col-xs-4">
            <div class="panel-body">
                <select multiple class="form-control">
                    <option>1</option>
                </select>
            </div>
        </div>

        </div>

    </div>
@stop

@section('javascript')
    @parent
    <script src="{{asset('static/bootstrap-table/dist/bootstrap-table.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-table/dist/locale/bootstrap-table-zh-CN.js')}}" type="text/javascript"></script>
    <script>
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                // contentType:"application/x-www-form-urlencoded",
                // headers:{'X-CSRF-Token':$('meta[name=_token]').attr('content')},
                method:'post',
                url : '{{url('project/arrange_search')}}',
                // dataType:"json",
                // json:'callback',
                success : function (res) {
                    // console.log(res.sta);
                    load(res);
                }
            });
        });

        {{--function edit($val) {--}}
            {{--$.ajax({--}}
                {{--method:'post',--}}
                {{--url : "{{url('project/arrange_search')}}",--}}
                {{--dataType:"json",--}}
                {{--json:'callback',--}}
                {{--traditional:true,--}}
                {{--data:{position:$val},--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--success : function (res) {--}}
                    {{--console.log(data.msg);--}}
                {{--}--}}
            {{--});--}}
        // }
            function load(res) {
                $('#table1').bootstrapTable({
                    data:res,
                    toolbar:'#toolbar',
                    singleSelect:true,
                    clickToSelect:true,
                    sortName: "created_at",
                    sortOrder: "desc",
                    pageSize: 5,
                    pageNumber: 1,

                    showToggle: true,
                    showRefresh: true,
                    showColumns: true,
                    search: true,
                    pagination: true,
                    columns: [{
                        field: "id",
                        title: 'ID',
                        switchable: true
                    },{
                        field: 'name',
                        title: '姓名',
                        switchable: true
                    },{
                        field: 'age',
                        title: '年龄',
                        switchable: true
                    }, {
                        field: 'sex',
                        title: '性别',
                        switchable: true
                    }, {
                        field: 'position',
                        title: '职位',
                        switchable: true
                    },{
                        field: 'state',
                        title: '状态',
                        switchable: true
                    },{
                        field: 'created_at',
                        title: '创建时间',
                        switchable: true
                    },{
                    field: 'updated_at',
                        title: '更新时间',
                        switchable: true
                }]
                })
            }

    </script>
@stop