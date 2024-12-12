<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();

?>

<x-app-layout>
    <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4" />

    <div class="flex gap-2 items-center p-3 pb-0" x-data="{
            selectedSort: '{{ request()->get('sort', '-updated_at') }}',
            searchKeyword: '{{ request()->get('search') }}',
            updateUrl() {
                const params = new URLSearchParams(window.location.search)
                if (this.selectedSort && this.selectedSort !== '-updated_at') {
                    params.set('sort', this.selectedSort)
                } else {
                    params.delete('sort')
                }

                if (this.searchKeyword) {
                    params.set('search', this.searchKeyword)
                } else {
                    params.delete('search')
                }
                window.location.href = window.location.origin + window.location.pathname + '?'
                + params.toString();
            }
        }">
        <form action="" method="GET" class="flex-1" @submit.prevent="updateUrl">
            <x-input type="text" name="search" placeholder="Search for the products" x-model="searchKeyword" />
        </form>
        <x-input x-model="selectedSort" @change="updateUrl" type="select" name="sort"
            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
            <option value="price">Price (ASC)</option>
            <option value="-price">Price (DESC)</option>
            <option value="title">Title (ASC)</option>
            <option value="-title">Title (DESC)</option>
            <option value="-updated_at">Last Modified at the top</option>
            <option value="updated_at">Last Modified at the bottom</option>
        </x-input>
    </div>

    <?php if ($products->count() === 0): ?>
    <div class="text-center text-gray-600 py-16 text-xl">
        There are no products published
    </div>
    <?php else: ?>
    <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 p-3">
        @foreach($products as $product)
            <!-- Product Item -->
            <div
            x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image ?: '/img/noimage.png',
                        'title' => $product->title,
                        'price' => $product->price,
                        'addToCartUrl' => route('cart.add', $product)
                    ]) }})" 
            class="card border rounded-lg shadow transition-colors bg-white flex flex-col">
                <a href="{{ route('product.view', $product->slug) }}" class="block">
                    <div class="aspect-square flex items-center justify-center overflow-hidden">
                        <img src="{{ $product->image ?: '/img/noimage.png' }}" alt="{{ $product->title }}"
                            class="object-cover w-full h-full p-4" />
                    </div>
                </a>
                <div class="card-body flex flex-col flex-grow justify-end p-2">
                    <div class="flex flex-col mb-2">
                        <h3 class="h-16 overflow-hidden">
                            <a href="{{ route('product.view', $product->slug) }}" class="line-clamp-2 text-black text-sm">
                                {{ $product->title }}
                            </a>
                        </h3>
                        <h5 class="text-black font-bold mt-4 mb-2">Rp. {{ number_format($product->price, 0, ',', '.') }}
                        </h5>
                    </div>
                    <button class="btn btn-outline text-black rounded-full" @click="addToCart()">
                        Add to Cart
                    </button>
                </div>
            </div>
            <!--/ Product Item -->
        @endforeach
    </div>
    {{$products->appends(['sort' => request('sort'), 'search' => request('search')])->links()}}
    <?php endif; ?>
</x-app-layout>