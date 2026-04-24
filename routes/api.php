
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetencesController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserCompetenceController;
use App\Http\Controllers\AuthController;

// Routes d'authentification JWT
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout']);
Route::post('auth/refresh', [AuthController::class, 'refresh']);
Route::get('auth/me', [AuthController::class, 'me']);

// Routes protégées par JWT
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::apiResource('competences', CompetencesController::class);
Route::get('competences/search/{keyword}', [CompetencesController::class, 'search']);

// Utilisateurs
Route::apiResource('utilisateurs', UtilisateurController::class);

// Interventions
Route::apiResource('interventions', InterventionController::class);

// Liens User-Competence (Pivot)
Route::get('user-competences', [UserCompetenceController::class, 'index']);
Route::post('user-competences', [UserCompetenceController::class, 'store']);
Route::get('user-competences/{code_user}/{code_comp}', [UserCompetenceController::class, 'show']);
Route::put('user-competences/{code_user}/{code_comp}', [UserCompetenceController::class, 'update']);
Route::delete('user-competences/{code_user}/{code_comp}', [UserCompetenceController::class, 'destroy']);
