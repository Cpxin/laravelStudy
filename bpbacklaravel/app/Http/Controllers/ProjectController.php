<?php

namespace App\Http\Controllers;

use App\Project;
use App\Staff;
use App\Vitae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Redis;
//use function MongoDB\BSON\toJSON;

class ProjectController extends Controller
{
    //项目初始页面
    public function over()
    {
        $project=Project::paginate(5);
        return view('project.project_over',['project'=>$project]);
    }
    //项目详情
    public function detail(Request $request,$id)
    {

        $project=Project::find($id);
        $pId=$request->input('Personnel');
        $str=$pId['Id'];
        if(isset($pId)){
            for($i=0;$str!=null;$i++){
                $str1= substr($str,0,strpos($str,';'));
                $str=substr($str,strpos($str,';')+1);
//                $key=substr($str1,0,strpos($str1,'*'));
//                $value=substr($str1,strpos($str1,'*')+1);
                $data[]=$str1;
            }
            $project->staffId=$pId['Id'];
            $project->save();
            return view('project.project_detail',['project'=>$project]);
        }

        return view('project.project_detail',['project'=>$project]);
    }
    //项目添加页面
    public function add()
    {
        return view('project.project_add');
    }
    public function save(Request $request)
    {
        DB::connection()->enableQueryLog();
        $project=new Project();
        $pro=$request->input('Project');
        $project->name=$pro['name'];
        $project->content=$pro['content'];
        $project->personnel=$pro['personnel'];
        $project->cost=$pro['cost'];
        $project->profit=$pro['profit'];

        if($project->save()){
            $record=new Record();
            $queries = DB::getQueryLog();     //2.
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('project/over')->with('success','添加成功');
        }else{
            return redirect()->back()->with('fail','添加失败');
        }
    }

    //人员安排
    public function arrange($id)
    {

        $staff=Staff::paginate(10);
//        $staff=$staff->items();
//        foreach ($staff as $k=>$v){
//            $arr[$k]=$v;
//        }
//        dd($arr);
        $project=Project::find($id);
        $need=$project->personnel;
        $have=$project->staffId;
        for($i=0;$need!=null;$i++){
            $str1= substr($need,0,strpos($need,';'));
            $need=substr($need,strpos($need,';')+1);
            $key=substr($str1,0,strpos($str1,'*'));
            $value=substr($str1,strpos($str1,'*')+1);
            $data[$key]=$value;
        }
        return view('project.project_arrange',['staff'=>$staff,'personnel'=>$data,'projectId'=>$id]);
    }

    //项目启动
    public function start($id)
    {
        $project=Project::find($id);

        $need=$project->personnel;
        $have=$project->staffId;
        $num=0; //需求人数
        for($i=0;$need!=null;$i++){
            $str1= substr($need,0,strpos($need,';'));
            $need=substr($need,strpos($need,';')+1);
            $key=substr($str1,0,strpos($str1,'*'));
            $value=substr($str1,strpos($str1,'*')+1);
            $num+=$value;
            $data[$key]=$value;     //['position1':'人数';'position2':'人数';..]
        }
        while($have!=null){
            $str1= substr($have,0,strpos($have,';'));
            $have=substr($have,strpos($have,';')+1);
            $staid[]=$str1;       //['staffId1';'staffId2';..]
        }
        if(count($staid)<$num){
            return redirect('project/detail/'.$id)->with('fail','分配人员数量不足,确定要开始吗?');
        }else {
            if (count($staid)>$num){
                return redirect('project/detail/'.$id)->with('fail','分配人员数量超额,确定要开始吗?');
            }else{
                if (count($staid)==$num){
                    return redirect('project/detail/'.$id)->with('success','分配成功,确定要开始吗?');
                }
            }
        }
    }

    public function assure($id)
    {
        $project=Project::find($id);
        $have=$project->staffId;
        while($have!=null){
            $str1= substr($have,0,strpos($have,';'));
            $have=substr($have,strpos($have,';')+1);
            $staid[]=$str1;       //['staffId1';'staffId2';..]
        }
        foreach ($staid as $sta){             //修改每个参与项目的员工的状态
            $staff=Staff::find($sta);
            $staff->state=1;
            $staff->save();
        }
        $project->state=1;
        $project->save();
        return redirect('project/over')->with('success','项目启动成功');

    }

    //项目结算
    public function settle($id)
    {
        $project=Project::find($id);
        $project->state=3;
        $project->save();
        $have=$project->staffId;
        while($have!=null){
            $str1= substr($have,0,strpos($have,';'));
            $have=substr($have,strpos($have,';')+1);
            $staid[]=$str1;       //['staffId1';'staffId2';..]
        }
        foreach ($staid as $sta){             //修改每个参与项目的员工的状态
            $staff=Staff::find($sta);
            $staff->state=0;
            $staff->save();
            $vitae=Vitae::where('staff_id',$staff->id);
            if(isset($vitae->id)){           //如果该员工有详细信息（简历）
                $vitae->experience.=$id.";";
                $vitae->save();
            }else{                          //否则新建该员工的详细信息（只有员工id和项目经历）
                $vit=new Vitae();
                $vit->staff_id=$staff->id;
                $vit->experience.=$id.";";
                $vit->save();
            }

        }
        return redirect('project/over')->with('success','项目结算成功');
    }

    public function update(Request $request)
    {

        $pro=$request->input('Project');
        $project=Project::find($pro['id']);
        $project->content=$pro['content'];
        $project->save();
        return redirect('project/detail/'.$pro['id']);


    }

//    public function arrange_search()
//    {
//           $redis=new Redis();
////        if($val!=null){
////        $val=$_POST['id'];
////        $sta=new Staff();
//            $sta=Staff::paginate(10);
//            $sta=$sta->items();
//            foreach ($sta as $k=>$v){
//                $arr[$k]=$v;
//            }
////        return response()->json($arr)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
////            return view('project.project_arrange')->with(['sta'=>$arr]);
//        return [csrf_token(),'sta'=>$arr];
//
//    }

}
