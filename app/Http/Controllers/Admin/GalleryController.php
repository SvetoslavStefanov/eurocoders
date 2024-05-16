<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class GalleryController extends Controller {
  public function index($userId = null) {
    $user = null;
    $imagesQuery = Gallery::orderBy('created_at', 'DESC');

    if ($userId) {
      $imagesQuery->where('user_id', $userId);
      $user = User::findOrFail($userId);
    }

    $images = $imagesQuery->paginate(10);

    return view('admin.gallery.index', ['images' => $images, 'user' => $user]);
  }

  public function show(Gallery $gallery) {
    return view('admin.gallery.show', ['image' => $gallery]);
  }

  public function destroy(Gallery $gallery) {
    $gallery->delete();

    return back();
  }
}
