<?php

use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DistributorController;
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
    Route::get('/marketing',[MarketingController::class, 'marketing'])->name('marketing');
    Route::get('/marketing/profile',[MarketingController::class, 'profile']);
    Route::get('/marketing/settings',[MarketingController::class, 'setting']);

    //save card
    Route::get('/marketing/save-card',[MarketingController::class, 'save_card'])->name('save.card');
    Route::post('/marketing/save',[MarketingController::class, 'saving'])->name('saving');

    //Consultation des cartes
    Route::get('/marketing/view-card',[MarketingController::class, 'view_card'])->name('view.card');
    Route::get('/marketing/seg-card/{segment}',[MarketingController::class, 'seg_card'])->name('segment-view');
    Route::get('/marketing/seg-card-detail/{id}',[MarketingController::class, 'show_card']);

    //Consultation des demandes
    Route::get('/marketing/view-demandes',[MarketingController::class, 'view_demandes'])->name('view.demandes');

    //Traitement d'une demande
    Route::get('/marketing/traitement/{id}',[MarketingController::class, 'traitement_demande']);
    Route::get('/marketing/share/{id}{idask}',[MarketingController::class, 'share_demande']);

    //voir son historique de transactions
    Route::get('/marketing/historik',[MarketingController::class, 'historik'])->name('historik');

    //Gestion des utilisateurs
    Route::get('/marketing/users',[MarketingController::class, 'users'])->name('users');
    Route::post('/marketing/add_users',[MarketingController::class, 'add_users'])->name('add_users');

    //Consultation des ventes
    Route::get('/marketing/ventes',[MarketingController::class, 'ventescarte'])->name('add_users');
});

Route::group(['middleware'=>['Managerauth']], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');
    Route::get('/branch_manager',[ManagerController::class, 'branch_manager'])->name('branch_manager');
    Route::get('/branch_manager/profile',[ManagerController::class, 'profile']);
    Route::get('/branch_manager/settings',[ManagerController::class, 'setting']);

    //Faire une demande et envoyer
    Route::get('/branch_manager/demander',[ManagerController::class, 'ask_card'])->name('demander');
    Route::post('/branch_manager/sending',[ManagerController::class, 'send'])->name('sending');

    //voir les demandes et confirmer la reception
    Route::get('/branch_manager/myasker',[ManagerController::class, 'myasker'])->name('myasker');
    Route::get('/branch_manager/confirme_ask',[ManagerController::class, 'confirme_ask'])->name('confirme_ask');

    //traitement demandes cartes recues
    Route::get('/branch_manager/trans-card',[ManagerController::class, 'trans_card_branch'])->name('trans.card');
    Route::get('/branch_manager/trash_ask',[ManagerController::class, 'trash_ask'])->name('trash_ask');
    Route::get('/branch_manager/treated_ask',[ManagerController::class, 'treated_ask'])->name('treated_ask');

    //Transferer une carte
    Route::get('/branch_manager/trans_card',[ManagerController::class, 'trans_card'])->name('trans_card');

    //consulter les stocks de cartes recues
    Route::get('/branch_manager/view-card-branch',[ManagerController::class, 'view_card_branch'])->name('view.card_branch');
    Route::get('/branch_manager/seg-card-detail-branch/{id}',[ManagerController::class, 'show_card_branch'])->name('show_card_branch');

    //Vendre la carte
    Route::get('/branch_manager/vendre/{id}',[ManagerController::class, 'vendre'])->name('vendre');

    //consultation vente
    Route::get('/branch_manager/ventes',[ManagerController::class, 'ventes'])->name('ventes');

    Route::get('/branch_manager/receive/{id}',[ManagerController::class, 'receive']);
});


Route::group(['middleware'=>['Distributorauth']], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');
    Route::get('/distributor',[DistributorController::class, 'distributor'])->name('distributor');
    Route::get('/distributor/demande_card',[DistributorController::class, 'ask_card'])->name('demande_distributor');
    Route::post('/distributor/opera_demande',[DistributorController::class, 'opera_demande'])->name('opera_demande');

    Route::get('/distributor/myask',[DistributorController::class, 'myask'])->name('myask');
    Route::get('/branch_manager/confirme_ask_agence',[DistributorController::class, 'confirme_ask_agence'])->name('confirme_ask_agence');

    Route::get('/distributor/mystock',[DistributorController::class, 'mystock'])->name('mystock');
    Route::get('/distributor/distribute',[DistributorController::class, 'distribute'])->name('distribute');
    Route::get('/distributor/attribue',[DistributorController::class, 'attribue'])->name('attribue');
    Route::post('/distributor/selected/{id}',[DistributorController::class, 'selected'])->name('selected');


    Route::post('/distributor/selling',[DistributorController::class, 'selling'])->name('selling');


    Route::get('/director/',[DirectorController::class, 'director'])->name('director');
});


Route::group(['middleware'=>['Directorauth']], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');

    Route::get('/director/',[DirectorController::class, 'director'])->name('director');
});
