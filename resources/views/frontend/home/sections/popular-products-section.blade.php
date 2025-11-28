<section class="product-tabs section-padding position-relative mt-30">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>Popular Products</h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                @foreach ($popularCategories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'first-category-tab' : '' }}" id="nav-tab-two"
                            data-bs-toggle="tab" data-bs-target="#tab-{{ $category->id }}" type="button" role="tab"
                            aria-controls="tab-{{ $category->id }}" aria-selected="false">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content wow animate__animated animate__fadeIn" id="myTabContent">
            @foreach ($popularProducts as $key => $popularProduct)
                <div class="tab-pane fade" id="tab-{{ $key }}" role="tabpanel">
                    <div class="row product-grid-4">
                        @foreach ($popularProduct as $product)
                            <x-product-card :product="$product" class="col-6 col-lg-4 col-xl-3 col-xxl-2" />
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!--End tab-content-->
    </div>
</section>

@push('scripts')
    <script>
        $(function() {
            $('.first-category-tab').click();
        });
    </script>
@endpush
