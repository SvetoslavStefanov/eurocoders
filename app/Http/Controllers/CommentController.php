<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $request->validate([
      'content' => 'string|required|max:500',
      'gallery_id' => 'required|exists:gallery,id'
    ]);

    $comment = Comment::create([
      'content' => $request->input('content'),
      'gallery_id' => $request->gallery_id,
      'user_id' => auth()->user()->id
    ]);

    return redirect()->back()->with('success', 'Comment added successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function show(Comment $comment) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function edit(Comment $comment) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment) {
    abort_if(auth()->user()->id !== $comment->user_id, Response::HTTP_FORBIDDEN, '403 Forbidden');

    $comment->delete();

    return redirect()->back()->withInput()->with('success', 'Comment deleted successfully.');
  }
}
