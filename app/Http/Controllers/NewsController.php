<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function indexFromNode(Request $request)
    {
        $page = $request->query('page', 1); // ?page=2 enz., standaard 1
        $limit = 10;

        $response = Http::get("http://localhost:3000/news?page={$page}&limit={$limit}");
        $newsApi = $response->json();
        $news = $newsApi['data'];
        $total = $newsApi['total'];
        $currentPage = $newsApi['page'];
        $lastPage = $newsApi['last_page'];

        return view('news.index', compact('news', 'total', 'currentPage', 'lastPage'));
    }

    public function show(News $news)
    {   
        $news = News::findOrFail($news->id);
        return view('news.show', compact('news'));
    }

}
