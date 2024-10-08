@foreach ($products as $key => $product)
    <div class="col">
        @include('frontend.partials.product_box_1',['product' => $product])
    </div>
@endforeach