<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::paginate(10);

        return view('backend.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_order_amount' => 'required|numeric',
        ]);

        City::create([
            'name' => $request->name,
            'min_order_amount' => $request->min_order_amount,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('message', 'City created successfully')
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
        $city = City::findOrFail($id);

        return view('backend.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_order_amount' => 'required|numeric',
        ]);

        City::where('id', $id)->update([
            'name' => $request->name,
            'min_order_amount' => $request->min_order_amount,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('message', 'City updated successfully')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::destroy($id);

        return redirect()->route('admin.cities.index')
            ->with('message', 'City deleted successfully')
            ->with('type', 'success');
    }
}
