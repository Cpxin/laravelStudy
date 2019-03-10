<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    /**
     * @return $this
     */
    public function index()
    {

        //        $sta=new Staff();
            $sta=Staff::paginate(10);

        foreach ($sta as $k){
            $arr[]=[$k->id=>$k->name];
        }

        return response()->json($arr)->setEncodingOptions(JSON_UNESCAPED_UNICODE);

//            return view('project.project_arrange')->with(['sta'=>$arr]);
//        return [csrf_token(),'sta'=>$arr];
    }
}
