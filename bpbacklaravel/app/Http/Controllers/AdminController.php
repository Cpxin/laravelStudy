<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function over()
    {
        if (isset($_GET['name'])){
            $admin=User::where('name',$_GET['name'])->paginate(10);
        }else{
            $admin=User::paginate(10);
        }
        return view('admin.admin_over',['admin'=>$admin]);
    }
    public function save(Request $request)
    {
        $strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        //随机分配密码
        $password=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);
        DB::connection()->enableQueryLog();
        $admin=new User();
        $psd=new Admin();
        $ad=$request->input('Admin');
        $admin->name=$ad['name'];
        $admin->email=$ad['email'];
        //使用hash算法存入数据库
        $admin->password=Hash::make($password);
        $admin->rank=$ad['rank'];

        if($admin->save()){
            $psd->adminId=$admin->id;
            $psd->password=$password;
            $psd->save();
            $record=new Record();
            $queries = DB::getQueryLog();
            $a = end($queries);
            $tmp = str_replace('?', '"'.'%s'.'"', $a["query"]); //删除sql语句中不必要的字符
            $record->cord=vsprintf($tmp, $a['bindings']);   //组合并存入相关数据库
            $record->save();
            return redirect('admin/over')->with('success','添加成功!'.$admin->id);
        }else{
            return redirect()->back()->with('fail','添加失败!');
        }
    }
    public function delete(){
        $id=$_GET['id'];
        $admin=User::find($id);
        if ($admin->delete()){
            return redirect('admin/over')->with('success','管理员删除成功!'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
