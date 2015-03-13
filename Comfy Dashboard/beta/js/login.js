function checkRadioNameValidity(field) 
{
	var maxlimit = 30;
	var minlimit = 3;
	var x = document.getElementById('go-button');
	if (field.value.length > minlimit && field.value.length < maxlimit) // if too long...trim it!
	{
		x.style.color = '#9CFF61';
		return true;
	}
	else
	{
		x.style.color = '#A29B9F';
		return false;
	}
}