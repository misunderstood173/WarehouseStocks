<?php

function updateProduct($conn, $product_id, $product_name, $product_country_id, $product_quantity, $product_UM_id)
{
  try {
    $product = checkIfProductExists($conn, $product_name, $product_country_id, $product_UM_id);
    if ($product && $product['ID'] != $product_id) {
      throw new Exception('Product already exists');
    }
    $employee_ID = $_SESSION['ID'];

    $sql = $conn->prepare(
      "UPDATE products SET Name = :name, Country_ID = :country_ID, Quantity = :product_quantity,
      Unit_of_measure_ID = :UM_ID, Last_modified_by_employee_ID = :employee_ID WHERE products.ID = :product_id"
      );
    $sql->bindParam(':name', $product_name);
    $sql->bindParam(':country_ID', $product_country_id);
    $sql->bindParam(':product_quantity', $product_quantity);
    $sql->bindParam(':UM_ID', $product_UM_id);
    $sql->bindParam(':employee_ID', $employee_ID);
    $sql->bindParam(':product_id', $product_id);
    $sql->execute();
  } catch (PDOException $e) {
		throw new PDOException("Can't update product " . $e->getMessage());
	}
}

function addProduct($conn, $product_name, $product_country_id, $product_quantity, $product_UM_id)
{
	try {
		$employee_ID = $_SESSION['ID'];

		$sql = $conn->prepare(
			"INSERT INTO products (Name, Country_ID, Quantity,
				Unit_of_measure_ID, Last_modified_by_employee_ID)
				VALUES (:name, :country, :quantity, :UM, :employee_ID)"
			);
		$sql->bindParam(':name', $product_name);
		$sql->bindParam(':country', $product_country_id);
		$sql->bindParam(':quantity', $product_quantity);
		$sql->bindParam(':UM', $product_UM_id);
		$sql->bindParam(':employee_ID', $employee_ID);
		$sql->execute();
	} catch (PDOException $e) {
		throw new PDOException("Can't add product " . $e->getMessage());
	}
}

function checkIfProductExists($conn, $product_name, $product_country_id, $product_UM_id)
{
	try {
		$sql = $conn->prepare(
			"SELECT *
			FROM products
			WHERE LOWER(products.Name) = LOWER(:name) AND products.Country_ID = :country_id
						AND products.Unit_of_measure_ID = :UM_ID"
			);
		$sql->bindParam(':name', $product_name);
		$sql->bindParam(':country_id', $product_country_id);
		$sql->bindParam(':UM_ID', $product_UM_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't check if product exists " . $e->getMessage());
	}
}

function getProductByID($conn, $product_id)
{
	try {
		$sql = $conn->prepare(
			"SELECT *
			FROM products
			WHERE products.ID = :product_id"
			);
		$sql->bindParam(':product_id', $product_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get product " . $e->getMessage());
	}
}

function getProductDetailsByID($conn, $product_id)
{
	try {
		$sql = $conn->prepare(
			"SELECT products.ID, products.Name, countries.country_name, products.Quantity,
    	units_of_measure.Abbreviation, units_of_measure.unit_name ,employees.Full_name, products.Last_time_modified
    	FROM products
    	LEFT JOIN countries on products.Country_ID = countries.ID
    	LEFT JOIN units_of_measure on products.Unit_of_measure_ID = units_of_measure.ID
    	JOIN employees on products.Last_modified_by_employee_ID = employees.ID
      WHERE products.ID = :product_id"
			);
		$sql->bindParam(':product_id', $product_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get product " . $e->getMessage());
	}
}

function getProductQuantity($conn, $id)
{
	try {
    $stmt = $conn->prepare(
      "SELECT products.Quantity
			FROM products
			WHERE products.ID = :id"
      );
		$stmt->bindParam(':id', $id);
    $stmt->execute();

		return floatval($stmt->fetch(PDO::FETCH_ASSOC)['Quantity']);

  } catch (PDOException  $e) {
    throw new PDOException("Can't get product quantity" . $e->getMessage());
  }
}

?>
