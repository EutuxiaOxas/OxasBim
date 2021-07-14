@extends('layouts.app')

@section('title')
	Productos  - Contrugangavalencia.com
@endsection

@section('header')

    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">
    <meta name="robots" content="index,follow"/>

    <!-- Primary Meta Tags -->
	<meta name="title" content="Contruganga - Productos en Tienda Virtual">
	<meta name="description" content="Tienda virtual de construganga valencia">
    <meta name="keywords" content="productos de construccion en valencia">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://alpargatastore.com/productos">
    <meta property="og:title" content="Contruganga - Productos en Tienda Virtual">
    <meta property="og:description" content="Tienda virtual de construganga valencia">
    <meta property="og:image" content="{{ asset( 'logo.png' ) }}">

    {{-- url canonical --}}
    <link rel="canonical" href="https://construgangavalencia.com/productos" />
	{{-- precargar imagenes --}}
	<link rel="preload" href="{{asset('logo.png')}}" as="image">

@endsection

@section('content')

<div class="container-fluid px-md-5">
	<div class="row pt-2">

		@include('common.navbar_left')

		<div class="col-12 col-md-10 pl-4 ">
			<div class="row">
				<div class="col-12 my-3">
					@if(isset($product_categorie))
					<h1 class="text-rubik font-light text-xl">Productos en categoria: <span class="text-lg">{{$product_categorie->title}}</span></h1>
					@else
					<h1 class="text-rubik font-light text-xl">Productos</h1>
					@endif

					@if(isset($productos) && sizeof($productos) > 0)
						<p class="text-rubik">Total de productos: <strong>{{sizeof($productos)}}</strong> </p>
					@elseif(sizeof($productos) > 0)
						<p class="text-rubik">Total de productos: <strong>{{sizeof($productos)}}</strong> </p>
					@endif
				</div>
				<div id="add_alert" style="display: none;" class="alert alert-success">Producto Agregado con éxito!</div>
			</div>
			<section class="row">
				@foreach($productos as $producto)

                    @include('common.card_product')

				@endforeach
			</section>
			<div class="row justify-content-center mt-5">
				{{ $productos->appends(request()->input())->links() }}
			</div>

		</div>
	</div>
</div>

@endsection
