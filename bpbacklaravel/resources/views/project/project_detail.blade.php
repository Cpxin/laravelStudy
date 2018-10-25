@extends('common.layouts')

@section('content')
    <div class="row col-sm-offset-3">
        <div class="col-sm-8">
            {{--<form class="form-horizontal" method="post" action="{{url('project/update',['id'=>$project->id])}}">--}}
                {{--{{csrf_field()}}--}}
                <!--基本信息-->
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
                                <p><strong>期限：</strong>{{$project->term}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!--项目内容-->
                <div class="panel panel-info">
                    <div class="panel panel-heading">项目内容<button class="btn btn-green" data-toggle="modal" data-target="#reviseProject" onclick="contentInfo('{{$project->content}}','{{$project->id}}')">编辑</button> </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-5">
                                <p id="pContent">{{$project->content}}</p>
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
                                <div class="col-sm-offset-1">
                                    <p>{{$project->personnel}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-green" href="{{url('project/arrange/'.$project->id)}}">
                                        选择员工
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="form-inline">
                                    <p>职位：
                                    <select class="form-control">
                                        <option>程序员</option>
                                        <option>项目主管</option>
                                        <option>项目经理</option>
                                    </select>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group  col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon" >人数：</div>
                                    <input type="text" style="width: 50px" id="num" name="Project[personnel]" value="{{old('Project')['personnel']?old('Project')['personnel']:''}}" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-green">
                                    <strong>+</strong>
                                </button>
                            </div>

                            <div class="col-sm-2"><p>{{$project->staffId}}</p></div>


                        </div>

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

                {{--<div class="panel">--}}
                    {{--<button type="submit" class="btn btn-xs btn-green">保 存</button>--}}
                {{--</div>--}}

            {{--</form>--}}
            @if($project->state==0)         <!--如果项目未启动-->
            <div class="panel">
                <a type="button" class="btn btn-xs btn-green" href="{{url('project/start',['id'=>$project->id])}}">启动</a>
            </div>
            @else
                <div class="panel">
                    <a type="button" class="btn btn-xs btn-green" href="{{url('project/settle',['id'=>$project->id])}}">结算</a>
                </div>
                @endif
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

        <!--右边-->
        {{--<div class="col-sm-9">--}}
        {{--<div class="jumbotron">--}}
        {{--<p class="text-left small">--}}
        {{--爱学习、爱编程、爱咖啡可乐、爱挑战、爱专研、爱打游戏、爱晚起、也爱工作到深夜.我擅长技术、崇尚简单和懒惰。我神秘而孤僻，沉默而爱憎分明。--}}
        {{--<br>Don't panic I‘m a programmer--}}
        {{--</p>--}}
        {{--<div class="panel-default">--}}
        {{--@include('common.message')--}}
        {{--<div class="panel-heading">附加信息</div>--}}
        {{--<div class="panel-body">--}}
        {{--<form class="form-horizontal" method="post" action="{{url('staff/save_detail/'.$staff->id)}}">--}}
        {{--{{csrf_field()}} <!--生成隐藏input表单-->--}}

        {{--<div class="form-group">--}}
        {{--<div class="col-sm-5">--}}
        {{--<label for="hobby">爱好:</label>--}}
        {{--<textarea id="hobby" name="Vitae[hobby]" value="{{old('Vitae')['hobby']?old('Vitae')['hobby']:''}}" class="form-control" rows="3"></textarea>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
        {{--<div class="input-group col-sm-5">--}}
        {{--<div class="input-group-addon" >邮箱</div>--}}
        {{--<input type="text" name="Vitae[email]" value="{{old('Vitae')['email']?old('Vitae')['email']:''}}" class="form-control " id="email" placeholder="未填写..">--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
        {{--<div class="input-group col-sm-5">--}}
        {{--<div class="input-group-addon" >住址</div>--}}
        {{--<input type="text" name="Vitae[adress]" value="{{old('Vitae')['adrss']?old('Vitae')['adress']:''}}" class="form-control " id="adress" placeholder="未填写..">--}}
        {{--</div>--}}
        {{--</div>--}}
        {{----}}
        {{--<div class="form-group">--}}
        {{--<div class="col-sm-offset-2 col-sm-10">--}}
        {{--<button type="submit" class="btn btn-primary" >保存</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{----}}
        {{--</div>--}}
    </div>
@stop

@section('javascript')
    @parent
    <script type="text/javascript">
        function contentInfo(con,id) {
            $('#mId').val(id);
            $('#mContent').val(con);
        }
    </script>
    @stop