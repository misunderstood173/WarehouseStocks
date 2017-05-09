<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Delete product</title>
</head>
<body>


<?php
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_country = $_POST['product_country'];
$product_quantity = $_POST['product_quantity'];
$product_UM = $_POST['product_UM'];

$productInfo = $product_name . ', ' . $product_country . ', '
            . $product_quantity . ', ' . $product_UM;

 ?>
<form action="deleteprocess.php" method="post">
  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
  <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="product_country" value="<?php echo $product_country; ?>">
  <input type="hidden" name="product_quantity" value="<?php echo $product_quantity; ?>">
  <input type="hidden" name="product_UM" value="<?php echo $product_UM; ?>">

  <p>Are you sure you want to delete this product {<?php echo $productInfo ?>} ?</p>
  <input type="submit" name="btnYes" value="Yes">
</form>
  <p><a href="/warehousestocks/products.php">Go Back</a></p>
</body>
<?php include 'footer.html'; ?>
</html>
