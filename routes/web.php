<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\{
    FactionComponent,
    GameComponent,
    PlayerComponent
};

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
    return redirect()->route('games');
});

Route::get('/players', PlayerComponent::class)->name('players');
Route::get('/factions', FactionComponent::class)->name('factions');
Route::get('/games', GameComponent::class)->name('games');
