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
			
			<a href="{{route('order.store')}}" id="boton_comprar" class="btn btn-primary">Comprar</a>

			@else
			
			<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalLogin">Iniciar Sesión para comprar</a>

			@endif
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div id="modal_option_container">
        	<button class="btn btn-primary sesion modal_option">Iniciar sesión</button>
        	<button class="btn btn-outline-primary registro modal_option">Registrarse</button>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="login_modal" class="modal_container">
        	<form action="" method="POST">
        		<div id="alert_container">
        			
        		</div>
        		<div class="form-group">
        			<h5>Correo</h5>
        			<input id="modal_login_email" class="form-control" type="email" name="email" autocomplete="off">
        		</div>
        		<div>
        			<div class="form-group">
        			<h5>Contraseña</h5>
        			<input id="modal_login_password" class="form-control" type="password" name="password" autocomplete="off">
        		</div>
        		<input type="submit" id="modal_login_submit" class="btn btn-primary" value="Iniciar sesion">
        		</div>
        	</form>
        </div>

        <div id="register_modal" class="modal_container" style="display: none;">
        	<form action="{{route('register')}}" method="POST">
        		<div id="modal_register_token">
        			@csrf
        		</div>
        		<div class="form-group">
        		    
        			<h5>Nombre</h5>
    		        <input id="modal_register_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        		</div>

        		<div class="form-group">
        		    
        			<h5>Apellido</h5>
    		        <input id="modal_register_apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="email">    
        		</div>

        		<div class="form-group">
        		    
        			<h5>Correo</h5>
    		        <input id="modal_register_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        		</div>

        		<div class="form-group">
        		    
        			<h5>Telefono</h5>
    		        <input id="modal_register_phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="email">
        		</div>

        		<div class="form-group">
        		    

        			<h5>Contraseña</h5>
    		        <input id="modal_register_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    		        <a href="#"><small class="inactive pass_watcher">Ver contraseña</small></a>
        		</div>

        		<div class="form-group">
        		    
        			<h5>Confirmar contraseña</h5>
    		        <input id="modal_register_confirm_password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    		        <a href="#"><small class="inactive pass_watcher">Ver contraseña</small></a>
        		</div>
        		<div class="form-group ">
        			<button id="modal_register_submit" type="submit" class="btn btn-primary col-md12">
        			    {{ __('Registrarse') }}
        			</button>
        		</div>	
        	</form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
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



<script type="text/javascript">
// ------------------- MODAL INICIAR SESION O REGISTRARSE -----------------------
	const modal_option_container = document.getElementById('modal_option_container'),
		  modal_options = document.querySelectorAll('.modal_option');

    // ------------------- Evento botones de opciones -----------------------
	modal_option_container.addEventListener('click', e => {
		let elemento = e.target

		if(e.target.classList.contains('sesion')){
			modal_sesion_option(elemento)
		}

		if(e.target.classList.contains('registro')){
			modal_register_option(elemento)
		}
	});

	function modal_sesion_option(element){
		let login_modal = document.getElementById('login_modal');
		cleanModalOptions()

		element.classList.remove('btn-outline-primary');
		element.classList.add('btn-primary');

		login_modal.style.display = 'block';
	}

	function modal_register_option(element){
		let register_modal = document.getElementById('register_modal');
		cleanModalOptions()
		element.classList.remove('btn-outline-primary');
		element.classList.add('btn-primary');
		
		register_modal.style.display = 'block';
	}


	function cleanModalOptions(){
		const modal_containers = document.querySelectorAll('.modal_container');

		modal_options.forEach(button => {
			button.classList.remove('btn-primary');
			button.classList.add('btn-outline-primary');
		});

		modal_containers.forEach(container => {
			container.style.display = 'none';
		});
	}
</script>


<script type="text/javascript">

	// ------------------- INICIO DE SESION Y REGISTRO -----------------------
	const modal_login_submit = document.getElementById('modal_login_submit'),
		  modal_register_submit = document.getElementById('modal_register_submit');

	modal_login_submit.addEventListener('click', e => {
		e.preventDefault();
		loadSesion()
	})

	modal_register_submit.addEventListener('click', e => {
		e.preventDefault();
		let name = document.getElementById('modal_register_name'),
			apellido = document.getElementById('modal_register_apellido'),
			email = document.getElementById('modal_register_email'),
			phone = document.getElementById('modal_register_phone'),
			password = document.getElementById('modal_register_password'),
			token = document.getElementById('modal_register_token').children[0],
			confirm_password = document.getElementById('modal_register_confirm_password');
		
		loadRegister(name.value, apellido.value, email.value, phone.value, password.value, confirm_password.value, token.value)
	})

	// ------------------- INICIAR SESION -----------------------
	function loadSesion(){
		let correo = document.getElementById('modal_login_email'),
			contraseña = document.getElementById('modal_login_password'),
			alert_container = document.getElementById('alert_container');

		axios.post('/login', {
			email: correo.value,
			password: contraseña.value,
		})
		.then(res => {
			if(res.status == 204){
				location.reload();
			}
		})
		.catch(err => {
			alert_container.innerHTML = `
				<div class="alert alert-danger col-12" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
				    Usuario o contraseña incorrectos, por favor intentar nuevamente

				</div>
			`
		})
	}

	// ------------------- REGISTRARSE -----------------------
	function loadRegister(name, apellido, email, phone, password, confirm_password, token){

		axios.post('/register', {
			name: name,
			apellido: apellido,
			email: email,
			phone: phone,
			password: password,
			password_confirmation: confirm_password,
			_token: token,
		})
		.then(res=> {
			location.reload();
		})
		.catch(err => {
			console.log(err)
		})
	}
</script>
<script type="text/javascript">
// ------------------- MOSTRAR CONTRASEÑAS -----------------------
    let passChange = document.querySelectorAll('.pass_watcher');

    passChange.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            let inputPass = e.target.parentNode.parentNode.children[1];
            let accion = e.target;


            if(accion.classList.contains('inactive'))
            {
                inputPass.type = "text"
                accion.classList.remove('inactive')
                accion.classList.add('active')

                accion.textContent = 'Ocultar contraseña';
            } else if(accion.classList.contains('active')) {
                inputPass.type = "password"
                accion.classList.remove('active')
                accion.classList.add('inactive')

                accion.textContent = 'Ver contraseña';
            }
        });
    });
</script>


@endsection