<h2>Hír feltöltés:</h2>
<form action="?oldal=hirfeltoltes" method="post">
    <div width: 500 px>
		Cím:	
        <label><input type="text" id="title" name="title" size="22" maxlength="40"> </label>
        <br/>
		Hír:
        <label> <textarea id="content" name="content" cols="30" rows="10"></textarea>  </label>
        <br/>
        <input id="kuld" type="submit" value="Küld">
    </div>
</form>
<?php
	include("./classes/feltolt.php");
?>
