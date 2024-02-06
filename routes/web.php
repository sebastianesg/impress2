<?php

use App\Http\Controllers\cms\AdminController;
use App\Http\Controllers\cms\CatalogController;
use App\Http\Controllers\cms\ChatController;
use App\Http\Controllers\cms\DashboardController;
use App\Http\Controllers\cms\RolController;
use App\Http\Controllers\cms\ProductController;
use App\Http\Controllers\cms\OrderController;
use App\Http\Controllers\cms\ClientController;
use App\Http\Controllers\cms\VariablesController;
use App\Http\Controllers\cms\ComboController;
use Illuminate\Support\Facades\Route;

// locale Route
//Route::get('lang/{locale}', [LanguageController::class, 'swap']);


/*
Todas las rutas del CMS van aca ya que tienen que estar protegidas por usuario / clave
A cada ruta ponerle el prefijo $cmsUrl para indicar de que es una ruta del CMS
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    $cmsUrl = env('APP_CMS');

    Route::get($cmsUrl.'/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource($cmsUrl.'/admins', AdminController::class, ['names' => ['index' => 'admins']])->middleware('check-permission:Administrador');

    Route::resource($cmsUrl.'/roles', RolController::class, ['names' => ['index' => 'roles']]);

    ///CATALOG
    Route::get($cmsUrl.'/{type}/catalogs', [CatalogController::class, 'index'])->where('type', '.*')->name('catalogs');

    Route::get($cmsUrl.'/{type}/catalogs/create', [CatalogController::class, 'create'])->where('type', '.*')->name('catalogs.create');

    Route::get($cmsUrl.'/{type}/catalogs/{cid}/edit', [CatalogController::class, 'edit'])->where('type', '.*')->name('catalogs.edit');

    Route::delete($cmsUrl.'/{type}/catalogs/{cid}', [CatalogController::class, 'destroy'])->where('type', '.*')->name('catalogs.destroy');

    Route::post($cmsUrl.'/{type}/catalogs', [CatalogController::class, 'store'])->where('type', '.*')->name('catalogs.store');

    Route::put($cmsUrl.'/{type}/catalogs', [CatalogController::class, 'update'])->where('type', '.*')->name('catalogs.update');

    Route::post($cmsUrl.'/getCatalogs', [CatalogController::class, 'getCatalogoSelect'])->where('type', '.*')->name('catalogs.select');

    ////CHAT
    Route::get($cmsUrl.'/chat', [ChatController::class, 'index'])->name('chat');

    Route::post($cmsUrl.'/chat/getMessages', [ChatController::class, 'getMessages'])->name('chat.messages');

    Route::post($cmsUrl.'/chat/sendMessage', [ChatController::class, 'sendMessage'])->where('uid', '.*')->name('chat.send');

    //products
    Route::resource($cmsUrl.'/products', ProductController::class)->middleware('check-permission:Administrador,Vendedor');

    Route::get($cmsUrl.'/producto/api', [ProductController::class, 'api'])->name('products.api');

    Route::get($cmsUrl.'/getPdfPrice', [ProductController::class, 'getPdfPrice'])->name('getPdfPrice');

    Route::resource($cmsUrl.'/orders', OrderController::class)->middleware('check-permission:Administrador,Vendedor');
    Route::put('/orders/{orderId}/products/{productId}/mark-completed', [OrderController::class, 'markProductCompleted'])->name('orders.markProductCompleted');
    Route::put('/orders/{orderId}/mark-completed', [OrderController::class, 'markOrderCompleted'])->name('orders.markOrderCompleted');
    Route::resource($cmsUrl.'/clients', ClientController::class)->middleware('check-permission:Administrador,Vendedor');

    Route::get($cmsUrl.'/responsible-for-realization', [OrderController::class, 'ordersResponsibleForRealization'])
    ->name('orders.responsibleForRealization');

Route::get($cmsUrl.'/responsible-for-shipping', [OrderController::class, 'ordersResponsibleForShipping'])
    ->name('orders.responsibleForShipping');

    Route::post($cmsUrl.'/orders/{orderId}/mark-as-ready', [OrderController::class, 'markAsReady'])->name('orders.markAsReady');
Route::post($cmsUrl.'/orders/{orderId}/mark-as-sent', [OrderController::class, 'markAsSent'])->name('orders.markAsSent');
Route::resource($cmsUrl.'/variables', VariablesController::class);
Route::post('update-prices', [ProductController::class, 'updatePrices'])->name('update.prices');

Route::get($cmsUrl.'/import', [ProductController::class, 'showImportForm'])->name('products.import.form');
Route::post($cmsUrl.'/import', [ProductController::class, 'importProducts'])->name('products.import');
Route::post($cmsUrl.'/generate-pdf', [OrderController::class, 'generatePdf']);
Route::resource($cmsUrl.'/combos', ComboController::class);
Route::post('/products/import', [ProductController::class, 'importFromExcel'])->name('products.import');


});


require_once __DIR__ . '/cmsauth.php';
require_once __DIR__ . '/front.php';
