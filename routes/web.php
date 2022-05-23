<?php

use App\Http\Controllers\Admin\ScrapeController;
use App\Http\Controllers\CreateBabylist;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\OverviewBabylist;
use App\Http\Controllers\SaveProductInBabylistController;
use App\Http\Controllers\ShareBabylistController;
use App\Http\Controllers\ShopController;
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
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/create-babylist', function () {
    return view('create_babylist');
})->middleware(['auth']);

// Route::get('/shop', function () {
//     return view('shop');
// });

// Route::get('/product-33', function () {
//     return view('detail-product');
// });

// Route::get('/share-babylist', function () {
//     return view('share_babylist');
// })->middleware(['auth']);

// Route::get('/overview-babylist', function () {
//     return view('overview-babylist');
// });

Route::get('/password-babylist', function () {
    return view('password-babylist');
});
Route::get('/shoppingcart', function () {
    return view('shoppingcart');
});


Route::get('/scraper', [ScrapeController::class, 'show']);
Route::post('/scrape/sub_categories', [ScrapeController::class, 'scrapeSubCategories'])->name('scrape.sub_categories');
Route::post('/scrape/articles', [ScrapeController::class, 'scrapeArticles'])->name('scrape.articles');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/shop', [ShopController::class, "index"])
    ->middleware(['auth'])->name('shop.index');

Route::get('/product-{id}', [DetailProductController::class, "show"]);

Route::get('/babylist-{name}', [OverviewBabylist::class, "show"]);

Route::post('/create-babylist/save', [CreateBabylist::class, "store"])
    ->middleware(['auth'])->name('create_babylist.save');

Route::get('/delete-saved-item', [OverviewBabylist::class, "delete"])
    ->middleware(['auth'])->name('delete-saved-item');

Route::get('/', [CreateBabylist::class, "show"])->middleware(['auth'])->name('home');


Route::get('/save-product-in-babylist', [SaveProductInBabylistController::class, "store"])->middleware(['auth']);

Route::get('/share-babylist-{babylist_id}', [ShareBabylistController::class, "show"])->middleware(['auth']);

Route::post('/share-babylist-{babylist_id}', [ShareBabylistController::class, "share"])->middleware(['auth']);

// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';
