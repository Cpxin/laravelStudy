<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/2
 * Time: 14:49
 */
namespace App\Http\Controllers;


use App\Project;
use App\Providers\AppServiceProvider;
use App\Record;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\Query;

class BmControllers extends Controller
{
    public function index($pos=null){
        if($pos!=null){
            $staff=Staff::where('position',$pos)->paginate(10);  //每次显示n条数据
        }else{
            $staff=Staff::paginate(10);
        }
        $sta=new Staff();
        $position= $sta->distinct('position')->get();
        return view('staff.index',[
            'staff'=>$staff,'position'=>$position]);
    }
    //为项目匹配员工,包含筛选
    //$pos 选择筛选的职业  $id 项目的id    $_GET['need'] 项目的需求
    public function select($pos=null){  //1.id 有值 need有值  2.id空,need空   顺序很重要!!!!!!!!!!!!
//        $data=array();
        if(isset($_GET['id'])&&$_GET['id']!=null){
            $id=$_GET['id'];
            Session::put('id',$id);
        }
        if(isset($_GET['need'&'id'])&&$_GET['need'&'id']!=null){
            $id=$_GET['id'];
            $needset=$_GET['need'];//1.projectdetail action needset有值 2.为空
            Session::put('needset',$needset);
            Session::put('id',$id);
            $need=$needset;
            for($i=0;strlen($need)!=0;$i++){
                $str1= substr($need,0,strpos($need,','));
                $need=substr($need,strpos($need,',')+1);
                $key=substr($str1,0,strpos($str1,'*'));
                $value=substr($str1,strpos($str1,'*')+1);
                $data[$key]=$value;
            }
        }
        if($pos!=null){
            $staff=Staff::where('position',$pos)->paginate(10);  //2.返回筛选
        }else{
            $staff=Staff::paginate(10);        //1.projectdetail 返回无筛选条件表
        }
        $sta=new Staff();
        $position= $sta->distinct('position')->get();
//        if(isset($data)){
            return view('project.projectselect',['staff'=>$staff,'position'=>$position,'need'=>Session::get('needset'),'id'=>Session::get('id')]);
//        }else{
//            return view('project.projectselect',['staff'=>$staff,'position'=>$position,'need'=>$needset,'id'=>$id]);
//        }
    }

    //在projectselect页面使用此方法,
    //点击确认选择后 将checkbox所对应的id(value值)上传,其中checkbox name为info[]
    public function selected(Request $request){
//        $project=new Project();
        $sta=$request->input('info');
        foreach ($sta as $k=>$value){            //$k为序号,$value为选中员工id
            $staff=Staff::find($value);
            $name=$staff->name;
            $position=$staff->position;
            $set[]=$value.'-'.$name.'-'.$position;
        }
//        $project->where('id',Session::get('id'))->update('staffId',implode(',',$set));
        $project=Project::find(Session::get('id'));          //获取路径中的项目id!!!!!!!!!
        $project->staffId=implode(',',$set);
//        $project->staffId='待定2';
        $project->save();
        return redirect('bm/project')->with('success','选择成功!'.Session::get('id'));
    }

    public function add(){
        $staff=new Staff();
        return view('staff.add',['staff'=>$staff]);
    }

    public function save(Request $request){
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
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $staff=new Staff();
        $val=$request->input('Staff');
        $staff->name=$val['name'];
        $staff->age=$val['age'];
        $staff->position=$val['position'];
        $staff->sex=$val['sex'];
        if($staff->save()){
            return redirect('bm/index')->with('success','添加成功!'.$staff->id);
        }else{
            return redirect()->back()->with('fail','添加失败!'.$staff->id);
        }
    }
    public function detail($id){
        $staff=Staff::find($id);
        return view('staff.detail',['staff'=>$staff]);
    }
    public function update(Request $request,$id){
        $staff=Staff::find($id);

        if($request->isMethod('POST')){
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
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $val=$request->input('Staff');
//            $staff->name=$val['name'];
//            $staff->age=$val['age'];
//            $staff->position=$val['position'];
//            $staff->sex=$val['sex'];
            $sql=$staff->id;
            if($staff->name!=$val['name']){
                $sql.=' 修改姓名为:'.$val['name'];
                $staff->name=$val['name'];
            }
            if($staff->age!=$val['age']){
                $sql.=' 修改年龄为:'.$val['age'];
                $staff->age=$val['age'];
            }
            if($staff->position!=$val['position']){
                $sql.=' 修改职位为:'.$val['position'];
                $staff->position=$val['position'];
            }
            if($staff->sex!=$val['sex']){
                $sql.=' 修改性别为:'.$val['sex'];
                $staff->sex=$val['sex'];
            }
//            \DB::connection()->enableQueryLog();
//            \DB::table('staff');
//            $queries = \DB::getQueryLog();
//            $sql=Staff::where('id',$id)->update(['name'=>$val['name'],'age'=>$val['age'],'position'=>$val['position'],'sex'=>$val['sex']])->toSql();
            if($staff->save()){
                $this->record($sql,$staff->id);
                return redirect('bm/index')->with('success','修改成功!'.$staff->id);
            }else{
                return redirect()->back()->with('fail','修改失败!'.$staff->id);
            }
        }
        return view('staff.update',['staff'=>$staff]);
    }
    public function delete($id){
        $staff=Staff::find($id);
        if($staff->delete()){
            $this->record('数据删除',$id);
            return redirect('bm/index')->with('success','删除成功!'.$staff->id);
        }else{
            return redirect()->back()->with('fail','删除失败!'.$staff->id);
        }
    }

    //员工操作记录,包含删除,修改
    //$sql操作记录字段,$staffid员工id
    //在delete(),update()中有调用
    public function record($sql=null,$staffid=null){
        $record=Record::paginate(10);
        if($sql!=null){
            $re=new Record();
            $re->cord=$sql;
            $re->staffid=$staffid;
            $re->save();
        }else{
            return view('staff.record',['record'=>$record]);
        }
    }
}