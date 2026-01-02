<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Shop;

class DashboardController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(5)->get();
        $shops = Shop::latest()->take(10)->get();
        return view('dashboard', compact('news', 'shops'));
    }
}
