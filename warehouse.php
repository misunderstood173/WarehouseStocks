<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Warehouse</title>
</head>
<body>
<?php
require('userconnectedcheck.php');

require 'menu.php';
$menuArray = array(
				'/warehousestocks/dispatch.php' => 'Dispatch',
				'/warehousestocks/receive.php' => 'Receive',
				'/warehousestocks/addproduct.php' => 'Add Product',
				'/warehousestocks/products.php' => 'All Products',
				'/warehousestocks/userlog.php' => 'My log');

if (isset($_SESSION['admin'])) {
	$menuArray['/warehousestocks/users.php'] = 'Users';
	$menuArray['/warehousestocks/um.php'] = 'Units of measure';
}
$menuArray['/warehousestocks/logout.php'] = 'Log Out';
echo buildMenu($menuArray);

echo '<p>Welcome ' . $_SESSION["user"] .'!</p>';

?>
<?php include 'footer.html'; ?>
</body>
</html>
