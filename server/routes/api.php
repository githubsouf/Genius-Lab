<?php

use App\Http\Controllers\Api\ActiviteController;
use App\Http\Controllers\Api\ActiviteHoraireController;
use App\Http\Controllers\Api\ActiviteLangueController;
use App\Http\Controllers\Api\ActiviteModaliteController;
use App\Http\Controllers\Api\AnimateurCategorieServiceController;
use App\Http\Controllers\Api\AnimateurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DemandeController;
use App\Http\Controllers\Api\DispoAnimateurController;
use App\Http\Controllers\Api\DispoEnfantController;
use App\Http\Controllers\Api\EnfantController;
use App\Http\Controllers\Api\EnfantInteretController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\HoraireController;
use App\Http\Controllers\Api\LangueAnimateurController;
use App\Http\Controllers\Api\ObjectifController;
use App\Http\Controllers\Api\OffreActiviteController;
use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\ParentalController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\DemandeActiviteEnfantController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ConversationsController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\Admin2FAController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\DevisController;
use App\Http\Controllers\Api\FactureController;
use App\Http\Controllers\Api\NotificationController;
use App\Models\DemandeActiviteEnfant;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//CRUD DE USER
Route::apiResource('users', UserController::class);

Route::apiResource('parental',ParentalController::class);
Route::apiResource('parentals.enfants',EnfantController::class)->scoped();
Route::apiResource('enfants.interets',EnfantInteretController::class)
->scoped()->except(['update', 'show']);

Route::apiResource('animateurs', AnimateurController::class);
Route::apiResource('animateurs.experiences', ExperienceController::class)
    ->scoped();// en cas d'erreur utilise scoped()
Route::apiResource('animateurs.langueanimateurs',LangueAnimateurController::class)
    ->scoped(['langueanimateur' => 'animateur'])
    ->except(['update', 'show']);
Route::apiResource('animateurs.services',AnimateurCategorieServiceController::class)
    ->scoped()
    ->except(['show', 'update']);
Route::apiResource('animateurs.dispo',DispoAnimateurController::class)
    ->scoped();
Route::apiResource('enfants.dispo', DispoEnfantController::class)
    ->scoped();

Route::apiResource('horaires',HoraireController::class);

Route::apiResource('activites',ActiviteController::class);
Route::apiResource('parentals.activites.reviews',ReviewController::class)->scoped();
Route::apiResource('activites.objectifs',ObjectifController::class)->scoped(); Route::apiResource('activites.langues',ActiviteLangueController::class)
    ->scoped()->except(['index', 'destroy','update']);  
Route::apiResource('activites.horaires',ActiviteHoraireController::class)
    ->scoped();
Route::apiResource('activites.modalites',ActiviteModaliteController::class)
    ->scoped();    

Route::apiResource('offres',OffreController::class);
Route::apiResource('offres.activites',OffreActiviteController::class)->scoped()->except(['update']);


Route::apiResource('parentals.demandes',DemandeController::class)->scoped();

Route::apiResource('demandes.activitesenfants',DemandeActiviteEnfantController::class)->scoped()->except(['update','destroy','show']);
Route::put('demandes/{demande}/activitesenfants',[DemandeActiviteEnfantController::class, 'update']);
Route::delete('demandes/{demande}/activitesenfants',[DemandeActiviteEnfantController::class, 'destroy']);


Route::apiResource('categories',CategorieController::class)->except(['update','store']);
Route::apiResource('categories.services',ServiceController::class)->except(['update','store']);




// Chat
Route::get('/conversations', [ConversationsController::class, 'index']);
Route::get('/conversations/{conversation}', [ConversationsController::class, 'show']);
Route::post('/conversations', [ConversationsController::class, 'store']);
Route::get('/conversations/{conversation}/messages', [MessagesController::class, 'index']);
Route::post('/conversations/{conversation}/messages', [MessagesController::class, 'store']);


//Double authentification
Route::middleware(['auth:api'])->group(function () {
    Route::get('/admin/enable-2fa', [Admin2FAController::class, 'enable2FA'])->name('admin.enable2fa');
    Route::post('/admin/verify-2fa', [Admin2FAController::class, 'verify2FA'])->name('admin.verify2fa');
});
Route::middleware(['auth:api', '2fa'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
});


//Systeme de recomendation
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/recommendations/form', [RecommendationController::class, 'store']);
    Route::get('/recommendations/{enfant}', [RecommendationController::class, 'recommend']);
});


//Upload facture et devis
Route::post('/generate-devis', [DevisController::class, 'generateDevis']);
Route::get('/download-devis/{id}', [DevisController::class, 'downloadDevis']);
Route::post('/generate-facture', [FactureController::class, 'generateFacture']);
Route::get('/download-facture/{id}', [FactureController::class, 'downloadFacture']);


//Upload image
Route::post('/enfants/{id}/upload-image', [ImageUploadController::class, 'uploadEnfantImage']);
Route::post('/animateurs/{id}/upload-image', [ImageUploadController::class, 'uploadAnimateurImage']);
Route::post('/activites/{id}/upload-image', [ImageUploadController::class, 'uploadActiviteImage']);
Route::get('/enfants/{id}/image', [ImageUploadController::class, 'getEnfantImage']);
Route::get('/animateurs/{id}/image', [ImageUploadController::class, 'getAnimateurImage']);
Route::get('/activites/{id}/image', [ImageUploadController::class, 'getActiviteImage']);


//Forgot et resset password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/session/reset-token', [AuthController::class, 'storeTokenInSession']);


//Verfier email
Route::get('/password/find/{token}', [AuthController::class, 'findToken']);
Route::get('/verify-email/{id}', [UserController::class, 'verifyEmail'])->name('verification.verify');
Route::get('/verify-email/{token}', [UserController::class, 'verifyEmail'])->name('verification.verify');


//login with fb/insta/google
Route::middleware(['web'])->group(function () {
    Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
    Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
});

Route::post('/login/cancel-authorization', [AuthController::class, 'cancelAuthorization']);
Route::post('/login/data-deletion', [AuthController::class, 'dataDeletion']);


//Systeme de notification
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
});


