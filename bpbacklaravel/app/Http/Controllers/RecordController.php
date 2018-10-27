<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function over()
    {
        $recrod=Record::paginate(10);
        return view('record.record_over',['record'=>$recrod]);
    }

    public function delete($id)
    {
        $record=Record::find($id);
        if($record->delete()){
            return  redirect('record/over')->with('success','删除成功！'.$id);
        }else{
            return redirect()->back()->with('fail','删除失败！'.$id);
        }
    }
}
