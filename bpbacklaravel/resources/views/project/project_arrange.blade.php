@extends('common.layouts')

@section('content')

    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addUser">添加用户 </button>
            </div>
            <div class="col-xs-4">
                <input type="text" class="form-control input-sm" placeholder="输入文字搜索" >
                <button class="btn btn-white btn-xs ">查 询 </button>
            </div>
            <div class="col-lg-3 col-lg-offset-2 col-xs-4" style=" padding-right: 40px;text-align: right;">
                <label for="paixu">排序:&nbsp;</label>
                <select class=" form-control">
                    <option>地区</option>
                    <option>地区</option>
                    <option>班期</option>
                    <option>性别</option>
                    <option>年龄</option>
                    <option>份数</option>
                </select>
            </div>
        </div>

        <div class="row">
        <div class="data-div col-xs-8">
            <div class="row tableHeader">
                <div class="col-xs-1 ">
                    Id
                </div>
                <div class="col-xs-2">
                    姓名
                </div>
                <div class="col-xs-1">
                    性别
                </div>
                <div class="col-xs-3">
                    职位
                </div>
                <div class="col-xs-1">
                    状态
                </div>
                <div class="col-xs-2">
                    操作
                </div>
            </div>
            @include('common.vaildator')
            @include('common.message')
            <div class="tablebody" id="table">
                @foreach($staff as $sta)
                    <div class="row">
                        <div class="col-xs-1 " id="id">
                            {{$sta->id}}
                        </div>
                        <div class="col-xs-2" id="name">
                            {{$sta->name}}
                        </div>
                        <div class="col-xs-1" id="sex">
                            {{$sta->sex}}
                        </div>
                        <div class="col-xs-3" id="position">
                            {{$sta->position}}
                        </div>
                        <div class="col-xs-1" >
                            {{$sta->state}}
                        </div>
                        <div class="col-xs-2">
                            {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseUser">详情</button>--}}
                            <a class="btn btn-success btn-xs" href="{{url('staff/detail',['id'=>$sta->id])}}">详情</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!--分页-->
            <div>
                <div class="pull-right">
                    {{$staff->render()}}
                </div>
            </div>

        </div>

        <div class="col-xs-4">
            <div class="panel-body">
                <select multiple class="form-control">
                    <option>1</option>
                </select>
            </div>
        </div>

        </div>

    </div>

@stop