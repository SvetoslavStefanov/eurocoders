<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
  public function __construct() {
    $this->middleware('auth')->except(['index', 'show']);
  }

  public function index() {
    $items = User::withCount('images')
      ->withCount('comments')
      ->orderBy('images_count', 'desc')
      ->paginate(10);

    return view('user.index', ['users' => $items]);
  }

  public function show(User $user) {
    return view('user.show', [
      'user' => $user::withCount('images')->withCount('comments')->where('id', $user->id)->first()
    ]);
  }

  public function edit(User $user) {
    abort_if(auth()->user()->id !== $user->id, Response::HTTP_FORBIDDEN, '403 Forbidden');

    return view('user.edit', ['user' => $user]);
  }

  public function update(User $user) {
    abort_if(auth()->user()->id !== $user->id, Response::HTTP_FORBIDDEN, '403 Forbidden');

    $data = request()->validate([
      'name' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'password' => 'nullable|string|min:8|confirmed',
      'old_password' => 'nullable|string|min:8',
    ]);

    if (isset($data['old_password']) && !empty($data['old_password'])) {
      if (!auth()->validate([
        'email' => $user->email,
        'password' => $data['old_password']
      ])) {
        return back()->withErrors(['old_password' => __('The old password is incorrect')]);
      }
      $data['password'] = bcrypt($data['password']);
    } else {
      unset($data['password']);
    }

    $user->update($data);

    return redirect()->route('users.show', $user)->withMessage(__('Your profile has been updated'));
  }
}
