<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'detail']); 
    }

    public function index() {

        $articles = Article::latest()->paginate(5); 

        return view("articles.index", [
            "articles" => $articles
        ]);
    }

    public function detail($id) {
        $article = Article::find($id);

        return view("articles.detail", [
            "article" => $article,
        ]);
    }

    public function add() {
        $categories = Category::all();

        return view("articles.add", [
            "categories" => $categories,
        ]);
    }

    public function create() {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',

        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect("/articles")->with("info", "A new article is created");
    }


    public function edit($id) {
        $article = Article::find($id);
        $categories = Category::all();

        return view("articles.edit", [
            "article" => $article,
            "categories" => $categories,
        ]);   
    }

        public function update($id) {
            $validator = validator(request()->all(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $article = Article::find($id);
            $article->title = request()->title;
            $article->body = request()->body;
            $article->category_id = request()->category_id;
            $article->save();

            return redirect("/articles/detail/$id")->with("info", "Article updated");
        }


    public function delete($id) {
        $article = Article::find($id);
        $article->delete();
        
        return redirect("/articles")->with("info", "Article deleted");
    }
}
