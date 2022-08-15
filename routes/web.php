<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HelpController;

use App\Http\Controllers\LogisticsController;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RulesController;
use Illuminate\Support\Facades\Route;

use Spatie\Sitemap\SitemapGenerator;

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

Route::get('/omniva', function () {
    return view('pages.commerce.omniva');
});

Route::post('/omniva', [LogisticsController::class, 'omniva'])->name('omniva.test');


Route::post('/stripe/initiateCheckout', 'App\Http\Controllers\StripeController@stripeCheckout')->name('stripe-checkout');
Route::get('/stripe/success', 'App\Http\Controllers\StripeController@processStripeSuccess')->name('stripe-success');
// Route::get('/test/checkout', function () {
//     return view('pages.commerce.payment');
// });

// Route::get('/', function () {
//     return view('pages.commerce.welcome');
// })->name('welcome');

Route::get('/', [ProductsController::class, 'welcome'])->name('welcome');

Route::prefix('info')->group(function () {
    Route::get('/purchases', [RulesController::class, 'purchases'])->name('info.purchases');
    Route::post('/ageconfirm', [RulesController::class, 'ageconfirm'])->name('info.ageconfirm');
    Route::post('/cookieagreement', [RulesController::class, 'cookieagreement'])->name('info.cookieagreement');
});

Route::prefix('reviews')->group(function () {
    Route::get('/all', [ReviewController::class, 'reviews_all'])->name('reviews.all');
    Route::post('/add/{id}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/accept/{id}', [ReviewController::class, 'accept'])->name('reviews.accept');
    Route::post('/reject/{id}', [ReviewController::class, 'reject'])->name('reviews.reject');
});

Route::prefix('logistics')->group(function () {
    Route::get('/orders', [LogisticsController::class, 'orders'])->name('logistics.orders');
    Route::get('/allorders', [LogisticsController::class, 'allorders'])->name('logistics.allorders');
    Route::post('/dispatched/{id}', [LogisticsController::class, 'dispatched'])->name('logistics.dispatched');
});

Route::get('sitemap', function () {
    SitemapGenerator::create('https://elektriukai.herokuapp.com/')->writeToFile('sitemap.xml');

    return 'sitemap is created';
});

//Route::get('/invoice', [invoiceController::class, 'show']);

Route::prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    // Route::get('/preview/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/preview/{id}/{slug}', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/search', [ProductsController::class, 'search'])->name('products.search');

    Route::get('/{category}', [ProductsController::class, 'indexCategory'])->name('products.category');
});


Route::prefix('help')->group(function () {
    Route::get('/contact', [HelpController::class, 'contact'])->name('help.contact');
    Route::get('/faq', [HelpController::class, 'faq'])->name('help.faq');
    Route::get('/terms', [HelpController::class, 'termsandagreements'])->name('help.termsandagreements');
    Route::get('/returns', [HelpController::class, 'returns'])->name('help.returns');
    Route::get('/privacy', [HelpController::class, 'privacy'])->name('help.privacy');
});

// Route::get('/duk', function () {
//     return view('pages.support.DUK');
// })->name('duk');

Route::prefix('admin')->group(function () {
    Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/create', [ProductsController::class, 'create'])->name('admin.create');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::get('/toggle', [AdminController::class, 'toggle'])->name('admin.toggle');
});

Route::prefix('cart')->group(function () {
    Route::post('/add/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/update/{id}', [CartController::class, 'edit'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/purchase/receipt', function () {
    return view('emails.purchase');
})->name('purchase.receipt');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('error')->group(function () {
    Route::get('/404', function () {
        return view('pages.error.404');
    });
});

Route::get('/error', function () {
    return view('pages.error.404');
})->name('404');

Route::Fallback(function () {
    return view('pages.error.404');
});
