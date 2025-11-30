<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(45);

        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $submenus = Submenu::all();

        return view('backend.products.create', compact('categories', 'submenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_delivery' => 'required|numeric',
            'price_pickup' => 'required|numeric',
            'qty' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'isHighlighted' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subMenu' => 'nullable|array',
            'subMenu.*.name' => 'required_with:subMenu|string|max:255',
            'subMenu.*.price' => 'required_with:subMenu|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_delivery' => $request->price_delivery,
            'price_pickup' => $request->price_pickup,
            'qty' => $request->qty,
            'category_id' => $request->category,
            'isHighlighted' => $request->isHighlighted,
            'image' => $imagePath,
            'subMenu' => $request->input('subMenu', []),
        ]);

        return redirect()->route('admin.products.index')
            ->with('message', 'Product created successfully')
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $submenus = Submenu::all();

        return view('backend.products.edit', compact('product', 'categories', 'submenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_delivery' => 'required|numeric',
            'price_pickup' => 'required|numeric',
            'qty' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'isHighlighted' => 'sometimes|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subMenu' => 'nullable|array',
            'subMenu.*.name' => 'required_with:subMenu|string|max:255',
            'subMenu.*.price' => 'required_with:subMenu|numeric',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        Product::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_delivery' => $request->price_delivery,
            'price_pickup' => $request->price_pickup,
            'qty' => $request->qty,
            'category_id' => $request->category,
            'isHighlighted' => $request->isHighlighted,
            'image' => $imagePath,
            'subMenu' => $request->input('subMenu', []),
        ]);

        return redirect()->route('admin.products.index')
            ->with('message', 'Product updated successfully')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);

        return redirect()->route('admin.products.index')
            ->with('message', 'Product deleted successfully')
            ->with('type', 'success');
    }
}
