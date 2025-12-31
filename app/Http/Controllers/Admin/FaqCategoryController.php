<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = FaqCategory::create($data);

        return response()->json($category, 201);
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faqCategory->update($data);

        return response()->json($faqCategory);
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return response()->noContent();
    }
}
