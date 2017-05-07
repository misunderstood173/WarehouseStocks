<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dispatch</title>
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
	<h3>Dispatch products</h3>

<?php

require 'productsProvider.php';
$products = array();
try {
	$products = getAllProducts();
} catch (PDOException $e) {
		die($e->getMessage());
}

	if(isset($_POST['product']) && isset($_POST['quantity']))
  {
		$required_products = array('ids' => $_POST['product'],
															 'quantities' => $_POST['quantity']);
		require 'warehouseActions.php';
		dispatchProducts($products, $required_products);

   	die('Dispatch complete !'
				. '<form id="products" method="post">
							<input type="hidden" name="JSON" value="json_arrays" >
							<input type="hidden" name="product" value=\'' . json_encode($_POST['product'], true) . '\' >
							<input type="hidden" name="quantity" value=\'' . json_encode($_POST['quantity'], true) . '\' >
							<input type="submit" name="btnSaveTemplate" formaction="SaveTemplate.php" value="Save As Template">
					 </form>'
				);
	}

?>
<form id="products" method="post" action="#">
</form>

<button type="button" name="btnAddProduct" onclick="addProduct()">Add Entry</button>

<script type="text/javascript">
products = <?php echo json_encode($products); ?>;
btnSend = '<input type="submit" name="btnSend" value="Send entries">';
btnSaveTemplate = '<input type="submit" name="btnSaveTemplate" formaction="SaveTemplate.php" value="Save As Template">';
current_id = 0;
function addProduct() {
	if(current_id >= products.length)
		return;
	usedIDs = getAllUsedIDs();
  product_options_value = getAllElementsValueFromFormByTagAndName('products', 'select', 'product[]');
  quantities = getAllElementsValueFromFormByTagAndName('products', 'input', 'quantity[]');
	products_max = getAllPreviousProductsMax();


  product_options_value.push('');
  quantities.push('');
	products_max.push(products[getFirstUnusedID()]['quantity']);
  var formElements = '';

  for (var i = 0; i < current_id + 1; i++) {
    formElements +=
    '<div class="productFields"> \
      <div class="inputField"> \
    		<label for="product[]">Product name: </label> \
        <select id="product' + i + '" name="product[]" onfocus="this.oldValue = this.value; \
				this.oldIndex = this.selectedIndex;" onChange="onChangeSelect(this)"> \
         ' + buildProductOptionsAndSelectByValue(usedIDs, product_options_value[i]) + '\
        </select> \
    	</div> \
      <div class="inputField"> \
    		<label for="quantity[]">Quantity: </label> \
    		<input type="text" id="quantity' + i + '" name="quantity[]" min="0" max="' + products_max[i]
				 + '" onInput="maxLimitCheck(this)"value="' + quantities[i] + '"> \
    	</div> \
    </div>';
  }
  current_id++;

  document.getElementById("products").innerHTML = formElements + '<br>' + btnSend + btnSaveTemplate;
	onChangeSelect(document.getElementById('product' + (current_id - 1)));
}

function onChangeSelect(selectObject)
{
	var elements = document.getElementById('products').getElementsByTagName('select');
	if (!selectObject.hasOwnProperty('oldIndex') && !selectObject.hasOwnProperty('oldValue')) {
		for (var i = 0; i < elements.length; i++) {
			if(elements[i] != selectObject)
				elements[i].options[selectObject.selectedIndex].disabled = true;
		}
	}
	else {
		for (var i = 0; i < elements.length; i++) {
			if(elements[i] != selectObject)
			{
				elements[i].options[selectObject.selectedIndex].disabled = true;
				elements[i].options[selectObject.oldIndex].disabled = false;
			}
		}
	}
	setMaxQuantity(selectObject);
}
function setMaxQuantity(selectObject)
{
	id = selectObject.id.substr('product'.length);
	quantityElementID = 'quantity' + id;
	quantityElement = document.getElementById(quantityElementID);
	quantityElement.max = products[selectObject.value]['quantity'];
	maxLimitCheck(quantityElement);
}

function maxLimitCheck(inputNumberObject)
{
	var value = parseFloat(inputNumberObject.value);
	if (value != inputNumberObject.value) {
		inputNumberObject.value = '';
		return;
	}
	var max = parseFloat(inputNumberObject.max);
	if (value > max) {
		inputNumberObject.value = max;
	}
}


function buildProductOptionsAndSelectByValue(usedIDs, value = '')
{
	var result = '';

	for (var index in products) {
		disabled = '';
		selected = '';
		if (products[index]['ID'] == value)
			selected = ' selected';
		if((usedIDs.indexOf(products[index]['ID']) > -1) && selected == '')
			disabled = ' disabled';
	result += '<option value="' + products[index]['ID'] + '"' + selected + disabled +'>' + products[index]['name']
						+ ' | ' + products[index]['country_name'] + ' | ' + products[index]['quantity'] + ' | '
						+ products[index]['unit_of_measure'] + '</option>';
	}
	return result;
}

function getAllUsedIDs()
{
	var elements = document.getElementById('products').getElementsByTagName('select');
	var result = [];
	for (var i = 0; i < elements.length; i++) {
		result.push(elements[i].value);
	}
	return result;
}

function getFirstUnusedID()
{
	usedIDs = getAllUsedIDs();
	if (usedIDs.length == 0)
		for (var index in products)
				return products[index]['ID'];

	for (var index in products)
		if (usedIDs.indexOf(products[index]['ID']) < 0)
			return products[index]['ID'];
}

function getAllElementsValueFromFormByTagAndName(formName, tag, name)
{
	var elements = document.getElementById(formName).getElementsByTagName(tag);
	var values = [];
	for (var i = 0; i < elements.length; i++)
		if (elements[i].name == name)
				values.push(elements[i].value);
	return values;
}

function getAllPreviousProductsMax()
{
	var elements = document.getElementById('products').getElementsByTagName('input');
	var result = [];
	for (var i = 0; i < elements.length; i++)
		if (elements[i].name == 'quantity[]')
				result.push(elements[i].max);
	return result;
}
</script>

</body>
</html>
