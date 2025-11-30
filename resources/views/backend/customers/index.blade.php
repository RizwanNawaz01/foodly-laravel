@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">

            <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Customer List') }}</h2>


            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">{{ __('Sno') }}</th>
                        <th class="px-6 py-3">{{ __('Customer Name') }}</th>
                        <th class="px-6 py-3">{{ __('Email') }}</th>
                        <th class="px-6 py-3">{{ __('User Type') }}</th>
                        <th class="px-6 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customers as $index => $customer)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $customers->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $customer->name }}
                            </td>

                            <td class="px-6 py-4">{{ $customer->email }}</td>
                            <td class="px-6 py-4 capitalize">
                                {{ $customer->role }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-start items-center gap-4">
                                    <a href="{{ route('admin.customer.edit', $customer->id) }}"
                                        class="text-blue-600 flex items-center gap-1">
                                        <span>✏️</span>
                                        {{ __('Edit') }}
                                    </a>
                                    <button onclick="deleteFun('customer',{{ $customer->id }})"
                                        class="text-red-600 flex items-center gap-1">
                                        <span>🗑</span>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination links -->
            <div class="mt-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
