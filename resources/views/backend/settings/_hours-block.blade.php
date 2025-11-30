<div class="mt-6">
    <h4 class="text-md font-semibold mb-2">{{ __($title) }}</h4>

    @php
        $hours = old($fieldName, $data);
    @endphp

    @foreach ($hours as $i => $day)
        <div class="flex gap-10 mb-3 border-b border-gray-300 pb-3">

            <div class="flex gap-2 justify-between items-center">
                <div class="font-medium text-gray-700 min-w-[100px]">
                    {{ $day['day'] ?? 'Unknown Day' }}
                </div>

                <!-- Closed + Double Shift -->
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-1 text-sm text-gray-700">
                        <input type="checkbox" name="{{ $fieldName }}[{{ $i }}][closed]" value="1"
                            {{ !empty($day['closed']) ? 'checked' : '' }}>
                        {{ __('Closed') }}
                    </label>

                    <label class="flex items-center gap-1 text-sm text-gray-700">
                        <input type="checkbox" name="{{ $fieldName }}[{{ $i }}][doubleShift]"
                            value="1" {{ !empty($day['doubleShift']) ? 'checked' : '' }}>
                        {{ __('2 Times') }}
                    </label>
                </div>
            </div>

            <!-- Shift Inputs -->
            <div class="shifts-container" style="{{ !empty($day['closed']) ? 'display:none;' : 'display:block;' }}">

                <!-- First shift -->
                <div class="flex items-center gap-2 mb-2">
                    <input type="time" name="{{ $fieldName }}[{{ $i }}][shifts][0][open]"
                        value="{{ $day['shifts'][0]['open'] ?? '' }}" class="border border-gray-300 rounded-md p-1.5">
                    <span>{{ __('to') }}</span>
                    <input type="time" name="{{ $fieldName }}[{{ $i }}][shifts][0][close]"
                        value="{{ $day['shifts'][0]['close'] ?? '' }}" class="border border-gray-300 rounded-md p-1.5">
                </div>

                <!-- Second shift -->
                <div class="second-shift flex items-center gap-2"
                    style="{{ empty($day['doubleShift']) ? 'display:none;' : 'flex;' }}">
                    <input type="time" name="{{ $fieldName }}[{{ $i }}][shifts][1][open]"
                        value="{{ $day['shifts'][1]['open'] ?? '' }}" class="border border-gray-300 rounded-md p-1.5">
                    <span>{{ __('to') }}</span>
                    <input type="time" name="{{ $fieldName }}[{{ $i }}][shifts][1][close]"
                        value="{{ $day['shifts'][1]['close'] ?? '' }}" class="border border-gray-300 rounded-md p-1.5">
                </div>
            </div>
        </div>
    @endforeach
</div>
