@if(Session::has('success'))
    <!--成功提示框-->
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>成功!</strong>{{Session::get('success')}}
    </div>
@endif
@if(Session::has('fail'))
    <!--失败提示框-->
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>失败!</strong>{{Session::get('fail')}}
    </div>
@endif