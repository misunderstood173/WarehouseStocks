<?php
include('userconnectedcheck.php');

if (!isset($_FILES["JSONfile"])) {
  die('No JSON file uploaded');
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["JSONfile"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file, PATHINFO_EXTENSION);

if($fileType != "json") {
  die("Sorry, only JSON files are allowed.");
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  die("Sorry, your file was not uploaded.");

} else {
  if (move_uploaded_file($_FILES["JSONfile"]["tmp_name"], $target_file)) {
      echo "The file ". basename($_FILES["JSONfile"]["name"]). " has been uploaded." . '<br>';
  } else {
      die("Sorry, there was an error uploading your file.");
  }
}


$products = json_decode(file_get_contents($target_file), true);
if ($products == NULL) {
  die("Can't decode JSON file");
}

include 'warehouseActions.php';
receiveProducts($products);
echo "Products received";
?>
