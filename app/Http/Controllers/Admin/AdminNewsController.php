<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\News;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' =>'recuired|max:255',
            'image' =>'recuired|image|max:2048',
            'content' => 'recuired',
            'published_at' => 'recuired|data'
        ]);

        $date['image'] = $request->file('image')->store('news', 'public');
        $data['user_id'] = Auth() -> id();

        News::create($data);
        return redirect()->route('admin.news.index')
    }

    public function show(string $id)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(string $id)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required',
            'published_at' => 'required|date'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index');
    }

    public function destroy(string $id)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
        Storage::disk('public')->delete($news->image);
        }

        $news -> delete()
        return redirect()->route('admin.news.index')
    }
}
