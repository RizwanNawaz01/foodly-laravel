<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postalCodes = PostalCode::paginate(10);
        $cities = City::all();

        return view('backend.postal_codes.index', compact('postalCodes', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();

        return view('backend.postal_codes.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'city_id' => 'required',
        ]);

        $postalCode = PostalCode::create($request->all());

        return redirect()->route('admin.postal_codes.index')->with('success', 'Postal Code created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postalCode = PostalCode::findOrFail($id);
        $cities = City::all();

        return view('backend.postal_codes.edit', compact('postalCode', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required',
            'city_id' => 'required',
        ]);

        $postalCode = PostalCode::findOrFail($id);
        $postalCode->update($request->all());

        return redirect()->route('admin.postal_codes.index')->with('success', 'Postal Code updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postalCode = PostalCode::findOrFail($id);
        $postalCode->delete();

        return redirect()->route('admin.postal_codes.index')->with('success', 'Postal Code deleted successfully');
    }
}
