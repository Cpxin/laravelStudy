@extends('common.layouts')
{{--@section('style')--}}
{{--@parent--}}
{{--@stop--}}
@section('content')
    @if(Auth::user()->rank<=4)
        <div role="tabpanel" class="tab-pane active" id="user">
            <div class="check-div form-inline">
                <div class="col-xs-3">
                    @if(Auth::user()->rank<=3)
                        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addWages">添加 </button>
                    @endif
                </div>
                <div class="col-xs-4">
                    <input type="text" id="wagePosition" class="form-control input-sm" placeholder="输入职位搜索" >
                    <button class="btn btn-white btn-xs " onclick="find_wages()">查 询 </button>
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
            <div class="" style="position: absolute">
                {{--<div class="panel panel-info" style="width:200px;margin-top: 10px;margin-left: 20px;float: left">--}}
                    {{--<div class="panel-heading">关于公司</div>--}}
                    {{--<ul class="list-group" id="Article_1">--}}
                        {{--<li class="list-group-item" onclick="art(0)">公司介绍</li>--}}
                        {{--<li class="list-group-item" onclick="art(1)">发展历程</li>--}}
                        {{--<li class="list-group-item" onclick="art(2)">管理团队</li>--}}
                        {{--<li class="list-group-item" onclick="art(3)">文化和价值观</li>--}}
                        {{--<li class="list-group-item" onclick="art(4)">企业荣誉</li>--}}
                    {{--</ul>--}}
                    {{--<div class="panel-body" style="text-align: center" id="addArticle" onclick="addArticle()">+</div>--}}
                {{--</div>--}}
                {{--<div class="panel panel-info" style="width:200px;margin-top: 10px;margin-left: 20px;float: left">--}}
                    {{--<div class="panel-heading">业务体系</div>--}}
                    {{--<ul class="list-group">--}}
                        {{--<li class="list-group-item">业务体系</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="panel panel-info" style="width:200px;margin-top: 10px;margin-left: 20px;float: left">--}}
                    {{--<div class="panel-heading">新闻及媒体资源</div>--}}
                    {{--<ul class="list-group">--}}
                        {{--<li class="list-group-item">新闻发布</li>--}}
                        {{--<li class="list-group-item">媒体资料库</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="panel panel-info" style="width:200px;margin-top: 10px;margin-left: 20px;float: left">--}}
                    {{--<div class="panel-heading">联系我们</div>--}}
                    {{--<ul class="list-group">--}}
                        {{--<li class="list-group-item">商务合作</li>--}}
                        {{--<li class="list-group-item">公司地址</li>--}}
                        {{--<li class="list-group-item">廉政举报</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                @foreach($article as $zt=>$t)
                    <div class="panel panel-info" style="width:200px;margin-top: 10px;margin-left: 20px;float: left">
                        <div class="panel-heading">{{$zt}}</div>
                        <ul class="list-group" id="{{$zt}}">
                            @foreach($t as $k=>$v)
                            <li class="list-group-item" onclick="art('{{$zt}}',{{$k}})">{{$v}}</li>
                            @endforeach
                        </ul>
                        <p class="" style="text-align: center" id="addArticle" onclick="addArticle('{{$zt}}')">+</p>
                    </div>
                    @endforeach
                <!--弹出添加用户窗口-->
                <div class="modal fade" id="addUser" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="post" action="{{url('staff/save')}}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        {{--@include('common.vaildator')--}}
                                        <div class="form-group ">
                                            <textarea class="" cols="70" rows="30" style="position:relative;left: 40px" id="content"></textarea>
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

                {{--<div class="container">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12 ">--}}
                            {{--<h2 class="text-primary text-center">日本女孩研发狗狗机器人,告诉你今天体味如何?</h2>--}}
                            {{--<div>--}}
                                {{--<p class="text-muted ">--}}
                                    {{--或许纯粹用机器测定你身上有无臭味，还不能激发人的耻度，但日本一家建设公司旗下的「CrazyLabo」疯狂实验室与北九州工业高等专门学校合作推出的人形与狗形气味探测机器人，将激发你内心最深处的羞耻感（或挫败感）！--}}
                                {{--</p>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center">--}}
                                        {{--<img src="img/sample-image.jpg" class="img-thumbnail" />--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<p class="text-muted">--}}
                                    {{--图中的这位可爱的女孩叫做「香织」，--}}
                                    {{--虽然被她眼睛直视感觉怪恐怖的，但微启的双唇，其实内部藏有气味探测装置。对她的双唇间吹气后，香织会从好到坏四个层次中归类你的口气。若你是香织的菜，她会告诉你：「柑橘般的酸甜滋味」（恋爱了？）；但太糟糕也会实话实说，毕竟她还不会说谎啊！--}}
                                {{--</p>--}}
                                {{--<p class="text-muted">--}}
                                    {{--相对于异常恐怖的香织，狗形气味机器人就可爱多啦。主要的功用是闻闻你的脚味，虽然它不会说话，但会以肢体语言表达感受。当刚穿上袜子给它嗅嗅，通常会开心地对你叫几声。但最糟的情况下，它会直接气绝身亡，背景音乐将拨放萧邦的送葬进行曲。虽然表达形式有种恶搞的感觉，但点击来源连结观看朝日新闻的视频，你应该会笑出来！--}}
                                {{--</p>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--<h4 class="text-muted">文章导航</h4>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">--}}
                                        {{--<img src="img/1.jpg" class="img-thumbnail" />--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">--}}
                                        {{--<img src="img/2.jpg" class="img-thumbnail" />--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">--}}
                                        {{--<img src="img/3.jpg" class="img-thumbnail" />--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 col-lg-offset-1  a">--}}
                            {{--<h4 class="text-muted text-center">随手文章 </h4>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


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
    </script>
@stop