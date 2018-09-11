<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/6
 * Time: 12:45
 */
namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectControllers extends Controller
{
    //1.项目列表
    public function project(){
        $project=Project::paginate(10);  //一次显示10行
        return view('project.project',['project'=>$project]);
    }

    //2.项目细节
    //$id 点击项目id
    public function detail($id){
//        $data=Session::get('set');
        $project=Project::find($id);
//        return view('project.projectdetail',['project'=>$project,'data',$data]);
        return view('project.projectdetail',['project'=>$project]);
    }

    //3.添加项目
    public function add(){
        return view('project.projectadd');
    }

    //4.数据保存
    //$request 来自projectadd页面
    public function save(Request $request){
        $validator=\Validator::make($request->input(),[
            'Project.name'=>'required|min:2|max:20',
            'Project.content'=>'required|min:5',
            'Project.personnel'=>'required|min:2',
//            'Project.staffId'=>'required|min:2',
            'Project.cost'=>'required|integer',
            'Project.profit'=>'required|integer',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不符合要求',
            'integer'=>':attribute 必须为整数',
        ],[
            'Project.name'=>'项目名称',
            'Project.content'=>'项目内容',
            'Project.personnel'=>'项目人员需求',
//            'Project.staffId'=>'项目实施人员',
            'Project.cost'=>'项目成本',
            'Project.profit'=>'项目预期利润',
        ]);
        if($validator->fails()){                        //如果验证失败
            return redirect()->back()->withErrors($validator)->withInput();  //将失败项显示
        }
        $project=new Project();
        $val=$request->input('Project');
        $project->name=$val['name'];
        $project->content=$val['content'];
        $project->personnel=$val['personnel'];
//        $project->staffId=$val['staffId'];
        $project->cost=$val['cost'];
        $project->profit=$val['profit'];

        if($project->save()){
            return redirect('bm/project')->with('success','添加项目成功'.$project->id);
        }else{
            return redirect()->back()->with('fail','添加失败'.$project->id);
        }
    }

    //5.项目更新
    //$request 来自projectupdate页面
    //$id 项目id
    public function update(Request $request,$id)
    {
        $project = Project::find($id);
        if($request->isMethod('POST')){        //如果是以post方式上传
        $validator = \Validator::make($request->input(), [
            'Project.name' => 'required|min:2|max:20',
            'Project.content' => 'required|min:2',
            'Project.personnel' => 'required|min:2',
//            'Project.staffId'=>'required|min:2',
            'Project.cost' => 'required|integer',
            'Project.profit' => 'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数',
        ], [
            'Project.name' => '项目名称',
            'Project.content' => '项目内容',
            'Project.personnel' => '项目人员需求',
//            'Project.staffId'=>'项目实施人员',
            'Project.cost' => '项目成本',
            'Project.profit' => '项目预期利润',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $val = $request->input('Project');
        $project->name = $val['name'];
        $project->content = $val['content'];
        $project->personnel = $val['personnel'];
        $project->staffId = $val['staffId'];
        $project->cost = $val['cost'];
        $project->profit = $val['profit'];

        if ($project->save()) {
            return redirect('bm/project')->with('success', '修改项目成功' . $project->id);
        } else {
            return redirect()->back()->with('fail', '修改失败' . $project->id);
        }
    }
        return view('project.projectupdate',['project'=>$project]);
    }

    //6.项目删除
    //删除按钮在project页面
    //$id 项目id
    public function delete($id){
        $project=Project::find($id);
        if($project->delete()){
            return redirect('bm/project')->with('success', '删除项目成功' . $project->id);
        }else{
            return redirect()->back()->with('fail', '删除失败' . $project->id);
        }
    }

    //7.项目启动确认
    //触发按钮在projectdetail页面
    //$id 项目id
    public function start($id){
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

    //8.项目确认启动
    //触发按钮来自projectdetail
    //$id 项目id
    public function assure($id){
        $project=Project::find($id);
        $project->speed='已启动!';
        $project->save();
        return redirect('bm/project')->with('success','项目 '.$id.' 启动成功!');
    }
}