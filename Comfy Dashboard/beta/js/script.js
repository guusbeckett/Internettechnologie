$(document).ready(function(){
	$("#news").hide();
	$("#weather").hide();
	$("#stream").show();

	$("#nieuws").click(function(){
		$("#news").show();
		$("#weather").hide();
		$("#stream").hide();
	});
	$("#weer").click(function(){
		$("#news").hide();
		$("#weather").show();
		$("#stream").hide();
	});
	$("#play").click(function(){
		$("#news").hide();
		$("#weather").hide();
		$("#stream").show();
	});
})

// Docs at http://simpleweatherjs.com
$(document).ready(function() {
	$.simpleWeather({
    woeid: '727612', //2357536
    location: '',
    unit: 'c',
    success: function(weather) {
    	html = '<h2>'+weather.temp+'&deg;'+weather.units.temp+'</h2>';
    	html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
    	html += '<li class="currently">'+weather.currently+'</li>';

    	for(var i=0;i<weather.forecast.length;i++) {
    		html += '<p>'+weather.forecast[i].day+': '+weather.forecast[i].high+'</p>';
    	}

    	$("#weatherdiv").html(html);
    },
    error: function(error) {
    	$("#weatherdiv").html('<p>'+error+'</p>');
    }
});
});
