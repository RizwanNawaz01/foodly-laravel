@extends('layouts.app')

@section('content')
    <main>
        <div class="app-container py-10">

            <h2 class="text-2xl font-semibold text-slate-900 mb-8 text-center">
                {{ __('Delivery Address') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">

                <!-- Sidebar -->
                <div class="md:col-span-1">
                    <x-user-sidebar />
                </div>

                <!-- Address Form -->
                <div class="md:col-span-3">
                    <form action="{{ route('customer.address.save') }}" method="POST"
                        class="bg-white p-8 rounded-lg shadow-lg">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-4">

                            <!-- First Name -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('First Name') }}</label>
                                <input type="text" value="{{ $address->first_name ?? '' }}" name="first_name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                                @error('first_name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('Last Name') }}</label>
                                <input type="text" value="{{ $address->last_name ?? '' }}" name="last_name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                                @error('last_name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium mb-2">{{ __('Email') }}</label>
                                <input type="email" value="{{ auth()->user()->email }}" disabled name="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                            </div>

                            <!-- Phone Number -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium mb-2">{{ __('Phone Number') }}</label>
                                <input type="tel" id="phone" value="{{ $address->phone ?? '' }}" name="phone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('Address') }}</label>
                                <input type="text" value="{{ $address->address ?? '' }}" name="address"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                            </div>

                            <!-- Street -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('Street') }}</label>
                                <input type="text" value="{{ $address->street ?? '' }}" name="street"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required />
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('City') }}</label>
                                <select name="city_id" id="city_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required>
                                    <option value="">{{ __('Select City') }}</option>
                                    @foreach ($cities as $cityOption)
                                        <option value="{{ $cityOption->id }}"
                                            {{ $cityOption->id == $address->city_id ? 'selected' : '' }}>
                                            {{ $cityOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label class="block text-sm font-medium mb-2">{{ __('Postal Code') }}</label>
                                <select name="postal_code_id" id="postal_code_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                    required>
                                    <option value="">{{ __('Select Postal Code') }}</option>
                                    @foreach ($postalCodes as $postalCode)
                                        <option value="{{ $postalCode->id }}"
                                            {{ $postalCode->id == $address->postal_code_id ? 'selected' : '' }}>
                                            {{ $postalCode->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- Save Button -->
                        <div class="mt-8 flex justify-start">
                            <button type="submit" class="px-6 py-2 text-white bg-primary rounded-md hover:bg-primary/90">
                                {{ __('Save Address') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <!-- jQuery for AJAX Postal Codes -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $('#city_id').on('change', function() {
                const cityId = $(this).val();
                $('#postal_code_id').html('<option>Loading...</option>');

                if (cityId) {
                    $.getJSON(`/frontend/postal-codes/${cityId}`, function(codes) {
                        let options = '<option value="">{{ __('Select Postal Code') }}</option>';
                        codes.forEach(pc => {
                            options += `<option value="${pc.id}">${pc.code}</option>`;
                        });
                        $('#postal_code_id').html(options);
                    }).fail(function() {
                        $('#postal_code_id').html(
                            '<option>{{ __('Error loading postal codes') }}</option>');
                    });
                } else {
                    $('#postal_code_id').html('<option value="">{{ __('Select Postal Code') }}</option>');
                }
            });
        });
    </script>
@endsection
