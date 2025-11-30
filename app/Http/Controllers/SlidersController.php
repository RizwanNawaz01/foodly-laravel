<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::paginate(10);

        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sub_title' => 'required',
            'small_title' => 'required',
            'small_sub_title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_name' => 'required',
            'link' => 'required',
            'order' => 'required',
            'gradient' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        $slider = Slider::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'small_title' => $request->small_title,
            'small_sub_title' => $request->small_sub_title,
            'image' => $imagePath,
            'link_name' => $request->link_name,
            'link' => $request->link,
            'order' => $request->order,
            'gradient' => $request->gradient,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully');
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
        $slider = Slider::findOrFail($id);

        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sub_title' => 'required',
            'small_title' => 'required',
            'small_sub_title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_name' => 'required',
            'link' => 'required',
            'order' => 'required',
            'gradient' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'small_title' => $request->small_title,
            'small_sub_title' => $request->small_sub_title,
            'image' => $imagePath,
            'link_name' => $request->link_name,
            'link' => $request->link,
            'order' => $request->order,
            'gradient' => $request->gradient,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully');
    }
}
