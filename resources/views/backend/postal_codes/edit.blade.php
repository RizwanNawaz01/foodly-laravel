@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center  mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Edit Postal Code') }}</h2>
            </div>
            <form action="{{ route('admin.postal_codes.update', $postalCode->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="code" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Postal Code') }}</label>
                    <input type="text" placeholder="{{ __('Postal Code') }}" id="code" name="code"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $postalCode->code }}">
                </div>
                <div class="mb-6">
                    <label for="city_id" class="block text-gray-700 text-sm font-bold mb-2">{{ __('City') }}</label>
                    <select name="city_id" id="city_id"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">{{ __('Select City') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $city->id == $postalCode->city_id ? 'selected' : '' }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full">{{ __('Update Postal Code') }}</button>
            </form>
        </div>
    </div>
@endsection
