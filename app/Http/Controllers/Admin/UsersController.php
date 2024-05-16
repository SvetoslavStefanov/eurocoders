<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
  public function index() {
    $items = User::orderBy('created_at', 'DESC')->paginate(10);

    return view('admin.users.index', ['users' => $items]);
  }

  public function destroy(User $user) {
    $user->delete();

    return back();
  }
}
