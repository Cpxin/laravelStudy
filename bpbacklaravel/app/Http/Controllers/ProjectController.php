<?php

namespace App\Http\Controllers;

use App\Project;
use App\Staff;
use Illuminate\Http\Request;
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
        $project=new Project();
        $pro=$request->input('Project');
        $project->name=$pro['name'];
        $project->content=$pro['content'];
        $project->personnel=$pro['personnel'];
        $project->cost=$pro['cost'];
        $project->profit=$pro['profit'];

        if($project->save()){
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
        for($i=0;$need!=null;$i++){
            $str1= substr($need,0,strpos($need,';'));
            $need=substr($need,strpos($need,';')+1);
            $key=substr($str1,0,strpos($str1,'*'));
            $value=substr($str1,strpos($str1,'*')+1);
            $data[$key]=$value;
        }
        $i=0;
        foreach ($data as $k=>$v){
            $boolstr=strpos($have,$k);
            if($boolstr){
                $strnum=substr_count($have,$k);
                if($strnum==$v){
                    $i++;
                }
            }
        }
        if($i!=count($data)){
            $bool=false;
            return redirect('bm/projectdetail/'.$id)->with('fail','分配人员与规定不符合,确定要开始吗?','bool',$bool); //如果预期人员与分配人员相符,
        }else{                                                                                                                 //则跳出确认按钮
            $bool=true;
            return redirect('bm/projectdetail/'.$id)->with('success','确定要开始?','bool',$bool);   //不相符也跳出按钮,可以强制启动
        }

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
