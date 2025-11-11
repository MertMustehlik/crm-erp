<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

Route::get('/', fn(): RedirectResponse => redirect()->to('/admin'));