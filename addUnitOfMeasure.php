<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Unit of Measure</title>
	<link rel="stylesheet" href="/warehousestocks/css/input.css">
</head>
<body>
<?php
	require 'menu.php';
	echo buildDefaultMenu();
?>
	<h3>Add a unit of measure</h3>

<?php

  if(isset($_POST['um_name']) && isset($_POST['um_abbreviation']))
  {
    try {
			require 'inputTest.php';
      $um_name = inputTest($_POST['um_name']);
      $um_abbreviation = inputTest($_POST['um_abbreviation']);
      if ($um_name != '' && $um_abbreviation != '') {
        require 'connection.php';
        require 'unitsofmeasure.php';

				$um = getUnitOfMeasureByNameAndAbbreviation($conn, $um_name, $um_abbreviation);
				if ($um == False)
				{
          $sql = $conn->prepare(
            "INSERT INTO units_of_measure (unit_name, Abbreviation)
            VALUES (:um_name, :um_abbreviation)"
            );
          $sql->bindParam(':um_name', $um_name);
          $sql->bindParam(':um_abbreviation', $um_abbreviation);
          $sql->execute();
          echo 'Unit of Measure added successfully !';
				}
				else
					echo 'This Unit of Measure already exists !';

        die('<p><a href="/warehousestocks/um.php">Go back</a></p>');

      }
      else {
        echo 'All fields required!' . '<br>';
      }

        } catch (PDOException  $e) {
          die("Connection failed: " . $e->getMessage());
        } catch (Exception $e) {
					die($e->getMessage());
				}
      }


?>
<form method="post" action="#">
 	<div class="inputField">
 		<label for="um_name">Name: </label>
 		<input type="text" name="um_name" id="um_name" tabindex="1">
 	</div>
  <div class="inputField">
 		<label for="um_abbreviation">Abbreviation: </label>
 		<input type="text" name="um_abbreviation" id="um_abbreviation" tabindex="2">
 	</div>

 	<input type="submit" name="btnAddUM" value="Add Unit of Measure" tabindex="3">
</form>
</body>
</html>
