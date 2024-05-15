<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
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

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public static function uploadImage(\Illuminate\Http\UploadedFile $image): string|null {
    $imageName = self::generateImageFileName($image, false);
    $image->move(config('gallery.upload_dir_path'), $imageName);

    Image::make(config('gallery.upload_dir_path') . $imageName)
      ->resize(config('gallery.thumb_size')[0], config('gallery.thumb_size')[0])
      ->save(config('gallery.upload_dir_path') . self::getThumbPathFromImagePath($imageName, auth()->user()->id));

    return  $imageName;
  }

  private static function generateImageFileName(\Illuminate\Http\UploadedFile $image, bool $isThumb = false): string {
    $prefix = $isThumb ? ('_' . config('gallery.thumb_size')[0] . '_' . config('gallery.thumb_size')[1]) : '';

    return auth()->user()->id . $prefix . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
  }

  private static function getThumbPathFromImagePath(string $path, int $userId): string {
    $pathItems = explode('_', $path);
    array_shift($pathItems);
    $path = join('_', ($pathItems));

    return $userId . '_' . config('gallery.thumb_size')[0] . '_' . config('gallery.thumb_size')[1] . '_' . $path;

  }

  public function getThumbAttribute(): string {
    return config('gallery.upload_dir') . self::getThumbPathFromImagePath($this->path, $this->user_id);
  }

  public function getFullPathAttribute(): string {
    return config('gallery.upload_dir') . $this->path;
  }

  public function delete() {
    File::delete($this->fullPath);
    File::delete($this->thumb);

    parent::delete();
  }
}
