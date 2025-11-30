@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center  mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Product List') }}</h2>
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2 bg-primary py-2 p-4 text-white rounded-full ">
                    <Icon name="ep:plus" class="text-white" /> Create Product
                </a>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">{{ __('Sno') }}</th>
                        <th class="px-6 py-3">{{ __('Image') }}</th>
                        <th class="px-6 py-3">{{ __('Name') }}</th>
                        <th class="px-6 py-3">{{ __('Qty') }}</th>
                        <th class="px-6 py-3">{{ __('Price') }}</th>
                        <th class="px-6 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $index => $product)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $products->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                    class="w-20 h-20 object-cover" />
                            </td>


                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->qty }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->price_delivery }} / {{ $product->pickup_price }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-start items-center gap-4">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="text-blue-600 flex items-center gap-1">
                                        <span>✏️</span> Edit
                                    </a>
                                    <button
                                        onclick="window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: { id: '{{ $product->id }}', type: 'products' } }))"
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
