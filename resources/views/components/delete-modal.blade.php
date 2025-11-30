    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: false, itemId: null, itemType: null }"
        x-on:open-delete-modal.window="
         itemId = $event.detail.id; 
         itemType = $event.detail.type; 
         open = true"
        x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">


        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('Confirm Delete') }}</h2>
            <p class="mb-6">{{ __('Are you sure you want to delete this') }} <span x-text="itemType"></span>?</p>

            <div class="flex justify-end gap-4">
                <button @click="open = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">{{ __('Cancel') }}</button>

                <form :action="`/admin/${itemType}/${itemId}`" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
