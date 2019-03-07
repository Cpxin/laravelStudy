@extends('common.layouts')

@section('style')
    @parent

    <link href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link  href="{{asset('static/bootstrap-table/dist/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{asset('static/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <style>
        .clickColor{
            background-color: #31b0d5;
        }
    </style>
    @stop

@section('content')
    <div role="tabpanel" class="tab-pane active" id="user">
        <div class="row" style="margin-top: 50px">

        <div class="data-div col-xs-8">

            <table class="table" id="table1">
                <tbody>
                @foreach($staff as $sta)
                    {{--@if($sta->state==2)--}}
                    <tr>
                        <td>{{$sta->id}}</td>
                        <td>{{$sta->name}}</td>
                        <td>{{$sta->age}}</td>
                        <td>{{$sta->sex($sta->sex)}}</td>
                        <td>{{$sta->position}}</td>
                        <td>@if($sta->state==0)
                                <img src="{{asset('/img/其他-im.png')}}" style="width:21px;height: 21px">
                            @else
                                @if($sta->state==1)
                                    <img src="{{asset('/img/离线-im.png')}}" style="width:21px;height: 21px">
                                @else
                                    @if($sta->state==2)
                                        <img src="{{asset('/img/空闲-im.png')}}" style="width:21px;height: 21px">
                                    @else
                                        <img src="{{asset('/img/忙碌-im.png')}}" style="width:21px;height: 21px">
                                    @endif
                                @endif
                            @endif
                            {{$sta->state($sta->state)}}
                        </td>
                        <td>
                            <a class="btn btn-success btn-xs" href="{{url('staff/detail',['id'=>$sta->id])}}">详情</a>
                        </td>
                    </tr>
                    {{--@endif--}}
                @endforeach
                </tbody>

            </table>

        </div>

        <div class="col-xs-4">
            <div class="panel-body">
                    {{--<select multiple class="selectpicker show-tick" id="select1" data-style="btn-success">--}}
                    {{--<option>1</option>--}}
                {{--</select>--}}
                {{--$personnel ： 职位：人数--}}
                @foreach($personnel as $k=>$v)
                    <ul class="list-group" id="{{$k}}">
                        <li class="list-group-item list-group-item-success" id="i{{$k}}" value="{{$v}}">职位：{{$k}}    剩余可选人数：{{$v}}</li>
                    </ul>
                @endforeach
                <ul class="list-group" id="其他">
                    <li class="list-group-item list-group-item-success" id="i其他" value="">职位：其他  </li>
                </ul>
            </div>

            <form id="form-horizontal" class="form-horizontal" method="post" action="{{url('project/detail',['id'=>$projectId])}}" >
                {{ csrf_field() }}
                <div class="input-group col-sm-5">
                    <input type="text" id="pId" name="Personnel[Id]" value="" class="form-control" placeholder="未填写.." style="display: none">
                </div>
                <div class="input-group col-sm-5">
                    <input type="text" id="pNum" name="Personnel[Num]" value="" class="form-control" placeholder="未填写.." style="display: none">
                </div>

                    <button type="button" class="btn btn-xs btn-green " onclick="set()" style="margin-left: 500px;">保 存</button>

            </form>

        </div>


        </div>

    </div>
@stop

@section('javascript')
    @parent
    <script src="{{asset('static/bootstrap-table/dist/bootstrap-table.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-table/dist/locale/bootstrap-table-zh-CN.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-select/dist/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/bootstrap-select/dist/js/i18n/defaults-zh_CN.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                if($('#Lproject1').css('display')=='none'){
                    $('#Lproject1').css('display','block');
                    $('#Lproject1').css('background','#F3F3FA');
                }
            });

            window.arr=[];
            load();
        });
            function load() {
                $('#table1').bootstrapTable({
                    toolbar:'#toolbar',
                    singleSelect:true,
                    clickToSelect:true,
                    sortName: "created_at",
                    sortOrder: "desc",
                    pageSize: 10,
                    pageNumber: 1,

                    showToggle: true,
                    showRefresh: true,
                    showColumns: true,
                    search: true,
                    pagination: true,
                    columns: [{
                        field: "id",
                        title: 'ID',
                        switchable: true
                    },{
                        field: 'name',
                        title: '姓名',
                        switchable: true
                    },{
                        field: 'age',
                        title: '年龄',
                        switchable: true
                    }, {
                        field: 'sex',
                        title: '性别',
                        switchable: true
                    }, {
                        field: 'position',
                        title: '职位',
                        switchable: true
                    },{
                        field: 'state',
                        title: '状态',
                        switchable: true
                    },{
                    field: 'operate',
                    title: '操作'
                }]
                })
            }
        $("#table1").on("click-row.bs.table",function(e, row,$element){

            if(!isInArray(arr,row['id'])){           //如果数组中不存在某元素
                arr.push(row['id']);                   //将职员id放入数组中
                var li=document.createElement('li');             //创建li元素
                li.setAttribute('class','list-group-item');     //在li中添加属性class='list-group-item'
                li.setAttribute('id',row['id']);               //该li id 为职员Id
                li.setAttribute('name','Staff['+row["id"]+']');
                li.innerHTML=row['id']+' '+row['name'];          //li中的值为 职员id+职员名

                if(document.getElementById(row['position'])){        //如果表格中点击行的员工的职位存在与之对应的ul 的id

                    var u1=document.getElementById(row['position']);

                    // var num= ul.getElementsByTagName('li').length-1;
                    var addfirst= document.getElementById("i"+row['position']);  //获得第一个li显示的剩余值
                    if(addfirst.value>0){
                        $($element).addClass('clickColor');  //为点击行添加背景色
                        addfirst.value--;
                        u1.appendChild(li);                            //对应ul 添加li元素
                        addfirst.innerHTML="职位："+row['position']+"    剩余可选人数："+addfirst.value+"";
                    }else {
                        if(addfirst.value<=0){
                            u1.setAttribute('class','clickColor');
                        }
                    }
                }else {
                    var u1l=document.getElementById("其他");
                    $($element).addClass('clickColor');
                    u1l.appendChild(li);
                }

            }else{
                deleteInArray(arr,row['id']);                     //数组中删除职员Id
                $($element).removeClass('clickColor');
                if(document.getElementById(row['position'])){        //如果表格中点击行的员工的职位存在与之对应的ul 的id
                    var l=document.getElementById(row['id']);
                    u=document.getElementById(row['position']);
                    u.removeChild(l);                            //除去对应ul 添加li元素
                    
                    var subfirst= document.getElementById("i"+row['position']);
                    subfirst.value++;
                    subfirst.innerHTML="职位："+row['position']+"    剩余可选人数："+subfirst.value+"";
                }else {
                    var ll=document.getElementById(row['id']);
                    uu=document.getElementById("其他");
                    uu.removeChild(ll);
                }
            }

        });
        function isInArray(arr,value){          //数组中是否存在某元素
            for(var i = 0; i < arr.length; i++){
                if(value === arr[i]){
                    return true;
                }
            }
            return false;
        }
        function deleteInArray(arr,value) {       //数组中删除某元素
            for(var j=0;j<arr.length;j++){
                if(value===arr[j]){
                    arr.splice(j,1);
                }
            }
        }
        var r=0;
        function set() {
            var i=document.getElementById('pId');
            var n=document.getElementById('pNum');
            var str='';
            var num='';
            for(var j=0;j<arr.length;j++){
                str+=arr[j]+';';
            }
            i.value=str;
            if (str.length!==0){
                document.getElementById("form-horizontal").submit();
            }else {
                if (confirm("未选择人员!")===false){
                    return false
                }
            }
            // console.log(r);
        }
        // function confirm() {
        //     if (r===0){
        //         return false;
        //     }else {
        //         return true;
        //     }
        // }


    </script>
@stop