<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settings = Setting::first();

        return view('backend.settings.create', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siteName' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'required|image|mimes:png|max:2048',
            'metaTitle' => 'required',
            'metaDescription' => 'required',
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'currency' => 'required',
            'order_outside_time' => 'required',
            'minOrder' => 'required',
            'services' => 'required',
            'openingHours' => 'required',
            'pickupHours' => 'required',
            'deliveryHours' => 'required',
        ]);

        $settings = Setting::first();

        if ($settings) {
            $settings->update($request->all());
        } else {
            Setting::create($request->all());
        }

        return redirect()->route('admin.settings.create')->with('success', 'Settings updated successfully');
    }
}
