<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@lading')->name('home');

Route::get('/productos', 'HomeController@products')->name('productos');
Route::get('/producto/{slug}', 'HomeController@showProduct')->name('producto.show');
Route::get('/categoria-productos/{slug}', 'HomeController@showProductsByCategory')->name('product.category.show');


Route::get('/cart', 'CartController@getCart');
Route::get('/cart/ver', 'HomeController@verCarrito');
Route::post('/cart/add', 'CartController@addToCart');
Route::post('/cart/storage', 'CartController@addStorageToCart');
Route::post('/cart/item/delete/{id}', 'CartController@eliminarDetalle')->name('cart.detail.destroy');
Route::get('/cart/delete', 'CartController@vaciarCarrito')->name('cart.destroy');
Route::post('/cart/change/count', 'CartController@updateCount');

Auth::routes();

/*---------------Login --------------*/
Route::get('/admin', 'Cms\LoginController@index');

//Metodo posts
Route::post('/cms/login', 'Cms\LoginController@login')->name('login.admin');
Route::post('/admin/logout', 'Cms\LoginController@logout')->name('login.logout');

/*---------------CMS ACCESO --------------*/

Route::middleware('cms')->group(function () {
	Route::get('/cms', 'Cms\IndexController@index')->name('cms.home');
});

/*---------------ADMINISTRADORES --------------*/
Route::middleware('admin')->group(function () {
	/*---------------Usuarios --------------*/
		Route::get('/cms/admin_users', 'Cms\IndexController@adminUsers')->name('cms.users');
		Route::get('/cms/get/user/{id}', 'Cms\UserController@getUser');
		//Metodo posts
		Route::post('/cms/user/create', 'Cms\UserController@makeUser')->name('cms.users.create');
		Route::post('/cms/update/user/{id}', 'Cms\UserController@editUser');
		Route::post('/cms/password/user/{id}', 'Cms\UserController@editPassword');
		Route::post('/cms/eliminar/user/{id}', 'Cms\UserController@eliminarUsuario');
});

/*---------------EDITORES LANDING PAGE CMS--------------*/
Route::middleware('landing')->group(function () {
	
	Route::get('/cms/banners', 'Cms\LogoBannerController@index')->name('banners.home');
	Route::get('/cms/crear/banner', 'Cms\LogoBannerController@crearBanner')->name('banners.create');
	Route::get('/cms/editar/banner/{id}', 'Cms\LogoBannerController@editarBanner')->name('banners.show');

		//posts
	Route::post('/cms/guardar/banner', 'Cms\LogoBannerController@guardarBanner')->name('banners.store');
	Route::post('/cms/actualizar/banner/{id}', 'Cms\LogoBannerController@actualizarBanner')->name('banners.update');
	Route::post('/cms/eliminar/banner/{id}', 'Cms\LogoBannerController@eliminarBanner')->name('banners.destroy');
	Route::post('/cms/guardar/logo', 'Cms\LogoBannerController@guardarLogo')->name('banners.logo');

	//ocultar/activar banners
	Route::get('/cms/activar/banner/{id}', 'Cms\LogoBannerController@activarBanner')->name('banners.active');
	Route::get('/cms/ocultar/banner/{id}', 'Cms\LogoBannerController@ocultarBanner')->name('banners.desactive');

});

Route::middleware('tienda')->group(function () {
	
	/*--------------- VISTA TIENDA VIRTUAL --------------*/
	Route::get('/cms/tienda', 'Cms\CmsController@tiendaVirtual')->name('tienda.home');

		/*--------------- CATEGORIAS --------------*/
	Route::get('/cms/tienda/categorias', 'Cms\CategoryController@index')->name('tienda.category.home');
	Route::get('/cms/tienda/get/category/{id}', 'Cms\CategoryController@getCategory');
		//metodos posts
	Route::post('/cms/categoria/verify/{slug}', 'Cms\CategoryController@verifySlug');
	Route::post('/cms/tienda/guardar/categoria', 'Cms\CategoryController@guardarCategoria')->name('tienda.category.store');
	Route::post('/cms/tienda/actualizar/categoria/{id}', 'Cms\CategoryController@atualizarCategoria');
	Route::post('/cms/tienda/eliminar/categoria/{id}', 'Cms\CategoryController@eliminarCategoria');


		/*--------------- PRODUCTOS --------------*/
	Route::get('/cms/tienda/productos', 'Cms\ProductController@index')->name('tienda.product.home');

	Route::get('/cms/tienda/crear/producto', 'Cms\ProductController@crearProducto')->name('tienda.product.create');

	Route::get('/cms/tienda/editar/producto/{id}', 'Cms\ProductController@editarProducto')->name('tienda.product.show');

	Route::post('/cms/productos/verify/{slug}', 'Cms\ProductController@verifySlug');

	Route::post('/cms/tienda/guardar/producto', 'Cms\ProductController@guardarProducto')->name('tienda.product.store');

	Route::post('/cms/tienda/actualizar/producto/{id}', 'Cms\ProductController@actualizarProducto')->name('tienda.product.update');

	Route::post('/cms/tienda/eliminar/producto/{id}', 'Cms\ProductController@eliminarProducto');

		/*--------------- PRODUCTOS IMAGENES --------------*/
	Route::post('/cms/update/product/image/{id}', 'Cms\ProductImageController@editImage');
});