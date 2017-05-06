<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Warehouse Products</title>
	<link rel="stylesheet" href="css/table.css">
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
 <h3>All Warehouse Products</h3>
<?php

echo "<table>";
echo "<tr>
      <th>Id</th>
      <th>Product Name</th>
      <th>Origin</th>
      <th>Quantity</th>
      <th>U.M.</th>
      <th>Last modified by Employee</th>
      <th>Last time modified</th>
			<th>Action</th>
      </tr>";

try {
	require "connection.php";

  $stmt = $conn->prepare(
    "SELECT products.ID, products.Name, countries.country_name, products.Quantity,
    units_of_measure.Abbreviation, units_of_measure.unit_name ,employees.Full_name, products.Last_time_modified
    FROM products
    JOIN countries on products.Country_ID = countries.ID
    JOIN units_of_measure on products.Unit_of_measure_ID = units_of_measure.ID
    JOIN employees on products.Last_modified_by_employee_ID = employees.ID
		ORDER BY products.ID ASC"
    );
  $stmt->execute();

	$entryFormat =
	'<form method="post">
	<tr>
	 	<td>%s</td>
		<td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
		<td>
	 	 	<input type="submit" formaction="updateproduct.php" value="Update">
	    <input type="submit" formaction="deleteproduct.php" value="Delete">
			<input type="submit" formaction="productlog.php" value="View Product Log">
		</td>
	 </tr>
	 <input type="hidden" name="product_id" value="%s">
	 <input type="hidden" name="product_name" value="%s">
	 <input type="hidden" name="product_country" value="%s">
	 <input type="hidden" name="product_quantity" value="%s">
	 <input type="hidden" name="product_UM" value="%s">
	 </form>
	 ';
	foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
		echo sprintf($entryFormat, $result['ID'], $result['Name'],
								$result['country_name'], $result['Quantity'],
								$result['Abbreviation'], $result['Full_name'], $result['Last_time_modified'],
								$result['ID'], $result['Name'], $result['country_name'], $result['Quantity'],
								$result['unit_name']);
	}

	echo '</table>';

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>
