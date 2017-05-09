<?php
function buildMenu($linkCaptionDictionary)
{
  $menu = '<header>' . 
          '<nav><ul class="menu">' .
          '<h2 class="title">Warehouse</h2>' .
          '<link rel="stylesheet" href="/warehousestocks/css/menu.css">';
  foreach ($linkCaptionDictionary as $link => $caption) {
    $menu .= '<li><a href="' . $link . '">' . $caption . '</a></li>';
  }
  $menu .= '</ul></nav>' . '</header>';
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
