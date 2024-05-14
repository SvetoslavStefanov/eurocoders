<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {
  use HasFactory;

  protected $table = 'gallery';
  protected $fillable = [
    'path',
    'user_id',
  ];

  protected $with = [
    'user'
  ];

  public function owner() {
    return $this->belongsTo(User::class, 'user_id');
  }
}
