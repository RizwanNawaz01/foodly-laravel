@extends('layouts.app')

@section('content')
    <main>
        <div class="app-container py-10">

            <h2 class="text-2xl font-semibold text-slate-900 mb-6">
                {{ __('Dashboard') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- Sidebar -->
                <div class="md:col-span-1">
                    <x-user-sidebar />
                </div>

                <!-- Main Dashboard Content -->
                <div class="md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Total Orders Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold text-slate-700">Total Orders</h3>
                            <p class="text-4xl font-bold text-primary">{{ $orders->count() }}</p>
                            <p class="text-sm text-slate-500">Total orders placed in the system</p>
                            <a href="{{ route('customer.orders') }}" class="mt-4 inline-block text-primary hover:underline">
                                View Orders
                            </a>
                        </div>

                        <!-- Profile Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold text-slate-700">Your Profile</h3>
                            <p class="text-sm text-slate-500">Manage your personal details</p>
                            <a href="{{ route('customer.profile') }}"
                                class="mt-4 inline-block text-primary hover:underline">
                                Edit Profile
                            </a>
                        </div>

                        <!-- Address Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold text-slate-700">Save Address</h3>
                            <p class="text-sm text-slate-500">Manage your shipping address</p>
                            <a href="{{ route('customer.address') }}"
                                class="mt-4 inline-block text-primary hover:underline">
                                Save Address
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
