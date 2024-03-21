<?php

use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;



Route::get('/',[Student::class,'displayStudent'])->name('student.display');
Route::get('/create',[Student::class,'createStudent'])->name('student.create');
Route::post('/submit',[Student::class,'submitStudent'])->name('student.submit');
Route::get('/edit/{id}',[Student::class,'editStudent'])->name('student.edit');
Route::put('/upload',[Student::class,'updateStudent'])->name('student.update');
Route::delete('/delete/{id}',[Student::class,'deleteStudent'])->name('student.delete');
