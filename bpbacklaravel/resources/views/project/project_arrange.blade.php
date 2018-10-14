@extends('common.layouts')

@section('style')
    @parent
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <link href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link  href="{{asset('static/bootstrap-table/dist/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{asset('static/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
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
                {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th >id</th>--}}
                        {{--<th >姓名</th>--}}
                        {{--<th >年龄</th>--}}
                        {{--<th >性别</th>--}}
                        {{--<th >职位</th>--}}
                        {{--<th >状态</th>--}}
                        {{--<th >创建时间</th>--}}
                        {{--<th >更新时间</th>--}}
                    {{--</tr>--}}
                {{--</thead>--}}
                <tbody>
                @foreach($staff as $sta)
                    <tr>
                        <td>{{$sta->id}}</td>
                        <td>{{$sta->name}}</td>
                        <td>{{$sta->age}}</td>
                        <td>{{$sta->sex}}</td>
                        <td>{{$sta->position}}</td>
                        <td>{{$sta->state}}</td>
                        <td>
                            <a class="btn btn-success btn-xs" href="{{url('staff/detail',['id'=>$sta->id])}}">详情</a>
                            <a class="btn btn-info btn-xs">修改</a>
                            <a class="btn btn-danger btn-xs" href="{{url('staff/delete',['id'=>$sta->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

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
                {{--<select multiple class="selectpicker show-tick" id="select1" data-style="btn-success">--}}
                    {{--<option>1</option>--}}
                {{--</select>--}}
                @foreach($personnel as $k=>$v)
                    <ul class="list-group" id="{{$k}}">
                        <li class="list-group-item list-group-item-success">职位：{{$k}} 人数：{{$v}}</li>
                    </ul>
                @endforeach

            </div>
        </div>

        </div>

    </div>
@stop

@section('javascript')
    @parent
    <script src="{{asset('static/bootstrap-table/dist/bootstrap-table.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-table/dist/locale/bootstrap-table-zh-CN.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-select/dist/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-select/dist/js/i18n/defaults-zh_CN.min.js')}}"></script>

    <script>
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $(document).ready(function () {
            {{--$.ajaxSetup({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--}--}}
            {{--});--}}
            {{--$.ajax({--}}
                {{--// contentType:"application/x-www-form-urlencoded",--}}
                {{--// headers:{'X-CSRF-Token':$('meta[name=_token]').attr('content')},--}}
                {{--method:'post',--}}
                {{--url : '{{url('project/arrange_search')}}',--}}
                {{--// dataType:"json",--}}
                {{--// json:'callback',--}}
                {{--success : function (res) {--}}
                    {{--// console.log(res.sta);--}}
                    {{--load(res);--}}
                {{--}--}}
            {{--});--}}
            load();
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
            function load() {
                $('#table1').bootstrapTable({
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
                    field: 'operate',
                    title: '操作'
                }]
                })
            }
        $("#table1").on("click-row.bs.table",function(e, row,index){

            var li=document.createElement('li');             //创建li元素
            li.setAttribute('class','list-group-item');     //在li中添加属性class='list-group-item'
            li.innerHTML=row['id']+' '+row['name'];          //li中的值为 职员id+职员名
            // console.log(row['position']);
            // var u1=document.getElementById('ul1');
            // u1.appendChild(li);
            if(document.getElementById(row['position'])){        //如果表格中点击行的员工的职位存在与之对应的ul 的id
                var u1=document.getElementById(row['position']);
                u1.appendChild(li);                            //对应ul 添加li元素
            }
        })

    </script>
@stop