$(document).ready(function(){
	$.ajax({
		url: "http://localhost/Szeleromuvek/classes/chart.php",
		method: "GET",
		success: function(data) {
			//console.log(data);
			var teljesitmeny = [];
			var kezdev = [];
			for(var i in data){
				kezdev.push(data[i].kezdev);
				teljesitmeny.push(data[i].telj);
			}
			
			var chartname="Erőmű teljesitmények átadási évek szerint";
			
			var data={
				labels: kezdev,
				datasets : [
					{
						data: teljesitmeny,
						label: chartname
					}
				]	
			};
			
			const ctx = document.getElementById("mychart").getContext("2d");
			
			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: data
			});
			
		},
		error: function(data) {
			console.log(data);
		}
	});
});