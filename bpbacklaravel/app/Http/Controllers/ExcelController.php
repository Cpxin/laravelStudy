<?php

namespace App\Http\Controllers;

use App\Project;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function export(){
//        $cellData = [['id','姓名','年龄'],
//                    ['10001','张三','19'],
//                    ['10002','李四','22'],
//                    ['10003','王五','23'],
//                    ['10004','赵六','19'],
//                    ['10005','猴七','22'],
//        ];
//        dd($_GET['type']);
        $cellData=[];
//        $staff=new Staff();
//        dd($cellData);
        switch ($_GET['type']){
            case 'staff':
                $staff=Staff::get();
                $j=0;
                $cellData[$j++]=['ID'=>'ID','name'=>'姓名','age'=>'年龄','sex'=>'性别','position'=>'职位','created_at'=>'创建时间'];
                foreach ($staff as $k=>$v){
                    $cellData[$j++]=[
                        'ID'=>$v->id,
                        'name'=>$v->name,
                        'age'=>$v->age,
                        'sex'=>$v->sex($v->sex),
                        'position'=>$v->position,
                        'created_at'=>$v->created_at
                    ];
                }
                $name = iconv('UTF-8', 'GBK', '员工信息');
                break;
            case 'project':
                $project=Project::get();
                $j=0;
                $cellData[$j++]=['ID'=>'ID','name'=>'项目名','content'=>'项目内容','personnel'=>'项目人员需求','staffId'=>'参与人员id','cost'=>'项目成本','profit'=>'项目利润','term'=>'项目工期','rank'=>'项目等级','created_at'=>'创建时间'];
                foreach ($project as $k=>$v){
                    $cellData[$j++]=[
                        'ID'=>$v->id,
                        'name'=>$v->name,
                        'content'=>$v->content,
                        'personnel'=>$v->personnel,
                        'staffId'=>$v->staffId,
                        'cost'=>$v->cost,
                        'profit'=>$v->profit,
                        'term'=>$v->term,
                        'rank'=>$v->rank,
                        'created_at'=>$v->created_at
                    ];
                }
                $name = iconv('UTF-8', 'GBK', '项目信息');
                break;
            default:
                break;
        }
        try{
            Excel::create($name,function($excel) use ($cellData){
                $excel->sheet('score', function($sheet) use ($cellData){
                    $sheet->rows($cellData);
                });
            })->store('xls')->export('xls');
        }catch (\Exception $e){
            return redirect()->back()->with('fail','导出文件出错!');
        }
    }
    //excel文件导入
    public function import(Request $request){

        $file=$request->file('import');
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
//            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            //这里的uploads是配置文件的名称
//            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            if ($ext=='xlsx'){
                Excel::load($realPath, function($reader) {
                    $data = $reader->all();
                    $data->toArray();
                    switch ($_GET['type']){
                        case 'staff':
                            $staff=new StaffController();
                            $staff->excel_save($data[0]);
                            break;
                        case 'project':
                            $project=new ProjectController();
                            $project->excel_save($data[0]);
                            break;
                        default:
                            break;
                    }
                });
            }else if ($ext=='xls'){
                Excel::load($realPath, function($reader) {
                    $data = $reader->all();
                    switch ($_GET['type']){
                        case 'staff':
                            $staff=new StaffController();
                            $staff->excel_save($data);
                            break;
                        case 'project':
                            $project=new ProjectController();
                            $project->excel_save($data);
                            break;
                        default:
                            break;
                    }
                });
            }else{
                return redirect()->back()->with('fail','文件格式错误!');
            }
            return redirect()->back();
        }else{
            return redirect()->back()->with('fail','文件不存在!');
        }
    }
}
