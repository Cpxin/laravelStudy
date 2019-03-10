<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function over()
    {
        if (isset($_GET['text'])){
            $record=Record::where('cord','like','%'.$_GET['text'].'%')->paginate(10);
        }else{
            $record=Record::paginate(10);
        }
        return view('record.record_over',['record'=>$record]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
