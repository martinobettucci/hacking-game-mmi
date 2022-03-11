<?php

if (!(isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')) {
  $message = 'Not the expected form source';
}
if (!(isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)) {
  $message = 'Error during upload : ' . $_FILES['uploadedFile']['error'];
}

$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

$allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
if (!(in_array($fileExtension, $allowedfileExtensions))) {
  $message = 'File type not accepted. Only accepted ' . implode(', ', $allowedfileExtensions);
}

$uploadFileDir = './uploaded_files/';
$dest_path = $uploadFileDir . $newFileName;
 
if(move_uploaded_file($fileTmpPath, $dest_path))
{
  $message = 'File is successfully uploaded.';
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory ' . $uploadFileDir . ' is writable by web server.';
}

echo $message;
