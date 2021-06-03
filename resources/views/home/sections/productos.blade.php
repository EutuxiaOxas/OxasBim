<section class="container-fluid px-2 px-md-4 my-5 mb-4">
    @php $x=0; @endphp
    @foreach ($array_other_products as $otros_products)
        <h2 class="text-rubik color-primary text-lg font-semibold mb-0">{{$categorias[$x]->title}}</h2>
        <p class="text-rubik mb-0"> {{ $categorias[$x]->description }} </p>
        @include('home.sections.products_home')
        @php ++$x; @endphp
    @endforeach
</section>
