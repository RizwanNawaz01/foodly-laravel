<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $about = About::first();

        return view('backend.about.create', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withErrors($validator)
                ->withInput();
        }

        $about = About::first();
        if ($request->hasFile('image')) {
            $about->image = $request->file('image')->store('about', 'public');
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();

        return redirect()->route('admin.about.create')->with('success', 'About updated successfully');
    }
}
