@foreach ($categoryYouMayLikeProducts as $key => $categoryYouMayLikeProduct)
    @php
        $category = App\Models\Category::select(['name', 'slug', 'id'])->find($key);
    @endphp

    <section class="new_arrival mt-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title wow animate__animated animate__fadeIn">
                        <h3>{{ $category->name }}</h3>
                        <a class="view_all_btn" href="{{ route('products.index', ['category' => $category->slug]) }}">View
                            All <i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categoryYouMayLikeProduct as $product)
                    <x-product-card :product="$product" class="col-6 col-lg-4 col-xl-3 col-xxl-2" />
                @endforeach
            </div>
        </div>
    </section>
@endforeach
