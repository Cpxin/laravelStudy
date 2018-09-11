@extends('common.layouts')

@section('content')
    @include('common.validator')
    <!--自定义内容区域-->
    <div class="panel-default">
        <div class="panel-heading">修改项目</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
            {{csrf_field()}} <!--生成隐藏input表单-->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">项目名称</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[name]" value="{{old('Project')['name']?old('Project')['name']:$project->name}}" class="form-control" id="name" placeholder="请输入项目名称">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.name')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目内容</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[content]" value="{{old('Project')['content']?old('Project')['content']:$project->content}}" class="form-control" id="content" placeholder="请输入项目内容">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.content')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目人员需求</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[personnel]" value="{{old('Project')['personnel']?old('Project')['personnel']:$project->personnel}}" class="form-control" id="personnel" placeholder="请输入人员需求">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.personnel')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目实施人员</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[staffId]" value="{{old('Project')['staffId']?old('Project')['staffId']:$project->staffId}}" class="form-control" id="staffId" placeholder="请输入实施人员信息">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.staffId')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目成本</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[cost]" value="{{old('Project')['cost']?old('Project')['cost']:$project->cost}}" class="form-control" id="cost" placeholder="请输入项目成本">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.cost')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目预期利润</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[profit]" value="{{old('Project')['profit']?old('Project')['profit']:$project->profit}}" class="form-control" id="profit" placeholder="请输入项目预期利润">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.profit')}}</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop