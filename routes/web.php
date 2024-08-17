<?php
 
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorysController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/', function () {
    return view('login');
})->name('login');

  
Route::controller(AuthController::class)->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
 

// Routes for normal users
Route::middleware(['auth', 'userAccess:user'])->group(function () {
    Route::get('/home', [ViewController::class, 'userviews'])->name('user');
    Route::get('/home', [CategorysController::class, 'indexs'])->name('user');

     // route profile
    Route::get('profiles', [ProfilesController::class, 'indexs'])->name('profiles');
    Route::get('/profiles/edit', [ProfilesController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles', [ProfilesController::class, 'update'])->name('profiles.update');
    Route::get('/anime/search', [AnimeController::class, 'search'])->name('anime.search');
    Route::get('/anime/filter', [AnimeController::class, 'filter'])->name('anime.filter');

    Route::get('episodes', [EpisodesController::class, 'indexs'])->name('episodes');
    Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');

    // routes/web.php
    Route::get('/episode/{id}', [EpisodesController::class, 'shows'])->name('episode.show');


});

// Routes for admins
Route::middleware(['auth', 'userAccess:admin'])->group(function () {
    Route::get('/admin', [ViewController::class, 'adminHomes'])->name('admin');
    // Route Category
    Route::get('/admin', [CategoryController::class, 'indexs']);
    Route::post('/admin', [CategoryController::class, 'stores'])->name('admin');    
    Route::get('/admin/edit/{id}', [CategoryController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.update');
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.destroy');

    // Route Anime
    Route::get('anime', [AnimeController::class, 'indexs'])->name('anime');
    Route::post('anime', [AnimeController::class, 'store'])->name('anime.store');
    Route::put('anime/update/{id}', [AnimeController::class, 'update'])->name('anime.update');
    Route::put('anime/update/{id}', [AnimeController::class, 'update'])->name('anime.update');
    Route::delete('anime/delete/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');
    
     // route profile
    Route::get('profile', [ProfileController::class, 'indexs'])->name('profile');
    // Halaman untuk mengedit profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Mengupdate profil
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('episode', [EpisodeController::class, 'index'])->name('episode');
    Route::post('episode/store', [EpisodeController::class, 'store'])->name('episode.store');
    Route::delete('episode/{id}', [EpisodeController::class, 'destroy'])->name('episode.destroy');

   });
