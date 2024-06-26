<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    if (!Gallery::findOrFail($request->gallery_id)->canAddNewComments()) {
      return back()->withErrors(['image' => __('You have reached the maximum number of comments')]);
    }
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
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment) {
    abort_if(auth()->user()->id !== $comment->user_id && auth()->user()->role !== 'admin', Response::HTTP_FORBIDDEN, '403 Forbidden');

    $request->validate([
      'content' => 'string|required|max:500',
      'gallery_id' => 'required|exists:gallery,id'
    ]);

    $comment->fill($request->all());
    $comment->save();

    return redirect()->back()->with('success', 'Comment updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Comment $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment) {
    abort_if(auth()->user()->id !== $comment->user_id && auth()->user()->role !== 'admin', Response::HTTP_FORBIDDEN, '403 Forbidden');

    $comment->delete();

    return redirect()->back()->withInput()->with('success', 'Comment deleted successfully.');
  }
}
