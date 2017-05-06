<?php
function getAllProducts()
{
  try {
    require "connection.php";

    $stmt = $conn->prepare(
      "SELECT products.ID, products.Name, countries.country_name, products.Quantity,
      units_of_measure.Abbreviation, employees.Full_name, products.Last_time_modified
      FROM products
      JOIN countries on products.Country_ID = countries.ID
      JOIN units_of_measure on products.Unit_of_measure_ID = units_of_measure.ID
      JOIN employees on products.Last_modified_by_employee_ID = employees.ID"
      );
    $stmt->execute();

    $products = array();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      $products[$result['ID']] = array(
        'ID' => $result['ID'],
        'name' => $result['Name'],
        'country_name' => $result['country_name'],
        'quantity' => $result['Quantity'],
        'unit_of_measure' => $result['Abbreviation']
      );
    }
  } catch (PDOException  $e) {
    throw new PDOException("Can't get product list" . $e->getMessage());
  }
  return $products;
}
?>
