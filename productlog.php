<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product <?php if (isset($_POST['product_name'])) echo $_POST['product_name']; ?> Log</title>
	<link rel="stylesheet" href="/warehousestocks/css/table.css">
</head>
<body>


<?php
$results_per_page = 20;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
if (isset($_GET["product_id"])) { $product_id  = $_GET["product_id"]; } else { $product_id=1; };
$start_from = ($page-1) * $results_per_page;

if (isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
}

  try {
    require "connection.php";
		require 'productsActions.php';
		$product = getProductDetailsByID($conn, $product_id);
		$product_name = $product['Name'];
		$product_country = $product['country_name'];
		$product_quantity = $product['Quantity'];
		$product_UM = $product['unit_name'];

		$productInfo = $product_name . ' | ' . $product_country . ' | '
								. $product_quantity . ' | ' . $product_UM;
		echo '<h2>' . $productInfo . '</h2>';

    $stmt = $conn->prepare(
      "SELECT CONCAT(employees.Full_name, ' [', employees.username, ']') AS 'Employee', employee_log.employee_ID,
            action_type.type, employee_log.action_type_ID, employee_log.description, employee_log.ip_address, employee_log.log_time
      FROM employee_log
      JOIN employees ON employees.ID = employee_log.employee_ID
      JOIN action_type on action_type.ID = employee_log.action_type_ID
      WHERE employee_log.product_modified_ID = :product_id
      ORDER BY employee_log.ID DESC
			LIMIT " . $start_from . ", " . $results_per_page
      );
    $stmt->bindParam('product_id', $product_id);
    $stmt->execute();

    echo "<table>";
    echo "<tr>
          <th>Employee</th>
          <th>Action</th>
          <th>Description</th>
          <th>Log time</th>
          <th>IP address</th>
          </tr>";

    $entryFormat =
    '<tr>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
     </tr>
     ';
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['Employee'], $result['type'],
                  $result['description'], $result['log_time'], $result['ip_address'],
                  $result['employee_ID'], $result['action_type_ID'], $result['description'], $result['log_time'],
                  $result['ip_address']);
    }

    echo '</table>';

		$stmt = $conn->prepare("SELECT COUNT(ID) AS total FROM employee_log WHERE employee_log.product_modified_ID = :product_id");
		$stmt->bindParam('product_id', $product_id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$total_pages = ceil($row["total"] / $results_per_page);

		for ($i=1; $i<=$total_pages; $i++) {
		            echo "<a href='/warehousestocks/productlog.php?product_id=" . $product_id . "&page=" . $i . "'";
		            if ($i==$page)  echo " class='currentPage'";
		            echo ">".$i."</a> ";
		};

  } catch (PDOException  $e) {
    echo "Connection failed: " . $e->getMessage();
  }

 ?>
  <p><a href="/warehousestocks/products.php">Go to All Products</a></p>
	<?php include 'footer.html'; ?>
</body>
</html>
