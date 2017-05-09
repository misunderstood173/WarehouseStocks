<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Warehouse Products</title>
	<link rel="stylesheet" href="/warehousestocks/css/table.css">
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
 <h3>All Warehouse Products</h3>

<?php
$results_per_page = 10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $results_per_page;

try {
	require "connection.php";

	$stmt = $conn->prepare('SELECT products.ID, products.Name, countries.country_name, products.Quantity,
					units_of_measure.Abbreviation, units_of_measure.unit_name ,employees.Full_name, products.Last_time_modified
					FROM products
					LEFT JOIN countries on products.Country_ID = countries.ID
					LEFT JOIN units_of_measure on products.Unit_of_measure_ID = units_of_measure.ID
					JOIN employees on products.Last_modified_by_employee_ID = employees.ID
					ORDER BY products.ID ASC
					LIMIT ' . $start_from . ', ' . $results_per_page);
	$stmt->execute();

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

	$entryFormat =
	'<tr>
	 	<td>%s</td>
		<td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
	  <td>%s</td>
		<td>
			<form method="post">
		 	 	<input type="submit" formaction="updateproduct.php" value="Update">
		    <input type="submit" formaction="deleteproduct.php" value="Delete">
				<input type="submit" formaction="productlog.php" value="View Product Log">

				<input type="hidden" name="product_id" value="%s">
			 	<input type="hidden" name="product_name" value="%s">
			 	<input type="hidden" name="product_country" value="%s">
			 	<input type="hidden" name="product_quantity" value="%s">
			 	<input type="hidden" name="product_UM" value="%s">
		 	</form>
		</td>
	 </tr>
	 ';
	foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
		echo sprintf($entryFormat, $result['ID'], $result['Name'],
								$result['country_name'], $result['Quantity'],
								$result['Abbreviation'], $result['Full_name'], $result['Last_time_modified'],
								$result['ID'], $result['Name'], $result['country_name'], $result['Quantity'],
								$result['unit_name']);
	}
	echo '</table>';

	$stmt = $conn->prepare("SELECT COUNT(ID) AS total FROM products");
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$total_pages = ceil($row["total"] / $results_per_page);

	for ($i=1; $i<=$total_pages; $i++) {
	            echo "<a href='/warehousestocks/products.php?page=" . $i . "'";
	            if ($i==$page)  echo " class='currentPage'";
	            echo ">".$i."</a> ";
	};

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
<?php include 'footer.html'; ?>
</body>
</html>
