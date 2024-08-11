<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/* 
GET /contacts: List all contacts -d 
GET /contacts/create: Show the form to create a new contact -d 
POST /contacts: Store a new contact -d
DELETE /contacts/{id}: Delete a contact-d
GET /contacts/{id}/edit: Show the form to edit a contact -d 

GET /contacts/{id}: Show a specific contact
PUT /contacts/{id}: Update a contact
*/
Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts.all');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::post('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');

Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
