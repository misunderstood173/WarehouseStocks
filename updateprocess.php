<title>Update Product</title>
<?php
require('userconnectedcheck.php');

$product_id = trim($_POST['product_id']);
//new attributes
$product_name = trim($_POST['product_name']);
$product_country = trim($_POST['product_country']);
$product_quantity = trim($_POST['product_quantity']);
$product_UM = trim($_POST['product_UM']);
//old attributes
$old_product_name = $_POST['old_product_name'];
$old_product_country = $_POST['old_product_country'];
$old_product_quantity = $_POST['old_product_quantity'];
$old_product_UM = $_POST['old_product_UM'];


try {
  if ($product_name != '' && $product_country != '' && $product_quantity != '' && $product_UM != '') {
    require 'connection.php';
    require 'getIDqueries.php';
    require 'productsActions.php';
    require 'menu.php';
    echo buildDefaultMenu();

    $UM_ID = getUnitOfMeasureID($conn, $product_UM);
    $country_ID = getCountryID($conn, $product_country);
    $employee_ID = $_SESSION['ID'];

    updateProduct($conn, $product_id, $product_name, $country_ID, $product_quantity, $UM_ID);

    //log action
    $stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, product_modified_ID, description, ip_address)
                  VALUES (:employee_ID, 3, :product_id, :description, :ip)');

    $descFormat = 'Product {%s, %s, %s, %s} modified to {%s, %s, %s, %s}';
    $desc = sprintf($descFormat, $old_product_name, $old_product_country, $old_product_quantity, $old_product_UM,
                  $product_name, $product_country, $product_quantity, $product_UM);
    require 'ipaddress.php';
    $ip = get_client_ip();
    $stmt->bindParam(':employee_ID', $employee_ID);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':description', $desc);
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();

    echo 'Product updated successfully !';
  }
  else {
    echo 'All fields required!' . '<br>';
  }

  } catch (PDOException  $e) {
    die("Connection failed: " . $e->getMessage());
  } catch (Exception $e) {
    die($e->getMessage());
  }
?>
