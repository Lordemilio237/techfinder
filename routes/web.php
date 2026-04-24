<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\CompetenceController;
use App\Http\Controllers\web\UtilisateurController; // ✅ Nom correct

Route::get('/', function () {
    return view('welcome');
});

Route::resource('competences', CompetenceController::class);

Route::resource('web/users', UtilisateurController::class)->names([
    'index'   => 'web.users.index',
    'create'  => 'web.users.create',
    'store'   => 'web.users.store',
    'show'    => 'web.users.show',
    'edit'    => 'web.users.edit',
    'update'  => 'web.users.update',
    'destroy' => 'web.users.destroy',
]);