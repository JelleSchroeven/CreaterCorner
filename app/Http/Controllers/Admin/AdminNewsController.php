<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\News;    
use Illuminate\Support\Facades\Http;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);

        $response = Http::get('http://localhost:3000/news', [
            'page' => $page,
            'limit' => 10
        ]);

        $apiData = $response->json();

        // data voor de Blade
        $news = $apiData['data'];
        $currentPage = $apiData['page'];
        $lastPage = $apiData['last_page'];

        return view('admin.news.index', compact('news', 'currentPage', 'lastPage'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' =>'required|max:255',
            'image' =>'nullable|image|max:2048',
            'content' => 'required',
            'published_at' => 'required|date'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        
        $data['user_id'] = Auth() -> id();

        News::create($data);
        return redirect()->route('admin.news.index');
    }

    public function show(News $news)
    {   
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {       
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'published_at' => 'required|date'
        ]);
        
        if ($request->has('remove_image') && $news->image) {
            if (Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = null;
        }

         if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect() -> route('admin.news.index');
    }

    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
        Storage::disk('public') -> delete($news->image);
        }

        $news -> delete();
        return redirect() -> route('admin.news.index');
    }
}
