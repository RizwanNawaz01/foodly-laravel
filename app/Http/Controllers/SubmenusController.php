<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submenus = Submenu::orderBy('id', 'desc')->paginate(15);

        return view('backend.submenus.index', compact('submenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.submenus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Submenu::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.submenus.index')
            ->with('message', 'Submenu created successfully')
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
        $submenu = Submenu::findOrFail($id);

        return view('backend.submenus.edit', compact('submenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Submenu::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.submenus.index')
            ->with('message', 'Submenu updated successfully')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Submenu::destroy($id);

        return redirect()->route('admin.submenus.index')
            ->with('message', 'Submenu deleted successfully')
            ->with('type', 'success');
    }
}
