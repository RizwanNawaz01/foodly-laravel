<?php

if (! function_exists('format_currency')) {
    function format_currency($amount, $decimals = 2)
    {

        $currency = cache()->remember('currency', 60 * 60, function () {
            $setting = \DB::table('settings')->select('currency')->first();

            return $setting->currency ?? 'CHF';
        });

        return $currency.' '.number_format($amount, $decimals, '.', ',');
    }
}

if (! function_exists('currency')) {
    function currency()
    {

        $currency = cache()->remember('currency', 60 * 60, function () {
            $setting = \DB::table('settings')->select('currency')->first();

            return $setting->currency ?? 'CHF';
        });

        return $currency;
    }
}

if (! function_exists('site_settings')) {

    function site_settings($key)
    {
        $setting = \DB::table('settings')->select($key)->first();

        return $setting->$key ?? null;
    }
}

if (! function_exists('restaurant_closed_time')) {
    function restaurant_closed_time()
    {
        $settings = \DB::table('settings')->first();

        if (! $settings || empty($settings->openingHours)) {
            return false; // Assume open if no settings
        }

        // Decode JSON if it's a string
        $openingHours = is_string($settings->openingHours)
            ? json_decode($settings->openingHours, true)
            : $settings->openingHours;

        if (! $openingHours) {
            return false;
        }

        $now = now();
        $currentDay = $now->format('l'); // Monday, Tuesday, etc.
        $currentTime = $now->format('H:i');

        // Find today's opening hours
        $todayHours = collect($openingHours)->firstWhere('day', $currentDay);

        if (! $todayHours) {
            return false; // Day not found, assume open
        }

        // Check if closed for the day
        if (! empty($todayHours['closed']) && $todayHours['closed'] === true) {
            return true; // Restaurant is closed
        }

        // Check if currently within any shift
        $shifts = $todayHours['shifts'] ?? [];
        $isOpen = false;

        foreach ($shifts as $shift) {
            if (empty($shift['open']) || empty($shift['close'])) {
                continue;
            }

            $openTime = $shift['open'];
            $closeTime = $shift['close'];

            // Check if current time is within this shift
            if ($currentTime >= $openTime && $currentTime <= $closeTime) {
                $isOpen = true;
                break;
            }
        }

        return ! $isOpen; // Return true if closed (not open)
    }
}
