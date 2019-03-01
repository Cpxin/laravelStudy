@extends('common.layouts')

@section('content')
    @if(Auth::user()->rank==1)
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addUser">添加用户 </button>
            </div>
            <div class="col-xs-4">
                <input type="text" id="adminName" class="form-control input-sm" placeholder="输入文字搜索" >
                <button class="btn btn-white btn-xs " onclick="find_admin()">查 询 </button>
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
                            <a class="btn btn-danger btn-xs" href="{{url('admin/delete')}}?id={{$ad->id}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
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

    <!--弹出添加用户窗口-->
    <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" action="{{url('admin/save')}}">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">添加管理员</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            {{--@include('common.vaildator')--}}
                            <div class="form-group ">
                                <label for="aName" class="col-xs-3 control-label">管理员姓名：</label>
                                <div class="col-xs-8 ">
                                    <input name="Admin[name]" value="{{old('Admin')['name']}}" class="form-control input-sm duiqi" id="aName" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aEmail" class="col-xs-3 control-label">管理员邮箱：</label>
                                <div class="col-xs-8 ">
                                    <input name="Admin[email]" value="{{old('Admin')['email']}}" class="form-control input-sm duiqi" id="aEmail" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">权限等级：

                                    </label>
                                <select class=" col-xs-3" name="Admin[rank]" style="margin-top:10px ">
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                        <button type="submit" class="btn btn-xs btn-green">保 存</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @else
        @include('common.jurisdiction')
    @endif
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
        function find_admin() {
            var name=$('#adminName').val();
            window.location.href="{{url('admin/over')}}?name="+name;
        }
    </script>
@stop