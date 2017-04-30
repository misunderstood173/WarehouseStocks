<?php
  if (isset($_GET['p'])) {
    $p = $_GET['p'];
    echo $p;
  }
  else {
    echo 'no p';
  }
  $test = array();
  $test[] = 'asd';
  $test[] = 'def';

  function getElementAtIndex($array, $index)
  {
    if (isset($array[$index])) {
      return $array[$index];
    }
    else {
      return '';
    }
  }
  if (isset($test[1])) {
    echo '<br>is set index 1';
    echo $test[1];
    echo '<br>';
  }
  else {
    echo 'index out of bounds';
  }
  echo 'your ip address is:' . get_client_ip();

  // Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['entries'])) {
    var_dump($_POST['entries']);
  }
  else {
    $id = $_POST['id'];
    var_dump($id);
    var_dump($_POST['id2']);
  }
}

echo '<br>';
 ?>
<form method="post">
  <input type="text" name="id[]" value="1">
  <input type="text" name="id[]" value="2">
  <input type="text" name="id[]" value="3">
  <input type="text" name="id2[]" value="9">
  <input type="text" name="id2[]" value="8">
  <input type="text" name="id2[]" value="7">
  <input type="submit" formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" value="Send id">
  <input type="submit" formaction="login.php" value="Send lgin">
  <input type="submit" formaction="products.php" value="Send 32">
</form>

<br>


<form id='form1' method="post">
</form>

<button type="button" name="button" onclick="myFunction()">+</button>
<div id='test'></div>


<p id='asdf'></p>
<script>
formElements = '';
btnSend = '<input type="submit" formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" value="Send entries">';
currentId = 1;
function myFunction() {
  formElements += '<br>' + '<input name="entries[]" id="id' + currentId + '" type="text" value="test' + currentId + '">';
  currentId++;
  document.getElementById("form1").innerHTML = formElements + '<br>' + btnSend;
  var values = getAllElementsValueFromFormByName('form1', 'entries[]');
  document.getElementById('test').innerHTML = values;
}

function getAllElementsValueFromFormByName(formName, name)
{
	var elements = document.getElementById(formName).getElementsByTagName('input');
	var values = [];
	for (var i = 0; i < elements.length; i++)
		if (elements[i].name == name)
				values.push(elements[i].value);
	return values;
}
</script>



<input type="text" id="myInput" onkeyup="filterOptions()" placeholder="Search for names.." title="Type in a name">

<div id='options'></div>

<script>
function testFunction(){
  alert('works');
}
function filterOptions() {
	var options = [];
  options.push("abs");
  options.push("sdaf");
  options.push("as");
  options.push("sssd");
  options.push("wfds");
  options.push("qews");

  var input, filter, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  var filteredOptions = '';

  for (i = 0; i < options.length; i++) {
      if (options[i].toUpperCase().indexOf(filter) > -1)
          filteredOptions += '<div class="option"><label onClick="testFunction()">' + options[i] + '</label></div>'
  }
  document.getElementById('options').innerHTML = filteredOptions;
}
</script>


 <a href="updateproduct.php">No ID</a>
 <a href="updateproduct.php?product_id=2">ID = 2</a>
