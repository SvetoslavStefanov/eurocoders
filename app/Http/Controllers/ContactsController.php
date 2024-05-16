<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view('contacts.index');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'phone' => 'required|string|max:255',
      'content' => 'required|string|max:1500|min:10',
    ]);

    Contacts::create($request->all());

    return redirect()->route('contacts.index')->with('success', __('Your message has been sent successfully'));
  }
}
