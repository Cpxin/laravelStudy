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
        <div class="data-div">
            <div class="row tableHeader">
                <div class="col-xs-2 ">
                    Id
                </div>
                <div class="col-xs-2">
                    姓名
                </div>
                <div class="col-xs-3">
                    邮箱
                </div>
                <div class="col-xs-2">
                    权限等级
                </div>
                <div class="col-xs-3">
                    操作
                </div>
            </div>
            @include('common.vaildator')
            @include('common.message')
            <div class="tablebody" id="table">
                @foreach($admin as $ad)
                    <div class="row">
                        <div class="col-xs-2 " id="id">
                            {{$ad->id}}
                        </div>
                        <div class="col-xs-2 " id="name">
                            {{$ad->name}}
                        </div>
                        <div class="col-xs-3 " id="email">
                            {{$ad->email}}
                        </div>
                        <div class="col-xs-2 " id="rank">
                            {{$ad->rank}}
                        </div>
                        <div class="col-xs-3">
                            <a class="btn btn-danger btn-xs" href="{{url('admin/delete',['id'=>$ad->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!--分页-->
        <div>
            <div class="pull-right">
                {{$admin->render()}}
            </div>
        </div>

    </div>
    @stop

@section('javascript')
    @parent
    <script>
        $(document).ready(function () {
            if($('#Ladmin1').css('display')=='none'){
                $('#Ladmin1').css('display','block');
                $('#Ladmin1').css('background','#F3F3FA');
            }
        });
    </script>
@stop