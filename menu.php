<?php
function buildMenu($linkCaptionDictionary)
{
  $menu ='<aside><ul class="menu">';
  foreach ($linkCaptionDictionary as $link => $caption) {
    $menu .= '<li><a href="' . $link . '">' . $caption . '</a></li>';
  }
  $menu .= '</ul></aside>';
  return $menu;
}

function buildDefaultMenu()
{
  $menuArray = array(
          'dispatch.php' => 'Dispatch',
          'receive.php' => 'Receive',
          'addproduct.php' => 'Add Product',
          'products.php' => 'All Products',
          'warehouse.php' => 'Go to Warehouse',
          'logout.php' => 'Log Out');
  return buildMenu($menuArray);
}
 ?>
