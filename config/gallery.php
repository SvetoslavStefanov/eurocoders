<?php
$uploadDir = 'uploads' . DIRECTORY_SEPARATOR;
return [
  'max_file_size_upload' => 10, //in mbs
  'upload_dir_path' => public_path($uploadDir),
  'thumb_size' => [400, 250],
  'upload_dir' => $uploadDir
];