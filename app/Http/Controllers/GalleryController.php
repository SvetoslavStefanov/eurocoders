<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller {
  /**
   * Instantiate a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth')->except(['index', 'show']);
  }

  /**
   * Display a listing of the resource.
   *
   */
  public function index() {
    $images = Gallery::orderBy('created_at', 'DESC')->paginate(10);

    return view('gallery.index',['images' => $images]);
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create() {
    return view('gallery.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   */
  public function store(Request $request) {
    if (!auth()->user()->canAddNewImage()) {
      return back()->withErrors(['image' => __('You have reached the maximum number of images')]);
    }
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:' . config('gallery.max_file_size_upload') * 1024,
    ]);

    $path = Gallery::uploadImage($request->file('image'));

    if ($path) {
      $image = Gallery::create([
        'path' => $path,
        'user_id' => auth()->user()->id
      ]);
    } else {
      throw ValidationException::withMessages([
        'image' => [__('Cannot upload the file')],
      ]);
    }

    return redirect()->route('gallery.show', $image)->withMessage(__('Your image has been uploaded'));
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Gallery $gallery
   */
  public function show(Gallery $gallery) {
    return view('gallery.show', ['image' => $gallery]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Gallery $gallery
   */
  public function destroy(Gallery $gallery, Request $request) {
    abort_if(auth()->user()->id !== $gallery->user_id && auth()->user()->role !== 'admin', Response::HTTP_FORBIDDEN, '403 Forbidden');

    $gallery->delete();

    return redirect($request->previous_page)->withMessage(__('Your image has been deleted'));
  }
}
