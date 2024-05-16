<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller {
  public function index() {
    $images = Gallery::latest()->take(5)->get();
    $users = User::latest()->take(5)->get();

    return view('admin.home', [
      'images' => $images,
      'users' => $users
    ]);
  }
}
