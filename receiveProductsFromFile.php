<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Receive Products From File</title>
    <link rel="stylesheet" href="css/table.css">
  </head>
  <body>

<?php
include('userconnectedcheck.php');

if (isset($_POST['JSON'])) {
  $products = json_decode($_POST['products'], true);
  include 'warehouseActions.php';
  receiveProducts($products);
  echo "Products received";
  die('<p><a href="receive.php">Go back</a></p>');
}

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
?>

<h3>Products from file</h3>

<?php
include 'productsPreview.php';
previewProducts($products);

?>

<form id="products" method="post" action="#">
      <input type="hidden" name="JSON" value="json_arrays" >
      <input type="hidden" name="products" value=' <?php echo json_encode($products, true); ?> ' >
      <input type="submit" name="btnReceive" value="Receive products">
</form>
</body>
</html>
