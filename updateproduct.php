<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/warehousestocks/css/input.css">
	<title>Update product</title>
	<script type="text/javascript"  src="js/inputCheck.js"></script>
</head>
<body>
<?php
include 'header.php';
?>
	 <h3>Update product</h3>

<?php

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_country = $_POST['product_country'];
$product_quantity = $_POST['product_quantity'];
$product_UM = $_POST['product_UM'];

?>


 <form method="post" action="updateprocess.php">
  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
  <input type="hidden" name="old_product_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="old_product_country" value="<?php echo $product_country; ?>">
  <input type="hidden" name="old_product_quantity" value="<?php echo $product_quantity; ?>">
  <input type="hidden" name="old_product_UM" value="<?php echo $product_UM; ?>">
 	<div class="inputField">
 		<label for="product_name">Product name: </label>
 		<input type="text" name="product_name" id="product_name" maxlength="255" tabindex="1" value="<?php echo $product_name; ?>">
 	</div>
   <div class="inputField">
 		<label for="product_country">Country of Origin: </label>
 		<select name="product_country" id="product_country" tabindex="2">
	     <?php require("countries.php");
				 $countries = AllCountries();
				 foreach ($countries as $value) {
					 $selected = '';
					 if ($value == $product_country) {
					 	$selected = ' selected';
					 }
						echo '<option' . $selected . '>' . $value . '</option>';
						echo "\n";
				 }
	 		?>
		</select>
 	</div>
   <div class="inputField">
 		<label for="product_quantity">Quantity: </label>
 		<input type="text" name="product_quantity" onInput="validNumberCheck(this)" id="product_quantity" tabindex="3" value="<?php echo $product_quantity; ?>">
 	</div>
   <div class="inputField">
 		<label for="product_UM">Unit of measure: </label>
 		<select name="product_UM" id="product_UM" tabindex="4">
       <?php require("unitsofmeasure.php");
				 $units_of_measure = AllUnitsOfMeasure();
				 foreach ($units_of_measure as $value) {
						$selected = '';
					  if ($value == $product_UM) {
						$selected = ' selected';
						}
						echo '<option' . $selected . '>' . $value . '</option>';
						echo "\n";
				 }
 			 	?>
     </select>
 	</div>
 	<input type="submit" name="btnUpdateProduct" value="Update Product" tabindex="5">
 </form>
 <?php include 'footer.html'; ?>
 </body>
 </html>
