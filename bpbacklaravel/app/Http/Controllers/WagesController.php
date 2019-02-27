<?php

namespace App\Http\Controllers;

use App\Record;
use App\Wages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WagesController extends Controller
{
    //
    public function over()
    {
        if (isset($_GET['position'])){
            $wages=Wages::where('position',$_GET)->paginate(10);
        }else{
            $wages=Wages::paginate(10);
        }
        return view('wages.wages_over',['wages'=>$wages]);
    }

    public function save(Request $request)
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
        DB::connection()->enableQueryLog();
        $wages=new Wages();
        $wag=$request->input('Wages');
        $wages->position=$wag['position'];
        $wages->basic=$wag['basic'];
        $wages->weekday=$wag['weekday'];
        $wages->time=$wag['time'];
        $wages->reward=$wag['reward'];
        $wages->other=$wag['other'];

        if($wages->save()){
            $record=new Record();
            $queries = DB::getQueryLog();     //2.
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('wages/over')->with('success','添加成功!'.$wages->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
    }
}
