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
        $page = $request->query('page', 1); // page query string
        $limit = 10;

        // Node API call
        $response = Http::get('http://localhost:3000/news', [
            'page' => $page,
            'limit' => $limit
        ]);

        $result = $response->json(); // verwacht { data: [...], total, page, last_page }

        $news = collect($result['data']); // Laravel collection, handig voor Blade
        $currentPage = $result['page'];
        $lastPage = $result['last_page'];

        return view('admin.news.index', compact('news', 'currentPage', 'lastPage'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        // Upload image lokaal
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('news', 'public');
            $data['image'] = '/storage/' . $path; // URL voor database
        }

        // Voeg ingelogde user_id toe
        $data['user_id'] = (int) auth()->id(); // zorg dat het integer is

        // Stuur POST naar Node API als JSON (niet als form-data)
        $apiUrl = config('app.news_api_url');
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($apiUrl, $data);


        return redirect()->route('admin.news.index')->with('success', 'Nieuws aangemaakt via API!');
    }





    public function show(News $news)
    {   
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {       
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, \App\Models\News $news)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        // Oude afbeelding verwijderen als "verwijder afbeelding" checkbox is aangevinkt
        if ($request->has('remove_image') && $news->image) {
            if (Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = null;
        }

        // Nieuwe afbeelding uploaden
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Update nieuwsitem
        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Nieuws bijgewerkt!');
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
