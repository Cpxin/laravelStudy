@extends('common.layouts')

@section('content')
    <div class="row col-sm-offset-3">
        <div class="col-sm-8">
            {{--<form class="form-horizontal" method="post" action="{{url('project/update',['id'=>$project->id])}}">--}}
                {{--{{csrf_field()}}--}}
                <!--基本信息-->
            @if(Session::has('success'))
                <!--成功提示框-->
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>成功!</strong>{{Session::get('success')}}
                        <button class="btn btn-xs btn-primary"><a style="color: white" href="{{url('project/assure',['id'=>$project->id])}}">启动</a></button>
                    </div>
            @endif
            @if(Session::has('fail'))
                <!--失败提示框-->
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>失败!</strong>{{Session::get('fail')}}
                        {{--<button class="btn btn-primary"><a href="{{url('bm/projectstart',['id'=>$project->id,'startbool'=>true])}}">启动</a></button>--}}
                        <button class="btn btn-xs btn-primary"><a style="color: white" href="{{url('project/assure',['id'=>$project->id])}}">启动</a></button>
                    </div>
                @endif
            @if(Session::has('none'))
                <!--失败提示框-->
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>失败!</strong>{{Session::get('none')}}
                        {{--<button class="btn btn-primary"><a href="{{url('bm/projectstart',['id'=>$project->id,'startbool'=>true])}}">启动</a></button>--}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading" >基本信息</div>
                    <div class="panel-body">

                        <div class="row">
                        <h1 align="center">{{$project->name}}</h1>
                        </div>

                        <div class="row">
                            <div class="col-sm-2 col-sm-offset-3">
                                <p><strong>编号：</strong>{{$project->id}}</p>
                            </div>
                            <div class="col-sm-2">
                                <p><strong>等级：</strong>{{$project->rank}}</p>
                            </div>
                            <div class="col-sm-2">
                                <p><strong>状态：</strong>{{$project->state($project->state)}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-2">
                                <p><strong>创建时间：</strong>{{$project->created_at}}</p>
                            </div>
                            <div class="col-sm-3">
                                <p><strong>期限：</strong>{{$project->term}}天</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!--项目内容-->
                <div class="panel panel-info">
                    <div class="panel panel-heading" style="display: flex;flex-direction: row">项目内容
                        @if($project->state!=3)
                            {{--<button class="btn btn-green col-sm-offset-10" style="float: right;margin-right: -20px" data-toggle="modal" data-target="#reviseProject" onclick="contentInfo('{{$project->content}}','{{$project->id}}')">重新上传</button>--}}
                        @endif
                    </div>
                    <div class="panel-body">
                        {{--<embed :src="" type="application/pdf" width="100%" height="100%" />--}}
                        <iframe src="{{asset('/storage')}}/{{$project->pdfUrl}}" width="100%" height="700px">123</iframe>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel panel-heading" style="display: flex;flex-direction: row">项目备注
                        @if($project->state==0&&Auth::user()->rank<=3)
                            <button class="btn btn-green col-sm-offset-10" style="float: right;margin-right: -20px" data-toggle="modal" data-target="#reviseProject" onclick="contentInfo('{{$project->content}}','{{$project->id}}')">编辑</button>
                        @endif
                    </div>
                    <div class="panel-body">
                        {{--<embed :src="" type="application/pdf" width="100%" height="100%" />--}}
                        <div class="row" >
                            <div class="col-sm-5 col-sm-offset-1" >
                                <pre style="width:700px"><p id="pContent" style="width:700px;text-overflow:ellipsis">{{str_replace("<br>","\n",$project->content)}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!--详细信息-->
                <div class="panel panel-primary">
                    <div class="panel panel-heading ">人员需求</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="form-inline col-sm-7">
                                <div class="">
                                    <p style="font-size: 15px">职位/人数:{{$project->personnel}}</p>
                                </div>
                                <div class="col-sm-2" style="margin-left: -13px;display: flex;flex-direction:row">
                                    @if($project->state==0&&Auth::user()->rank<=3)
                                    <a class="btn btn-green" href="{{url('project/arrange/'.$project->id)}}">
                                        选择员工
                                    </a>
                                    <a class="btn btn-danger" href="{{url('project/detail/'.$project->id)}}?clear=true" id="clear">
                                        清空已选
                                    </a>
                                        @endif
                                </div>
                            </div>
                        </div>

                            <div class="col-sm-7" style="margin-left: -13px;margin-top: 10px"><p style="font-size: 15px">已选员工ID：{{$project->staffId}}</p></div>

                        {{--</div>--}}

                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel panel-heading">项目资金</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-2">
                                <p><strong>预期成本：</strong>{{$project->cost}}</p>
                            </div>
                            <div class="col-sm-3">
                                <p><strong>预期利润：</strong>{{$project->profit}}</p>
                            </div>
                        </div>

                    </div>
                </div>

            {{--</form>--}}
            @if($project->state==0)         <!--如果项目未启动-->
            <div  style="text-align: center">
                <a type="button" class="btn btn-xs btn-green" style="height: 40px;width: 70px;font-size: 20px" href="{{url('project/start',['id'=>$project->id])}}">启动</a>
            </div>
            @else
                    @if($project->state!=3)
                <div style="text-align: center">
                    <a type="button" class="btn btn-xs btn-green" style="height: 40px;width: 70px;font-size: 20px" href="{{url('project/settle',['id'=>$project->id])}}">结算</a>
                </div>
                        @endif
                @endif
        </div>

        <!--弹出修改项目内容窗口-->
        <div class="modal fade" id="reviseProject" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('project/update')}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">修改内容</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group ">
                                    <label for="mName" class="col-xs-3 control-label">项目内容：</label>
                                        <div class="col-xs-8 ">
                                            <input id="mId" value="" name="Project[id]" class="form-control input-sm " placeholder="">
                                        </div>
                                </div>
                                <div class="form-group ">
                                    <label for="mName" class="col-xs-3 control-label">项目内容：</label>
                                    <div class="row">
                                        <div class="col-xs-8 ">
                                        <div class="form-group">
                                            <textarea id="mContent" name="Project[content]" value="{{old('Project')['content']?old('Project')['content']:''}}" class="form-control" rows="3" placeholder="未填写.."></textarea>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal" id="pSure">确定</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            if($('#Lproject1').css('display')=='none'){
                $('#Lproject1').css('display','block');
                $('#Lproject1').css('background','#F3F3FA');
            }
        });
        function contentInfo(con,id) {
            $('#mId').val(id);
            $('#mContent').val(con);
        }
        $('#imBtn').on('click',function () {
            $('#imBtnInput').click();
        });
        function im() {
            document.getElementById("imSubmit").submit();
        }
    </script>
    @stop