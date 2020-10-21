
// ------- FUNCIONES BOTONES DASHBOARD --------------

    // ----- OBTENER DETALLE DE ORDEN -----

function getOrdenDetail(id){
    axios.get(`/order/Detail/${id}`)
        .then(res => {
            modalInfo(res.data, id);
        })
}


// ---------   FUNCIONES y MODAL PARA INFORMACION DE ENVIOS -------

    // ----- OBTENER DETALLE DE ENVIO -----

function getOrdenInfo(id){
  axios.get(`/get/shiping-info/${id}`)
    .then(res => {
      modalEnvioInfo(res.data, id)
    })
}

    // ----- GUARDAR DATOS DE ENVIO -----

function agregarDatosDeEnvio(d_identidad, dir_1, dir_2, tlfn, c_postal, orden_id){
    axios.post('/guardar/shiping-data', {
        documento_de_identidad: d_identidad,
        direccion_1: dir_1,
        direccion_2: dir_2,
        telefono: tlfn,
        codigo_postal: c_postal,
        orden_id: orden_id
    })
    .then(res => {
        if(res.status === 204){
            getOrdenInfo(orden_id);
        }
    })
}

    // ----- MODAL DETALLES DE ORDEN -----
function modalInfo(detalles, orden){
    let orderId = document.getElementById('detalle_id'),
        container = document.getElementById('modal_container');

    container.innerHTML = ''
    orderId.textContent = `Orden: #${orden}`;

    detalles.forEach(detalle => {
        container.innerHTML += `
            <tr>
              <td>
                  <img src="/storage/${detalle.img}" width="40">
              </td>
              <td>${detalle.title}</td>
              <td>${detalle.cantidad}</td>
              <td>${detalle.price}</td>
            </tr>
        `
    });
}

    // ----- MODAL DETALLES DE ENVIO -----

function modalEnvioInfo(info, orden){
  let container = document.getElementById('modal_info_container'),
      ordenId = document.getElementById('detalle_envio_id');

  container.innerHTML = '';

  if(Object.entries(info).length > 0){
    ordenId.innerHTML = `Información de envio, Orden: #${info.orden_id}`

    container.innerHTML += `
        <div>Identidad: <strong>${info.documento_de_identidad}</strong></div>
        <div>Dirección 1: <strong>${info.direccion_1}</strong> </div>
        <div>Dirección 2: <strong>${info.direccion_2}</strong> </div>
        <div>Telefono: <strong>${info.telefono}</strong> </div>
        <div>Código postal: <strong>${info.codigo_postal}</strong> </div>
    `
  }else {
    ordenId.innerHTML = 'No has agregado ninguna Información de envio, por favor agrega esta informacion'
    container.innerHTML = `
        <a href="#"id="agregar_datos_envio" class="btn btn-primary" >Agregar datos de envio</a>
    `
    document.getElementById('agregar_datos_envio').addEventListener('click', e => {
        
        modalFormularioDatosEnvio(container,orden)
    })
  }
}
    
    // ----- AGREGAR FORMULARIO EN MODAL DATOS DE ENVIO PARA GUARDAR LOS DATOS -----

function modalFormularioDatosEnvio(container, orden_id){
    container.innerHTML = `
        <form>
            <div class="form-group row">
                <label for="name" class="col-md-5 col-form-label text-md-right">Documento de identidad</label>

                <div class="col-md-6">
                    <input id="documento_de_identidad" type="text" class="form-control" name="documento_de_identidad" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="direccion_1" class="col-md-5 col-form-label text-md-right">dirección 1</label>

                <div class="col-md-6">
                    <input id="direccion_1" type="text" class="form-control" name="direccion_1" required >
                </div>
            </div>

            <div class="form-group row">
                <label for="direccion_2" class="col-md-5 col-form-label text-md-right">dirección 2</label>

                <div class="col-md-6">
                    <input id="direccion_2" type="text" class="form-control" name="direccion_2"  required >
                </div>
            </div>

            <div class="form-group row">
                <label for="telefono" class="col-md-5 col-form-label text-md-right">Telefono</label>

                <div class="col-md-6">
                    <input id="telefono" type="text" class="form-control" name="telefono" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="codigo_postal" class="col-md-5 col-form-label text-md-right">Código_postal</label>

                <div class="col-md-6">
                    <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" required>
                </div>
            </div>
            <div class="col-md-6 offset-md-4">
                <button type="submit" id="edit_datos_envio" class="btn btn-primary">
                    Agregar datos de envio
                </button>
            </div>
        </form>
    `;

    document.getElementById('edit_datos_envio').addEventListener('click', e => {
        e.preventDefault();
        let documentoIdentidad = document.getElementById('documento_de_identidad'),
            direccion_1 = document.getElementById('direccion_1'),
            direccion_2 = document.getElementById('direccion_2'),
            telefono = document.getElementById('telefono'),
            codigo_postal = document.getElementById('codigo_postal');

        agregarDatosDeEnvio(documentoIdentidad.value, direccion_1.value, direccion_2.value, telefono.value, codigo_postal.value, orden_id)
    })
}


// ---------   FUNCIONES y MODAL PARA INFORMACION DE PAGOS -------


    // ----- FUNCION PARA OBTENER INFORMACION DE LOS PAGOS POR ORDEN -----
function getPagoInfo(id){
    axios.get(`/obtener/pago/${id}`)
        .then(res => {
            modalPagoInfo(res.data)
        });
}

    // ----- FUNCION QUE RELLENA EL MODAL CON LOS DETALLES DE CADA PAGO -----
function modalPagoInfo(data){
    const container = document.getElementById('modal_pago_container');

    let container_info = container.children[0],
        container_detalles = container.children[2];

    container_info.innerHTML = `
        <div>
            <h5>Pago total de la orden #${data.orden_id}: ${data.total_pago} $</h5>
            <p>Restante por pagar: ${data.restante <= 0 ? '0' : data.restante} $</p>
        </div>
    `

    container_detalles.innerHTML = '';

    if(data.restante <= 0){
        data.pagos.forEach(({titular, monto, banco_emisor, banco_receptor, referencia, fecha, identidad_titular,numero}) => {
            container_detalles.innerHTML += `
                <div class="mr-2 p-2" style="flex: 1 0 50; border: 1px solid #333;">
                    <h5 class="m-0 mb-1">Transferencia: <strong>#${numero}</strong></h5>
                    <h6 class="m-0">Titular: <strong>${titular}</strong></h6>
                    <p class="m-0">Identidad titular: <strong>${identidad_titular}</strong></p>
                    <p class="m-0">Banco emisor: <strong>${banco_emisor}</strong></p>
                    <p class="m-0">Banco receptor: <strong>${banco_receptor}</strong></p>
                    <p class="m-0">Monto: <strong>${monto} $</strong></p>
                    <p class="m-0">Rereferencia: <strong>${referencia}</strong></p>
                    <p class="m-0">Fecha: <strong>${fecha}</strong></p>
                    
                </div>
            `
        });
    }else if(data.restante > 0){

        if(data.pagos.length > 0){
            container_detalles.innerHTML += `<h4 style="flex: 1 0 100%;">Completa tu pago para finalizar tu compra.</h4>`;
            data.pagos.forEach(({titular, monto, banco_emisor, banco_receptor, referencia, fecha, identidad_titular,numero}) => {
                container_detalles.innerHTML += `
                    <div class="mr-2 p-2" style="flex: 1 0 50; border: 1px solid #333;">
                        <h5 class="m-0 mb-1">Transferencia: <strong>#${numero}</strong></h5>
                        <h6 class="m-0">Titular: <strong>${titular}</strong></h6>
                        <p class="m-0">Identidad titular: <strong>${identidad_titular}</strong></p>
                        <p class="m-0">Banco emisor: <strong>${banco_emisor}</strong></p>
                        <p class="m-0">Banco receptor: <strong>${banco_receptor}</strong></p>
                        <p class="m-0">Monto: <strong>${monto} $</strong></p>
                        <p class="m-0">Rereferencia: <strong>${referencia}</strong></p>
                        <p class="m-0">Fecha: <strong>${fecha}</strong></p>
                    </div>
                `
            });
            container_detalles.innerHTML += `
                <div style="flex: 1 0 100%;">
                    <a href="/cuentas?orden=${data.orden_id}&nuevo_pago=true" class="btn btn-primary mt-4">Agregar nuevo pago</a>
                </div>
            `

        }else {
            container_detalles.innerHTML = `
                <div style="flex-direction: column;">
                    <h5>Debe realizar un pago para completar su compra.<h5>
                    <div>
                        <a href="/cuentas?orden=${data.orden_id}" class="btn btn-primary">Realizar Pago</a>
                    </div>
                </div>
            `
        }
    }
}

let ordenDetails = document.querySelectorAll('.orden-detalle'),
    ordenEnvios = document.querySelectorAll('.orden-envio-info'),
    ordenPagos = document.querySelectorAll('.orden-pago-info');

document.addEventListener('DOMContentLoaded', () => {
    if(ordenDetails){
        ordenDetails.forEach(detalle => {
            detalle.addEventListener('click', e => {
                let id = e.target.id
                getOrdenDetail(id)
            });
        });
    }

    if(ordenEnvios){
      ordenEnvios.forEach(info => {
        info.addEventListener('click', e => {
          let id = e.target.id;
          getOrdenInfo(id)
        })
      })
    }

    if(ordenPagos){
        ordenPagos.forEach(pago => {
            pago.addEventListener('click', e => {
                let id = e.target.id;
                getPagoInfo(id);
            })
        })
    }
})

