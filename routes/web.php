<?php

use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
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

Route::post('/start',[AuthController::class, 'login_action'])->name('login.action');


Route::group(['middleware'=>['Makauth']], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');
    Route::get('/marketing/',[MarketingController::class, 'marketing'])->name('home');
    Route::get('/marketing/home',[MarketingController::class, 'marketing'])->name('home');
    Route::get('/marketing/profile',[MarketingController::class, 'profile'])->name('profile');
    Route::get('/marketing/settings',[MarketingController::class, 'setting'])->name('setting');

    //Manage visa card
    Route::get('/marketing/save-card',[MarketingController::class, 'save_card'])->name('save.card');
    Route::get('/marketing/view-card',[MarketingController::class, 'view_card'])->name('view.card');
    Route::get('/marketing/view-demandes',[MarketingController::class, 'view_demandes'])->name('view.demandes');
    Route::get('/marketing/seg-card/{segment}',[MarketingController::class, 'seg_card']);
    Route::get('/marketing/seg-card-detail/{id}',[MarketingController::class, 'show_card']);
    Route::post('/marketing/save',[MarketingController::class, 'saving'])->name('saving');
    Route::get('/marketing/traitement/{id}',[MarketingController::class, 'traitement_demande']);
    Route::get('/marketing/share/{id}{idask}',[MarketingController::class, 'share_demande']);
    /*Route::post('/marketing/search_card',[MarketingController::class, 'search_card'])->name('search_card');*/
});

Route::group(['middleware'=>['Managerauth']], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');
    Route::get('/branch_manager/',[ManagerController::class, 'branch_manager'])->name('home');
    Route::get('/branch_manager/home',[ManagerController::class, 'branch_manager'])->name('home');
    Route::get('/branch_manager/profile',[ManagerController::class, 'profile'])->name('profile');
    Route::get('/branch_manager/settings',[ManagerController::class, 'setting'])->name('setting');


    Route::get('/branch_manager/demander',[ManagerController::class, 'ask_card'])->name('demander');
    Route::post('/branch_manager/sending',[ManagerController::class, 'send'])->name('sending');
    Route::get('/branch_manager/view-card-branch',[ManagerController::class, 'view_card_branch'])->name('view.card_branch');
    Route::get('/branch_manager/receive/{id}',[ManagerController::class, 'receive']);
    Route::get('/marketing/seg-card-detail-branch/{id}',[ManagerController::class, 'show_card_branch']);
    Route::get('/marketing/trans-card',[ManagerController::class, 'trans_card_branch'])->name('trans.card');
});
