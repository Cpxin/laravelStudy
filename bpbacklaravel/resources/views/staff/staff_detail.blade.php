@extends('common.layouts')

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">基本信息</div>
                <div class="panel-body">
                    <img src="img/me.png" class="img-responsive img-rounded img-thumbnail" alt="Me">
                    <p class="text-center text-primary">{{$staff->name}}</p>
                    <address>
                        {{--<strong>中国</strong><br>--}}
                        <span class="glyphicon glyphicon-sex" title="sex"><kbd>{{$staff->sex}}</kbd></span><br>
                        <span class="glyphicon glyphicon-age" title="age">{{$staff->age}}</span><br>
                        <span class="glyphicon glyphicon-position" title="position">{{$staff->position}}</span><br>
                        {{--<span class="glyphicon glyphicon-envelope" title="Email"><code>1610712512@qq.com</code></span>--}}
                    </address>
                </div>
            </div>

        <div class="panel panel-info">
            <div class="panel panel-heading">Personal Skill</div>
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
            <div class="panel panel-heading">ContactMe</div>
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
        <div class="col-sm-9">
            <div class="jumbotron">
                {{--<p class="text-left small">--}}
                    {{--爱学习、爱编程、爱咖啡可乐、爱挑战、爱专研、爱打游戏、爱晚起、也爱工作到深夜.我擅长技术、崇尚简单和懒惰。我神秘而孤僻，沉默而爱憎分明。--}}
                    {{--<br>Don't panic I‘m a programmer--}}
                {{--</p>--}}
                <div class="panel-default">
                    @include('common.message')
                    <div class="panel-heading">附加信息</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{url('staff/save_detail/'.$staff->id)}}">
                        {{csrf_field()}} <!--生成隐藏input表单-->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[email]" value="{{old('Vitae')['email']?old('Staff')['email']:''}}" class="form-control" id="email" placeholder="请输入邮箱">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-2 control-label">住址</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[adress]" value="{{old('Vitae')['adress']?old('Vitae')['adress']:''}}" class="form-control" id="adress" placeholder="请输入员工住址">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-2 control-label">教育情况</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[education]" value="{{old('Vitae')['education']?old('Vitae')['education']:''}}" class="form-control" id="experience" placeholder="请输入员工教育情况">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-2 control-label">技能</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[skill]" value="{{old('Vitae')['skill']?old('Vitae')['skill']:''}}" class="form-control" id="skill" placeholder="请输入员工技能">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-2 control-label">爱好</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[hobby]" value="{{old('Vitae')['hobby']?old('Vitae')['hobby']:''}}" class="form-control" id="hobby" placeholder="请输入员工爱好">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-2 control-label">项目经验</label>
                                <div class="col-sm-5">
                                    <input type="text" name="Vitae[experience]" value="{{old('Vitae')['experience']?old('Vitae')['experience']:''}}" class="form-control" id="experience" placeholder="请输入员工教育情况">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" >保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-group" id="accoradion">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#detail" data-toggle="collapse" data-parent="#accoradion">附加信息</a>
                        </div>
                        <div id="detail" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="">
                                    <li><b>邮箱</b></li>
                                    <li>12000</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#collapseOne" data-toggle="collapse" data-parent="#accoradion">工作经验</a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
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

                    <div class="panel-heading">
                        <div class="panel-title">
                            <a href="#collapseTwo" data-toggle="collapse" data-parent="#accoradion">教育经历</a>
                        </div>


                        <div id="collapseTwo" class="panel-collapse collapse">
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

    @stop