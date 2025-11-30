{{-- resources/views/admin/settings.blade.php --}}
@extends('layouts.admin')

@section('content')
    <main>
        <div class="app-container relative px-3 pt-4 flex">
            <livewire:admin.sidebar />
            <div class="flex-1 p-4 sm:ml-64 lg:ml-80">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf
                        @method('POST')

                        {{-- SITE INFO --}}
                        <section>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Site Information') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ __('Site Name') }}</label>
                                    <input name="siteName" value="{{ old('siteName', $settings->siteName ?? '') }}"
                                        type="text" placeholder="{{ __('Site Name') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ __('Site Logo') }}</label>
                                    <input type="file" name="logo"
                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                                    @if (!empty($settings->logo))
                                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo Preview"
                                            class="h-20 object-contain mt-2" />
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ __('Favicon') }}</label>
                                    <input type="file" name="favicon"
                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                                    @if (!empty($settings->favicon))
                                        <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Favicon Preview"
                                            class="h-10 w-10 object-contain mt-2" />
                                    @endif
                                </div>
                            </div>
                        </section>

                        {{-- SEO --}}
                        <section>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Site SEO') }}</h3>
                            <input name="metaTitle" value="{{ old('metaTitle', $settings->metaTitle ?? '') }}"
                                placeholder="{{ __('Meta Title') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            <input name="metaDescription"
                                value="{{ old('metaDescription', $settings->metaDescription ?? '') }}"
                                placeholder="{{ __('Meta Description') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                        </section>

                        {{-- ABOUT --}}
                        <section>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('About Section') }}</h3>
                            <input name="title" value="{{ old('title', $settings->title ?? '') }}"
                                placeholder="{{ __('About Title') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            <textarea name="description" placeholder="{{ __('About Description') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('description', $settings->description ?? '') }}</textarea>

                            {{-- Services --}}
                            <div>
                                <h4 class="text-lg font-semibold mb-2">{{ __('Our Services') }}</h4>
                                @php
                                    $services = old('services', $settings->services ?? []);
                                @endphp
                                <div id="services-container">
                                    @foreach ($services as $i => $service)
                                        <div class="flex gap-2 items-center mb-2">
                                            <input name="services[{{ $i }}][name]"
                                                value="{{ $service['name'] ?? '' }}" placeholder="Service Name"
                                                class="border border-gray-300 rounded-md p-2 flex-1" />
                                            <input name="services[{{ $i }}][description]"
                                                value="{{ $service['description'] ?? '' }}" placeholder="Description"
                                                class="border border-gray-300 rounded-md p-2 flex-1" />
                                            <button type="button" onclick="this.closest('div').remove()"
                                                class="bg-red-500 text-white px-3 py-1 rounded">{{ __('Remove') }}</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addService()"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('Add Service') }}</button>
                            </div>
                        </section>

                        {{-- CONTACT --}}
                        <section>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Contact Details') }}</h3>
                            <input name="address" value="{{ old('address', $settings->address ?? '') }}"
                                placeholder="{{ __('Address') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            <input name="contact" value="{{ old('contact', $settings->contact ?? '') }}"
                                placeholder="{{ __('Phone or Website') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                        </section>

                        {{-- STORE SETTINGS --}}
                        <section>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Store Configuration') }}</h3>
                            <input type="number" name="minOrder" value="{{ old('minOrder', $settings->minOrder ?? '') }}"
                                placeholder="{{ __('Minimum Order') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            <input name="currency" value="{{ old('currency', $settings->currency ?? '') }}"
                                placeholder="{{ __('Currency') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                            <input name="order_outside_time"
                                value="{{ old('order_outside_time', $settings->order_outside_time ?? '') }}"
                                placeholder="{{ __('Order Outside Time') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />

                            {{-- Opening Hours --}}
                            <div x-data="{ tab: 'opening' }" class="mt-8">

                                <!-- Tabs -->
                                <div class="flex gap-4 border-b border-gray-300 mb-6">
                                    <button type="button" @click="tab = 'opening'"
                                        :class="tab === 'opening' ? 'border-b-2 border-blue-600 font-semibold' : ''"
                                        class="pb-2">
                                        {{ __('Opening Hours') }}
                                    </button>

                                    <button type="button" @click="tab = 'pickup'"
                                        :class="tab === 'pickup' ? 'border-b-2 border-blue-600 font-semibold' : ''"
                                        class="pb-2">
                                        {{ __('Pickup Hours') }}
                                    </button>

                                    <button type="button" @click="tab = 'delivery'"
                                        :class="tab === 'delivery' ? 'border-b-2 border-blue-600 font-semibold' : ''"
                                        class="pb-2">
                                        {{ __('Delivery Hours') }}
                                    </button>
                                </div>

                                <!-- ===================================================== -->
                                <!-- ================== OPENING HOURS ===================== -->
                                <!-- ===================================================== -->
                                <div x-show="tab === 'opening'">
                                    @include('backend.settings._hours-block', [
                                        'title' => 'Weekly Opening Hours',
                                        'fieldName' => 'openingHours',
                                        'data' => $settings->openingHours ?? [],
                                    ])
                                </div>

                                <!-- ===================================================== -->
                                <!-- =================== PICKUP HOURS ===================== -->
                                <!-- ===================================================== -->
                                <div x-show="tab === 'pickup'">
                                    @include('backend.settings._hours-block', [
                                        'title' => 'Pickup Hours',
                                        'fieldName' => 'pickupHours',
                                        'data' => $settings->pickupHours ?? [],
                                    ])
                                </div>

                                <!-- ===================================================== -->
                                <!-- ================== DELIVERY HOURS ==================== -->
                                <!-- ===================================================== -->
                                <div x-show="tab === 'delivery'">
                                    @include('backend.settings._hours-block', [
                                        'title' => 'Delivery Hours',
                                        'fieldName' => 'deliveryHours',
                                        'data' => $settings->deliveryHours ?? [],
                                    ])
                                </div>

                            </div>

                        </section>

                        {{-- SAVE --}}
                        <div class="mt-8 mb-6">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded">{{ __('Save Settings') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function addService() {
            const container = document.getElementById('services-container');
            if (!container) return;
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'items-center', 'mb-2');
            div.innerHTML = `
        <input name="services[][name]" placeholder="Service Name" class="border border-gray-300 rounded-md p-2 flex-1" />
        <input name="services[][description]" placeholder="Description" class="border border-gray-300 rounded-md p-2 flex-1" />
        <button type="button" onclick="this.closest('div').remove()" class="bg-red-500 text-white px-3 py-1 rounded">Remove</button>
    `;
            container.appendChild(div);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[name$="[closed]"]').forEach(cb => {
                cb.addEventListener('change', function() {
                    const shiftsContainer = cb.closest('.flex.gap-10').querySelector(
                        '.shifts-container');
                    if (shiftsContainer) {
                        shiftsContainer.style.display = cb.checked ? 'none' : 'block';
                    }
                });
            });

            document.querySelectorAll('input[name$="[doubleShift]"]').forEach(cb => {
                cb.addEventListener('change', function() {
                    const secondShift = cb.closest('.flex.gap-10').querySelector('.second-shift');
                    if (secondShift) {
                        secondShift.style.display = cb.checked ? 'flex' : 'none';
                    }
                });
            });
        });
    </script>
@endsection
