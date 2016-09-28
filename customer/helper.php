<?php
define('UPLOADED_IMAGES_DIR', '../../upload_images/');
define('JSON_MODEL', UPLOADED_IMAGES_DIR.'model.json');

$json_in = file_get_contents(JSON_MODEL);
$json_in_decoded = json_decode($json_in, true);

function dir_to_array($dir_name) {
  $files_names = array();

  if (is_dir($dir_name)) {
    $handle = opendir($dir_name);

    while (false !== ($file_name = readdir($handle))) {
      $file_path = $dir_name.$file_name;

      if (is_file($file_path) && is_readable($file_path)) {
        array_push($files_names, $file_name);
      }
    }
    closedir($handle);
  }

  return $files_names;
}

function generate_uuid() {
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0x0fff) | 0x4000,
    mt_rand(0, 0x3fff) | 0x8000,
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}
?>
