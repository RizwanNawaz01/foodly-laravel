@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center  mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Add City') }}</h2>
            </div>
            <form action="{{ route('admin.cities.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('City Name') }}</label>
                    <input type="text" placeholder="{{ __('City Name') }}" id="name" name="name"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>
                <div class="mb-6">
                    <label for="min_order_amount"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Min Order Amount') }}</label>
                    <input type="number" placeholder="{{ __('Min Order Amount') }}" id="min_order_amount"
                        name="min_order_amount"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>
                <button type="submit"
                    class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full">{{ __('Add City') }}</button>
            </form>
        </div>
    </div>
@endsection
