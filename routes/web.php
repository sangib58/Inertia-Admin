<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/signIn', [UserController::class, 'ShowSignIn'])->name('user.show-signIn')->withoutMiddleware('auth');
    Route::post('/signInPost', [UserController::class, 'SignIn'])->name('user.post-signIn')->withoutMiddleware('auth');
    Route::post('/signOut', [UserController::class, 'SignOut'])->name('user.signOut')->withoutMiddleware('auth');
    Route::post('/register', [UserController::class, 'Register'])->name('user.registration')->withoutMiddleware('auth');
    Route::post('/user-log', [UserController::class, 'StoreLogHistory'])->name('user.store-log');
    Route::get('/dashboard', [UserController::class, 'ShowDashboard'])->name('user.show-dashboard');
    Route::get('/change-password', [UserController::class, 'ShowChangePassword'])->name('user.show-changePassword');
    Route::post('/change-password-post', [UserController::class, 'ChangePassword'])->name('user.post-changePassword');
    Route::get('/profile', [UserController::class, 'ShowProfile'])->name('user.show-profile');
    Route::post('/update-profile', [UserController::class, 'UpdateProfile'])->name('user.update-profile');
    Route::post('/unlock', [UserController::class, 'UnLock'])->name('user.open-lock');
    Route::get('/users', [UserController::class, 'ShowUserList'])->name('user.show-users');
    Route::post('/add-user', [UserController::class, 'AddUser'])->name('user.add-user');
    Route::post('/update-user', [UserController::class, 'UpdateUser'])->name('user.update-user');
    Route::delete('/delete-user', [UserController::class, 'DeleteUser'])->name('user.delete-user');
    Route::get('/user-role', [UserController::class, 'ShowUserRoles'])->name('user.show-roles');
    Route::post('/add-role', [UserController::class, 'AddRole'])->name('user.add-role');
    Route::put('/update-role', [UserController::class, 'UpdateRole'])->name('user.update-role');
    Route::delete('/delete-role', [UserController::class, 'DeleteRole'])->name('user.delete-role');

    Route::get('/menu', [MenuController::class, 'ShowMenuList'])->name('menu.show-menus');
    Route::post('/add-menu', [MenuController::class, 'AddMenu'])->name('menu.add-menu');
    Route::put('/update-menu', [MenuController::class, 'UpdateMenu'])->name('menu.update-menu');
    Route::delete('/delete-menu', [MenuController::class, 'DeleteMenu'])->name('menu.delete-menu');
    Route::get('/menu-group', [MenuController::class, 'ShowMenuGroupList'])->name('menu.show-menuGroups');
    Route::post('/add-menu-group', [MenuController::class, 'AddMenuGroup'])->name('menu.add-menuGroup');
    Route::put('/update-menu-group', [MenuController::class, 'UpdateMenuGroup'])->name('menu.update-menuGroup');
    Route::delete('/delete-menu-group', [MenuController::class, 'DeleteMenuGroup'])->name('menu.delete-menuGroup');
    Route::get('/sidebar-menu/{menuGroupId}', [MenuController::class, 'ShowSidebarMenu'])->name('menu.show-sidebarMenu');

    Route::get('/', [SettingsController::class, 'GetLanding'])->name('settings.index')->withoutMiddleware('auth');
    Route::get('/settings', [SettingsController::class, 'GetSettings'])->name('settings.show');
    Route::post('/update-generalSettings', [SettingsController::class, 'UpdateGeneralSettings'])->name('settings.updateGeneralSettings');
    Route::put('/update-emailSettings', [SettingsController::class, 'UpdateEmailSettings'])->name('settings.updateEmailSettings');
    Route::put('/update-emailTextSettings', [SettingsController::class, 'UpdateEmailTextSettings'])->name('settings.updateEmailTextSettings');
    Route::post('/update-landingSettings', [SettingsController::class, 'UpdateLandingSettings'])->name('settings.updateLandingSettings');
    Route::post('/storeContact', [SettingsController::class, 'CreateContacts'])->name('settings.storeContact')->withoutMiddleware('auth');
    Route::get('/contact', [SettingsController::class, 'GetContacts'])->name('settings.showContacts');
    Route::get('/faq', [SettingsController::class, 'GetFaqs'])->name('settings.showFaqs');
    Route::post('/add-faq', [SettingsController::class, 'AddFaq'])->name('settings.AddFaq');
    Route::put('/update-faq', [SettingsController::class, 'UpdateFaq'])->name('settings.UpdateFaq');
    Route::delete('/delete-faq', [SettingsController::class, 'DeleteFaq'])->name('settings.DeleteFaq');
    Route::get('/browse-log', [SettingsController::class, 'GetBrowseLogs'])->name('settings.showBrowseLogs');
});


