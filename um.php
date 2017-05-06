<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
	<title>All Units of Measure</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
<h3>All Warehouse Units of Measure</h3>

<?php
echo "<table>";
echo "<tr>
      <th>ID</th>
      <th>Unit name</th>
      <th>Abbreviation</th>
			<th>Action</th>
      </tr>";

try {
  require "connection.php";
  $stmt = $conn->prepare(
    'SELECT units_of_measure.ID, units_of_measure.unit_name, units_of_measure.Abbreviation
    FROM units_of_measure'
    );
  $stmt->execute();

  $entryFormat =
    '<form method="post">
  	<tr>
  	 	<td>%s</td>
  		<td>%s</td>
  	  <td>%s</td>
  		<td>
  	 	 	<input type="submit" formaction="editUnitOfMeasure.php" value="Edit">
  		</td>
  	 </tr>
  	 <input type="hidden" name="um_id" value="%s">
  	 </form>
  	 ';
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['ID'], $result['unit_name'], $result['Abbreviation'],
                  $result['ID']);
  }

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo '</table>';

?>

<a href="addUnitOfMeasure.php">Add new unit of measure</a>

</body>
</html>
