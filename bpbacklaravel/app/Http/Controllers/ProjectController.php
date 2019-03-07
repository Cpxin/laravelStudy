<?php

namespace App\Http\Controllers;

use App\Project;
use App\Record;
use App\Staff;
use App\Vitae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Support\Facades\Redis;
//use function MongoDB\BSON\toJSON;

class ProjectController extends Controller
{
    //项目初始页面
    public function over()
    {
        if (isset($_GET['name'])||isset($_GET['state'])){
            if (isset($_GET['name'])){
                $project=Project::where('name','like','%'.$_GET['name'].'%')->paginate(9);
            }
            if (isset($_GET['state'])){
                $project=Project::where('state',$_GET['state'])->paginate(9);
            }

        }else{
            $project=Project::paginate(9);
        }
        return view('project.project_over',['project'=>$project]);
    }
    //项目详情 在项目安排页面点击保存时，上传员工ID，并保存至数据库
    public function detail(Request $request,$id)
    {

        $project=Project::find($id);
        if (isset($_GET['clear'])){  //当点击清空已选人员时
            $project->staffId="";
            $project->save();
            return view('project.project_detail',['project'=>$project]);
        }
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
        $staff=new Staff();
        $position=$staff->distinct()->get(['position']);

        return view('project.project_add',['position1'=>$position]);
    }
    public function save(Request $request)
    {
        //对传递过来的信息进行验证
        $validator=\Validator::make($request->input(),[
            'Project.name'=>'required|min:2|max:20',
            'Project.pdfUrl'=>'required',
            'Project.content'=>'required',
            'Project.personnel'=>'required|max:50',
            'Project.cost'=>'required|integer',
            'Project.profit'=>'required|integer',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不符合要求',
            'integer'=>':attribute 必须为整数',
        ],[
            'Project.name'=>'项目名',
            'Project.pdfUrl'=>'项目内容',
            'Project.content'=>'项目备注',
            'Project.personnel'=>'人员需求',
            'Project.cost'=>'项目成本',
            'Project.profit'=>'项目利润',
        ]);
        //如果传递的信息内容不符合要求则返回错误信息
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::connection()->enableQueryLog();
        $project=new Project();
        $pro=$request->input('Project');

        $need=$pro['personnel'];
        $num=0; //需求人数
        for($i=0;$need!=null;$i++){
            $str1= substr($need,0,strpos($need,';'));
            $need=substr($need,strpos($need,';')+1);
            $key=substr($str1,0,strpos($str1,'*'));
            $value=substr($str1,strpos($str1,'*')+1);
            $num+=$value;
            $data[$key]=$value;     //['position1':'人数';'position2':'人数';..]
        }
        if ($num>=0&&$num<=10){
            $project->rank=0;
        }else if ($num>10&&$num<=50){
            $project->rank=1;
        }else if ($num>50&&$num<=100){
            $project->rank=2;
        }else if ($num>100){
            $project->rank=3;
        }
        $project->name=$pro['name'];
        //将项目内容中的html格式的换行符转换为可识别的换行符
        $project->pdfUrl=$pro['pdfUrl'];
        $project->content=str_replace("\r\n","<br>",$pro['content']);
        $project->personnel=$pro['personnel'];
        $project->cost=$pro['cost'];
        $project->term=$pro['term'];
        $project->profit=$pro['profit'];
        if($project->save()){
            $record=new Record();
            $queries = DB::getQueryLog();
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
        $staff=Staff::paginate(50);
        $project=Project::find($id);
        //获取人员需求
        $need=$project->personnel;
        $have=$project->staffId;
        //数据库中的人员需求格式为：职位*数量； 将其拆分为一个键值对数组
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
        if(isset($staid)&&count($staid)<$num){
            return redirect('project/detail/'.$id)->with('fail','分配人员数量不足,确定要开始吗?');
        }else if(isset($staid)){
            if (count($staid)>$num){
                return redirect('project/detail/'.$id)->with('fail','分配人员数量超额,确定要开始吗?');
            }else{
                if (count($staid)==$num){
                    return redirect('project/detail/'.$id)->with('success','分配成功,确定要开始吗?');
                }
            }
        }
        return redirect('project/detail/'.$id)->with('none','未选择人员，请重新选择！');

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
        if (isset($staid)){      //如果有安排人员
            foreach ($staid as $sta){             //修改每个参与项目的员工的状态
                $staff=Staff::find($sta);
                $staff->state=3;
                $staff->save();
            }
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
            $staff->state=2;
            $staff->save();
            $vitae=Vitae::where('staff_id',$staff->id)->get();
//            dd($vitae[0]->experience,isset($vitae[0]->id));
            if(isset($vitae[0]->id)){           //如果该员工有详细信息（简历）
                $vitae[0]->experience.=$id.";";
                $vitae[0]->save();
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

    public function delete($id)
    {
        $project=Project::find($id);
        $filename=$project->pdfUrl;
        $bool = Storage::disk('public')->delete($filename);
        if($project->delete()&&$bool){
            return  redirect('project/over')->with('success','删除成功！'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败！'.$id);
        }
    }
    //项目信息批量存储
    public function excel_save($obj){
        $arr=[];
        $arr2=[];
        $arr3=[];
        $columns = Schema::getColumnListing('project');  //获取表中所有字段名
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
            $bool=DB::table('project')->insert($arr);
            if ($bool){
                return redirect()->back()->with('success','批量保存成功!');
            }else{
                return redirect()->back()->with('fail','批量保存失败!');
            }
        }else{
            return redirect()->back()->with('fail','文件内容不符合规定!');
        }
    }

    public function word_save(Request $request)
    {
//        $id=$_GET['id'];
        if (isset($_GET['delete'])){
            if ($_GET['delete']=='false'){
                Storage::disk('public')->delete($_GET['pdfUrl']);
            }
        }
        $file = $request->file('import');
//        $file=$_POST['import'];
//        dd($file->isValid());
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
//            dd($ext);
//            dd($realPath);
            if ($ext=='pdf'){
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                $bool = Storage::disk('public')->put($filename, file_get_contents($realPath));

                echo $filename;
            }else{
//                return redirect()->back('fail','导入文件格式出错!');
                echo "fail";
            }
        }else{
//            return redirect()->back('fail','导入文件出错!');
            echo "fail";
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
