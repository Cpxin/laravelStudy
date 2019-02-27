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
    public function index()
    {
        $admin=User::find(Auth::user()->id);

        return view('common.layouts',['admin'=>$admin]);
    }
    public function over()
    {
//        $staff=new Staff();
//        dd(Auth::id());
        if (isset($_GET['name'])){
            $staff=Staff::where('name',$_GET['name'])->paginate(9);
//            dd($staff);
        }else{
            $staff=Staff::paginate(9);//每翻一次页执行一次,查找结果为一个模型，对其更改也会改变数据库
                                      //并且在翻页时由于重新渲染视图，搜索会被重置取消（get值被替换为page页数）
        }
//        $arr=$staff->toArray();
        $w=date("w");
        $wages=Wages::all();
        $position=$wages->pluck("weekday","position");   //职位 =>工作日
        foreach ($staff as $sta){
            if (isset($position[$sta->position])){      //如果有规定工作日
                if (strstr($position[$sta->position],$w)!=false){   //如果该员工在工作日
                    $sta=$staff->find($sta->id);
                    $sta->state=2;
                    $sta->save();
                    //                dd($sta->state);
                }
            }
        }
//        if (isset($_GET['name'])){
//            return redirect('staff/over')->with(['staff'=>$staff,'adminId'=>Auth::id()]);
//        }
        return view('staff.staff_over',['staff'=>$staff,'adminId'=>Auth::id()]);
    }

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

    public function detail($id)
    {
        $staff=Staff::find($id);

        $vitae=Vitae::where('staff_id',$id)->with('staff')->get();   //关联表查询
        foreach ($vitae as $v){
            $vit=$v;        //通过循环才能读取？？
        }
        if (isset($vit)){           //如果员工有对应简历表
            if($vit->experience!=''){      //如果该员工有项目经历
                $have=$vit->experience;
//            dd($have);
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
                return view('staff.staff_detail',['staff'=>$staff,'vitae'=>$vit,'projectArr'=>$project]);
            }else{
                return view('staff.staff_detail',['staff'=>$staff,'vitae'=>$vit]);
            }
        }else{
            return view('staff.staff_detail',['staff'=>$staff]);
        }


    }

    public function save_detail(Request $request,$id)
    {
//        $validator=\Validator::make($request->input(),[
//            'Staff.name'=>'required|min:2|max:20',
//            'Staff.age'=>'required|integer',
//            'Staff.position'=>'required|min:2',
//            'Staff.sex'=>'required|integer',
//        ],[
//            'required'=>':attribute 为必填项',
//            'min'=>':attribute 长度不符合要求',
//            'integer'=>':attribute 必须为整数',
//        ],[
//            'Staff.name'=>'姓名',
//            'Staff.age'=>'年龄',
//            'Staff.position'=>'职位',
//            'Staff.sex'=>'性别',
//        ]);
//        if($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInput();
//        }
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

    public function save_img(Request $request,$id)
    {
        $vitae=Vitae::where('staff_id',$id)->with('staff')->get();   //关联表查询
        foreach ($vitae as $v){
            $vit=$v;        //通过循环才能读取？？
        }
        if (isset($vit)) {       //如果是已存在的员工数据则为更新操作
            $v=$request->file('img');
            $name=$v->getClientOriginalName();
            $ext=$v->getClientOriginalExtension();
            $fileName=md5(uniqid($name));
            $fileName=$fileName.'.'.$ext;
            $bool=Storage::disk('public')->put($fileName,file_get_contents($v->getRealPath()));
//            $vit->image='http://localhost/bpbacklaravel/public/storage/'.$fileName;
            $vit->image='storage/'.$fileName;
            $vit->save();
            if($vit->save()){
                return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vit->id);
            }else{
                return redirect()->back()->with('fail','添加失败!');
            }
        }
        $vitae=new Vitae();
        $v=$request->file('img');
        $name=$v->getClientOriginalName();
        $ext=$v->getClientOriginalExtension();
        $fileName=md5(uniqid($name));
        $fileName=$fileName.'.'.$ext;
        $bool=Storage::disk('local')->put($fileName,file_get_contents($v->getRealPath()));
        $vitae->image='storage/app/'.$fileName;
        $vitae->staff_id=$id;
        $vitae->save();
        if($vitae->save()){
            return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }

    }

    public function delete($id)
    {
        $staff=Staff::find($id);   //通过点击获取的id查找数据
        if($staff->delete()){      //如果删除成功
            return  redirect('staff/over')->with('success','删除成功！'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败！'.$id);
        }
    }

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
    //微信登录
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
//        if ($staff->state==0){
//            $staff->state=4;
//            $staff->save();
//        }
//        echo $id;
    }
    //微信密码注册
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
    public function wx_staff_detail(){
        $id=$_GET['id'];
        $staff=Staff::find($id);

        $detail=array(
            'id'=>$staff->id,
            'name'=>$staff->name,
            'position'=>$staff->position,
            'state'=>$staff->state,
            'updated_at'=>$staff->updated_at
        );
        echo json_encode($detail,JSON_UNESCAPED_UNICODE);
//        dd($detail['name']);
    }
    //微信签到
    public function wx_staff_sign(){
        $id=$_GET['id'];
        $staff=Staff::find($id);
        if($staff->state==0){
            $staff->state=2;
            $staff->save();
        }
        echo $staff->updated_at;
    }
    //excel文件内容批量保存
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