<?php

namespace App\Http\Controllers;

use App\Record;
use App\Wages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WagesController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function over()
    {
        if (isset($_GET['position'])){
            $wages=Wages::where('position',$_GET)->paginate(10);
        }else{
            $wages=Wages::paginate(10);
        }
        return view('wages.wages_over',['wages'=>$wages]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $wag= $request->input('Wages');
        $wages=Wages::find($wag['id']);
        $wages->position=$wag['position'];
        $wages->basic=$wag['basic'];
        $wages->weekday=$wag['weekday'];
        $wages->time=$wag['time'];
        $wages->reward=$wag['reward'];
        $wages->other=$wag['other'];
        if ($wages->save()){
            return redirect('wages/over')->with('success',$wages->position.'修改成功!');
        }else{
            return redirect()->back()->with('fail','修改失败失败!');
        }

    }
}
