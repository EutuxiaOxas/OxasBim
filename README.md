## Manual de uso de plantilla de Desarrollo basada en Laravel 7

El siguiente manual tiene como finalidad explicar paso a paso como usar correctamente la plantilla de desarrollo.

Se tendran en cuenta todos los conflictos, y ediciones necesarias para el correcto uso.

Explicar cual es el correcto orden en que se deben migrar las diferentes ramas hacia la master, para obtener el producto final.

Sugerencia: Agregar todas las ramas a utilizar, reparar los conflictos y por ultimo realizar los respectivos comandos de composer install, npm install y php artisan storage:link

## RAMAS OBLIGATORIAS

## 1- Rama Administrador

La rama administrador contiene:

- Administrador CMS del sitio web
- Usuario de administrador (seed)
- Seccion de usuarios de administracion

---

Para realizar el merge a la master es necesario:

    Dar click en merge y listo


-------------------------------------

## 2- Rama Landin_page

La rama landing_page contiene:

- seccion en el administrador para crear/editar/eliminar banners princiaples
- Usuario con permisos de edicion (seed)
- Nuevo perfil de usuario para edicion de landing page

---

Para realizar el merge a la master es necesario:

    Primero migrar la rama "administrador"
    segundo migrar la rama "landing_page"
    ejecutar comando artisan correspondientes:
        1- phpa artisan migrate
        2-php artisan db:seed

## RAMAS SECUNDARIAS

## Rama blog
La rama Blog contiene:
    
   - Sección en el  administrador para crear/editar/eliminar categorias y articulos
   - cuenta con sistema de categorias principales y sub categorias (categorias hijos)
   - Nuevo perfil de usuario para edición del blog
   - Vista de blog y post individuales

##  Rama Productos
La rama Productos contiene: 

   - Sección en el administrador para crear/editar/eliminar categorias y productos
   - Rol de usuario para edicion de la tienda
   - Vitrina de productos
    
## Rama Carrito de compras
La rama de Carrito contiene: 
    
   - Carrito de compras funcional
   - complementación directa con la rama Productos
   - Vista de carrito de compras completo
   - Observar contenido del carrito desde el menu principal
    
## Rama Compradores
La rama compradores contiene:
    
   - Vista de registro y inicio de sesión para usuarios comunes
   - Inicio de sesion con google
   - Vista de dashboard para el usuario

## Rama Ordenes
La rama Ordenes contiene: 
    
   - Sección en el administrador para observar las ordenes realizadas y los detalles de estas
   - Complementación directa con la rama carrito de compras
   - Funcionalidad del boton comprar para realizar una orden
   - Sección en el dashboard de usuario para ver las ordenes realizadas
    
## Rama Métodos de envios
La rama Metodos de envio contiene:
    
   - Complementación directa con la rama ordenes
   - Agregar dirección de envio al realizar una orden
   - permitir cancelar una orden

## Rama Método de Pagos
La rama Métodos de pagos contiene: 

   - Sección en el administrador para crear/eliminar/editar bancos y cuentas bancarias disponibles
   - Sección en el administrador para ver los pagos realizados
   - complementación directa con la rama Métodos de envios
   - Vista con las cuentas disponibles
   - Vista para registrar pagos por transferencia bancaria
    
## Rama Paypal
La rama Paypal contiene:
    
   - Funcionalidad para realizar pagos con paypal
   - complementación directa con rama Métodos de Pagos

## CONFIGURACIÓN DE LOS MERGES
---------------------------------------
## CONFIGURACION CON TIENDA VIRTUAL
jerarquia de las ramas de la tienda virtual: productos-> carrito de compras-> compradores -> ordenes -> metodos de envio -> metodos de pago -> paypal

    - Paso 1-) Haber agregado las ramas principales administrador y landing page
    
    - Paso 2-) Si se va a utilizar una tienda virtual completa o parcial, hacer primero merge de la rama productos y de todas las ramas dependiente de esta que se vayan a utilizar en el orden anotado arriba
    
    - Paso 3-) Hacer merge de la rama contactanos y reparar los conflictos que surjan (conflictos especificados mas abajo) 
    
    - Paso 4-) Agregar rama blog en caso de ser utilizada y reparar conflictos
    
## CONFLICTOS 
(Aclaración al unir la rama productos con las ramas dependientes no provocará conflictos por ello realizar eso primero)
    
    - Al agregar la rama contactanos se crearan conflictos en el archivo web, mover las rutas de contactanos dentro del bloque de código de Landing page, al final de este
    
    - Reparar conflictos en HomeController, agregar la funcion de contactanos al final y cerrar las llaves incompletas
    
    - En la carpeta Layout/app.blade.php reparar el navbar agregando el enlace a la vista contactanos en un li aparte y quitando los cierre de etiquetas extras que se pudieron haber creado
    
    - Al agregar la rama de blog, en el archivo web agregar el bloque de blog hasta el final y quitar los avisos de conflictos de git
    - Reparar conflicto en HomeController de igual forma que con la rama contactanos
    
    - Reparar de igual forma conflictos en el app.blade.php como se mencionó anteriormente
    
    - Reparar conflicto en la carpeta middleware -> Kernel.php quitando los avisos de conflicto de git y agregando el middleware de blog
    
---------------------------------------

## CONFIGURACIÓN SIN TIENDA VIRTUAL
    
    - Paso 1-) Haber agregado las ramas principales administrador y landing page
    
    - Paso 2-) Agregar rama de contactanos de primero en caso de ser utilizada
    
    - Paso 3-) Agregar rama de blog en caso de ser utilizada y reparar conflictos de Web, HomeController y App.blade.php como se mencionó en los conflictos de Tienda virtual
    
-------------------------------------

## CONFIGURACIÓN DENTRO DEL .ENV PARA CIERTAS FUNCIONES

Agregar credenciales de recaptchap que son esenciales para el uso del administrador:

    - RECAPTCHA_SITE_KEY= 
    - RECAPTCHA_SECRET_KEY= 

Agregar credenciales de google en caso de utilizar el inicio de sesión con google:

    - GOOGLE_CLIENT_ID = 
    - GOOGLE_CLIENT_SECRET =
    
Agregar credenciales de paypal en caso de utilizar pagos a través de este (por ahora en modo de prueba):

    - PAYPAL_CLIENT_ID = 
    - PAYPAL_SECRET = 
    - PAYPAL_MODE = sandbox
