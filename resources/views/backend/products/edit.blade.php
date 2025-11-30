@extends('layouts.admin')

@section('content')
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Edit Product') }}</h2>
            </div>

            ```
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                x-data="productForm()">
                @csrf
                @method('PUT')

                <!-- Main Product Fields -->
                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" placeholder="Product Name"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required
                            value="{{ $product->name }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" placeholder="Product Description"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price Delivery</label>
                            <input type="number" step="0.01" name="price_delivery" placeholder="Price Delivery"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required
                                value="{{ $product->price_delivery }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price Pickup</label>
                            <input type="number" step="0.01" name="price_pickup" placeholder="Price Pickup"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required
                                value="{{ $product->price_pickup }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="qty" placeholder="Product Quantity"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required
                            value="{{ $product->qty }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <option value="">Please Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 pb-2">Highlight Product</label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="isHighlighted" class="sr-only peer" value="1"
                                {{ $product->isHighlighted ? 'checked' : '' }}>
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                class="w-24 h-24 mb-2">
                        @endif
                        <input type="file" name="image"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>

                </div>

                <!-- Sub Menu Items -->
                <div class="space-y-4 mt-6" x-data>
                    <div class="flex gap-4 justify-between items-center">
                        <h3 class="text-lg font-semibold">Sub Menu Items</h3>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="staticMenu" class="sr-only">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-black">Static Menu</span>
                        </label>
                    </div>

                    <template x-for="(item, index) in subMenu" :key="item.id">
                        <div class="flex gap-2 items-center">
                            <input type="text" :name="'subMenu[' + index + '][name]'" x-model="item.name"
                                placeholder="Name" class="border border-gray-300 rounded-md p-2 flex-1">
                            <input type="number" :name="'subMenu[' + index + '][price]'" x-model="item.price"
                                step="0.01" placeholder="Price" class="border border-gray-300 rounded-md p-2 w-32">
                            <button type="button" @click="removeSubMenu(index)"
                                class="bg-red-500 text-white px-3 py-1 rounded">Remove</button>
                        </div>
                    </template>

                    <button type="button" @click="addSubMenu()" class="bg-blue-500 text-white px-4 py-2 rounded">Add Sub
                        Menu</button>
                </div>

                <div class="mt-6 mb-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Save Product</button>
                </div>
            </form>
        </div>
        ```

    </div>

    <script>
        function productForm() {
            return {
                subMenu: @json($product->subMenu ?? []),
                staticMenu: false,
                staticItems: @json($staticItems ?? []),
                addSubMenu() {
                    this.subMenu.push({
                        id: Date.now(),
                        name: '',
                        price: 0
                    });
                },
                removeSubMenu(index) {
                    this.subMenu.splice(index, 1);
                },
                init() {
                    this.$watch('staticMenu', value => {
                        if (value) {
                            this.subMenu = [...this.staticItems];
                        }
                    });
                }
            }
        }
    </script>
@endsection
