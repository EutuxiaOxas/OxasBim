@extends('layouts.app')

@section('title')
	Carrito
@endsection

@section('content')
<style type="text/css">
	.outspacing {
		padding: 0;
		margin: 0;
	}
</style>

<div class="container">
	<div class="row mt-5">
		@if (session('error'))
		    <div class="alert alert-danger col-12" role="alert">
		        {{ session('error') }}
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		    </div>
		@endif
		<div class="col-12" id="alerts_container">
			
		</div>
		
		@if(auth()->user())
		<div class="col-7" id="product_container" style="border-right: 1px solid #333">
			
		</div>
		@else
		<div class="col-7" id="storage_container" style="border-right: 1px solid #333">
			
		</div>
		@endif
		<div class="col-4 offset-1 d-flex" style="flex-direction: column;">
			<div id="total_container" class="mb-3"></div>
			@if(auth()->user())
			<a href="#" id="boton_comprar" class="btn btn-primary">Contactar</a>
			@else
			<a href="#" class="btn btn-primary">Iniciar Sesión para contactar</a>
			@endif
		</div>
	</div>
</div>


<script type="text/javascript">
//-------------------- INICIALIZACIÓN Y EVENTOS AJAX -----------------
	document.addEventListener('DOMContentLoaded', () =>{
		loadStorage()
		
	});

	function changeCount(id, count){
		axios.post(`/cart/change/count`, {
			detalle_id: id,
			cantidad: count 
		})
		.then(res => {
			alertCount(res.data, 'success')
			callingCart();
		})
	}

	function deleteProduct(id){
		axios.post(`/cart/item/delete/${id}`)
			.then(res =>{
				alertCount(res.data, 'danger')
				callingCart();
			})
	}

	function vaciarCarrito(){
		axios.get('/cart/delete')
			.then(res => {
				alertCount(res.data, 'danger')
				callingCart();
			})
	}

	function alertCount(message, alert)
	{
		let container = document.getElementById('alerts_container')

		container.innerHTML += `
			<div class="alert alert-${alert} col-12" role="alert">
			    ${message}
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			      </button>
			</div>
		`
	}
</script>

<script type="text/javascript">

// ------------------- EVENTOS VISTA CARRITO CON LOCAL STORAGE -----------------------

	// ------------------- Cargar elementos del storage -----------------------

	function loadStorage(){
		const container = document.getElementById('storage_container');
			  
		if(container){

			container.innerHTML = '';

			if(productos.length > 0){
				productos.forEach(producto => {
					
					let menorque = `
					<option ${producto.cantidad == 1 ? 'selected' : ''}>1</option>
					<option ${producto.cantidad == 2 ? 'selected' : ''}>2</option>
					<option ${producto.cantidad == 3 ? 'selected' : ''}>3</option>
					<option ${producto.cantidad == 4 ? 'selected' : ''}>4</option>
					<option ${producto.cantidad == 5 ? 'selected' : ''}>5</option>
					<option ${producto.cantidad == 6 ? 'selected' : ''}>6</option>
					<option ${producto.cantidad == 7 ? 'selected' : ''}>7</option>
					<option ${producto.cantidad == 8 ? 'selected' : ''}>8</option>
					<option ${producto.cantidad == 9 ? 'selected' : ''}>9</option>
					<option ${producto.cantidad == 10 ? 'selected' : ''}>10</option>
					`;

					let mayorque = `
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option selected>${producto.cantidad}</option>
					`;

					container.innerHTML += `
						<div class="mb-4">
							<div class="row">
								<div class="col-5">
									<img src="${producto.image}" style="width: 250px; height: 150px">
								</div>
								<div class="col-4 d-flex" style="flex-direction: column;flex:1; justify-content: center;">
									<h5><a href="/producto/${producto.link}">${producto.title}</a></h5>
									<p>Costo: <strong>${producto.price}</strong></p>
									<button id="${producto.id}" class="btn btn-sm btn-outline-primary carrito_eliminar_storage">Eliminar producto</button>
								</div>
								<div class="col-3 d-flex" style="flex-direction: column;flex:1; justify-content: center;">
									<h5>Cantidad</h5>
									<select id="${producto.id}" class="form-control selector_carrito_storage">
											${producto.cantidad <= 10 ? menorque : mayorque}
									</select>
								</div>
							</div>
						</div>
					`
				});
				container.innerHTML += `
					<div class="col-12 my-3">
						<a href="#" id="carrito_vaciar_storage" class="btn btn-danger btn-block">Vaciar carrito</a>
					</div>
				`
				loadTotalProducts(productos, 0)
				eventosStorage();
			}else {
				container.innerHTML = '<h2>No hay productos disponibles</h2>';
			}
		}
	}



	// ------------------- Cargar eventos a botones de los productos -----------------------
	function eventosStorage(){
		let changeCantidad = document.querySelectorAll('.selector_carrito_storage'),
			vaciarCarrito = document.getElementById('carrito_vaciar_storage'),
			deleteProduct = document.querySelectorAll('.carrito_eliminar_storage');

		if (changeCantidad){

			changeCantidad.forEach(element => {
				element.addEventListener('change', (e) =>{

					let id = e.target.id,
						cantidad = e.target.value;


					updateCount(id, cantidad);
				});
			})
		}

		if(deleteProduct){

			deleteProduct.forEach(element => {

				element.addEventListener('click', e => {

					let id = e.target.id;
					productos = destroyProduct(productos,id)


					storage.addStorage(productos)
						.then(res => {
							carrito.agregarCarrito(productos);
							loadStorage()
							alertCount('Producto eliminado con éxito', 'danger');
							loadTotalProducts(productos, 0)
						})
				});
			})
		}

		if(vaciarCarrito){

			vaciarCarrito.addEventListener('click', (e) =>{

				e.preventDefault()
				destroyCarrito();
				
			});
		}
	}

	// ------------------- Actualizar cantidad del producto -----------------------
	function updateCount(id, count){
		productos.forEach(producto => {
			if(producto.id == id){
				producto.cantidad = count;
			}
		})

		storage.addStorage(productos)
			.then(res => {
				carrito.agregarCarrito(productos);
				alertCount('Cantidad del producto actualizada con éxito!', 'success');
				loadTotalProducts(productos, 0)
			})
	}

	// ------------------- Eliminar producto -----------------------
	function destroyProduct(productos, id){
		return productos.filter(function(producto){
			return producto.id !== id
		});
	}


	// ------------------- vaciar el carrito -----------------------

	function destroyCarrito(){
		productos = []

		storage.addStorage(productos)
			.then(res => {
				carrito.agregarCarrito(productos);
				loadStorage()
				alertCount('Carrito vaciado con éxito!', 'danger');
				loadTotalProducts(productos, 0)
			})
	}
</script>

@endsection