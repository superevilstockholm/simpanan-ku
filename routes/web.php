<?php

use Illuminate\Support\Facades\Route;

// Basic
Route::get('/', function () {
    return view('pages.index', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true,
            'showSideBar' => false
        ]
    ]);
})->name('index');

Route::get('features', function () {
    return view('pages.features', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true,
            'showSideBar' => false
        ]
    ]);
})->name('features');

Route::get('testimonials', function () {
    return view('pages.testimonials', [
        'meta' => [
            'showNavBar' => true,
            'showFooter' => true,
            'showSideBar' => false
        ]
    ]);
})->name('testimonials');

// Auth
Route::get('login', function () {
    return view('pages.auth.login', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => false
        ]
    ]);
})->name('login');

Route::get('register/student', function () {
    return view('pages.auth.student_register', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => false
        ]
    ]);
})->name('student_register');

Route::get('register/teacher', function () {
    return view('pages.auth.teacher_register', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => false
        ]
    ]);
})->name('teacher_register');

// Admin
Route::get('admin-dashboard', function () {
    return view('pages.admin.index', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => true
        ]
    ]);
});

// Teacher
Route::get('teacher-dashboard', function () {
    return view('pages.teacher.index', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => true
        ]
    ]);
});

// Student
Route::get('student-dashboard', function () {
    return view('pages.student.index', [
        'meta' => [
            'showNavBar' => false,
            'showFooter' => false,
            'showSideBar' => true
        ]
    ]);
});
