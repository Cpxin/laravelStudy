@extends('common.layouts')

@section('content')
    <div class="row col-sm-offset-3">
        <div class="col-sm-8">
            <form class="form-horizontal" method="post" action="{{url('project/save')}}">
                {{csrf_field()}}
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
                                <p><strong>状态：</strong>{{$project->state}}</p>
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
                    <div class="panel panel-heading">项目内容</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-5">
                                <p>{{$project->content}}</p>
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

                <div class="panel">
                    <button type="submit" class="btn btn-xs btn-green">保 存</button>
                </div>

            </form>
        </div>

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