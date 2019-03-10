@extends('common.layouts')
{{--@section('style')--}}
{{--@parent--}}
{{--@stop--}}
@section('content')
    @if(Auth::user()->rank<=4)
        <div role="tabpanel" class="tab-pane active" id="user">
            <div class="check-div form-inline">
                <div class="col-xs-3">

                </div>
                <div class="col-xs-4">

                </div>
                <div class="col-xs-5" style=" padding-right: 40px;text-align: right;">
                    <img id="toout" onclick="window.location.href='{{url('admin/logout')}}'" src="{{asset('img/退出.png')}}" style="height: 30px;width: 30px" >
                </div>
            </div>
            <div class="" style="position: relative">
                @include('common.message')
                @include('common.vaildator')
                <div class="panel panel-info">
                    <div class="panel-heading">文章模块</div>
                    <div class="panel-body">
                        @foreach($article as $zt=>$t)
                        <div class="panel panel-info glyphicon " style="width:200px;margin-top: 10px;margin-left: 20px;float: left">
                            <div class="panel-heading ">{{$zt}}<a href="{{url('homepage/delete')}}?ztitle={{$zt}}"><span   class="glyphicon glyphicon-remove" style="float: right"></span></a></div>
                            <ul class="list-group" id="{{$zt}}">
                                @foreach($t as $k=>$v)
                                <li class="list-group-item" onclick="art('{{$zt}}',{{$k}})">{{$v}}</li>
                                @endforeach
                            </ul>
                            <p class="" style="text-align: center" id="addArticle" onclick="addArticle('{{$zt}}')">+</p>
                        </div>
                        @endforeach
                        <div >
                            <img src="{{asset('img/加.png')}}" style="height: 50px;width: 50px;margin-left: 50px;margin-top: 100px" onclick="addzTitle()">
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">留言板</div>
                    <div class="panel-body">
                        <ul class="list-group">
                        @foreach($message as $mes)
                                <li class="list-group-item">{{$mes->content}}<a href="{{url('homepage/message_delete')}}?id={{$mes->id}}"><span  class="glyphicon glyphicon-remove" style="float: right"></span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!--弹出添加用户窗口-->
                <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="post" action="{{url('homepage/update')}}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        {{--@include('common.vaildator')--}}
                                        <input value="" name="Article[title]" id="mTitle" style="display: none">
                                        <div class="form-group ">
                                            <textarea name="Article[content]" class="" cols="70" rows="30" style="position:relative;left: 40px" id="content"></textarea>
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

        </div>
            <!--弹出添加用户窗口-->
            <div class="modal fade" id="addArticle_modal" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        {{--<form class="form-horizontal" method="post" action="{{url('staff/save')}}">--}}
                        {{--{{ csrf_field() }}--}}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">请输入标题</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                {{--@include('common.vaildator')--}}
                                <div >
                                    <input id="ztitle" style="display: none">
                                    <input id="aTitle" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button  class="btn btn-xs btn-green" onclick="addArticle_modal($('#ztitle').val())">保 存</button>
                        </div>
                        {{--</form>--}}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!--弹出添加用户窗口-->
            <div class="modal fade" id="addzTitle_model" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="post" action="{{url('homepage/add_ztitle')}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">请输入标题</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                {{--@include('common.vaildator')--}}
                                <div >
                                    总标题：<input id="zztitle" name="title[ztitle]" class="form-control" placeholder="">
                                    标题：<input id="aaTitle" name="title[title]" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                            <button  class="btn btn-xs btn-green" type="submit">保 存</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            if($('#Lhomepage1').css('display')=='none'){
                $('#Lhomepage1').css('display','block');
                $('#Lhomepage1').css('background','#F3F3FA');
            }
        });
        function art(title,val) {           //当点击li时
            var about=$('#addUser');       //文章内容模态框
            var str=$('#'+title+' li').eq(val).html();  //标题
            var text='';
            $.get('{{url('homepage/article')}}',{'title':str},function (content) {
                text=content;
                $('#content').html(text);
                $('#gridSystemModalLabel').html(str);
                $('#mTitle').val(str);
                about.modal('show');
            });
        }
        function addArticle(ztitle) {     //当点击添加文章标题时，传入总标题
            $('#ztitle').val(ztitle);
            $('#addArticle_modal').modal('show');

        }
        function addArticle_modal(ztitle) {       //当点击保存添加标题时，传入总标题
            var title=document.getElementById('aTitle').value;
            $.ajax({
                type:'get',
                url:'{{url('homepage/add_title')}}',
                data:{'z_title':ztitle,'title':title},
                success:function(data){
                    // console.log(data);
                    var li=document.createElement('li');
                    li.setAttribute('class','list-group-item');
                    li.setAttribute('onclick','art('+document.getElementById(ztitle).getElementsByTagName("li").length+')');
                    li.innerHTML=document.getElementById('aTitle').value;
                    document.getElementById(ztitle).appendChild(li);
                    $('#addArticle_modal').modal('hide');
                }

            });
        }
        function addzTitle() {
            $('#addzTitle_model').modal('show');
        }
        function del(ztitle) {
            $.ajax({
                url:'{{url('homepage/delete')}}',
                type:'get',
                data:{ztitle:ztitle},
                success:function (data) {
                    console.log(132);
                }
            })
        }

    </script>
@stop