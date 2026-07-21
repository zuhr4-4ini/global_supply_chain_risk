<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/compare', [CompareController::class, 'index'])
    ->name('compare');

Route::get('/favorite', [FavoriteController::class, 'index'])
    ->name('favorite');

Route::get('/favorite/add/{country}', [FavoriteController::class, 'add'])
    ->name('favorite.add');

Route::get('/favorite/remove/{country}',
    [FavoriteController::class, 'remove'])
    ->name('favorite.remove');

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin');

Route::get('/admin/ports', [AdminController::class, 'ports'])
    ->name('admin.ports');

Route::get('/admin/users', [AdminController::class, 'users'])
    ->name('admin.users');

Route::get('/admin/articles', [AdminController::class, 'articles'])
    ->name('admin.articles');

Route::get('/admin/articles/create',[AdminController::class, 'createArticle'])
    ->name('admin.article.create');

Route::post('/admin/articles/store',[AdminController::class, 'storeArticle'])
    ->name('admin.articles.store');

Route::get('/admin/articles/edit/{id}',[AdminController::class, 'editArticle'])
    ->name('admin.article.edit');

Route::post('/admin/articles/update/{id}',[AdminController::class, 'updateArticle'])
    ->name('admin.article.update');

Route::get('/admin/articles/delete/{id}',[AdminController::class, 'deleteArticle'])
    ->name('admin.article.delete');

Route::get('/admin/ports/create',[AdminController::class, 'createPort'])
    ->name('admin.port.create');

Route::post('/admin/ports/store',[AdminController::class, 'storePort'])
    ->name('admin.port.store');

Route::get('/admin/ports/edit/{id}',[AdminController::class, 'editPort'])
    ->name('admin.port.edit');

Route::post('/admin/ports/update/{id}',[AdminController::class, 'updatePort'])
    ->name('admin.port.update');

Route::get('/admin/ports/delete/{id}',[AdminController::class, 'deletePort'])
    ->name('admin.port.delete');

Route::get('/admin/users/create',[AdminController::class, 'createUser'])
    ->name('admin.users.create');

Route::post('/admin/users/store',[AdminController::class, 'storeUser'])
    ->name('admin.users.store');

Route::get('/admin/users/edit/{id}',[AdminController::class, 'editUser']);

Route::post('/admin/users/delete/{id}',[AdminController::class, 'deleteUser']);

Route::post('/admin/users/update/{id}',[AdminController::class, 'updateUser']);