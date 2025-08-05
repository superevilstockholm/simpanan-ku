<?php

use Illuminate\Support\Facades\Route;

// Basic
Route::get('/', function () {
    return view('pages.index', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true
        ]
    ]);
})->name('index');

Route::get('features', function () {
    return view('pages.features', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true
        ]
    ]);
})->name('features');

Route::get('testimonials', function () {
    return view('pages.testimonials', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true
        ]
    ]);
})->name('testimonials');

// Auth
Route::get('login', function () {
    return view('pages.auth.login', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false
        ]
    ]);
})->name('login');

Route::get('register/student', function () {
    return view('pages.auth.student_register', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false
        ]
    ]);
})->name('student_register');

Route::get('register/teacher', function () {
    return view('pages.auth.teacher_register', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false
        ]
    ]);
})->name('teacher_register');
