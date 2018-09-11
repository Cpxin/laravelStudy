@extends('common.layouts')

@section('content')
    @include('common.validator')
    <!--自定义内容区域-->
    <div class="panel-default">
        <div class="panel-heading">新增项目</div>
        <div class="panel-body">
            <form class="form-horizontal" method="get" action="{{url('bm/projectsave')}}">
            {{csrf_field()}} <!--生成隐藏input表单-->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">项目名称</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[name]" value="{{old('Project')['name']}}" class="form-control" id="name" placeholder="请输入项目名称">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.name')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目内容</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[content]" value="{{old('Project')['content']}}" class="form-control" id="content" placeholder="请输入项目内容">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.content')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目人员需求</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[personnel]" value="{{old('Project')['personnel']}}" class="form-control" id="personnel" placeholder="请输入人员需求">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.personnel')}}</p>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="age" class="col-sm-2 control-label">项目实施人员</label>--}}
                    {{--<div class="col-sm-5">--}}
                        {{--<input type="text" name="Project[staffId]" value="{{old('Project')['staffId']}}" class="form-control" id="staffId" placeholder="请输入实施人员信息">--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-5">--}}
                        {{--<p class="form-control-static text-danger">{{$errors->first('Project.staffId')}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目成本</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[cost]" value="{{old('Project')['cost']}}" class="form-control" id="cost" placeholder="请输入项目成本">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.cost')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">项目预期利润</label>
                    <div class="col-sm-5">
                        <input type="text" name="Project[profit]" value="{{old('Project')['profit']}}" class="form-control" id="profit" placeholder="请输入项目预期利润">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Project.profit')}}</p>
                    </div>
                </div>

                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-2 control-label">性别</label>--}}
                    {{--<div class="col-sm-5">--}}
                        {{--@foreach($staff->sex() as $ind=>$val)--}}
                            {{--<label class="radio-inline">--}}
                                {{--<input name="Staff[sex]" type="radio" value="{{$ind}}">{{$val}}--}}
                            {{--</label>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-5">--}}
                        {{--<p class="form-control-static text-danger">{{$errors->first('Staff.sex')}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop