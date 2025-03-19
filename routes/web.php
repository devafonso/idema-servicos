<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/requerimento-vista-processo', function () {
    return Inertia::render('RequerimentoVistaProcesso');
})->name('requerimento-vista-processo');

Route::get('/parrachos', function () {
    return Inertia::render('Parrachos');
})->name('parrachos');

Route::get('/licencas-emitidas', function () {
    return Inertia::render('LicencasEmitidas');
})->name('licencas-emitidas');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';