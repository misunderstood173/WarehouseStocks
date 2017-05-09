<?php
require('userconnectedcheck.php');
$user = $_SESSION['user'];
$user_id = $_SESSION['ID'];
if (isset($_POST['user_id']) && isset($_POST['user_full_name'])) {
	$user = $_POST['user_full_name'];
	$user_id = $_POST['user_id'];
}

if (isset($_GET["user_id"])) {
	$user_id  = $_GET["user_id"];
	try {
		require "connection.php";
		require 'usersActions.php';
		$user = getUserByID($conn, $user_id)['Full_name'];
	} catch (PDOException  $e) {
	  echo "Connection failed: " . $e->getMessage();
	}
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/warehousestocks/css/table.css">
	<title><?php echo $user. "'s log"; ?></title>
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
	<h3><?php echo $user. "'s log"; ?></h3>
<?php
$results_per_page = 20;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $results_per_page;

echo "<table>";
echo "<tr>
      <th>Action</th>
      <th>Description</th>
      <th>Product ID</th>
      <th>Log time</th>
      <th>IP address</th>
      </tr>";

try {
  require "connection.php";

  $stmt = $conn->prepare(
    'SELECT action_type.type, employee_log.description,  employee_log.product_modified_ID,
    employee_log.log_time ,employee_log.ip_address
    FROM employee_log
    JOIN action_type ON employee_log.action_type_ID = action_type.ID
    WHERE employee_log.employee_ID = :employee_ID
    ORDER BY employee_log.log_time DESC
		LIMIT ' . $start_from . ', ' . $results_per_page
    );
  $stmt->bindParam(':employee_ID', $user_id);
  $stmt->execute();

  $entryFormat =
  "<tr>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
  </tr>
  ";
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['type'], $result['description'],
                  $result['product_modified_ID'], $result['log_time'], $result['ip_address']);
  }
	echo '</table>';

	$stmt = $conn->prepare("SELECT COUNT(ID) AS total FROM employee_log WHERE employee_log.employee_ID = :employee_ID");
	$stmt->bindParam(':employee_ID', $user_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$total_pages = ceil($row["total"] / $results_per_page);

	for ($i=1; $i<=$total_pages; $i++) {
	            echo "<a href='/warehousestocks/userlog.php?user_id=" . $user_id . "&page=" . $i . "'";
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
