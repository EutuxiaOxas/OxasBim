@extends('layouts.app')

@section('title')
	Productos
@endsection

@section('content')


	<style type="text/css">
		.acordeon_container{
            max-height: 0;
            overflow: hidden;
            transition: all .1s linear;
        }

        .acordeon_container.active{
        	max-height: 10rem;
        }

        .arrow_class {
        	transition: all .1s ease;
        }

        .arrow_class.active{
        	transform: rotate(-90deg);
        }

        .sub_categorie_item{
        	list-style: none;
        	padding: 0;
        }

		/*Stilos Navbar lateral*/
		.span-circle{
			background-color: #f3f5f9;
			border-radius: 50%;
			width: 25px!important;
			height: 25px!important;
			padding: 0.3rem;
			cursor: pointer;
		}
		.acordeon_container{
			padding-left: 1rem;
		}
		.acordeon_container li{
			padding-top: 0.5rem;
		}
		#categories_container a{
			color: #222;
		}
		#categories_container a:hover{
			text-decoration: none;
		}
	</style>

<div class="container-fluid px-md-5">
	<div class="row pt-2">
		
		@include('common.navbar_left')
				
		<div class="col-12 col-md-10 pl-4 ">
			<div class="row">
				<div class="col-12 my-3">
					@if(isset($product_categorie))
					<h1 class="text-rubik">Productos en categoria: <small>{{$product_categorie->title}}</small></h1>
					@else
					<h1 class="text-rubik">Productos</h1>
					@endif

					@if(isset($productos) && sizeof($productos) > 0)
						<p style="font-family:Rubik">Total de productos: <strong>{{sizeof($productos)}}</strong> </p>
					@elseif(sizeof($productos) > 0)
						<p style="font-family:Rubik">Total de productos: <strong>{{sizeof($productos)}}</strong> </p>
					@endif
				</div>				
				<div id="add_alert" style="display: none;" class="alert alert-success">Producto Agregado con éxito!</div>
			</div>
			<section class="row">
				@foreach($productos as $producto)
				{{-- Product Card --}}
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