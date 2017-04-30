<?php
include('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<title>Add product</title>
	<script type="text/javascript"  src="js/inputCheck.js"></script>
	<link rel="stylesheet" href="css/input.css">
</head>
<body>
<?php
include 'menu.php';
echo buildDefaultMenu();

$product_name = $product_country_id = $product_quantity = $product_UM_id = '';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      try {
        $product_name = trim($_POST['product_name']);
        $product_country_id = trim($_POST['product_country_id']);
        $product_quantity = trim($_POST['product_quantity']);
        $product_UM_id = trim($_POST['product_UM_id']);
        if ($product_name != '' && $product_country_id != '' && $product_quantity != '' && $product_UM_id != '') {
        include 'connection.php';
				include 'getIDqueries.php';
				include 'productsActions.php';

				$desc = '';
				$product = checkIfProductExists($conn, $product_name, $product_country_id, $product_UM_id);
				$product_id = $product['ID'];
				if ($product_id != False)
				{
					$new_quantity = floatval($product['Quantity']) + floatval($product_quantity);
					updateProduct($conn, $product_id, $product['Name'], $product['Country_ID'], $new_quantity, $product['Unit_of_measure_ID']);
					$desc = 'Quantity added: ' . $product_quantity;
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
					include 'ipaddress.php';
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<div class="inputField">
		<label for="product_name">Product name: </label>
		<input type="text" name="product_name" maxlength="255" tabindex="1">
	</div>
  <div class="inputField">
		<label for="product_country_id">Country of Origin: </label>
		<select name="product_country_id" tabindex="2">
	    <?php include("countries.php");
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
      <?php include("unitsofmeasure.php");
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
