@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Add Page') }}</h2>
            </div>

            <form action="{{ route('admin.pages.store') }}" method="POST">
                @csrf

                <!-- Page Name -->
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Page Name') }}</label>
                    <input type="text" id="name" name="name" placeholder="{{ __('Page Name') }}"
                        class="shadow-sm border border-gray-300 rounded-lg w-full p-2.5" required>
                </div>

                <!-- Page Slug -->
                <div class="mb-6">
                    <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Page Slug') }}</label>
                    <input type="text" id="slug" name="slug" placeholder="{{ __('Page Slug') }}"
                        class="shadow-sm border border-gray-300 rounded-lg w-full p-2.5" required>
                </div>

                <!-- Page Content with CKEditor -->
                <div class="mb-6">
                    <label for="content"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Page Content') }}</label>
                    <textarea id="content" name="content" placeholder="{{ __('Page Content') }}" required></textarea>
                </div>

                <!-- Meta Title -->
                <div class="mb-6">
                    <label for="meta_title"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Meta Title') }}</label>
                    <input type="text" id="meta_title" name="meta_title" placeholder="{{ __('Meta Title') }}"
                        class="shadow-sm border border-gray-300 rounded-lg w-full p-2.5" required>
                </div>

                <!-- Meta Description -->
                <div class="mb-6">
                    <label for="meta_description"
                        class="block text-gray-700 text-sm font-bold mb-2">{{ __('Meta Description') }}</label>
                    <textarea id="meta_description" name="meta_description" placeholder="{{ __('Meta Description') }}"
                        class="shadow-sm border border-gray-300 rounded-lg w-full p-2.5" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full">{{ __('Add Page') }}</button>
            </form>
        </div>
    </div>

    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'undo', 'redo', 'sourceEditing'
                ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
