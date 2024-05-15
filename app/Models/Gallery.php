<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Gallery extends Model {
  use HasFactory;

  protected $table = 'gallery';
  protected $fillable = [
    'path',
    'user_id',
  ];

  protected $with = [
    'owner'
  ];

  public function owner() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public static function uploadImage(\Illuminate\Http\UploadedFile $image): string|null {
    $imageName = self::generateImageFileName($image, false);
    $image->move(config('gallery.upload_dir_path'), $imageName);

    Image::make(config('gallery.upload_dir_path') . $imageName)
      ->resize(config('gallery.thumb_size')[0], config('gallery.thumb_size')[0])
      ->save(config('gallery.upload_dir_path') . self::generateImageFileName($image, true));

    return  $imageName;
  }

  private static function generateImageFileName(\Illuminate\Http\UploadedFile $image, bool $isThumb = false): string {
    $prefix = $isThumb ? ('_' . config('gallery.thumb_size')[0] . '_' . config('gallery.thumb_size')[1]) : '';

    return auth()->user()->id . $prefix . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
  }

  public function getThumbAttribute(): string {
    $pathItems = explode('_', $this->path);
    array_shift($pathItems);
    $path = join('_', ($pathItems));

    return config('gallery.upload_dir') . $this->user_id . '_' . config('gallery.thumb_size')[0] . '_' . config('gallery.thumb_size')[1] . '_' . $path;
  }
}
