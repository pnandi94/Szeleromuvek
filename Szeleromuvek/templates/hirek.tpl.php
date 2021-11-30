<h2>Hírek:</h2>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
	crossorigin="anonymous">
</script>
<script src="././classes/news.js">
</script>
<div id="hirek">
    <?php
		include("./classes/dbh.classes.php");
		$result=new DbhQuery();
		$result->hirek(2);
	?>
</div>

<button id="pdf">Korábbi hírek</button>
