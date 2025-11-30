@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Edit Customer') }}</h2>

            <!-- Tabs -->
            <div x-data="{ tab: 'customer' }">
                <div class="flex space-x-4 border-b mb-6">
                    <button :class="tab === 'customer' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-600'"
                        class="py-2 px-4 font-medium" @click="tab = 'customer'">
                        {{ __('Customer Info') }}
                    </button>
                    <button :class="tab === 'address' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-600'"
                        class="py-2 px-4 font-medium" @click="tab = 'address'">
                        {{ __('Address') }}
                    </button>
                </div>

                <!-- Customer Info Form -->
                <div x-show="tab === 'customer'" class="space-y-6">
                    <form action="{{ route('admin.customer.updateCustomer', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" value="{{ $customer->name }}"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                        </div>

                        <div>
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" id="email" name="email" value="{{ $customer->email }}"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                        </div>

                        <div>
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password"
                                class="shadow-sm border rounded-lg w-full p-2.5">
                        </div>

                        <div>
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="shadow-sm border rounded-lg w-full p-2.5">
                        </div>

                        <button type="submit"
                            class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full mt-4">{{ __('Update Customer') }}</button>
                    </form>
                </div>

                <!-- Address Form -->
                <div x-show="tab === 'address'" class="space-y-6">
                    <form action="{{ route('admin.customer.updateAddress', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($address)
                            <input type="hidden" name="address_id" value="{{ $address->id }}">
                        @endif

                        <div>
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" id="first_name" name="first_name"
                                value="{{ $address->first_name ?? $customer->name }}"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                        </div>

                        <div>
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $address->last_name ?? '' }}"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                        </div>

                        <div>
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" id="phone" name="phone" value="{{ $address->phone ?? '' }}"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                        </div>

                        <div>
                            <label for="address">{{ __('Address') }}</label>
                            <textarea id="address" name="address" class="shadow-sm border rounded-lg w-full p-2.5" required>{{ $address->address ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="street">{{ __('Street') }}</label>
                            <textarea id="street" name="street" class="shadow-sm border rounded-lg w-full p-2.5" required>{{ $address->street ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="city_id">{{ __('City') }}</label>
                            <select name="city_id" id="city_id" class="shadow-sm border rounded-lg w-full p-2.5" required>
                                <option value="">{{ __('Select City') }}</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $address && $address->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="postal_code_id">{{ __('Postal Code') }}</label>
                            <select name="postal_code_id" id="postal_code_id"
                                class="shadow-sm border rounded-lg w-full p-2.5" required>
                                <option value="">{{ __('Select Postal Code') }}</option>
                                @foreach ($postalCodes as $postalCode)
                                    <option value="{{ $postalCode->id }}"
                                        {{ $address && $address->postal_code_id == $postalCode->id ? 'selected' : '' }}>
                                        {{ $postalCode->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="bg-primary hover:bg-primary/80 text-white py-2 px-4 rounded-full mt-4">{{ __('Update Address') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
