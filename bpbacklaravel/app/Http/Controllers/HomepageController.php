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
    //文章查找
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
    public function update(Request $request){
        $article=$request->input('Article');
        $art=Article::where('title',$article['title'])->get();
//        dd($art[0]->title);
        $art[0]->content=$article['content'];
        if ($art[0]->save()){
            return redirect('homepage/over')->with('success','文章'.$article['title'].'修改成功');
        }else{
            return redirect()->back()->with('fail','文章'.$article['title'].'修改失败');
        }
    }
    //添加标题
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
    public function front(){
        $title=$_GET['title'];
        $article=Article::select('content')->where('title',$title)->get();
//        dd($article);
//        dd($article[0]->content);
        return view('homepage.homepage_article',['title'=>$title,'content'=>$article[0]->content]);

    }
}
