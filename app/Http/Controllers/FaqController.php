<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::with('category');

        if ($request->category_id) {
            $query->where('faq_category_id', $request->category_id);
        }

        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('question', 'like', "%{$request->search}%")   
                ->orWhere('answer', 'like', "%{$request->search}%");
            });
        }

        $faqs = $query->latest()->get();
        $categories = FaqCategory::all();

        if ($request->ajax()) {
            return response()->json($faqs);
        }

        return view('faqs.index', compact('faqs', 'categories'));
    }


    public function filter(Request $request)
    {
        $query = Faq::with('category');

        if ($request->category_id) {
            $query->where('faq_category_id', $request->category_id);
        }

        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('question', 'like', "%{$request->search}%")
                ->orWhere('answer', 'like', "%{$request->search}%");
            });
        }

        $faqs = $query->latest()->get();
        return response()->json($faqs);
    }
}

