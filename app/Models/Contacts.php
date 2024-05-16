<?php

namespace App\Models;

use App\Mail\ContactsMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contacts extends Model {
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'phone',
    'content',
  ];

  protected static function boot() {
    parent::boot();

    static::created(function ($contact) {
      self::sendEmail($contact);
    });
  }

  private static function sendEmail($contact) {
    Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactsMail($contact));
  }
}
