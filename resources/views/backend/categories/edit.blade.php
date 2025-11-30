@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center  mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Edit Category') }}</h2>
            </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Category Name') }}</label>
                    <input type="text" placeholder="{{ __('Category Name') }}" id="name" name="name"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $category->name }}">
                </div>

                <div class="mb-6">
                    <label for="description"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}</label>
                    <textarea placeholder="{{ __('Description') }}" id="description" name="description"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>{{ $category->description }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="meta_title"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Meta Title') }}</label>
                    <input type="text" placeholder="{{ __('Meta Title') }}" id="meta_title" name="meta_title"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $category->meta_title }}">
                </div>

                <div class="mb-6">
                    <label for="meta_description"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Meta Description') }}</label>
                    <textarea placeholder="{{ __('Meta Description') }}" id="meta_description" name="meta_description"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>{{ $category->meta_description }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="meta_keywords"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Meta Keywords') }}</label>
                    <textarea placeholder="{{ __('Meta Keywords') }}" id="meta_keywords" name="meta_keywords"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>{{ $category->meta_keywords }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image') }}</label>
                    <input type="file" placeholder="{{ __('Image') }}" id="image" name="image"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                    <img src="{{ asset('storage//' . $category->image) }}" alt="{{ $category->name }}" class="mt-2 w-24">
                </div>

                <div class="mb-6">
                    <label for="background_image"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Background Image') }}</label>
                    <input type="file" placeholder="{{ __('Background Image') }}" id="background_image"
                        name="background_image"
                        class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                    <img src="{{ asset('storage//' . $category->background_image) }}" alt="{{ $category->name }}"
                        class="mt-2 w-24">
                </div>
                <button type="submit"
                    class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full">{{ __('Update Category') }}</button>
            </form>
        </div>
    </div>
@endsection
