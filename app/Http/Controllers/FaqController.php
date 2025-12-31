<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\FaqCategory::all(); // <-- categorieën ophalen
        $query = Faq::with('category'); // categorie laden

        // Optioneel: filteren op categorie
        if ($request->has('category_id') && $request->category_id != null) {
            $query->where('faq_category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        $faqs = $query->get();

        return view('faqs.index', compact('faqs', 'categories')); 
    }

}

