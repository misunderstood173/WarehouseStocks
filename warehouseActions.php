<?php
require 'productsActions.php';
function receiveProducts($products)
{
  try {
    require "connection.php";
    require 'ipaddress.php';

    $length = count($products['product_name']);

    for ($i=0; $i < $length; $i++) {
      $product_name = $products['product_name'][$i];
      $product_country_id = $products['product_country_id'][$i];
      $product_quantity = $products['product_quantity'][$i];
      $product_UM_id = $products['product_UM_id'][$i];

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
                    VALUES (:employee_ID, 8, :product_id, :description, :ip)');
      $ip = get_client_ip();
      $stmt->bindParam(':employee_ID', $_SESSION['ID']);
      $stmt->bindParam(':product_id', $product_id);
      $stmt->bindParam(':description', $desc);
      $stmt->bindParam(':ip', $ip);
      $stmt->execute();
      }
    } catch (PDOException  $e) {
      die("Connection failed: " . $e->getMessage());
    } catch (Exception $e) {
      die($e->getMessage());
    }
}

function dispatchProducts($allProducts, $required_products)
{
	try {
		require "connection.php";
		require 'ipaddress.php';

		$length = count($required_products['ids']);
		//check quantities
		for ($i=0; $i < $length; $i++) {
			$req_quantity = $required_products['quantities'][$i];
			$req_product_id = $required_products['ids'][$i];
			$warehouse_stock = getProductQuantity($conn, $req_product_id);
			if (floatval($req_quantity) > $warehouse_stock) {
				die('Not enough in stock for ' . "'" . $allProducts[$req_product_id]['name'] . "'"
						. '. Warehouse stock: ' . $warehouse_stock
						. '. You requested ' . $req_quantity);
			}
			//refresh cached products quantity
			$allProducts[$req_product_id]['quantity'] = $warehouse_stock;
		}

		for ($i=0; $i < $length; $i++) {
			$req_quantity = floatval($required_products['quantities'][$i]);
			$req_product_id = $required_products['ids'][$i];
			$new_product_quantity = floatval($allProducts[$req_product_id]['quantity']) - $req_quantity;
			updateProductQuantity($conn, $allProducts[$req_product_id], $new_product_quantity);
			$allProducts[$req_product_id]['quantity'] = $new_product_quantity;
		}

		} catch (PDOException  $e) {
			die("Connection failed: " . $e->getMessage());
		} catch (Exception $e) {
			die($e->getMessage());
		}
}

function updateProductQuantity($conn, $product, $new_product_quantity)
{
	$employee_ID = $_SESSION['ID'];
	$old_product_quantity = $product['quantity'];
	try {
		$sql = $conn->prepare(
			"UPDATE products SET Quantity = :product_quantity, Last_modified_by_employee_ID = :employee_ID WHERE products.ID = :product_id"
			);
		$sql->bindParam(':product_quantity', $new_product_quantity);
		$sql->bindParam(':employee_ID', $employee_ID);
		$sql->bindParam(':product_id', $product['ID']);
		$sql->execute();

		$product['quantity'] = $new_product_quantity;

		//log action
		$stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, product_modified_ID, description, ip_address)
									VALUES (:employee_ID, 7, :product_id, :description, :ip)');

		$descFormat = 'Product quantity modified from %s to %s';
		$desc = sprintf($descFormat, $old_product_quantity, $new_product_quantity);
		$ip = get_client_ip();
		$stmt->bindParam(':employee_ID', $employee_ID);
		$stmt->bindParam(':product_id', $product['ID']);
		$stmt->bindParam(':description', $desc);
		$stmt->bindParam(':ip', $ip);
		$stmt->execute();
	} catch (PDOException  $e) {
    throw new PDOException("Can't dispatch product" . $e->getMessage());
  }
}
?>
