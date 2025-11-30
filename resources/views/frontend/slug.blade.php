@extends('layouts.app')

@section('content')
    <main>
        <div class="app-container px-6 mt-10">
            <div clas="bg-purple-50 py-6">
                <div clas="max-w-screen-xl max-lg:max-w-xl mx-auto">
                    <h1 clas="text-3xl font-bold mb-4">{{ $page->title }}</h1>

                    <div clas="prose max-w-none">{!! $page->content !!}</div>
                </div>
            </div>
        </div>
    </main>
@endsection
