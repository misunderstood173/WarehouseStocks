
<!doctype html>
<html>
<head>
	<title>Warehouse</title>
</head>
<body>
<?php
include('userconnectedcheck.php');

include 'menu.php';
$menuArray = array(
				'dispatch.php' => 'Dispatch',
				'receive.php' => 'Receive',
				'addproduct.php' => 'Add Product',
				'products.php' => 'All Products',
				'userlog.php' => 'My log');

if (isset($_SESSION['admin'])) {
	$menuArray['users.php'] = 'Users';
	$menuArray['um.php'] = 'Units of measure';
}
$menuArray['logout.php'] = 'Log Out';
echo buildMenu($menuArray);

echo 'Welcome ' . $_SESSION["user"] .'!';
?>

</body>
</html>
