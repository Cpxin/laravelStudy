<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //项目初始页面
    public function over()
    {
        $project=Project::paginate(5);
        return view('project.project_over',['project'=>$project]);
    }
    //项目详情
    public function detail($id)
    {
        $project=Project::find($id);
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


}
