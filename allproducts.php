<!doctype html>
<html>
<head>
	<title>Warehouse Products</title>
	<link rel="stylesheet" href="css/table.css">
</head>
<body>
  <h3>All products in warehouse</h3>
<?php

echo "<table>";
echo "<tr>
      <th>Product Name</th>
      <th>Origin</th>
      <th>Quantity</th>
      <th>U.M.</th>
      </tr>";

try {
	include "connection.php";

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
	 </tr>
	 </form>
	 ';
	foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
		echo sprintf($entryFormat, $result['Name'], $result['country_name'],
                $result['Quantity'], $result['Abbreviation']);
	}

	echo '</table>';

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
	<p><a href="index.html">Go back</a></p>
</body>
</html>
