<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowedbookController;

Route::get('/', [Controller::class, 'home']);

Route::get('/books', [BookController::class, 'book']);
Route::post('/create_book', [BookController::class, 'create_books']);
Route::post('/edit_book', [BookController::class, 'edit_book']);
Route::post('/delete_book', [BookController::class, 'delete_book']);


Route::get('/categories', [CategoriesController::class, 'category']);
Route::post('/create_category', [CategoriesController::class, 'create_category']);
Route::post('/edit_category', [CategoriesController::class, 'edit_category']);
Route::post('/delete_category', [CategoriesController::class, 'delete_category']);

Route::get('/member', [MemberController::class, 'member']);
Route::post('/create_member', [MemberController::class, 'create_member']);
Route::post('/edit_member', [MemberController::class, 'edit_member']);
Route::post('/delete_member', [MemberController::class, 'delete_member']);

Route::get('/borrow', [BorrowedbookController::class, 'borrows']);
Route::post('/create_borrows', [BorrowedbookController::class, 'create_borrows']);
Route::get('/manage_borrow', [BorrowedbookController::class, 'manage_borrows']);
Route::get('/member/{id}/borrowed-books', [BorrowedbookController::class, 'getBorrowedBooks']);
Route::post('/mark_book_returned', [BorrowedbookController::class, 'markBookAsReturned']);

