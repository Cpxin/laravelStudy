@extends('common.layouts')
@section('content')
    <!--自定义内容区域-->
    <div class="panel panel-default">
        <div class="panel-heading">项目详情</div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td width="50%">ID</td>
                <td>{{$project->id}}</td>
            </tr>
            <tr>
                <td>项目名称</td>
                <td>{{$project->name}}</td>
            </tr>
            <tr>
                <td>项目内容</td>
                <td>{{$project->content}}</td>
            </tr>
            <tr>
                <td>项目人员需求</td>
                <td>{{$project->personnel}}</td>
            </tr>
            <tr>
                <td>项目实施人员</td>
                <td>{{$project->staffId}}
                    {{--<button class="btn btn-primary " style="padding-left: 10px"><a href="{{url('bm/select',['need'=>$project->personnel,'id'=>$project->id]}}">选择员工</a></button>--}}
                    <button class="btn btn-primary " style="padding-left: 10px"><a style="color: white" href="{{action('BmControllers@select',[null,'need'=>$project->personnel,'id'=>$project->id])}}">选择员工</a></button>
                </td>
            </tr>
            <tr>
                <td>项目成本</td>
                <td>{{$project->cost}}</td>
            </tr>
            <tr>
                <td>项目预期利润</td>
                <td>{{$project->profit}}</td>
            </tr>
            <tr>
                <td>项目进度</td>
                <td>{{$project->speed}}</td>
            </tr>
            <tr>
                <td>项目创建时间</td>
                <td>{{$project->created_at}}</td>
            </tr>
            <tr>
                <td>项目完成时间</td>
                <td>{{$project->updated_at}}</td>
            </tr>
            </tbody>
        </table>
        <div class="panel-footer"><button class="btn btn-primary"><a style="color: white" href="{{url('bm/projectstart',['id'=>$project->id])}}">启动项目</a></button></div>


    @if(Session::has('success'))
        <!--成功提示框-->
            <div class="alert alert-success alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>成功!</strong>{{Session::get('success')}}
                <button class="btn btn-primary"><a style="color: white" href="{{url('bm/projectassure',['id'=>$project->id])}}">启动</a></button>
            </div>
    @endif
    @if(Session::has('fail'))
        <!--失败提示框-->
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>失败!</strong>{{Session::get('fail')}}
                {{--<button class="btn btn-primary"><a href="{{url('bm/projectstart',['id'=>$project->id,'startbool'=>true])}}">启动</a></button>--}}
                <button class="btn btn-primary"><a style="color: white" href="{{url('bm/projectassure',['id'=>$project->id])}}">启动</a></button>
            </div>
        @endif
    </div>
@stop
