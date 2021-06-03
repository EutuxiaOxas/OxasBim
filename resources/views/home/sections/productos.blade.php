<section class="container my-5 px-2 px-md-0 mb-4">
    @php /*print_r($array_other_products);*/   @endphp
    @php $x=0; @endphp
    @foreach ($array_other_products as $otros_products)
        <h2>{{$categorias[$x]->title}}</h2>
        @include('home.sections.products_home')
        @php ++$x; @endphp
    @endforeach
</section>
