@extends('common.layouts')

@section('content')
    <div class="row" >
        <div class="col-sm-6 col-sm-offset-3">
            @include('common.message')
            @include('common.vaildator')
            <form id="form-horizontal" class="form-horizontal" method="post" action="{{url('project/save')}}" onsubmit="return conform();">
                {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-heading">基本信息</div>
                <div class="panel-body">

                    <div class="form-group">
                        <div class="input-group col-sm-5 col-sm-offset-3">
                            <div class="input-group-addon" >项目名称</div>
                        <input type="text" id="pName" name="Project[name]" value="{{old('Project')['name']?old('Project')['name']:''}}" class="form-control" placeholder="未填写..">
                    </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel panel-heading" style="display: flex;flex-direction: row">项目内容
                    {{--<form id="imSubmit" class="" method="post" action="{{url('project/word_save')}}"  >--}}
                            <span class="btn btn-danger col-sm-offset-9" >
                                <span id="imBtn">导入pdf文件</span>
                                <input type="file" name="import" style="display: none" onchange="im(this)"   id="imBtnInput" >
                            </span>
                    <input type="text" id="pPdfUrl" name="Project[pdfUrl]" value="{{old('Project')['pdfUrl']?old('Project')['pdfUrl']:''}}" class="form-control" style="display: none" >
                    {{--</form>--}}
                </div>
                {{--@include('common.vaildator')--}}
                {{--@include('common.message')--}}
                <div class="panel-body" id="pdf">
                    {{--@if(isset($pdfUrl))--}}
                        {{--<iframe src="{{asset('/storage/'.$pdfUrl)}}" width="100%" height="100%">123</iframe>--}}
                        {{--@endif--}}
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel panel-heading" style="display: flex;flex-direction: row">项目备注</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="form-group ">
                        <textarea id="pContent" name="Project[content]" value="{{old('Project')['content']?old('Project')['content']:''}}" class="form-control col-sm-offset-1" style="width: 700px" rows="10" placeholder="未填写.."></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel panel-heading">详细信息</div>
                <div class="panel-body col-sm-offset-3">


                        <div class="form-group" >
                            <div class="form-inline" >
                                <div class="input-group col-sm-5" style="width: auto">
                                    <div class="input-group-addon" >项目人员需求</div>
                                    <input type="text" id="pPersonnel" name="Project[personnel]" value="{{old('Project')['personnel']?old('Project')['personnel']:''}}" class="form-control" placeholder="未填写..">
                                </div>
                                <div class="input-group">
                                    <button id="need" class="btn-green">+</button>
                                </div>

                            </div>

                            <div id="select" class="form-inline" style="display: none">
                            <div class="input-group">
                                <div class="input-group-addon" >职位</div>

                                <select id="pos" class="form-control">
                                    @foreach($position1 as $pos)
                                        <option><a href="#">{{$pos->position}}</a></option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="input-group col-sm-2">
                                    <div class="input-group-addon" >人数</div>
                                    <input id="num" type="text" class="form-control" value="" placeholder="" >
                                </div>

                                <div class="input-group col-sm-2">
                                    <button id="sure" class="btn-green">+</button>
                                </div>
                            </div>

                        </div>

                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon" >项目期限</div>
                            <input type="text" id="pTerm" name="Project[term]" value="{{old('Project')['term']?old('Project')['term']:''}}" class="form-control" placeholder="未填写..">
                        </div>
                    </div>

                        <div class="form-group">
                            <div class="input-group col-sm-5">
                                <div class="input-group-addon" >项目预期成本</div>
                                <input type="text" id="pCost" name="Project[cost]" value="{{old('Project')['cost']?old('Project')['cost']:''}}" class="form-control" placeholder="未填写..">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group col-sm-5">
                                <div class="input-group-addon" >项目预期利润</div>
                                <input type="text" id="pProfit" name="Project[profit]" value="{{old('Project')['profit']?old('Project')['profit']:''}}" class="form-control" placeholder="未填写..">
                            </div>
                        </div>
                </div>
            </div>

                <div >
                <button  id="sub" type="button" class="btn btn-xs btn-green col-sm-offset-5" style="width: 70px;height: 40px" onclick="onbefore()">保 存</button>
                </div>

            </form>
        </div>


    </div>

@stop

@section('javascript')
    @parent
    <script type="text/javascript">
        var i=0;
        $(document).ready(function () {
            if($('#Lproject1').css('display')=='none'){
            $('#Lproject1').css('display','block');
            $('#Lproject1').css('background','#F3F3FA');
            }
        });

        $('#need').on('click',function () {
            $('#select').css('display','block');
            $('#need').css('display','none');
            i=0;
        });
        $('#sure').on('click',function () {
            var s=$('#pPersonnel').val();
            if(s.indexOf($('#pos').val())==-1) {
                s += $('#pos').val() + '*' + $('#num').val() + ';';
            }else {
                var s1=s.substring(s.indexOf($('#pos').val()));
                s1=s1.substring(s1.indexOf(";")+1);
                s=s.substring(0,s.indexOf($('#pos').val()))+s1+$('#pos').val() + '*' + $('#num').val() + ';';
            }

            $('#pPersonnel').val(s);
            $('#select').css('display','none');
            $('#need').css('display','block');

        });
        $('#sub').on('click',function () {
            document.getElementById("form-horizontal").submit();
            i=0;
        });

        function conform() {
            if(i===0){
                return false;
            }else {
                return true;
            }
        }
        $('#imBtn').on('click',function () {
            $('#imBtnInput').click();
        });
        function im(env) {
            var formData = new FormData();
            formData.append("import", document.getElementById("imBtnInput").files[0]);
            var iframe=document.createElement('iframe');
            iframe.setAttribute('width','100%');
            iframe.setAttribute('height','700px');
            $.ajax({
                url:'{{url('project/word_save')}}',
                data:formData,
                type:'post',
                cache: false,
                processData: false,
                contentType: false,
                success: function (result) {
                    $('#pPdfUrl').val(result);
                    iframe.setAttribute('src','{{asset('/storage')}}'+'/'+result);
                    document.getElementById('pdf').appendChild(iframe);
                }
            });

        }
        function onbefore() {   //不向服务端发送删除pdf请求
            pdf=true;
        }
    </script>
    @stop