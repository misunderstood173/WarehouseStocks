<?php
include('userconnectedcheck.php');
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  try {
    include "connection.php";

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
    include 'ipaddress.php';
    $ip = get_client_ip();
    $stmt->bindParam(':employee_ID', $employee_ID);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':description', $desc);
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();
    die('<p><a href="products.php">Go Back</a></p>');

  } catch (PDOException  $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
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
  <p><a href="products.php">Go Back</a></p>
</body>
</html>
