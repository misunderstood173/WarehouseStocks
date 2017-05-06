<?php
include('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<title>Edit Unit of Measure</title>
</head>
<body>


<?php
include 'menu.php';
echo buildDefaultMenu();
if (!isset($_POST['um_id'])) {
  die();
}

try {
  require 'connection.php';
  require 'unitsofmeasure.php';

  $um_id = $_POST['um_id'];
  $um = getUnitOfMeasureByID($conn, $um_id);

} catch (PDOException  $e) {
  die("Connection failed: " . $e->getMessage());
} catch (Exception $e) {
  die($e->getMessage());
}

?>
<p>Edit Unit of Measure</p>

 <form method="post" action="editUMprocess.php">
  <input type="hidden" name="um_id" value="<?php echo $um['ID']; ?>">
 	<div class="inputField">
 		<label for="um_name">Name: </label>
 		<input type="text" name="um_name" id="um_name" tabindex="1" value="<?php echo $um['unit_name']; ?>">
 	</div>
  <div class="inputField">
 		<label for="um_abbreviation">Abbreviation: </label>
 		<input type="text" name="um_abbreviation" id="um_abbreviation" tabindex="2" value="<?php echo $um['Abbreviation']; ?>">
 	</div>

 	<input type="submit" name="btnEditUM" value="Edit" tabindex="3">
 </form>
 </body>
 </html>
