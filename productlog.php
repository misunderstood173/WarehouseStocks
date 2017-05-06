<?php
include('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product <?php if (isset($_POST['product_name'])) echo $_POST['product_name']; ?> Log</title>
	<link rel="stylesheet" href="css/table.css">
</head>
<body>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_country = $_POST['product_country'];
  $product_quantity = $_POST['product_quantity'];
  $product_UM = $_POST['product_UM'];

  $productInfo = $product_name . ', ' . $product_country . ', '
              . $product_quantity . ', ' . $product_UM;
  echo '<h2>' . $productInfo . '</h2>';

  try {
    include "connection.php";

    $stmt = $conn->prepare(
      "SELECT CONCAT(employees.Full_name, ' [', employees.username, ']') AS 'Employee', employee_log.employee_ID,
            action_type.type, employee_log.action_type_ID, employee_log.description, employee_log.ip_address, employee_log.log_time
      FROM employee_log
      JOIN employees ON employees.ID = employee_log.employee_ID
      JOIN action_type on action_type.ID = employee_log.action_type_ID
      WHERE employee_log.product_modified_ID = :product_id
      ORDER BY employee_log.ID DESC"
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
    '<form method="post">
    <tr>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
     </tr>
     <input type="hidden" name="employee_ID" value="%s">
     <input type="hidden" name="action_type_ID" value="%s">
     <input type="hidden" name="description" value="%s">
     <input type="hidden" name="log_time" value="%s">
     <input type="hidden" name="ip_address" value="%s">
     </form>
     ';
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['Employee'], $result['type'],
                  $result['description'], $result['log_time'], $result['ip_address'],
                  $result['employee_ID'], $result['action_type_ID'], $result['description'], $result['log_time'],
                  $result['ip_address']);
    }

    echo '</table>';
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
