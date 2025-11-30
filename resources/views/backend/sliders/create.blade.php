@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Add Slider') }}</h2>
            </div>

            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data"
                x-data="productForm()" x-init="init()">
                @csrf

                <!-- Main Product Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" placeholder="Slider Title"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sub Title</label>
                        <input type="text" name="sub_title" placeholder="Slider Sub Title"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gradident</label>
                        <input type="text" name="gradient" placeholder="Slider Gradident"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">smallTitle</label>
                        <input type="text" name="small_title" placeholder="Slider smallTitle"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">smallSubtitle</label>
                        <input type="text" name="small_subtitle" placeholder="Slider smallSubtitle"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link Name</label>
                        <input type="text" name="link_name" placeholder="Slider Link Name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="text" name="link" placeholder="Slider Link"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" name="order" placeholder="Slider Order"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Is Active</label>
                        <input type="checkbox" name="is_active" placeholder="Slider Order"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                </div>

                <div class="mt-6 mb-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Save Slider</button>
                </div>
            </form>
        </div>
    </div>
@endsection
