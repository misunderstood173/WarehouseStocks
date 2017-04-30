
<!doctype html>
<html>
<head>
	<title>Warehouse</title>
</head>
<body>
<?php
include('userconnectedcheck.php');
echo 'Welcome ' . $_SESSION["user"] .'!';

include 'menu.php';
$menuArray = array(
				'dispatch.php' => 'Dispatch',
				'receive.php' => 'Receive',
				'addproduct.php' => 'Add Product',
				'products.php' => 'All Products',
				'userlog.php' => 'My log');

if (isset($_SESSION['admin'])) {
	$menuArray['users.php'] = 'Users';
}
$menuArray['logout.php'] = 'Log Out';
echo buildMenu($menuArray);
?>

</body>
</html>
