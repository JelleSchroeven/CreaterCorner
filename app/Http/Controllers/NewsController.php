<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {   
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }

}
