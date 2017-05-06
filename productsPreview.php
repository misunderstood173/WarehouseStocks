<?php
function previewProducts($products)
{
  try{
    require "connection.php";
    require "countries.php";
    require "unitsofmeasure.php";

    echo "<table>";
    echo "<tr>
          <th>Product name</th>
          <th>Country</th>
          <th>Quantity</th>
          <th>Unit of measure</th>
          </tr>";
    $entryFormat =
            '<tr>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
             </tr>
             ';
    $length = count($products['product_name']);
    for ($i=0; $i < $length; $i++) {
      $product_name = $products['product_name'][$i];
      $product_country = getCountryById($conn, $products['product_country_id'][$i])['country_name'];
      $product_quantity = $products['product_quantity'][$i];
      $product_UM = getUnitOfMeasureByID($conn, $products['product_UM_id'][$i])['unit_name'];

      echo sprintf($entryFormat, $product_name, $product_country, $product_quantity, $product_UM);
    }

    echo '</table>';

  } catch (PDOException  $e) {
    die("Connection failed: " . $e->getMessage());
  } catch (Exception $e) {
    die($e->getMessage());
  }
}

?>
