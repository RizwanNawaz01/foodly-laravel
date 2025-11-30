@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl text-slate-900 font-semibold">Edit About Section</h2>
            </div>

            <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Main Title -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input name="title" value="{{ old('title', $about->title ?? '') }}" type="text"
                        placeholder="About Title" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Main Description</label>
                    <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('description', $about->description ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Our Services</h3>
                    <div id="services-container">
                        @if (!empty($about->services))
                            @foreach (json_decode($about->services, true) as $index => $service)
                                <div class="flex gap-2 items-center mb-2 service-row">
                                    <input name="services[{{ $index }}][name]" value="{{ $service['name'] }}"
                                        placeholder="Service Name" class="border border-gray-300 rounded-md p-2 flex-1" />
                                    <input name="services[{{ $index }}][description]"
                                        value="{{ $service['description'] }}" placeholder="Description"
                                        class="border border-gray-300 rounded-md p-2 flex-1" />
                                    <button type="button" onclick="removeService(this)"
                                        class="bg-red-500 text-white px-3 py-1 rounded">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" onclick="addService()" class="bg-blue-500 text-white px-4 py-2 rounded">Add
                        Service</button>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input name="address" value="{{ old('address', $about->address ?? '') }}" type="text"
                        placeholder="Address" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <!-- Contact Info -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Contact Info</label>
                    <input name="contact" value="{{ old('contact', $about->contact ?? '') }}" type="text"
                        placeholder="Phone or Website" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                    @if (!empty($about->image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $about->image) }}" alt="Preview"
                                class="h-32 w-32 object-cover rounded" />
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Save About Section</button>
                </div>
            </form>
        </div>
    </div>
@endsection
