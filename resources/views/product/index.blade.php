<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();

?>

<x-app-layout>
    <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4 items-center" />

    <?php if ($products->count() === 0): ?>
    <div class="text-center text-gray-600 py-16 text-xl min-h-screen">
        There are no products published
    </div>
    <?php else: ?>

    <!-- Carousel -->
    <div class="w-full rounded-3xl min-h-56 p-4" id="default-carousel" data-carousel="slide">
        <!-- Carousel Wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="duration-700 ease-in-out" data-carousel-item>
                <img class="object-contain object-center rounded-xl absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    src="{{asset('banner_1.jpg')}}" alt="..." />
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img class="object-contain object-center rounded-xl absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    src="{{asset('banner_1.jpg')}}" alt="..." />
            </div>
        </div>
        <!-- Slider Indicator -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
        </div>
        <!-- Slider Controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    <!-- End Carousel -->

    <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 p-3">
        @foreach($products as $product)
            <!-- Product Item -->
            <div x-data="productItem({{ json_encode([
                'id' => $product->id,
                'slug' => $product->slug,
                'image' => $product->image ?: '/img/noimage.png',
                'title' => $product->title,
                'price' => $product->price,
                'addToCartUrl' => route('cart.add', $product)
            ]) }})" class="card border rounded-3xl shadow transition-colors bg-white flex flex-col">
                <a href="{{ route('product.view', $product->slug) }}" class="block">
                    <div class="aspect-square flex items-center justify-center overflow-hidden p-4">
                        <img src="{{ $product->image ?: '/img/noimage.png' }}" alt="{{ $product->title }}"
                            class="object-contain object-center w-full h-48 p-4" />
                    </div>
                </a>
                <div class="card-body flex flex-col flex-grow justify-end p-4">
                    <div class="flex flex-col mb-2">
                        <h3 class="h-16 overflow-hidden">
                            <a href="{{ route('product.view', $product->slug) }}" class="line-clamp-2 text-black text-sm">
                                {{ $product->title }}
                            </a>
                        </h3>
                        <h5>
                            <span class="border border-accent text-l font-bold me-2 px-2.5 py-0.5 rounded-full
                                                                                ">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </h5>
                        <!-- <h5 class="font-bold mt-4 mb-2 tex">Rp. {{ number_format($product->price, 0, ',', '.') }} -->
                        <!-- </h5> -->
                    </div>
                    <!-- <button class="btn btn-outline rounded-full" @click="addToCart()">
                                                                                    Add to Cart
                                                                                </button> -->
                </div>
            </div>
            <!--/ Product Item -->
        @endforeach
    </div>
    {{$products->appends(['sort' => request('sort'), 'search' => request('search')])->links()}}
    <?php endif; ?>
    <footer class="mt-16 rounded-3xl footer bg-primary text-neutral-content p-10">
        <nav>
            <h6 class="footer-title">Services</h6>
            <a class="link link-hover">Branding</a>
            <a class="link link-hover">Design</a>
            <a class="link link-hover">Marketing</a>
            <a class="link link-hover">Advertisement</a>
        </nav>
        <nav>
            <h6 class="footer-title">Company</h6>
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Jobs</a>
            <a class="link link-hover">Press kit</a>
        </nav>
        <nav>
            <h6 class="footer-title">Legal</h6>
            <a class="link link-hover">Terms of use</a>
            <a class="link link-hover">Privacy policy</a>
            <a class="link link-hover">Cookie policy</a>
        </nav>
    </footer>
</x-app-layout>