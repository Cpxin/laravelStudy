<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function over(){
        return view('homepage.homepage_over');
    }
    public function article(){
        $_GET['title'];
        $article=Article::where('title',$_GET['title'])->get();
        if (count($article)!=0){
            echo $article[0]->content;
        }else{
            echo "无";
        };
    }
}
