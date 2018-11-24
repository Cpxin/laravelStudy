@extends('common.layouts')

@section('content')
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addWages">添加 </button>
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
                <div class="col-xs-1">
                    职位
                </div>
                <div class="col-xs-1">
                    基本工资
                </div>
                <div class="col-xs-2">
                    工作周期
                </div>
                <div class="col-xs-3">
                    作息时间
                </div>
                <div class="col-xs-1">
                    奖惩情况
                </div>
                <div class="col-xs-1">
                    其他
                </div>
                <div class="col-xs-2">
                    操作
                </div>
            </div>
            @include('common.vaildator')
            @include('common.message')
            <div class="tablebody" id="table">
                @foreach($wages as $wag)
                    <div class="row">
                        <div class="col-xs-1 " id="id">
                            {{$wag->id}}
                        </div>
                        <div class="col-xs-1 " id="name" style="" >
                            {{$wag->position}}
                        </div>
                        <div class="col-xs-1 " id="name" style="" >
                            {{$wag->basic}}
                        </div>
                        <div class="col-xs-2 " id="name" style="" >
                            {{$wag->weekday}}
                        </div>
                        <div class="col-xs-3 " id="name" style="" >
                            {{$wag->time}}
                        </div>
                        <div class="col-xs-1 " id="name" style="" >
                            {{$wag->reward}}
                        </div>
                        <div class="col-xs-1 " id="name" style="" >
                            {{$wag->other}}
                        </div>
                        <div class="col-xs-2">
                            <a class="btn btn-danger btn-xs" href="{{url('record/delete',['id'=>$wag->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!--分页-->
        <div>
            <div class="pull-right">
                {{$wages->render()}}
            </div>
        </div>

        <div class="modal fade" id="addWages" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('wages/save')}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">添加作业</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                {{--@include('common.vaildator')--}}
                                <div class="form-group ">
                                    <label for="sName" class="col-xs-3 control-label">职位：</label>
                                    <div class="col-xs-8 ">
                                        <input name="Wages[position]" value="{{old('Wages')['position']}}" class="form-control input-sm duiqi" id="sName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sLink" class="col-xs-3 control-label">基本工资：</label>
                                    <div class="col-xs-8 ">
                                        <input name="Wages[basic]" value="{{old('Wages')['basic']}}" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">工作周期：</label>
                                    <div class="col-xs-8">
                                        <input name="Wages[weekday]" value="{{old('Wages')['weekday']}}" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">工作时间：</label>
                                    <div class="col-xs-8">
                                        <input name="Wages[time]" value="{{old('Wages')['time']}}" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">奖惩指数：</label>
                                    <div class="col-xs-8">
                                        <input name="Wages[reward]" value="{{old('Wages')['reward']}}" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">其他：</label>
                                    <div class="col-xs-8">
                                        <input name="Wages[other]" value="{{old('Wages')['other']}}" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button type="submit" class="btn btn-xs btn-green">保 存</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
@stop

@section('javascript')
    @parent
    <script>
        $(document).ready(function () {
            if($('#Lwage1').css('display')=='none'){
                $('#Lwage1').css('display','block');
                $('#Lwage1').css('background','#F3F3FA');
            }
        });
    </script>
@stop