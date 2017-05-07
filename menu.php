<?php
function buildMenu($linkCaptionDictionary)
{
  echo '<h2>Warehouse</h2>';
  echo '<link rel="stylesheet" href="/warehousestocks/css/menu.css">';

  $menu ='<nav><ul class="menu">';
  foreach ($linkCaptionDictionary as $link => $caption) {
    $menu .= '<li><a href="' . $link . '">' . $caption . '</a></li>';
  }
  $menu .= '</ul></nav>';
  return $menu;
}

function buildDefaultMenu()
{
  $menuArray = array(
          '/warehousestocks/dispatch.php' => 'Dispatch',
          '/warehousestocks/receive.php' => 'Receive',
          '/warehousestocks/addproduct.php' => 'Add Product',
          '/warehousestocks/products.php' => 'All Products',
          '/warehousestocks/warehouse.php' => 'Go to Warehouse',
          '/warehousestocks/logout.php' => 'Log Out');
  return buildMenu($menuArray);
}
 ?>
