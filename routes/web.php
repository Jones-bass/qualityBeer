<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('filament.admin.auth.register');
})->name('frontend.home');

Route::fallback(function () {
    return redirect('/app');
});

Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
});
