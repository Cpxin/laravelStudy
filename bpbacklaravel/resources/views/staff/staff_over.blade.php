@extends('common.layouts')


@section('content')

    @if($adminId==1)

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
                <div class="col-xs-1 ">
                    Id
                </div>
                <div class="col-xs-2">
                    姓名
                </div>
                <div class="col-xs-2">
                    年龄
                </div>
                <div class="col-xs-2">
                    性别
                </div>
                <div class="col-xs-2">
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
                    <div class="col-xs-2" id="age">
                        {{$sta->age}}
                    </div>
                    <div class="col-xs-2" id="sex">
                      {{$sta->sex($sta->sex)}}
                    </div>
                    <div class="col-xs-2" id="position">
                        {{$sta->position}}
                    </div>
                    <div class="col-xs-1" id="state">
                        {{$sta->state($sta->state)}}
                    </div>
                    <div class="col-xs-2">
                        {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseUser">详情</button>--}}
                        <a class="btn btn-success btn-xs" href="{{url('staff/detail',['id'=>$sta->id])}}">详情</a>
                        <a class="btn btn-info btn-xs"   onclick="editInfo('{{$sta->id}}','{{$sta->name}}','{{$sta->age}}','{{$sta->sex}}','{{$sta->position}}')">修改</a>
                        <a class="btn btn-danger btn-xs" href="{{url('staff/delete',['id'=>$sta->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                    </div>
                </div>
                    @endforeach
            </div>

        </div>
    <!--分页-->
        <div>
            <div class="pull-right">
                {{$staff->render()}}
            </div>
        </div>

        <!--弹出添加用户窗口-->
        <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('staff/save')}}">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">添加员工</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            {{--@include('common.vaildator')--}}
                                <div class="form-group ">
                                    <label for="sName" class="col-xs-3 control-label">员工姓名：</label>
                                    <div class="col-xs-8 ">
                                        <input name="Staff[name]" value="{{old('Staff')['name']}}" class="form-control input-sm duiqi" id="sName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sLink" class="col-xs-3 control-label">年龄：</label>
                                    <div class="col-xs-8 ">
                                        <input name="Staff[age]" value="{{old('Staff')['age']}}" class="form-control input-sm duiqi" id="sLink" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">性别：</label>
                                    <div class="col-xs-8">
                                        <input name="Staff[sex]" value="{{old('Staff')['sex']}}" class="form-control input-sm duiqi" id="sOrd" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">职位：</label>
                                    <div class="col-xs-8">
                                        <input name="Staff[position]" value="{{old('Staff')['position']}}" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                    <div class="col-xs-8">
                                        <select class=" form-control select-duiqi">
                                            <option value="">国际关系地区</option>
                                            <option value="">北京大学</option>
                                            <option value="">天津大学</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                    <div class="col-xs-8">
                                        <select class=" form-control select-duiqi">
                                            <option value="">管理员</option>
                                            <option value="">普通用户</option>
                                            <option value="">游客</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="situation" class="col-xs-3 control-label">状态：</label>
                                    <div class="col-xs-8">
                                        <label class="control-label" for="anniu">
                                            <input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="control-label" for="meun">
                                            <input type="radio" name="situation" id="forbid"> 禁用</label>
                                    </div>
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

        <!--弹出修改用户窗口-->
        <div class="modal fade" id="reviseStaff" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('staff/update')}}">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">修改员工</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group ">
                                <label for="sName" class="col-xs-3 control-label">员工ID：</label>
                                <div class="col-xs-8 ">
                                    <input  name="rStaff[id]" value="" class="form-control input-sm duiqi" id="cId" placeholder="">
                                </div>
                            </div>
                                <div class="form-group ">
                                    <label for="sName" class="col-xs-3 control-label">员工姓名：</label>
                                    <div class="col-xs-8 ">
                                        <input  name="rStaff[name]" value="" class="form-control input-sm duiqi" id="cName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sLink" class="col-xs-3 control-label">年龄：</label>
                                    <div class="col-xs-8 ">
                                        <input name="rStaff[age]" value=""  class="form-control input-sm duiqi" id="cAge" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sOrd" class="col-xs-3 control-label">性别：</label>
                                    <div class="col-xs-8">
                                        <input name="rStaff[sex]" value=""  class="form-control input-sm duiqi" id="cSex" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">职位：</label>
                                    <div class="col-xs-8">
                                        <input name="rStaff[position]" value=""  class="form-control input-sm duiqi" id="cPosition" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">地区：</label>
                                    <div class="col-xs-8">
                                        <input type="" value="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sKnot" class="col-xs-3 control-label">权限：</label>
                                    <div class="col-xs-8">
                                        <input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="situation" class="col-xs-3 control-label">状态：</label>
                                    <div class="col-xs-8">
                                        <label class="control-label" for="anniu">
                                            <input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="control-label" for="meun">
                                            <input type="radio" name="situation" id="forbid"> 禁用</label>
                                    </div>
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

        <!--弹出删除用户警告窗口-->
        {{--<div class="modal fade" id="deleteUser" role="dialog" aria-labelledby="gridSystemModalLabel">--}}
            {{--<div class="modal-dialog" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
                        {{--<h4 class="modal-title" id="gridSystemModalLabel">提示</h4>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="container-fluid">--}}
                            {{--确定要删除该用户？删除后不可恢复！--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>--}}
                        {{--<button type="button" class="btn  btn-xs btn-danger">保 存</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.modal-content -->--}}
            {{--</div>--}}
            {{--<!-- /.modal-dialog -->--}}
        {{--</div>--}}
        <!-- /.modal -->

    </div>
    @endif
@stop

@section('javascript')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            if($('#Lstaff1').css('display')=='none'){
                $('#Lstaff1').css('display','block');
                $('#Lstaff1').css('background','#F3F3FA');
            }
        });
            function editInfo(arr0,arr1,arr2,arr3,arr4) {
                $('#cId').val(arr0);
                $('#cName').val(arr1);
                $('#cAge').val(arr2);
                $('#cSex').val(arr3);
                $('#cPosition').val(arr4);
                $('#reviseStaff').modal('show');
            }
            // $('#reviseStaff').on('show.bs.modal',function (event) {
        // });
    </script>
@stop