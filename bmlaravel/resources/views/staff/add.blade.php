@extends('common.layouts')

@section('content')
    @include('common.validator')
    <!--自定义内容区域-->
    <div class="panel-default">
        <div class="panel-heading">新增职员</div>
        <div class="panel-body">
            <form class="form-horizontal" method="get" action="{{url('bm/save')}}">
            {{csrf_field()}} <!--生成隐藏input表单-->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5">
                        <input type="text" name="Staff[name]" value="{{old('Staff')['name']}}" class="form-control" id="name" placeholder="请输入员工姓名">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Staff.name')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5">
                        <input type="text" name="Staff[age]" value="{{old('Staff')['age']}}" class="form-control" id="age" placeholder="请输入员工年龄">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Staff.age')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">职位</label>
                    <div class="col-sm-5">
                        <input type="text" name="Staff[position]" value="{{old('Staff')['position']}}" class="form-control" id="age" placeholder="请输入员工职位">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Staff.position')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-5">
                        @foreach($staff->sex() as $ind=>$val)
                            <label class="radio-inline">
                                <input name="Staff[sex]" type="radio" value="{{$ind}}">{{$val}}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Staff.sex')}}</p>
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