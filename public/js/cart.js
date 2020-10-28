//----------------- UI cart class --------------


class CarritoUI {
  constructor(carrito, cart_body) {
    this.cart_body = cart_body;
    this.carrito = carrito;
  }


  agregarCarrito(productos)
  {
  	
  	if(productos.length > 0)
  	{
  		this.cart_body.innerHTML = '';
  		productos.forEach(producto => {
  			let template = ''
  			if(producto.producto){
  				template = `
  					<div class="d-flex pl-2 mb-2">
  						<img src='/storage/${producto.imagen}' class="mr-2" style="width: 25px; height: 25px ;object-fit: cover;">
  						<p>	
  							${producto.producto.title} 

  							<span>(${producto.cantidad})</span>
  						</p>

  					</div>
  				`;
  			}else{
  				template = `
  					<div class="d-flex pl-2 mb-2">
  						<img src='${producto.image}' class="mr-2" style="width: 25px; height: 25px ;object-fit: cover;">
  						<p>	
  							${producto.title} 

  							<span>(${producto.cantidad})</span>
  						</p>

  					</div>
  				`;
  			}
  			this.cart_body.innerHTML+= template;
  			
  		})
  		this.cart_body.innerHTML+= `
  				<div class="text-center">
  					<a href="/cart/ver" class="btn btn-sm btn-primary">Ver Carrito</a>
  				</div>
  			`
  		this.carrito.children[0].children[0].classList.add('cart_on')
  	}else {
  		this.cart_body.innerHTML = 'No hay productos en el carrito';
  		this.carrito.children[0].children[0].classList.remove('cart_on')
  	}

  }

  addingAlert(alert){

  	alert.style.display = 'block';

  	setTimeout( () => {
  		alert.style.display = 'none';
  	}, 1500);
  }


  totalCart(productos, container, value){
  	let total_amount = 0;
  	container.innerHTML = '';

  	if(productos.length > 0){
  		
  		if(value == 1){
  			productos.forEach(producto => {
  				let precio = producto.producto.price,
  					precio_total = precio * producto.cantidad;

  				total_amount = total_amount + precio_total 
  				

  				container.innerHTML += `
  					<div class="d-flex mb-3">
  						<div class=" mr-2">
  							<img src="/storage/${producto.imagen}" style="width: 60px; height: 60px; object-fit: cover;">
  						</div>
  						<div class="d-flex" style="justify-content: space-between; flex:1;">
  							<div>
  								<h5 class="outspacing">${producto.producto.title}</h5>
  								<p class="outspacing"><strong>Cantidad: ${producto.cantidad}</strong></p>
  								<p class="outspacing"><strong>Precio: ${precio}</strong></p>
  							</div>

  							<div>
  								<h5 class="outspacing">Total: <small>${precio_total} $</small></h5>
  							</div>
  						</div>
  						
  					</div>
  				`
  			})
  		}

  		if(value == 0){
  			console.log('sin sesion')

  			productos.forEach(producto => {
  				let precio = producto.price;

  				let cadena = precio.split(" ");

  				precio = cadena[0] * producto.cantidad;

  				total_amount = total_amount + precio 
  				

  				container.innerHTML += `
  					<div class="d-flex mb-3">
  						<div class=" mr-2">
  							<img src="${producto.image}" style="width: 60px; height: 60px; object-fit: cover;">
  						</div>
  						<div class="d-flex" style="justify-content: space-between; flex:1;">
  							<div>
  								<h5 class="outspacing">${producto.title}</h5>
  								<p class="outspacing"><strong>Cantidad: ${producto.cantidad}</strong></p>
  								<p class="outspacing"><strong>Precio: ${producto.price}</strong></p>
  							</div>

  							<div>
  								<h5 class="outspacing">Total: <small>${precio} $</small></h5>
  							</div>
  						</div>
  						
  					</div>
  				`
  			})
  		}

  		container.innerHTML += `
  			<div>
  				<h5>Total a pagar: <strong>${total_amount}$</strong></h5>
  			</div>
  		`
  	}
  }


}

//----------------- API CALLS class --------------

class CartApi {
	async getCart(){
		return axios.get('/cart')	 
	}

	async addToCart(id){

		return axios.post(`/cart/add`, {
			product_id: id,
		})
		
	}
}




//----------------- LocalSorage class --------------


class Storage{
	constructor()
	{
		this.storage = '';
	}


	getStorage(){
		let datos = localStorage.getItem('carrito');
		let cart = JSON.parse(datos)


		if(cart)
		{

			this.storage = cart;
			return this.storage


		}else {
			let cartBody = [];

			localStorage.setItem('carrito', JSON.stringify(cartBody));
			
			cart = localStorage.getItem('carrito');
			this.storage = JSON.parse(cart)
			return this.storage
		}
	}


	async addStorage(products)
	{
		localStorage.setItem('carrito', JSON.stringify(products));
	}

}





//-------------------- Declaracion de variables -----------------
const total_container = document.getElementById('total_container');
let cart_main = document.getElementById('cart_main'),
    cart_body = document.getElementById('cart_body'),
    session = document.getElementById('sesion');

let productos = [];

//-------------------- Inicio de clases -----------------

let storage = new Storage();
let carrito = new CarritoUI(cart_main, cart_body);
let apiCart = new CartApi();



//-------------------- inicio de script -----------------
	
	//-------------------- Sesion no iniciada-----------------
if(session.value == 0)
{
	productos = storage.getStorage();
	let buttonsStorage = document.querySelectorAll('.to_storage'),
		buttonsVerStorage = document.querySelectorAll('.ver_storage');
	
	carrito.agregarCarrito(productos);
	
	if(buttonsStorage)
	{
		events(session.value, buttonsStorage);
	}

	if(buttonsVerStorage){
		events(2, buttonsVerStorage);
	}
}
	
	//-------------------- Sesion iniciada -----------------

if(session.value == 1){
	let	buttonsServer = document.querySelectorAll('.to_server');
	
	productos = storage.getStorage();
	addingStorageToServer(productos);

	// apiCart.getCart()
	// 	.then(res => {
	// 		productos = res.data
	// 		carrito.agregarCarrito(productos)
	// });


	if(buttonsServer)
	{
		events(session.value, buttonsServer);
	}

}



//-------------------- Agregar productos -----------------

function events(value, elements)
{	

	//-------------------- LocalStorage -----------------

	if(value == 0)
	{
		elements.forEach(element => {
			element.addEventListener('click', (e) => {
				let name = e.target.parentNode.parentNode.children[0].textContent,
					id = e.target.id,
					price = e.target.parentNode.parentNode.children[2].textContent,
					image = e.target.parentNode.parentNode.parentNode.children[0].src,
					slug = e.target.parentNode.parentNode.children[3].value,
					alert = document.getElementById('add_alert');

				let producto = {title: name, id: id, image: image, price: price, cantidad: 1, link: slug}

				let verify = verifyProduct(producto);
				if(verify){
					productos.push(producto);
				}


				storage.addStorage(productos)
					.then(res => {
						carrito.agregarCarrito(productos);
						carrito.addingAlert(alert);
					})
			});
		});
	}

	//--------------------Vista producto LocalStorage -----------------
	if(value == 2){
		elements.forEach(element => {
			element.addEventListener('click', (e) => {
				let id = e.target.id,
					padre = e.target.parentNode.parentNode.children[0].children[0],
					name = padre.children[0].textContent,
					price = padre.children[2].textContent,
					image = e.target.parentNode.parentNode.parentNode.children[0].src,
					slug = padre.children[4].value,
					alert = document.getElementById('add_alert');

				console.log(padre)
				let producto = {title: name, id: id, image: image, price: price, cantidad: 1, link: slug}

				
				let verify = verifyProduct(producto);
				if(verify){
					productos.push(producto);
				}


				storage.addStorage(productos)
					.then(res => {
						carrito.agregarCarrito(productos);
						carrito.addingAlert(alert);
					})
			});
		});
	}


	//-------------------- Servidor -----------------

	if(value == 1){
		elements.forEach(element => {
			element.addEventListener('click', (e) => {
				let id = e.target.id,
					alert = document.getElementById('add_alert');

				
				apiCart.addToCart(id)
					.then(res => {
						if(res.status == 200){
							callingCart();
							carrito.addingAlert(alert)
						}
					})
			});
		});
	}
}

	//-------------- VERIFICAR PRODUCTO --------
function verifyProduct(producto){
	let variable;
	let encontrado = '';
	if(productos.length > 0){

		productos.forEach(element => {
			if(element.id == producto.id){
				element.cantidad = element.cantidad + 1;
				variable = false;
				encontrado = 'encontrado';
			}
		});

		if(encontrado.length == 0){
			variable = true;
		}

	}else{
		variable = true;
	}

	return variable;
}

//-------------------- Agregar Storage Al servidor -----------------

function addingStorageToServer(storage){
	if(storage.length > 0)
	{
		axios.post('/cart/storage', {
			products: storage,
		})
		.then(res => {
			if(res.status == 200){
				localStorage.clear();
				callingCart();
			}
		})
	}else{
		callingCart();
	}
}


//-------------------- Llamar carrito de productos -----------------

function callingCart(){
	apiCart.getCart()
		.then(res => {
			productos = res.data;
			carrito.agregarCarrito(productos);
			loadProducts(productos);
			loadTotalProducts(productos, 1)
		})
}


function loadTotalProducts(elements,value){
	if(total_container){
		carrito.totalCart(elements, total_container, value)
	}
}


//-------------------- Llenar productos vista carrito -----------------
function loadProducts(productos){
	let container_products = document.getElementById('product_container');
	if(container_products){
		let boton_comprar = document.getElementById('boton_comprar');
		container_products.innerHTML = ''
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

				container_products.innerHTML += `
					<div class="mb-4">
						<div class="row">
							<div class="col-5">
								<img src="/storage/${producto.imagen}" style="width: 250px; height: 150px">
							</div>
							<div class="col-4 d-flex" style="flex-direction: column;flex:1; justify-content: center;">
								<h5><a href="/producto/${producto.producto.slug}">${producto.producto.title}</a></h5>
								<p>Costo: <strong>${producto.producto.price}</strong></p>
								<button id="${producto.producto.id}" class="btn btn-sm btn-outline-primary carrito_eliminar_storage">Eliminar producto</button>
							</div>
							<div class="col-3 d-flex" style="flex-direction: column;flex:1; justify-content: center;">
								<h5>Cantidad</h5>
								<select id="${producto.producto.id}" class="form-control selector_carrito">
										${producto.cantidad <= 10 ? menorque : mayorque}
								</select>
							</div>
						</div>
					</div>
				`
			});

			container_products.innerHTML += `
				<div class="col-12 my-3">
					<a href="#" id="vaciar_carrito" class="btn btn-danger btn-block">Vaciar carrito</a>
				</div>
			`
			boton_comprar.style.display = 'block';
			loadEventsCartView()
		}else{
			container_products.innerHTML = `
				<h2>No hay productos en el carrito</h2>
			`
			boton_comprar.style.display = 'none';
		}
	}
}

//-------------------- carga de eventos después de cargar productos -----------------
function loadEventsCartView(){
	let cantidadSelect = document.querySelectorAll('.selector_carrito'),
		vaciar_carrito = document.getElementById('vaciar_carrito'),
		eliminarProduct = document.querySelectorAll('.carrito_eliminar_storage');


	//-------------------- Cambiar cantidad del producto -----------------

	if(cantidadSelect){
		cantidadSelect.forEach(cantidad => {
			cantidad.addEventListener('change', (e) =>{
				let id = e.target.id,
					count = e.target.value;

				changeCount(id, count)
			});
		})
	}

	//-------------------- Eliminar producto del carrito -----------------
	if(eliminarProduct){
		eliminarProduct.forEach(button => {
			button.addEventListener('click', e =>{
				deleteProduct(e.target.id)
			})
		})
	}

	//-------------------- Vaciar carrito -----------------
	if(vaciar_carrito){
		vaciar_carrito.addEventListener('click', () =>{
			vaciarCarrito()
		})
	}

	//-------------------- FUNCIONES DE LOS EVENTOS EN LA VISTA CARRITO.BLADE -----------------
}


