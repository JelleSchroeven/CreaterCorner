<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Alle FAQ's ophalen
        $faqs = Faq::all();

        // View returnen met FAQ's
        return view('faqs.index', compact('faqs'));
    }
}

