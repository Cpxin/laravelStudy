<?php

namespace App\Http\Controllers;

use App\Article;
use App\Message;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\MagicConstTest;

class HomepageController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function over(){
        $article=Article::select('z_title','title')->get();
        $art=[];
        foreach ($article as $zt=>$t){
            $art[$t->z_title][]=$t->title;
        }
        $message=Message::select('content','id')->get();
        return view('homepage.homepage_over',['article'=>$art,'message'=>$message]);
    }
    /**
     * 文章查找
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * 添加标题
     */
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
    /**
     * 添加总标题
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_ztitle(Request $request)
    {
        $t=$request->input('title');
        $ztitle=$t['ztitle'];
        $title=$t['title'];
        $article=Article::where('z_title',$ztitle)->get();
        if (isset($article[0])){
            return redirect('homepage/over')->with('fail',$ztitle.'标题已存在!');
        }else{
            $article=new Article();
            $article->z_title=$ztitle;
            $article->title=$title;
            if ($article->save()){
                return redirect('homepage/over')->with('success',$ztitle.'标题添加成功!');
            }else{
                return redirect('homepage/over')->with('fail',$ztitle.'标题添加失败!');
            }
        }
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        $ztitle=$_GET['ztitle'];
        $article=Article::where('z_title',$ztitle)->get();
        if (isset($article[0])&&$article[0]->delete()){
            return redirect('homepage/over')->with('success',$ztitle.'标题删除成功!');
        }else{
            return redirect('homepage/over')->with('fail',$ztitle.'标题删除失败!');
        }
    }
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function message()
    {
        $content=$_POST['content'];
        $message=new Message();
        $message->content=$content;
        $message->save();
        return redirect('/');
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function message_delete()
    {
        $id=$_GET['id'];
        $message=Message::find($id);
        if ($message->delete()){
            return redirect('homepage/over')->with('success','留言-'.$id.'删除成功!');
        }else{
            return redirect('homepage/over')->with('fail','留言-'.$id.'删除失败!');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function front(){
        $title=$_GET['title'];
        $article=Article::select('content')->where('title',$title)->get();
//        dd($article);
//        dd($article[0]->content);
        return view('homepage.homepage_article',['title'=>$title,'content'=>$article[0]->content]);

    }
}
