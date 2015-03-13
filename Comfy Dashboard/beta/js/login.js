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

function logincheck()
{
	$('.bounce').removeClass('bounce');
	var json;
	var json2;
	var radioNaam = document.getElementById('radioName').value;
	var d = new Date();
	d.setTime(d.getTime() + (14 * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toGMTString();
	bootstrap_alert = function()
	{};
	bootstrap_alert.warning = function(message)
	{
		$('#alert_placeholder').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span>' + message + '</span></div>');
	};
	$.ajax(
	{
		url: 'http://188.166.22.194/cgi-bin/api.php?q=validate&name=' + radioNaam,
		dataType: 'json',
		success: function(response)
		{
			json = response;
			if (json.result == "name " + radioNaam + " is valid")
			{
				$.ajax(
				{
					url: 'http://188.166.22.194/cgi-bin/api.php?q=getid&name=' + radioNaam,
					dataType: 'json',
					success: function(response)
					{
						json2 = response;
						var id = json2.result.split('to id ');
						document.cookie = "radioID=" + id[1] + ";" + expires;
						document.cookie = "radioName=" + radioNaam + ";" + expires;
						window.location = 'index.php';
					}
				});
				return;
			}
			else(json.result == "name " + radioNaam + " is invalid");
			{
				// bootstrap_alert.warning('This radio was not found');
				document.getElementById('radioName').className = "bounce";
				return;
			}
		}
	});
}