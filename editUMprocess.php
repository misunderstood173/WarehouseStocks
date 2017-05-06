<?php
include('userconnectedcheck.php');

if (isset($_POST['um_id']) && isset($_POST['um_name']) && isset($_POST['um_abbreviation'])) {
  $um_id = $_POST['um_id'];
  $um_name = trim($_POST['um_name']);
  $um_abbreviation = trim($_POST['um_abbreviation']);

  try {
    if ($um_name != '' && $um_abbreviation != '') {
      include 'connection.php';
      include 'menu.php';
      require 'unitsofmeasure.php';

      $sql = $conn->prepare(
        "UPDATE units_of_measure SET unit_name = :um_name, Abbreviation = :um_abbreviation
        WHERE units_of_measure.ID = :um_id"
        );
      $sql->bindParam(':um_name', $um_name);
      $sql->bindParam(':um_abbreviation', $um_abbreviation);
      $sql->bindParam(':um_id', $um_id);
      $sql->execute();

      echo 'Unit of Measure updated successfully !';
    }
    else {
      echo 'All fields required!';
    }

    echo  '<p><a href="um.php">Go back</a></p>';

    } catch (PDOException  $e) {
      die("Connection failed: " . $e->getMessage());
    } catch (Exception $e) {
      die($e->getMessage());
    }
}
?>
