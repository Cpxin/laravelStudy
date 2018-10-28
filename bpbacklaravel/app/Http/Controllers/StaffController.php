<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/22
 * Time: 19:51
 */
namespace App\Http\Controllers;

use App\Record;
use App\Staff;
use App\Vitae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        return view('common.layouts');
    }
    public function over()
    {
//        $staff=new Staff();
        $staff=Staff::paginate(5);
//        $arr=$staff->toArray();
        return view('staff.staff_over',['staff'=>$staff]);
    }

    public function save(Request $request)
    {
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
        DB::connection()->enableQueryLog();
        $staff=new Staff();
        $sta=$request->input('Staff');
        $staff->name=$sta['name'];
        $staff->age=$sta['age'];
        $staff->sex=$sta['sex'];
        $staff->position=$sta['position'];

        if($staff->save()){
            $record=new Record();
            $queries = DB::getQueryLog();     //2.
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('staff/over')->with('success','添加成功!'.$staff->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
    }

    public function detail($id)
    {
        $staff=Staff::find($id);
        return view('staff.staff_detail',['staff'=>$staff]);
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
        $vitae=new Vitae();
        $v=$request->input('Vitae');
        $vitae->staff_id=$id;
        $vitae->image="无";
        $vitae->email=$v['email'];
        $vitae->experience=$v['experience'];
        $vitae->skill=$v['skill'];
        $vitae->adress=$v['adress'];
        $vitae->education=$v['education'];
        $vitae->hobby=$v['hobby'];

        if($vitae->save()){
            return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
//        $test=$vitae->where('staff_id',$id)->value('id');
//        return redirect('staff/detail/'.$id)->with('success','添加成功!'.$vitae->id);
    }

    public function delete($id)
    {
        $staff=Staff::find($id);
        if($staff->delete()){
            return  redirect('staff/over')->with('success','删除成功！'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败！'.$id);
        }
    }

    public function update(Request $request)
    {
        DB::connection()->enableQueryLog();   //1.开启QueryLog

        $sta=$request->input('rStaff');
        $id=$sta['id'];
        $staff=Staff::find($id);
        $staff->name=$sta['name'];
        $staff->age=$sta['age'];
        $staff->sex=$sta['sex'];
        $staff->position=$sta['position'];

        if($staff->save()){
            $record=new Record();
            $queries = DB::getQueryLog();     //2.
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('staff/over')->with('success','修改成功!'.$id);
        }else{
            return redirect()->back()->with('fail','修改失败！'.$id);
        }
    }

}