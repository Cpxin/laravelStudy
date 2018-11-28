<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function over()
    {
        $admin=User::paginate(10);
        return view('admin.admin_over',['admin'=>$admin]);
    }
}
