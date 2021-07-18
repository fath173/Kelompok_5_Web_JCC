<?php

// untuk Auth
use App\Http\Livewire\Auth\Login as loginn;
use App\Http\Livewire\Auth\Register as regis;
// use App\Http\Livewire\Auth\Logout;

// untuk backend
use App\Http\Controllers\Backend\orderadmin;
use App\Http\Livewire\Backend\Gallery\Galeri;
use App\Http\Livewire\Backend\Orders\Orderadmin as adminOrder;
use App\Http\Livewire\Backend\Pelanggan\Pelanggan;
use App\Http\Livewire\Backend\Petugas\Petugas;
use App\Http\Livewire\Backend\Products\Product as ProductsAdmin;
use App\Http\Livewire\Backend\Products\ProductVariation;
use App\Http\Livewire\Backend\Report\ReportOrders;
use App\Http\Livewire\Backend\Testimonial\Testimoni;

// untuk frontend
use App\Http\Livewire\Frontend\Accounts\Account;
use App\Http\Livewire\Frontend\Accounts\Address;
use App\Http\Livewire\Frontend\Carts\Cart;
use App\Http\Livewire\Frontend\Carts\Checkout;
use App\Http\Livewire\Frontend\Gallery\Galeri as GalleryFrontend;
use App\Http\Livewire\Frontend\Landingpage;
use App\Http\Livewire\Frontend\Orders\Orders;
use App\Http\Livewire\Frontend\Orders\OrdersDetail;
use App\Http\Livewire\Frontend\Orders\Payment;
use App\Http\Livewire\Frontend\Orders\PurchaseOrders;
use App\Http\Livewire\Frontend\Products\Detail;
use App\Http\Livewire\Frontend\Products\Product;
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

// Route::get('/', function () {
//     return view('livewire.frontend.index');
// });

// Route::get('/admin/main', function () {
//     return view('layouts.backend.main');
// });

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', Landingpage::class)->name('/');
Route::get('/products', Product::class);
Route::get('/products/{id}', Detail::class);
Route::get('/gallery', GalleryFrontend::class);

Route::group(['middleware' => 'guest'], function () {
    // Route::get('/home', Landingpage::class);

    Route::get('/loginn', loginn::class)->name('loginn');
    Route::get('/registerr', regis::class)->name('registerr');
});


Route::group(['middleware' => ['auth']], function () {
    // Route::get('/products', Product::class);
    // Route::get('/products/{id}', Detail::class);
    // Route::get('/gallery', GalleryFrontend::class);
    // URL untuk Halaman Pelanggan atau Landing Page
    Route::get('/cart', Cart::class);
    Route::get('/checkout', Checkout::class);
    Route::get('/account', Account::class);
    Route::get('/account-address', Address::class);
    Route::get('/orders', Orders::class);
    Route::get('/orders-detail/{id}', OrdersDetail::class);
    Route::get('/orders-payment/{id}', Payment::class);
    Route::get('/orders-purchase/{id}', PurchaseOrders::class);

    // URL untuk Dashboard/Admin
    Route::get('/admin-orders', adminOrder::class);
    Route::get('/admin-galeri', Galeri::class);
    Route::get('/admin-petugas', Petugas::class);
    Route::get('/admin-products', ProductsAdmin::class);
    Route::get('/admin-products-variation/{id}', ProductVariation::class);
    Route::get('/admin-testimoni', Testimoni::class);
    Route::get('/admin-pelanggan', Pelanggan::class);
    Route::get('/admin-laporan', ReportOrders::class);
});
