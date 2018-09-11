@extends('common.layouts')

@section('content')
    @include('common.message')
    <!--自定义内容区域-->
    <div class="panel panel-default">

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown1" data-toggle="dropdown">
                选择职位
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="{{url('bm/select')}}">All</a> </li>
                @foreach($position as $val)
                    <li><a href="{{url('bm/select',['pos'=>$val->position])}}">{{$val->position}}</a></li>
                    {{--<li><a href="{{action('BmControllers@select',['pos'=>$val->position,'need'=>null])}}">{{$val->position}}</a></li>--}}
                @endforeach
            </ul>
        </div>
        <form action="{{url('bm/selected')}}" method="get">
        <div class="panel panel-heading">职员列表- {{$need.$id}}<button type="submit" class="btn btn-primary">确认选择</button></div>
            <table class="table table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th id="id">ID</th>
                    <th id="name">姓名</th>
                    <th id="age">年龄</th>
                    <th id="sex">性别</th>
                    <th id="position">职位</th>
                    <th id="time">添加时间</th>
                    <th width="120" id="do">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staff as $va)
                    <tr>
                        <th scope="row"><input type="checkbox" name="info[]" value="{{$va->id}}">{{$va->id}}</th>
                        <th>{{$va->name}}</th>
                        <th>{{$va->age}}</th>
                        <th>{{$va->sex($va->sex)}}</th>
                        <th>{{$va->position}}</th>
                        <th>{{date($va->created_at)}}</th>
                        <th>
                            <a href="{{url('bm/detail',['id'=>$va->id])}}">详情</a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
            {{--</div>--}}
                {{--<p>{{dd($arry)}}</p>--}}
        {{--</div>--}}

    </div>
    <!--分页-->
    <div>
        <div class="pull-right">
            {{$staff->render()}}
        </div>
    </div>
    @stop