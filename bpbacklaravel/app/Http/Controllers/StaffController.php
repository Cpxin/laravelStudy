<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/22
 * Time: 19:51
 */
namespace App\Http\Controllers;

use App\Project;
use App\Record;
use App\Staff;
use App\Staff_login;
use App\User;
use App\Vitae;
use App\Wages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use function PhpParser\filesInDir;
use PhpParser\Node\Expr\Cast\Object_;
use function PHPSTORM_META\map;

class StaffController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admin=User::find(Auth::user()->id);

        return view('common.layouts',['admin'=>$admin]);
    }

    /**
     * 该方法用来处理员工数据的展示，包括全部员工显示、员工筛选显示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function over()
    {
        //如果需要进行员工id查找、职位查找、员工状态查找，则从数据库中查找相应数据，否则查找全部员工信息。
        if (isset($_GET['id'])||isset($_GET['position'])||isset($_GET['state'])){
            if (isset($_GET['id'])){  //如果是id搜索
                $staff=Staff::where('id',$_GET['id'])->paginate(9);
            }
            if (isset($_GET['position'])){ //如果是职位搜索
                $staff=Staff::where('position',$_GET['position'])->paginate(9);
            }
            if (isset($_GET['state'])){   //如果是员工状态搜索
                $staff=Staff::where('state',$_GET['state'])->paginate(9);
            }
        }else{
            $staff=Staff::paginate(9);//每翻一次页执行一次,查找结果为一个模型，对其更改也会改变数据库
                                      //并且在翻页时由于重新渲染视图，搜索会被重置取消（get值被替换为page页数）
        }
        $h=date('h:i'); //小时:分钟
        $m=date('a');//am pm 获取上午还是下午
        $w=date("w");//星期几
        $wages=Wages::all();   //获取全部作业表，用来对员工当前状态进行对照、更改
        $time=$wages->pluck('time','position');  //职位 =>工作周期 例：上午8:00至12:00下午2:00至6:00
        $position=$wages->pluck('weekday',"position");   //职位 =>工作日
        $range=[];  //用来存放工作时间范围
        foreach ($time as $pos=>$t ){
            $str1= substr($t,strpos($t,":")-2,5);  //8:00
            $letter=substr($t,strpos($t,':')+3);   //至12：00；下午2:00至06:00
            $str2=substr($letter,strpos($letter,":")-2,5); //12:00
            $letter=substr($letter,strpos($letter,'午')+3);  //02:00至06:00
            $str3=substr($letter,strpos($letter,":")-2,5);//2:00
            $letter=substr($letter,strpos($letter,'至'));  //至06:00
            $str4=substr($letter,strpos($letter,":")-2,5);//6:00
            $range[$pos]=array($str1,$str2,$str3,$str4);   //['8:00','12:00','2:00','6:00']
        }
        foreach ($staff as $sta){ //循环并处理每个查找的员工状态
            $vit=Vitae::find($sta->id);   //当前员工的详细信息
            if (isset($position[$sta->position])){      //如果该员工的职位有规定工作日
                if (strstr($position[$sta->position],(string)$w)!=''){   //如果该员工在工作日
                    if ($m='am'&&$h>=$range[$sta->position][0]&&$h<=$range[$sta->position][1]){//在工作日上午且在上班时间
                        if ($vit==null||$vit->now_project==0){ //当前员工没有详细信息，或没有执行中的任务
                            $sta->state=2;        //改为空闲状态
                            $sta->save();
                            continue;
                        }else{
                            $sta->state=3;        //否则为忙碌状态
                            $sta->save();
                            continue;
                        }
                    }else if ($m='pm'&&$h>=$range[$sta->position][2]&&$h<=$range[$sta->position][3]){//在工作日下午且在上班时间
                        if ($vit==null||$vit->now_project==0){
                            $sta->state=2;
                            $sta->save();
                            continue;
                        }else{
                            $sta->state=3;
                            $sta->save();
                            continue;
                        }
                    }
                    $sta->state=1;          //在工作日但是下班了，改为休息状态
                    $sta->save();
                }else{
                    $sta->state=1;   //不在工作日，改为休息状态
                    $sta->save();
                }
            }else{
                $sta->state=0;    //未设置工作日(即使当前有任务)，改为其他状态
                $sta->save();
            }
        }
        $positionnel=new Staff();
        $position=$positionnel->distinct()->get(['position']);  //根据所有员工的职位获得职位列表
        if (isset($_GET['position'])){
            //返回员工总览视图，并携带：相关员工表、职位表、当前管理员ID、当前要查找的职位名 信息
            return view('staff.staff_over',['staff'=>$staff,'position'=>$position,'adminId'=>Auth::id(),'now_position'=>$_GET['position']]);
        }else if (isset($_GET['state'])){
            //携带相应员工状态的数据
            return view('staff.staff_over',['staff'=>$staff,'position'=>$position,'adminId'=>Auth::id(),'now_state'=>$_GET['state']]);
        }else{
            return view('staff.staff_over',['staff'=>$staff,'position'=>$position,'adminId'=>Auth::id()]);
        }
    }

    /**
     *获取表单上传的值保存至数据库
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        //对传递过来的信息进行验证
        $validator=\Validator::make($request->input(),[
            'Staff.name'=>'required|min:2|max:20',
            'Staff.age'=>'required|integer',
            'Staff.position'=>'required|min:2',
            'Staff.sex'=>'required|integer',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不符合要求',
            'integer'=>':attribute 必须为整数',
        ],[
            'Staff.name'=>'姓名',
            'Staff.age'=>'年龄',
            'Staff.position'=>'职位',
            'Staff.sex'=>'性别',
        ]);
        //如果传递的信息内容不符合要求则返回错误信息
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //获取数据库日志
        DB::connection()->enableQueryLog();
        //将传递信息存入到数据库中
        $staff=new Staff();
        $sta=$request->input('Staff');
        $staff->name=$sta['name'];
        $staff->age=$sta['age'];
        $staff->sex=$sta['sex'];
        $staff->position=$sta['position'];
        //如果保存成功则将操作放入操作表中
        if($staff->save()){
            $record=new Record();
            $queries = DB::getQueryLog();
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('staff/over')->with('success','添加成功!'.$staff->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');  //否则返回添加失败
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $staff=Staff::find($id);
        $vitae=Vitae::where('staff_id',$id)->with('staff')->get();   //关联表查询
        $now=array(
            'now_project_id'=>'',
            'now_project_name'=>'',
            'now_project_term'=>''
        );
        foreach ($vitae as $v){
            $vit=$v;        //通过循环才能读取？？
        }
        if (isset($vit)){           //如果员工有对应简历表
            if ($vit->now_project!=null&&$vit->now_project!=0){
                $nowProject=Project::find($vit->now_project);
                $now['now_project_id']=$nowProject->id;
                $now['now_project_name']=$nowProject->name;
                $now['now_project_term']=(((int)((strtotime('now')-strtotime($nowProject->created_at))/86400))/$nowProject->term)*100;
            }
            if($vit->experience!=''){      //如果该员工有项目经历
                $have=$vit->experience;
                while($have!=null){
                    $str1= substr($have,0,strpos($have,';'));
                    $have=substr($have,strpos($have,';')+1);
                    $proid[]=$str1;       //['projectId1';'projectId2';..]
                }
                foreach ($proid as $pid){
                    $pro=Project::find($pid);
                    $project[]=[
                        'pid'=>$pro->id,
                        'pName'=>$pro->name,
                        'prank'=>$pro->rank,
                    ];
                }
                return view('staff.staff_detail',['staff'=>$staff,'vitae'=>$vit,'now_project'=>$now,'projectArr'=>$project]);
            }else{
                return view('staff.staff_detail',['staff'=>$staff,'now_project'=>$now,'vitae'=>$vit]);
            }
        }else{
            return view('staff.staff_detail',['staff'=>$staff,'now_project'=>$now]);
        }


    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_detail(Request $request,$id)
    {
        $vitae=Vitae::where('staff_id',$id)->with('staff')->get();   //关联表查询
        foreach ($vitae as $v){
            $vit=$v;        //通过循环才能读取？？
        }
        if (isset($vit)){       //如果是已存在的员工数据则为更新操作
            $v=$request->input('rVitae');
            $vit=Vitae::find($vit->id);
            $vit->email=$v['email'];
            $vit->adress=$v['adress'];
            $vit->hobby=$v['hobby'];
            if($vit->save()){
                return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vit->id);
            }else{
                return redirect()->back()->with('fail','添加失败!');
            }
        }
        $vitae=new Vitae();
        $v=$request->input('rVitae');
        $vitae->staff_id=$id;
        $vitae->image="无";
        $vitae->email=$v['email'];
//        $vitae->skill=$v['skill'];
        $vitae->adress=$v['adress'];
//        $vitae->education=$v['education'];
        $vitae->hobby=$v['hobby'];

        if($vitae->save()){
            return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
//        $test=$vitae->where('staff_id',$id)->value('id');
//        return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_img(Request $request,$id)
    {
        $vitae=Vitae::where('staff_id',$id)->with('staff')->get();   //关联表查询
        foreach ($vitae as $v){
            $vit=$v;        //通过循环才能读取？？
        }
        if (isset($vit)) {       //如果是已存在的员工数据则为更新操作
            $v=$request->file('img');
//            $name=$v->getClientOriginalName();
            $ext=$v->getClientOriginalExtension();
//            $fileName=md5(uniqid($name));
//            $fileName=$fileName.'.'.$ext;
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $bool=Storage::disk('public')->put($filename,file_get_contents($v->getRealPath()));
//            $vit->image='http://localhost/bpbacklaravel/public/storage/'.$fileName;
            $vit->image=$filename;
            $vit->save();
            if($vit->save()){
                return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vit->id);
            }else{
                return redirect()->back()->with('fail','添加失败!');
            }
        }
        $vitae=new Vitae();
        $v=$request->file('img');
//        $name=$v->getClientOriginalName();
        $ext=$v->getClientOriginalExtension();
//        $fileName=md5(uniqid($name));
//        $fileName=$fileName.'.'.$ext;
        $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
        $bool=Storage::disk('public')->put($filename,file_get_contents($v->getRealPath()));
        $vitae->image=$filename;
        $vitae->staff_id=$id;
        $vitae->save();
        if($vitae->save()){
            return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $staff=Staff::find($id);   //通过点击获取的id查找数据
        $vitae=Vitae::where('staff_id',$id)->get();
        $filename=$vitae[0]->image;
        $bool = Storage::disk('public')->delete($filename);
        if($staff->delete()&&$vitae[0]->delete()&&$bool){      //如果删除成功
            return  redirect('staff/over')->with('success','删除成功！'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败！'.$id);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        DB::connection()->enableQueryLog();   //开启QueryLog数据库日志
        $sta=$request->input('rStaff');   //接收前端键值为rStaff的表单
        $id=$sta['id'];
        $staff=Staff::find($id);           //通过表单中的id查找数据
        $staff->name=$sta['name'];
        $staff->age=$sta['age'];
        $staff->sex=$sta['sex'];
        $staff->position=$sta['position'];
        if($staff->save()){
            $record=new Record();
            $queries = DB::getQueryLog();
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('staff/over')->with('success','修改成功!'.$id);
        }else{
            return redirect()->back()->with('fail','修改失败！'.$id);
        }
    }
    /**
     * 微信登录
     */
    public function wx_staff_login(){
        $id=$_POST["id"];
        $pwd=$_POST["pwd"];
        if (!isset($id)){
            echo "请输入ID";
            exit;
        }
        if (!isset($pwd)){
            echo "请输入密码";
            exit;
        }
        $staff=Staff::find($id);
        if ($staff!=null){
            $staff_pwd=Staff_login::where('staff_id',$id)->with('staff')->get();
            if (count($staff_pwd)!=0){
                foreach ($staff_pwd as $p){
                    $password=$p;
                }
                if ($pwd==$password->pwd){
                    echo "登录成功";
                }else{
                    echo "密码输入错误";
                    exit;
                }
            }else{
                echo "未设置密码";
                exit;
            }
        }else{
            echo "员工ID不存在";
            exit;
        }
    }
    /**
     * 微信密码注册
     */
    public function wx_staff_pwd(){
        $id=$_POST["id"];
        $pwd=$_POST["pwd"];
        $staff=Staff::find($id);
        if ($staff!=null){
            $staff_pwd=Staff_login::where('staff_id',$id)->with('staff')->get();
            if (count($staff_pwd)==0){
                $stapwd=new Staff_login();
                $stapwd->staff_id=$id;
                $stapwd->pwd=$pwd;
                $stapwd->save();
                echo "密码设置成功";
            }else{
                echo "已存在密码";
            }
        }else{
            echo "员工ID不存在";
        }
    }

    /**
     * 微信获取员工信息接口
     */
    public function wx_staff_detail(){
        $id=$_GET['id'];
        $staff=Staff::find($id);
        //返回json数据内容
        $detail=array(
            'id'=>$staff->id,
            'name'=>$staff->name,
            'position'=>$staff->position,
            'state'=>$staff->state,
            'img'=>'',
            'updated_at'=>$staff->updated_at,
            'now_project'=>0,
            'now_project_data'=>[
                'now_project_name'=>null,
                'now_project_term'=>null,
            ],
            'experience'=>[],
            'information'=>'',
        );
        $vitae=Vitae::where('staff_id',$id)->get();
        if(isset($vitae[0]->id)){           //如果该员工有详细信息
            $detail['now_project']=$vitae[0]->now_project;
            if ($vitae[0]->now_project!=null&&$vitae[0]->now_project!=0){ //如果员工当前有执行的任务
                $nowProject=Project::find($vitae[0]->now_project);
                $detail['now_project_data']['now_project_name']=$nowProject->name;
                $detail['now_project_data']['now_project_term']=(((int)((strtotime('now')-strtotime($nowProject->created_at))/86400))/$nowProject->term)*100;
            }
            if ($vitae[0]->image!=''){
                $detail['img']=$vitae[0]->image;  //员工照片名
            }
            if($vitae[0]->experience!=''){      //如果该员工有项目经历
                $have=$vitae[0]->experience;
                while($have!=null){
                    $str1= substr($have,0,strpos($have,';'));
                    $have=substr($have,strpos($have,';')+1);
                    $proid[]=$str1;       //['projectId1';'projectId2';..]
                }
                foreach ($proid as $pid){  //循环每个员工项目经历
                    $pro=Project::find($pid);
                    $detail['experience'][$pid]['id']=$pid;
                    $detail['experience'][$pid]['name']=$pro->name;
                    $detail['experience'][$pid]['rank']=$pro->rank;
                }
            }
            if ($vitae[0]->information!=''){
                $detail['information']=$vitae[0]->information; //发给员工的短消息
            }
        }
        //将数组转换为json格式
        echo json_encode($detail,JSON_UNESCAPED_UNICODE);
    }
    /**
     * 微信签到
     */
    public function wx_staff_sign(){
        $id=$_GET['id'];
        $staff=Staff::find($id);
        if($staff->state==0){
            $staff->state=2;
            $staff->save();
        }
        echo $staff->updated_at;
    }
    /**
     * 向员工发送信息
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wx_information(Request $request){
        $info=$request->input('Info');
        $vitae=Vitae::where('staff_id',$info['id'])->with('staff')->get();   //关联表查询
        if (isset($vitae[0])){       //如果是已存在的员工数据则为更新操作
            $vit=Vitae::find($vitae[0]->id);
            $vitae[0]->information=$info['content'];
            if($vitae[0]->save()){
                return redirect('staff/detail/'.$info['id'])->with('success','发送信息成功!'.$vit->id);
            }else{
                return redirect()->back()->with('fail','添加失败!');
            }
        }
        $vitae=new Vitae();
        $vitae->staff_id=$info['id'];
        $vitae->information=$info['content'];
        if($vitae->save()){
            return redirect('staff/detail/'.$info['id'])->with('success','发送信息成功!'.$vitae->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
    }
    /**
     * excel文件内容批量保存
     * @param $obj
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excel_save($obj){
        $arr=[];
        $arr2=[];
        $arr3=[];
        $columns = Schema::getColumnListing('staff');  //获取表中所有字段名
        foreach ($columns as $k=>$v){
            $arr2[$k]=$v;                       //表格字段数组
        }
        $j=0;
        foreach ($obj as $k=>$v){
            $arr[$j++]=$v->toArray();          //数据源数组
        }
        $i=0;
        foreach ($v as $k=>$val){
            $arr3[$i++]=$k;                //数据源字段名数组
        }
//        dd($arr2,$arr3);
//        dd($arr);
        if (count(array_diff($arr3,$arr2))==0){
            $bool=DB::table('staff')->insert($arr);
            if ($bool){
                return redirect()->back()->with('success','批量保存成功!');
            }else{
                return redirect()->back()->with('fail','批量保存失败!');
            }
        }else{
            return redirect()->back()->with('fail','文件内容不符合规定!');
        }
    }
}