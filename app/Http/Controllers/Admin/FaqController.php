<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Lijst van alle FAQ's met categorie
   public function index()
    {
        $faqs = Faq::with('category')->latest()->get();
        $categories = FaqCategory::all();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    // Nieuwe FAQ aanmaken
    public function store(Request $request)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create($data);

        $faq->load('category');

        return response()->json($faq, 201);
    }

    // Bestaande FAQ updaten
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($data);
        $faq->load('category');

        return response()->json($faq);
    }
    

    public function show(Faq $faq)
    {
        $faq->load('category');
        return response()->json($faq);
    }

    public function filter(Request $request)
    {
        $query = Faq::with('category');

        if($request->has('category_id') && $request->category_id != ''){
            $query->where('faq_category_id', (int) $request->category_id);
        }

        if($request->has('search') && $request->search != ''){
            $query->where(function($q) use ($request){
                $q->where('question', 'like', "%{$request->search}%")
                ->orWhere('answer', 'like', "%{$request->search}%");
            });
        }

        $faqs = $query->latest()->get();

        return response()->json($faqs);
    }



    // FAQ verwijderen
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->noContent();
    }
}
