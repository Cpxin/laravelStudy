@extends('common.layouts')

@section('content')
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                <a class="btn btn-yellow btn-xs" href="{{url('project/add')}}">添加项目 </a>
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
                            @if($pro->state!=3)
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
    </script>
@stop