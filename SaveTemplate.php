<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  try {
    require "connection.php";
    require 'productsActions.php';

    if (isset($_POST['JSON'])) {
      $_POST['product'] = json_decode($_POST['product'], true);
      $_POST['quantity'] = json_decode($_POST['quantity'], true);
    }

    $required_products = array('ids' => $_POST['product'],
                               'quantities' => $_POST['quantity']);

    $products = array(
      'product_name' => array(),
      'product_country_id' => array(),
      'product_quantity' => array(),
      'product_UM_id' => array()
    );
    $length = count($required_products['ids']);
		for ($i=0; $i < $length; $i++) {
      $prod = getProductByID($conn, $required_products['ids'][$i]);
      $products['product_name'][] = $prod['Name'];
      $products['product_country_id'][] = $prod['Country_ID'];
      $products['product_quantity'][] = $required_products['quantities'][$i];
      $products['product_UM_id'][] = $prod['Unit_of_measure_ID'];
		}

    require 'downloadVariableJSON.php';
    downloadVariableWithName($products, 'dispatchTemplate');

    } catch (PDOException  $e) {
      die("Connection failed: " . $e->getMessage());
    } catch (Exception $e) {
      die($e->getMessage());
    }
}
?>
