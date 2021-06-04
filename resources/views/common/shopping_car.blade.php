{{-- carrito de compras --}}
<div class="modal fade" id="modalCarritoCompras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carrito de compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cart_body">

                <div hidden id="cardExample">
                    <div class="product_main row mb-2">
                        <div class="col-3 col-lg-2">
                            <div class="container_img_modal_cart shadow-md">
                                <img class="img_modal_cart" src="" alt="Imagen Producto en carrito">
                            </div>
                        </div>
                        <div class="col-9 col-lg-10 px-0 pl-4">
                            <div class="row align-items-center">
                                <span class="title_modal_cart mr-3"></span>
                                <span class="price_modal_cart"></span>
                            </div>
                            <div class="row align-items-center mt-2">
                                <div class="col-auto mr-3 px-0">
                                    <span class="cantidad_modal_cart">Cantidad:</span>
                                </div>
                                <div class="col-6 col-md-2">
                                    <select class="form-control cantidad_producto_cart">

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="${producto.id}">
                        </div>
                    </div>
                </div>

                <div id="containerBodyShoppingCard">
                </div>

                <div class="text-center" id="emptyShoppingCar">
                    <strong class="text-lg">No tienes productos en el carrito de compras</strong>
                    <div class="text-center">
                        <img width="50%" src="{{ asset('empty.svg') }}" alt="carrito vacio">
                    </div>
                </div>

            </div>
            <div class="modal-footer" >
                <div hidden id="footerModalShoppingCar">
                    <button id="openModalDatos" class="btn btn btn-primary px-4" data-toggle="modal" data-dismiss="modal" data-target="#modalIrAWhatsapp">Finalizar en Whatsapp</button>
                    <button type="button" id="vaciar_carrito_cart" class="btn btn btn-outline-danger">Vaciar Carrito</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

{{-- Modal de datso del comprador --}}
<div class="modal fade" id="modalIrAWhatsapp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega tus datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-danger" role="alert">
                </div>

                <form action="/ir/whatsapp" id="form_modal_whatsapp" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" id="total_products" name="total_products">
                    <input type="hidden" id="total_amount" name="total_amount">
                    <div class="form-group">
                        <h5>Nombre y apellido</h5>
                        <input class="form-control" type="text" id="form_name" required maxlength="191" name="nombre" placeholder="Ingresa tu nombre y apellido">
                    </div>

                    <div class="form-group">
                        <h5>Correo</h5>
                        <input class="form-control" type="text" required maxlength="191" name="correo" placeholder="Ingresa tu correo electronico">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Continuar" id="finalizarCompra">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Boton Flotante Carrito Cel -->
<div class="float_button_cart d-md-none openModalCar" data-toggle="modal" data-target="#modalCarritoCompras">
    <div class="container_float_cart" id="container_float">
        <i id="cart_icon_id" class="fas fa-shopping-cart"></i>
        <div id="carrito_badge" hidden style="position: absolute; top: -5px; right: -5px;">
            <span class="badge_button_float_quantity"></span>
      </div>
    </div>
</div>
<!-- Producto Agregado al carrito -->
<div id="message_success">¡Agregado con éxito!</div>
