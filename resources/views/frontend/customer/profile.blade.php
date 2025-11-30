@extends('layouts.app')

@section('content')
    <main>
        <div class="app-container mx-auto py-10 mb-5">

            <h2 class="text-2xl font-semibold text-slate-900 mb-8 text-center">
                {{ __('Profile Settings') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">

                <!-- Sidebar -->
                <div class="md:col-span-1">
                    <x-user-sidebar />
                </div>

                <!-- Profile and Password Update Section -->
                <div class="md:col-span-3 space-y-8">

                    <!-- Update Profile Information -->
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-slate-700 mb-6">Update Profile Information</h3>
                        <livewire:profile.update-profile-information-form />
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-slate-700 mb-6">Update Password</h3>
                        <livewire:profile.update-password-form />
                    </div>

                </div>

            </div>

        </div>
    </main>
@endsection
