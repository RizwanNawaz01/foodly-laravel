@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center  mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Postal Code List') }}</h2>
                <a href="{{ route('admin.postal_codes.create') }}"
                    class="flex items-center gap-2 bg-primary py-2 p-4 text-white rounded-full ">
                    <Icon name="ep:plus" class="text-white" /> Create Postal Code
                </a>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">{{ __('Sno') }}</th>
                        <th class="px-6 py-3">{{ __('Code') }}</th>
                        <th class="px-6 py-3">{{ __('City Name') }}</th>
                        <th class="px-6 py-3">{{ __('Date') }}</th>
                        <th class="px-6 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($postalCodes as $index => $postalCode)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postalCodes->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postalCode->code }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postalCode->city->name }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $postalCode->created_at->format('Y-m-d') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-start items-center gap-4">
                                    <a href="{{ route('admin.postal_codes.edit', $postalCode->id) }}"
                                        class="text-blue-600 flex items-center gap-1">
                                        <span>✏️</span> Edit
                                    </a>
                                    <button
                                        onclick="window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: { id: '{{ $postalCode->id }}', type: 'postal_codes' } }))"
                                        class="text-red-600 flex items-center gap-1">
                                        <span>🗑</span> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination links -->
            <div class="mt-4">
                {{ $postalCodes->links() }}
            </div>
        </div>
    </div>
@endsection
