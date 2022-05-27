<?php

use App\Http\Controllers\Admin\ScrapeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CreateBabylist;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\OverviewBabylist;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SaveProductInBabylistController;
use App\Http\Controllers\ShareBabylistController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\WebhookController;
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

// ____________________________ Admin ________________________________________

Route::get('/scraper', [ScrapeController::class, 'show']);
Route::post('/scrape/sub_categories', [ScrapeController::class, 'scrapeSubCategories'])->name('scrape.sub_categories');
Route::post('/scrape/articles', [ScrapeController::class, 'scrapeArticles'])->name('scrape.articles');

// _____________________ Home _______________________

Route::get('/', [CreateBabylist::class, "show"])->middleware(['auth'])->name('home');

// ______________________ Shop _____________________

Route::get('/shop', [ShopController::class, "index"])
    ->middleware(['auth'])->name('shop.index');

// Route::post('/shop', [ShopController::class, "index"])
//     ->middleware(['auth'])->name('shop.index');

// ___________________ Detail page product __________________

Route::get('/product-{id}', [DetailProductController::class, "show"]);

// ____________________ Overview babylist _____________________________

Route::get('/babylist-{name}', [OverviewBabylist::class, "show"])->name('babylist.overview');
Route::post('/babylist-{name}', [OverviewBabylist::class, "show"])->name('babylist.overview');


Route::get('/babylist-{name}/password', [PasswordController::class, "show"])->name('babylist.password');


// _________________________ Create babylist _______________________
// Route::get('/create-babylist', function () {
//     return view('create_babylist');
// })->middleware(['auth']);

Route::get('/create-babylist', [CreateBabylist::class, "showForm"])
    ->middleware(['auth'])->name('create_babylist.showform');

Route::post('/create-babylist', [CreateBabylist::class, "showForm"])
    ->middleware(['auth'])->name('create_babylist.showform');

Route::post('/create-babylist/save', [CreateBabylist::class, "store"])
    ->middleware(['auth'])->name('create_babylist.save');

Route::post('/create-babylist/update', [CreateBabylist::class, "update"])
    ->middleware(['auth'])->name('create_babylist.update');


// _______________________ Saved products ________________
Route::get('/save-product-in-babylist', [SaveProductInBabylistController::class, "store"])->middleware(['auth']);

Route::get('/delete-saved-item', [OverviewBabylist::class, "delete"])
    ->middleware(['auth'])->name('delete-saved-item');


// ________________________ Share babylist ___________________________
Route::get('/share-babylist-{babylist_id}', [ShareBabylistController::class, "show"])->middleware(['auth']);

Route::post('/share-babylist-{babylist_id}', [ShareBabylistController::class, "share"])->middleware(['auth']);


// _________________________ Shoppingcart ____________________________

Route::post('/shoppingcart/add', [OverviewBabylist::class, "shoppingcart"]);

Route::post('/shoppingcart/delete-item', [ShoppingcartController::class, "deleteItem"]);

Route::get('/shoppingcart', [ShoppingcartController::class, "show"]);

// ____________________________ Checkout ________________________________

Route::get('/checkout', [CheckoutController::class, "checkout"]);

Route::get('/webhooks/mollie', [WebhookController::class, "handle"])->name('webhooks.mollie');

Route::get('checkout/success', [CheckoutController::class, "success"])->name('order.success');



// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
