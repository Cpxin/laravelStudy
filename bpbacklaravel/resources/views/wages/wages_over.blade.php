@extends('common.layouts')
{{--@section('style')--}}
    {{--@parent--}}
{{--@stop--}}
@section('content')
    @if(Auth::user()->rank<=4)
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                @if(Auth::user()->rank<=3)
                <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addWages">添加 </button>
                    @endif
            </div>
            <div class="col-xs-4">
                <input type="text" id="wagePosition" class="form-control input-sm" placeholder="输入职位搜索" >
                <button class="btn btn-white btn-xs " onclick="find_wages()">查 询 </button>
            </div>
            <div class="col-xs-5" style=" padding-right: 40px;text-align: right;">
                <img id="toout" onclick="window.location.href='{{url('admin/logout')}}'" src="{{asset('img/退出.png')}}" style="height: 30px;width: 30px" >
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
                            @if(Auth::user()->rank<=3)
                            <a class="btn btn-info btn-xs" onclick="change('{{$wag->id}}','{{$wag->position}}','{{$wag->basic}}','{{$wag->weekday}}','{{$wag->time}}','{{$wag->reword}}','{{$wag->other}}')">修改</a>
                            <a class="btn btn-danger btn-xs" href="" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div >
            <div class="pull-left">
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
                                    <div class="col-xs-9 ">
                                        <input name="Wages[position]" value="{{old('Wages')['position']}}" class="form-control input-sm duiqi" id="sName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sLink" class="col-xs-3 control-label">基本工资：</label>
                                    <div class="col-xs-9 ">
                                        <input name="Wages[basic]" value="{{old('Wages')['basic']}}" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">工作周期：</label>
                                    <div class="col-xs-9">
                                        <input name="Wages[weekday]" value="{{old('Wages')['weekday']}}" class="form-control input-sm duiqi" id="sWeekDay" placeholder="">
                                        <div class="btn-group" style="margin-left: -50px" id="weekgroup">
                                            <button type="button" class="btn btn-default " id="week1" onclick="week(1)" >一</button>
                                            <button type="button" class="btn btn-default" id="week2" onclick="week(2)">二</button>
                                            <button type="button" class="btn btn-default" id="week3" onclick="week(3)">三</button>
                                            <button type="button" class="btn btn-default" id="week4" onclick="week(4)">四</button>
                                            <button type="button" class="btn btn-default" id="week5" onclick="week(5)">五</button>
                                            <button type="button" class="btn btn-default" id="week6" onclick="week(6)">六</button>
                                            <button type="button" class="btn btn-default" id="week7" onclick="week(0)">七</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">工作时间：</label>
                                    <input name="Wages[time]" value="" class="form-control input-sm duiqi" id="sTime" style="display: none" placeholder="">
                                    <div class="col-xs-5 col-xs-offset-1" style="margin-left: 5px">
                                        <div style="display: flex;flex-direction: row">
                                            <p>上午</p><input id="Time1" type="time" style="width: 80px">至<input id="Time2" type="time" style="width: 80px">
                                        </div>
                                        <div style="display: flex;flex-direction: row">
                                            <p>下午</p><input id="Time3" type="time" style="width:80px">至<input id="Time4" type="time" style="width: 80px">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">奖惩指数：</label>
                                    <div class="col-xs-9">
                                        <input name="Wages[reward]" value="{{old('Wages')['reward']}}" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">其他：</label>
                                    <div class="col-xs-9" style="display: flex;flex-direction: column">
                                        <input name="Wages[other]" value="{{old('Wages')['other']}}" class="form-control input-sm duiqi" id="sOther" placeholder="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button type="submit" class="btn btn-xs btn-green" onclick="time()">保 存</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="changeWages" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('wages/update')}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">修改作业</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                {{--@include('common.vaildator')--}}

                                <input style="display: none" id="cId" name="Wages[id]">
                                <div class="form-group ">
                                    <label for="sName" class="col-xs-3 control-label">职位：</label>
                                    <div class="col-xs-9 ">
                                        <input name="Wages[position]" value="{{old('Wages')['position']}}" class="form-control input-sm duiqi" id="cName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sLink" class="col-xs-3 control-label">基本工资：</label>
                                    <div class="col-xs-9 ">
                                        <input name="Wages[basic]" value="{{old('Wages')['basic']}}" class="form-control input-sm duiqi" id="cBasic" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">工作周期：</label>
                                    <div class="col-xs-9">
                                        <input name="Wages[weekday]" value="{{old('Wages')['weekday']}}" class="form-control input-sm duiqi" id="cWeekDay" placeholder="">
                                        <div class="btn-group" style="margin-left: -50px" id="weekgroup">
                                            <button type="button" class="btn btn-default " id="week1" onclick="week(1)" >一</button>
                                            <button type="button" class="btn btn-default" id="week2" onclick="week(2)">二</button>
                                            <button type="button" class="btn btn-default" id="week3" onclick="week(3)">三</button>
                                            <button type="button" class="btn btn-default" id="week4" onclick="week(4)">四</button>
                                            <button type="button" class="btn btn-default" id="week5" onclick="week(5)">五</button>
                                            <button type="button" class="btn btn-default" id="week6" onclick="week(6)">六</button>
                                            <button type="button" class="btn btn-default" id="week7" onclick="week(7)">七</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">工作时间：</label>
                                    <input name="Wages[time]" value="" class="form-control input-sm duiqi" id="cTime" style="display: none" placeholder="">

                                    <div class="col-xs-5 col-xs-offset-1" style="margin-left: 5px">
                                        <p id="pTime"></p>
                                        <div style="display: flex;flex-direction: row">
                                            <p>上午</p><input id="cTime1" type="time" style="width: 80px">至<input id="cTime2" type="time" style="width: 80px">
                                        </div>
                                        <div style="display: flex;flex-direction: row">
                                            <p>下午</p><input id="cTime3" type="time" style="width:80px">至<input id="cTime4" type="time" style="width: 80px">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">奖惩指数：</label>
                                    <div class="col-xs-9">
                                        <input name="Wages[reward]" value="{{old('Wages')['reward']}}" class="form-control input-sm duiqi" id="cReword" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">其他：</label>
                                    <div class="col-xs-9" style="display: flex;flex-direction: column">
                                        <input name="Wages[other]" value="{{old('Wages')['other']}}" class="form-control input-sm duiqi" id="cOther" placeholder="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button type="submit" class="btn btn-xs btn-green" onclick="time2()">保 存</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
    @else
        @include('common.jurisdiction')
    @endif
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
        function find_wages() {
            var position=$('#wagePosition').val();
            window.location.href="{{url('wages/over')}}?position="+position;
        }
        function time() {

            var time1=$('#Time1').val();
            var time2=$('#Time2').val();
            var time3=$('#Time3').val();
            var time4=$('#Time4').val();
            $('#sTime').val('上午'+time1+'至'+time2+'下午'+time3+'至'+time4);
        }
        function time2() {

            var time1=$('#cTime1').val();
            var time2=$('#cTime2').val();
            var time3=$('#cTime3').val();
            var time4=$('#cTime4').val();
            $('#cTime').val('上午'+time1+'至'+time2+'下午'+time3+'至'+time4);
        }
        function week(val) {
            var week='week'+val;
            // console.log(document.getElementById(week).className.indexOf('active'));
            if (document.getElementById(week).className.indexOf('active')!==-1){
                document.getElementById(week).classList.remove('active');
                var data=document.getElementById('sWeekDay').value;
                data=data.replace(val,'');
                document.getElementById('sWeekDay').value=data;

            }else {
                document.getElementById(week).className+=' active';
                var data2=document.getElementById('sWeekDay').value;
                data2+=val;
                document.getElementById('sWeekDay').value=data2;
            }
        }
        function change(id,position,basic,weekday,time,reword,other) {
            $('#cId').val(id);
            $('#cName').val(position);
            $('#cBasic').val(basic);
            $('#cWeekDay').val(weekday);
            $('#cReword').val(reword);
            $('#pTime').html(time);
            $('#cOther').val(other);
            $('#changeWages').modal('show');

        }
    </script>
@stop