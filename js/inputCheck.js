function validNumberCheck(inputNumberObject)
{
	var value = parseFloat(inputNumberObject.value);
	if (value != inputNumberObject.value) {
		inputNumberObject.value = '';
		return;
	}
}
