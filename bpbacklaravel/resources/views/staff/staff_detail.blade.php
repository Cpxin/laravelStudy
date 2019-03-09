@extends('common.layouts')

@section('style')
    @stop

@section('content')
    @if(Auth::user()->rank<=3)
    <div class="row col-sm-offset-1" style="margin-left: 10px">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">基本信息</div>
                <div class="panel-body">
                    {{--<img src="{{asset('img/me.png')}}" class="col-sm-offset-1 img-responsive img-rounded img-thumbnail" style="height: 270px;width: 300px;margin-right: 50px" alt="Me">--}}
                    {{--<button class="btn-block col-sm-offset-4" style="width: 100px;">上传照片</button>--}}
                    <form method="post" enctype="multipart/form-data" id="file_upload" action="{{url('staff/save_img/'.$staff->id)}}">
                        {{ csrf_field() }}
                            @if(isset($vitae->image)&&$vitae->image!=null&&$vitae->image!="无")
                        　　<img  src="{{asset('/storage')}}/{{$vitae->image}}" class="col-sm-offset-1 img-responsive img-rounded img-thumbnail" style="border: 2px solid #1f4ba5;border-radius: 150px;height: 300px;width: 300px;margin-right: 50px">
                        　　@else
                            <img src="{{asset('img/用户.png')}}" class="col-sm-offset-1 img-responsive img-rounded img-thumbnail" style="border: 2px solid #1f4ba5;border-radius: 150px;height: 300px;width: 300px;margin-right: 50px" alt="Me">
                        @endif
                            <p>
                            　　　　<input type="file" id="test-image-file" name="img" accept="image/gif, image/jpeg, image/png, image/jpg" value="选择头像">

                            　　</p>
                        {{--<p id="test-file-info"></p>--}}


                    <p  class=" col-sm-offset-1" style="width: 100px">姓名：{{$staff->name}}</p>
                    <address>
                        {{--<strong>中国</strong><br>--}}
                        <span class="glyphicon glyphicon-sex col-sm-offset-1" title="sex">性别：{{$staff->sex($staff->sex)}}</span><br>
                        <span class="glyphicon glyphicon-age col-sm-offset-1" title="age">年龄：{{$staff->age}}</span><br>
                        <span class="glyphicon glyphicon-position col-sm-offset-1" title="position">职位：{{$staff->position}}</span><br>
                        {{--<span class="glyphicon glyphicon-envelope" title="Email"><code>1610712512@qq.com</code></span>--}}
                    </address>
                        @if(Auth::user()->rank<=3)
                    <button type="submit"  class="col-sm-offset-5 btn btn-primary">保存</button>
                            @endif
                    </form>
                </div>
            </div>

        {{--<div class="panel panel-info">--}}
            {{--<div class="panel panel-heading">技能</div>--}}
            {{--<div class="panel-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<span class="text-muted">HTML5</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="progress">--}}
                            {{--<div class="progress-bar progress-bar-striped active" style="width: 85%"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<span class="text-success">IOS</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="progress">--}}
                            {{--<div class="progress-bar progress-bar-striped progress-bar-success active" style="width: 85%"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<span class="text-info">PHP</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="progress">--}}
                            {{--<div class="progress-bar progress-bar-striped progress-bar-info active" style="width: 70%"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<span class="text-warning">JQuery</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="progress">--}}
                            {{--<div class="progress-bar progress-bar-striped progress-bar-warning active" style="width: 65%"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row">--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<span class="text-danger">CSS</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="progress">--}}
                            {{--<div class="progress-bar progress-bar-striped progress-bar-danger active" style="width: 50%"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="panel panel-primary">
            <div class="panel panel-heading">发送消息</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{url('staff/wx_information')}}">
                    {{ csrf_field() }}
                    {{--<div class="form-group">--}}
                        {{--<label for="email" class="col-sm-2 control-label">Email</label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<input type="email" id="email" class="form-control" placeholder="Email">--}}
                            {{--@if($vitae->email!=null)--}}
                                {{--<p style="margin-top: 7px">{{$vitae->email}}</p>--}}
                                {{--@else--}}
                                {{--<p style="margin-top: 7px">未填写邮箱</p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <input type="text" name="Info[id]" style="display: none" value="{{$staff->id}}">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">消息</label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="Info[content]" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary pull-right">发送</button>
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
                        <div class="panel-title">
                            <a href="#collapseThree" data-toggle="collapse" data-parent="#accoradion">当前执行任务</a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-info">
                                        <div class="row">
                                            <div class="col-sm-4">项目ID</div>
                                            <div class="col-sm-4">项目名称</div>
                                            <div class="col-sm-4">项目进度</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-success">
                                        <div class="row">
                                            <div class="col-sm-4">{{$now_project['now_project_id']}}</div>
                                            <div class="col-sm-4">{{$now_project['now_project_name']}}</div>
                                            <div class="col-sm-4">
                                                <div class="progress" style="">
                                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                         aria-valuenow="45" aria-valuemin="0" aria-valuemax="" style="width: {{$now_project['now_project_term']}}%">
                                                        <div class="progress-text" style="color: black">{{$now_project['now_project_term']}}&nbsp;&nbsp;&nbsp;Day</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    {{--@endif--}}
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#collapseTwo" data-toggle="collapse" data-parent="#accoradion">项目经历</a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
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
                        <form class="form-horizontal" method="post" action="{{url('staff/save_detail/'.$staff->id)}}">
                        {{csrf_field()}} <!--生成隐藏input表单-->
                        <div class="panel-title">
                            <a href="#collapseOne" data-toggle="collapse" data-parent="#accoradion">附加信息</a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
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
                                @if(Auth::user()->rank<=3)
                                <button class="btn btn-primary" type="submit" style="float:right;margin-right: 20px">保存</button>
                                    @endif
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
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
            if($('#Lstaff1').css('display')=='none'){
                $('#Lstaff1').css('display','block');
                $('#Lstaff1').css('background','#F3F3FA');
            }
        });
    </script>
@stop