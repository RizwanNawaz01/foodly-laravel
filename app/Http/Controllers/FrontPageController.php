<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;

class FrontPageController extends Controller
{
    /**
     * Display the main front page.
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function slug($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if ($page) {
            return view('frontend.slug', compact('page'));
        } else {
            abort(404);
        }
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->paginate(12);

        if ($category) {
            return view('frontend.category', compact('category', 'products'));
        } else {
            abort(404);
        }
    }
}
