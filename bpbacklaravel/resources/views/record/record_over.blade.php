@extends('common.layouts')

@section('content')
    @if(Auth::user()->rank<=2)
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="check-div form-inline">
            <div class="col-xs-3">
                {{--<button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addUser">添加用户 </button>--}}
            </div>
            <div class="col-xs-4">
                <input type="text" id="recordText" class="form-control input-sm" placeholder="输入文字搜索" >
                <button class="btn btn-white btn-xs " onclick="find_record()">查 询 </button>
            </div>
            <div class="col-xs-5" style=" padding-right: 40px;text-align: right;">
                <img id="toout" onclick="window.location.href='{{url('admin/logout')}}'" src="{{asset('img/退出.png')}}" style="height: 30px;width: 30px" >
            </div>
        </div>
        <div class="data-div">
            <div class="row tableHeader">
                <div class="col-xs-1 ">
                    Id
                </div>
                <div class="col-xs-9">
                    记录
                </div>
                <div class="col-xs-2">
                    操作
                </div>
            </div>
            @include('common.vaildator')
            @include('common.message')
            <div class="tablebody" id="table">
                @foreach($record as $cord)
                    <div class="row">
                        <div class="col-xs-1 " id="id">
                            {{$cord->id}}
                        </div>
                        <div class="col-xs-9 " id="name" style="width:1255px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" >
                            {{$cord->cord}}
                        </div>
                        <div class="col-xs-2">
                            <a class="btn btn-danger btn-xs" href="{{url('record/delete',['id'=>$cord->id])}}" onclick="if(confirm('确定要删除吗?')==false) return false;">删除</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!--分页-->
        <div >
            <div class="pull-left">
                {{$record->render()}}
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
            if($('#Lcord1').css('display')=='none'){
                $('#Lcord1').css('display','block');
                $('#Lcord1').css('background','#F3F3FA');
            }
        });
        function find_record() {
            var text=$('#recordText').val();
            window.location.href="{{url('record/over')}}?text="+text;
        }
    </script>
@stop