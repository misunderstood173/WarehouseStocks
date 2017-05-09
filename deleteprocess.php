<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
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

try {
  require "connection.php";

  $stmt = $conn->prepare(
    "DELETE FROM products WHERE products.ID = :product_id"
    );
  $stmt->bindParam('product_id', $product_id);
  $stmt->execute();
  echo "Product deleted successfully";

  //log action
  $stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, product_modified_ID, description, ip_address)
                  VALUES (:employee_ID, 4, :product_id, :description, :ip)');

  $descFormat = 'Product {%s} deleted';
  $desc = sprintf($descFormat, $productInfo);
  $employee_ID = $_SESSION['ID'];
  require 'ipaddress.php';
  $ip = get_client_ip();
  $stmt->bindParam(':employee_ID', $employee_ID);
  $stmt->bindParam(':product_id', $product_id);
  $stmt->bindParam(':description', $desc);
  $stmt->bindParam(':ip', $ip);
  $stmt->execute();
  echo '<p><a href="/warehousestocks/products.php">Go Back</a></p>';

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
</body>
<?php include 'footer.html'; ?>
</html>
