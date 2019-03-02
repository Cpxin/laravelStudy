<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function over(){
        $article=Article::select('z_title','title')->get();
        $art=[];
        foreach ($article as $zt=>$t){
            $art[$t->z_title][]=$t->title;
        }

        return view('homepage.homepage_over',['article'=>$art]);
    }
    public function article(){
//        dd($_GET['title']);
        $article=Article::where('title',$_GET['title'])->get();
        if (count($article)!=0){
            if (isset($article[0]->content)){
                echo $article[0]->content;
            }else{
                echo "无";
            }
        }else{
            echo "无";
        };
    }
    public function add_title(){
        $ztitle=$_GET['z_title'];
        $title= $_GET['title'];
        $article=new Article();
        $article->z_title=$ztitle;
        $article->title=$title;
        if ($article->save()){
            echo "添加成功";
        }else{
            echo "添加失败";
        }
    }
}
