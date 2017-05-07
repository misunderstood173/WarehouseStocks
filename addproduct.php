<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add product</title>
	<script type="text/javascript"  src="js/inputCheck.js"></script>
	<link rel="stylesheet" href="/warehousestocks/css/input.css">
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
 <h3>Add a product</h3>
<?php

$product_name = $product_country_id = $product_quantity = $product_UM_id = '';
    if(isset($_POST['product_name']) && isset($_POST['product_country_id']) && isset($_POST['product_quantity']) && isset($_POST['product_UM_id']))
    {
      try {
				require 'inputTest.php';
        $product_name = inputTest($_POST['product_name']);
        $product_country_id = inputTest($_POST['product_country_id']);
        $product_quantity = inputTest($_POST['product_quantity']);
        $product_UM_id = inputTest($_POST['product_UM_id']);
      if ($product_name != '' && $product_country_id != '' && $product_quantity != '' && $product_UM_id != '') {
        require 'connection.php';
				require 'productsActions.php';

				$desc = '';
				$product = checkIfProductExists($conn, $product_name, $product_country_id, $product_UM_id);
				$product_id = $product['ID'];
				if ($product != False)
				{
					$new_quantity = floatval($product['Quantity']) + floatval($product_quantity);
					updateProduct($conn, $product_id, $product['Name'], $product['Country_ID'], $new_quantity, $product['Unit_of_measure_ID']);
					$desc = 'Product quantity modified from ' . $product['Quantity'] . ' to ' . $new_quantity;
				}
				else
				{
					addProduct($conn, $product_name, $product_country_id, $product_quantity, $product_UM_id);
					$product_id = $conn->lastInsertId();
					$desc = 'Product added';
				}
					//log action
					$stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, product_modified_ID, description, ip_address)
												VALUES (:employee_ID, 2, :product_id, :description, :ip)');
					require 'ipaddress.php';
					$ip = get_client_ip();
					$stmt->bindParam(':employee_ID', $_SESSION['ID']);
					$stmt->bindParam(':product_id', $product_id);
					$stmt->bindParam(':description', $desc);
					$stmt->bindParam(':ip', $ip);
					$stmt->execute();

          die('Product added successfully !');
        }
        else {
          echo 'All fields required!' . '<br>';
        }

        } catch (PDOException  $e) {
          die("Connection failed: " . $e->getMessage());
        } catch (Exception $e) {
					die($e->getMessage());
				}
      }

?>
<form method="post" action="#">
	<div class="inputField">
		<label for="product_name">Product name: </label>
		<input type="text" name="product_name" maxlength="255" tabindex="1">
	</div>
  <div class="inputField">
		<label for="product_country_id">Country of Origin: </label>
		<select name="product_country_id" tabindex="2">
	    <?php require("countries.php");
						$countries = AllCountries();
						foreach ($countries as $key => $value) {
				        echo '<option value="' . $key . '">' . $value . '</option>';
				        echo "\n";
						}
			?>
		</select>
	</div>
  <div class="inputField">
		<label for="product_quantity">Quantity: </label>
		<input type="text" name="product_quantity" onInput="validNumberCheck(this)" tabindex="3">
	</div>
  <div class="inputField">
		<label for="product_UM_id">Unit of measure: </label>
		<select name="product_UM_id" tabindex="4">
      <?php require("unitsofmeasure.php");
						$units_of_measure = AllUnitsOfMeasure();
						foreach ($units_of_measure as $key => $value) {
				        echo '<option value="' . $key . '">' . $value . '</option>';
				        echo "\n";
						}
			?>
    </select>
	</div>
	<input type="submit" name="btnAddProduct" value="Add Product" tabindex="5">
</form>
</body>
</html>
