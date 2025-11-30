@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900">
                    {{ __('Category Sales Report') }}
                </h2>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800">{{ __('Total Categories') }}</h3>
                    <p class="text-3xl font-bold mt-2 text-blue-900">
                        {{ count($report) }}
                    </p>
                </div>

                <div class="p-6 bg-green-50 border border-green-200 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800">{{ __('Total Revenue') }}</h3>
                    <p class="text-3xl font-bold mt-2 text-green-900">
                        {{ format_currency(array_sum(array_column($report, 'total_revenue'))) }}
                    </p>
                </div>

            </div>

            <!-- Table -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">{{ __('Sno') }}</th>
                        <th class="px-6 py-3">{{ __('Category') }}</th>
                        <th class="px-6 py-3">{{ __('Total Products Sold') }}</th>
                        <th class="px-6 py-3">{{ __('Total Revenue') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($report as $index => $row)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $row->category_name }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $row->total_quantity_sold }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ format_currency($row->total_revenue) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
