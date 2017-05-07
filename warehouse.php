
<!doctype html>
<html>
<head>
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

echo 'Welcome ' . $_SESSION["user"] .'!';
?>

</body>
</html>
