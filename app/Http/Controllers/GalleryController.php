<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

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
    //
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
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8000',
    ]);

    // Store the uploaded image
    $image = $request->file('image');
    $extenstion = $image->getClientOriginalExtension();
    $imageName = time().'.'.$extenstion;
    $image->move(public_path('uploads'), $imageName);

    $image = Gallery::create([
      'path' => ('uploads/' . $imageName),
      'user_id' => auth()->user()->id
    ]);

    redirect()->route('gallery.show', $image)->withMessage(__('Your image has been uploaded'));
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Gallery $gallery
   */
  public function show(Gallery $gallery) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Gallery $gallery
   */
  public function destroy(Gallery $gallery) {
    //
  }
}
