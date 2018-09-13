<?php
/**
 * Created by PhpStorm.
 * User: XIN
 * Date: 2018/9/13
 * Time: 16:54
 */
namespace App\Http\Controllers;

use App\Article;
use http\Env\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }
    public function show($id)
    {
        return Article::find($id);
    }
    public function store(Request $request)
    {
        return Article::create($request->all());
    }
    public function update(Request $request,$id)
    {
        $article=Article::findOfFail($id);
        $article->update($request->all());

        return $article;
    }
    public function delete(Request $request,$id)
    {
        $article=Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}