<?php
require('userconnectedcheck.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Receive</title>
	<script type="text/javascript"  src="js/inputCheck.js"></script>
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
	<h3>Receive products</h3>

<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    require 'warehouseActions.php';
    receiveProducts($_POST);

    die('Products received !' . '');
  }

?>
<div class="receiveProductsFromFile">
	<span>Receive Products From File</span>
	<form action="receiveProductsFromFile.php" method="post" enctype="multipart/form-data">
	    <input type="file" name="JSONfile" id="JSONfile">
	    <input type="submit" name="btnReceive" value="Receive">
	</form>
</div>

<form id="products" method="post" action="#">

</form>

<div class="products">
	<form id="products" method="post" action="#">
	</form>

	<button type="button" name="btnAddProduct" onClick="addProduct()">Add Entry</button>
</div>

<script type="text/javascript">
countries = <?php require("countries.php"); echo json_encode(AllCountries()); ?>;
countriesOptions = '';
for (var index in countries) {
  countriesOptions += '<option value="' + index + '">' + countries[index] + '</option>' + '\n';
}

unitsOfMeasure = <?php require("unitsofmeasure.php"); echo json_encode(AllUnitsOfMeasure()); ?>;
UMoptions = '';
for (var index in unitsOfMeasure) {
  UMoptions += '<option value="' + index + '">' + unitsOfMeasure[index] + '</option>' + '\n';
}

btnSend = '<input type="submit" name="btnSend" value="Send entries">';
current_id = 0;

function addProduct() {
  var inputSoFar = getInputSoFar();
  inputSoFar['product_name'].push('');
  inputSoFar['product_quantity'].push('');
  inputSoFar['product_country_id'].push('');
  inputSoFar['product_UM_id'].push('');
  var formElements = '';
  for (var i = 0; i < current_id + 1; i++) {
    formElements +=
    '<div class="product"> \
      <div class="inputField"> \
    		<label for="product_name[]">Product name: </label> \
    		<input type="text" name="product_name[]" maxlength="255" value="' + inputSoFar['product_name'][i] + '"> \
    	</div> \
      <div class="inputField"> \
    		<label for="product_country_id[]">Country of Origin: </label> \
    		<select name="product_country_id[]">' + getOptionsAndSelectByValue(countries, inputSoFar['product_country_id'][i]) + '\
    		</select> \
    	</div> \
      <div class="inputField"> \
    		<label for="product_quantity[]">Quantity: </label> \
    		<input type="text" name="product_quantity[]" onInput="validNumberCheck(this)" value="' + inputSoFar['product_quantity'][i] + '"> \
    	</div> \
      <div class="inputField"> \
    		<label for="product_UM_id[]">Unit of measure: </label> \
    		<select name="product_UM_id[]">' + getOptionsAndSelectByValue(unitsOfMeasure, inputSoFar['product_UM_id'][i]) + ' \
        </select> \
    	</div> \
    </div>';
  }
  current_id++;

  document.getElementById("products").innerHTML = formElements + '<br>' + btnSend;
}

function getOptionsAndSelectByValue(array, value)
{
  var result = '';
  for (var index in array) {
    selected = '';
    if (index == value) {
      selected = ' selected';
    }
    result += '<option value="' + index + '"' + selected + '>' + array[index] + '</option>' + '\n';
  }
  return result;
}

function getInputSoFar()
{
	var elements = document.getElementById('products').getElementsByTagName('input');
	var result = [];
  var names = [];
  var quantities = [];
	for (var i = 0; i < elements.length; i++) {
  //  alert(elements[i].value);
		if (elements[i].name == 'product_name[]')
				names.push(elements[i].value);
    else if (elements[i].name == 'product_quantity[]')
    		quantities.push(elements[i].value);
  }
  result['product_name'] = names;
  result['product_quantity'] = quantities;

  elements = document.getElementById('products').getElementsByTagName('select');
  var countryIds = [];
  var UMids = [];
	for (var i = 0; i < elements.length; i++) {
  //  alert(elements[i].value);
		if (elements[i].name == 'product_country_id[]')
				countryIds.push(elements[i].value);
    else if (elements[i].name == 'product_UM_id[]')
    		UMids.push(elements[i].value);
  }
  result['product_country_id'] = countryIds;
  result['product_UM_id'] = UMids;

	return result;
}

</script>

</body>
</html>
