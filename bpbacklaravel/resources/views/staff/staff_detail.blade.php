@extends('common.layouts')

@section('style')
    @stop

@section('content')
    <div class="row col-sm-offset-1" style="margin-left: 10px">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">基本信息</div>
                <div class="panel-body">
                    <img src="{{asset('img/me.png')}}" class="img-responsive img-rounded img-thumbnail" alt="Me">
                    <p class="text-center text-primary">{{$staff->name}}</p>
                    <address>
                        {{--<strong>中国</strong><br>--}}
                        <span class="glyphicon glyphicon-sex" title="sex"><kbd>{{$staff->sex($staff->sex)}}</kbd></span><br>
                        <span class="glyphicon glyphicon-age" title="age">{{$staff->age}}</span><br>
                        <span class="glyphicon glyphicon-position" title="position">{{$staff->position}}</span><br>
                        {{--<span class="glyphicon glyphicon-envelope" title="Email"><code>1610712512@qq.com</code></span>--}}
                    </address>
                </div>
            </div>

        <div class="panel panel-info">
            <div class="panel panel-heading">技能</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-muted">HTML5</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" style="width: 85%"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-success">IOS</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-success active" style="width: 85%"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-info">PHP</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-info active" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-warning">JQuery</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-warning active" style="width: 65%"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-danger">CSS</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-danger active" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel panel-heading">发送邮件</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" class="form-control" placeholder="Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary pull-right">Send</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

        <!--右边-->
        <div class="col-sm-8">
            <div class="jumbotron">
                {{--<p class="text-left small">--}}
                    {{--爱学习、爱编程、爱咖啡可乐、爱挑战、爱专研、爱打游戏、爱晚起、也爱工作到深夜.我擅长技术、崇尚简单和懒惰。我神秘而孤僻，沉默而爱憎分明。--}}
                    {{--<br>Don't panic I‘m a programmer--}}
                {{--</p>--}}
                <div class="panel-default">
                    @include('common.message')
                </div>
            </div>

            <div class="panel-group" id="accoradion">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <form class="form-horizontal" method="post" action="{{url('staff/save_detail/'.$staff->id)}}">
                        {{csrf_field()}} <!--生成隐藏input表单-->
                        <div class="panel-title">
                            <a href="#collapseOne" data-toggle="collapse" data-parent="#accoradion">附加信息</a>

                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-success">
                                        <div class="row">
                                            <div class="col-sm-4">爱好</div>
                                            <div class="col-sm-4"><input name="rVitae[hobby]" value="{{isset($vitae->hobby)?$vitae->hobby:'' }}"  class="form-control input-sm duiqi" id="chobby" style="background: rgba(0,0,0,0);border:none" placeholder="未填写"></div>
                                            {{--<div class="col-sm-4"><button  class="btn btn-primary" >修改</button></div>--}}
                                        </div>
                                    </li>

                                    <li class="list-group-item list-group-item-warning">
                                        <div class="row">
                                            <div class="col-sm-4">邮箱</div>
                                            <div class="col-sm-4"><input name="rVitae[email]" value="{{isset($vitae->email)?$vitae->email:'' }}"  class="form-control input-sm duiqi" id="chobby" style="background: rgba(0,0,0,0);border:none" placeholder="未填写"></div>
                                            {{--<div class="col-sm-4"><button  class="btn btn-primary" >修改</button></div>--}}
                                        </div>
                                    </li>

                                    <li class="list-group-item list-group-item-info">
                                        <div class="row">
                                            <div class="col-sm-4">住址</div>
                                            {{--<div class="col-sm-4"><input name="rVitae[adress]" value="{{old('rVitae')['adress']?old('rVitae')['adress']:''}}"  class="form-control input-sm duiqi" id="chobby" style="background: rgba(0,0,0,0);border:none" placeholder=""></div>--}}
                                            <div class="col-sm-4"><input name="rVitae[adress]" value="{{isset($vitae->adress)?$vitae->adress:'' }}"  class="form-control input-sm duiqi" id="chobby" style="background: rgba(0,0,0,0);border:none" placeholder="未填写"></div>
                                            {{--<div class="col-sm-4"><button  class="btn btn-primary" >修改</button></div>--}}
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btn-primary" type="submit" style="float:right;margin-right: 20px">保存</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#collapseTwo" data-toggle="collapse" data-parent="#accoradion">项目经历</a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="list-group">

                                    <li class="list-group-item list-group-item-info">
                                        <div class="row">
                                            <div class="col-sm-4">项目ID</div>
                                            <div class="col-sm-4">项目名称</div>
                                            <div class="col-sm-4">项目等级</div>
                                        </div>
                                    </li>
                                    @if(isset($projectArr))
                                    @foreach($projectArr as $pro)
                                    <li class="list-group-item list-group-item-success">
                                        <div class="row">
                                            <div class="col-sm-4">{{$pro['pid']}}</div>
                                            <div class="col-sm-4">{{$pro['pName']}}</div>
                                            <div class="col-sm-4">{{$pro['prank']}}</div>
                                        </div>
                                    </li>
                                    @endforeach
                                        @else
                                        <li class="list-group-item list-group-item-success">
                                            <div class="row">
                                                <div class="col-sm-12">无</div>
                                            </div>
                                        </li>
                                    @endif


                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#collapseThree" data-toggle="collapse" data-parent="#accoradion">教育经历</a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-success">
                                        <div class="row">
                                            <div class="col-sm-4">2015/3/1-至今</div>
                                            <div class="col-sm-4">XXX公司</div>
                                            <div class="col-sm-4">IOS开发工程师</div>
                                        </div>
                                    </li>

                                    <li class="list-group-item list-group-item-warning">
                                        <div class="row">
                                            <div class="col-sm-4">2015/3/1-至今</div>
                                            <div class="col-sm-4">XXX公司</div>
                                            <div class="col-sm-4">IOS开发工程师</div>
                                        </div>
                                    </li>

                                    <li class="list-group-item list-group-item-info">
                                        <div class="row">
                                            <div class="col-sm-4">2015/3/1-至今</div>
                                            <div class="col-sm-4">XXX公司</div>
                                            <div class="col-sm-4">IOS开发工程师</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>

    @stop

@section('javascript')
    @parent
    <script>
        $(document).ready(function () {
            if($('#Lstaff1').css('display')=='none'){
                $('#Lstaff1').css('display','block');
                $('#Lstaff1').css('background','#F3F3FA');
            }
        });
    </script>
@stop