@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Edit Slider') }}</h2>
            </div>

            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data"
                x-data="productForm()" x-init="init()">
                @csrf
                @method('PUT')

                <!-- Main Product Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" placeholder="Slider Title" value="{{ $slider->title }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sub Title</label>
                        <input type="text" name="sub_title" placeholder="Slider Sub Title"
                            value="{{ $slider->sub_title }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            required>
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image"
                            class="w-20 h-20 object-cover" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gradident</label>
                        <input type="text" name="gradient" placeholder="Slider Gradident" value="{{ $slider->gradient }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">smallTitle</label>
                        <input type="text" name="small_title" placeholder="Slider smallTitle"
                            value="{{ $slider->small_title }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">smallSubtitle</label>
                        <input type="text" name="small_subtitle" placeholder="Slider smallSubtitle"
                            value="{{ $slider->small_subtitle }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link Name</label>
                        <input type="text" name="link_name" placeholder="Slider Link Name"
                            value="{{ $slider->link_name }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="text" name="link" placeholder="Slider Link" value="{{ $slider->link }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" name="order" placeholder="Slider Order" value="{{ $slider->order }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 pb-2">Is Active</label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" class="peer sr-only"
                                {{ $slider->is_active ? 'checked' : '' }}>
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                            </div>
                            <span class="ml-3 text-sm font-medium text-black">Is Active</span>
                        </label>
                    </div>

                </div>

                <div class="mt-6 mb-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Update Slider</button>
                </div>
            </form>
        </div>
    </div>
@endsection
