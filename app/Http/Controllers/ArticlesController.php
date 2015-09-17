<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Construct loads middleware
     * for article/create
     *
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Show all articles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();

        return view('articles/index', compact('articles'));
    }

    /**
     * Show a single article.
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('articles/show', compact('article'));
    }

    /**
     * Show the page to create a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('articles/create', compact('article'));
    }

    /**
     * Save a new article.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());

        \Auth::user()->articles()->save($article);

        return redirect('articles');
    }

    /**
     * Edit an article.
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('articles/edit', compact('article'));
    }

    /**
     * Update an Article.
     *
     * @param Article $article
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());
        return redirect('articles');
    }
}
