<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
  use HasFactory;

  protected $table = 'comment';
  protected $fillable = [
    'gallery_id',
    'user_id',
    'content',
  ];
  public function owner() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function gallery() {
    return $this->belongsTo(Gallery::class, 'gallery_id');
  }
}
