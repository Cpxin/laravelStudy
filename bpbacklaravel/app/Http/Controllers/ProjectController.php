<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function over()
    {
        $project=Project::paginate(5);
        return view('project.project_over',['project'=>$project]);
    }
}
