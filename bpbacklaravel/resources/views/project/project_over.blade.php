@extends('common.layouts')

@section('content')
    @if(Auth::user()->rank<=4)
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-2">
                @if(Auth::user()->rank<=3)
                <a class="btn btn-yellow btn-xs" href="{{url('project/add')}}">添加项目 </a>
                    @endif
            </div>
            <div class="col-xs-3">
                <input type="text" id="projectName" class="form-control input-sm" placeholder="输入项目名搜索" >
                <button class="btn btn-white btn-xs " onclick="find_project()">查 询 </button>
            </div>
            <div class="col-xs-2">
                @if(Auth::user()->rank<=3)
                <form id="imSubmit" method="post" action="{{url('excel/import')}}?type=project" enctype="multipart/form-data">
                <span class="btn btn-danger fileinput-button">
                    <span id="imBtn">导入Excel文件</span>
                    <input type="file" name="import" style="display: none" onchange="im()"   id="imBtnInput" >
                </span>
                </form>
                    @endif
            </div>
            <div class="col-xs-2  " >
                @if(Auth::user()->rank<=3)
                <form method="post" action="{{url('excel/export')}}?type=project">
                    <button type="submit" class="btn btn-success fileinput-button" style="height: 35px;font-size: 13px">
                        导出Excel文件
                    </button>
                </form>
                    @endif
            </div>
            <div class="col-xs-3" style=" padding-right: 40px;text-align: right;">
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
        <div class="data-div">
            <div class="row tableHeader">
                <div class="col-xs-1 ">
                    Id
                </div>
                <div class="col-xs-2">
                    项目名称
                </div>
                <div class="col-xs-2">
                    项目预期成本
                </div>
                <div class="col-xs-1">
                    项目等级
                </div>
                <div class="col-xs-2">
                    项目状态
                </div>
                <div class="col-xs-2">
                    项目创建时间
                </div>
                <div class="col-xs-2">
                    操作
                </div>
            </div>
            @include('common.vaildator')
            @include('common.message')
            <div class="tablebody" id="table">
                @foreach($project as $pro)
                    <div class="row">
                        <div class="col-xs-1 " id="id">
                            {{$pro->id}}
                        </div>
                        <div class="col-xs-2" id="name">
                            {{$pro->name}}
                        </div>
                        <div class="col-xs-2" id="age">
                            {{$pro->cost}}
                        </div>
                        <div class="col-xs-1" id="sex">
                            {{$pro->rank}}
                        </div>
                        <div class="col-xs-2" id="position">
                            {{$pro->state($pro->state)}}
                        </div>
                        <div class="col-xs-2" >
                            {{$pro->created_at}}
                        </div>
                        <div class="col-xs-2">
                            {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseUser">详情</button>--}}
                            <a class="btn btn-success btn-xs" href="{{url('project/detail',['id'=>$pro->id])}}">详情</a>
                            @if($pro->state!=3&&Auth::user()->rank<=3)
                            <a class="btn btn-info btn-xs">修改</a>
                            <a class="btn btn-danger btn-xs" href="{{url('project/delete',['id'=>$pro->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!--分页-->
        <div>
            <div class="pull-right">
                {{$project->render()}}
            </div>
        </div>
    </div>
    @else
        @include('common.jurisdiction')
    @endif
@stop

@section('javascript')
    @parent
    <script>
        $(document).ready(function () {
            if($('#Lproject1').css('display')=='none'){
                $('#Lproject1').css('display','block');
                $('#Lproject1').css('background','#F3F3FA');
            }
        });
        function find_project() {
            var name=$('#projectName').val();
            window.location.href="{{url('project/over')}}?name="+name;
        }
        function im() {
            document.getElementById("imSubmit").submit();
        }
    </script>
@stop