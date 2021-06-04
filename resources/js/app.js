require('./bootstrap');

const rootURL = document.getElementById('rootURL').textContent;
const addProduct = document.querySelectorAll('.addProduct')

// Agregar productos al carrito de compras
if(addProduct != null){
    addProduct.forEach(item => {
        item.addEventListener('click', event => {
            // obtengo el id del producto
            const productId = event.target.id;
            // Obtengo la cantidad a agraegar
            const select_quantity = document.getElementById('quantity_product_'+productId);
            let quantity = select_quantity.value

            // Obtengo los datos del localstorage
            let ProductsLocalStorage = localStorage.getItem('productsShoppingCar');

            // Hay elementos en el carrito de compras?
            if(ProductsLocalStorage === null) {

                let newProduct = {
                    id: productId,
                    quantity: quantity
                }

                ProductsLocalStorage = '['+JSON.stringify(newProduct)+']';

                // Almaceno el producot en el localStorage
                localStorage.setItem('productsShoppingCar',ProductsLocalStorage);

                updateBadgeQuantityShoppingcar();

            }else{
                // Llevo el string al formato JSON
                arrayProductsLocalStorage = JSON.parse(ProductsLocalStorage);

                // Actulaizo el localstorage
                updateShoppingCar(arrayProductsLocalStorage, productId, quantity);
            }
            // Notifico que se agrego exitosamente
            successProductAdd();

        });
    });
}

// Editar productos desde el modal de carrito de compras
const openModalCar = document.querySelectorAll('.openModalCar');

openModalCar.forEach(item => {
    item.addEventListener('click', event => {
        // Obtengo los datos del localstorage
        let ProductsLocalStorage = localStorage.getItem('productsShoppingCar');
        // Contenedor donde se agregaran los prodcuctos del carrito de compras
        const containerBodyShoppingCard = document.getElementById('containerBodyShoppingCard')
        containerBodyShoppingCard.innerHTML = ''

        //  selecciono el pie del modal
        const footerModalShoppingCar = document.getElementById('footerModalShoppingCar');

        if( ProductsLocalStorage !== null ){
            // Llevo el string al formato JSON
            arrayProductsLocalStorage = JSON.parse(ProductsLocalStorage);

            // Obtengo el card de ejemplo
            let cardExample = document.getElementById('cardExample');
            // Recorro todos los productos del local storage
            arrayProductsLocalStorage.forEach(product => {
                newCardProductShoppingCar = cardExample.firstElementChild.cloneNode(true);
                // Obtengo los campos del card  clonado
                let newTitle = newCardProductShoppingCar.querySelector('.title_modal_cart');
                let newPrice = newCardProductShoppingCar.querySelector('.price_modal_cart');
                let newImage = newCardProductShoppingCar.querySelector('.img_modal_cart');
                let selectQuantity = newCardProductShoppingCar.querySelector('.cantidad_producto_cart');
                // obtengo el id del producto y la cantidad agregada
                let productId = product.id;
                let quantity= product.quantity;
                selectQuantity.id = productId;
                // Obtengo los datos del producto
                 axios.get('/get/product-id/'+productId).then( function(response){
                    const { data } = response
                    let title = data.title
                    let price = data.price
                    let image = data.image
                    let quantityBD = data.quantity

                    // Asigno los valores del local storage a los campos html
                    newPrice.textContent = `${price} $`
                    newTitle.textContent = title;
                    newImage.src = `${rootURL}/storage/${image}`;

                    // cantidad
                    if(quantityBD >= 10){
                        for (let i = 1; i < 11; i++) {
                            let option=document.createElement("option");

                            option.value=i;
                            option.text=i;

                            // veo si la cantidad coincide
                            if( i == quantity ){
                                option.setAttribute('selected', '')
                            }

                            selectQuantity.appendChild(option)
                        }

                    }

                });
                // Inserto el card en el modal
                containerBodyShoppingCard.appendChild(newCardProductShoppingCar);

                // cambio el local storage en caso de que cambie el select del producto
                selectQuantity.addEventListener('change', event => {
                    newQuantity = event.target.value
                    productId = event.target.id

                    // Obtengo los datos del localstorage
                    let ProductsLocalStorage = localStorage.getItem('productsShoppingCar');

                    // Llevo el string al formato JSON
                    arrayProductsLocalStorage = JSON.parse(ProductsLocalStorage);

                    // Actulaizo el localstorage
                    updateShoppingCar(arrayProductsLocalStorage, productId, newQuantity);

                })

            });

            footerModalShoppingCar.removeAttribute('hidden')

        }else{
            footerModalShoppingCar.setAttribute('hidden', '')
            containerBodyShoppingCard.textContent = 'No tienes productos agragados al carrito.'
        }


    });
});


// VAciar el carrito de compras
const vaciar_carrito_cart = document.getElementById('vaciar_carrito_cart')

vaciar_carrito_cart.addEventListener('click', event => {
    localStorage.removeItem('productsShoppingCar');
    $('#modalCarritoCompras').modal('hide')
    updateBadgeQuantityShoppingcar();
})


function updateShoppingCar (arrayProductsLocalStorage, productId, quantity){

    let productInShppingCar = false;

    // Recorro los valores del localstorage y veo si el producto ya estaba agregado
    arrayProductsLocalStorage.forEach(product => {
        if (productId == product.id ){
            productInShppingCar = true;
            product.quantity = quantity;
        }
    });

    // El producto no estaba en el carrito de compras
    if (!productInShppingCar){

        let newProduct = {
            id: productId,
            quantity: quantity
        }

        arrayProductsLocalStorage.push(newProduct);

    }
    // Almaceno el producot en el localStorage
    localStorage.setItem('productsShoppingCar',JSON.stringify(arrayProductsLocalStorage));
    // Actualizo el span de cantidad de productos en el carrito
    updateBadgeQuantityShoppingcar();

}

function updateBadgeQuantityShoppingcar(){
    // Obtengo los datos del localstorage
    let ProductsLocalStorage = localStorage.getItem('productsShoppingCar');

    // obtengo el span
    const carrito_badge = document.getElementById('carrito_badge');

    if( ProductsLocalStorage !== null ){
        // Llevo el string al formato JSON
        arrayProductsLocalStorage = JSON.parse(ProductsLocalStorage);
        let quantityTotal = 0;
        arrayProductsLocalStorage.forEach(product => {
            quantityTotal+= parseInt(product.quantity) ;
        });

        if( quantityTotal > 0 ){
            carrito_badge.removeAttribute('hidden')
            carrito_badge.firstElementChild.textContent = quantityTotal
        }else{
            carrito_badge.setAttribute('hidden', '')
        }
    }else{
        carrito_badge.setAttribute('hidden', '')
    }
}

// Funcion para notificacion de producto agregado exitosamente
function successProductAdd(){
    let messageSuccess = document.getElementById("message_success");
    messageSuccess.style.visibility = "visible";
    messageSuccess.style.opacity = "1";
    messageSuccess.classList.add('transitionClean');
    setTimeout(hiddenMessageAddProduct,2250);
    function hiddenMessageAddProduct(){
        messageSuccess.style.opacity = "0";
        messageSuccess.style.visibility = "hidden";
        messageSuccess.classList.remove('transitionClean');
    }
}

// Al cargar el sitio web
$(window).on('load', function () {
    updateBadgeQuantityShoppingcar()
})


// Al abrir el modal de Datos
const openModalDatos = document.getElementById('openModalDatos')

openModalDatos.addEventListener('click', event => {
    // Obtengo los datos del localstorage
    let ProductsLocalStorage = localStorage.getItem('productsShoppingCar');

    const total_products = document.getElementById('total_products');

    total_products.value = ProductsLocalStorage

    const total_amount = document.getElementById('total_amount');

    // Llevo el string al formato JSON
    arrayProductsLocalStorage = JSON.parse(ProductsLocalStorage);
    let amount = 0;
    // recorro los productos del localstorage
    arrayProductsLocalStorage.forEach(product => {
        let productId = product.id;
        let quantity = product.quantity;
        // busco los valores de ada producto
        axios.get('/get/product-id/'+productId).then( function(response){
            const { data } = response
            let price = data.price
            console.log(price)

            amount+= parseInt(price*quantity);
            total_amount.value = amount
        });
    });

})
