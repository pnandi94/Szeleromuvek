$.getJSON(
	"https://api.openweathermap.org/data/2.5/weather?q=Kecskemet&appid=58e1e3bcf6ad6e6d4e7512992eb861f2",
	function (data) {
		console.log(data);

		var icon = "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
		var weather = data.weather[0].main;
		var temp = Math.floor(data.main.temp);

		$('.icon').attr('src', icon);
		$('.weather').append(weather);
		$('.temp').append(temp).append(" F° fok");
	}
);