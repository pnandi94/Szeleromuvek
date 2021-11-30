<script type="text/javascript" src = "./classes/jquery.min.js"></script>
<script type="text/javascript" src = "./classes/eromuvek.js"></script>
<title>Felsőfokú intézmények</title>
<style>
    #informaciosdiv {
      width: 500px;
    }
    #eromuinfo {
      float: right;
      border: 1px solid black;
      width: 250px;
      height: 70px;
    }
    .cimke{
      display: inline-block;
      width: 135px;
      text-align: right;
    }
    span {
      margin: 3px 5px;
    }
    label {
      display: inline-block;
      width: 70px;
      text-align: right;
    }
    select {
      width: 160px;
    }
</style>
    <h1>Erőművek:</h1>
    <div id = 'informaciosdiv'>
      <div id = 'eromuinfo'>
        <span class="cimke">Darab:</span><span id="db" class="adat"></span><br>
        <span class="cimke">Teljesitmény (MW):</span><span id="teljesitmeny" class="adat"></span><br>
      </div>
      <label for='megyecimke'>Megye:</label>
      <select id = 'megyeselect'></select>
      <br><br>
      <label for = 'helyszincimke'>Helyszín:</label>
      <select id = 'helyszinselect'></select>
      <br><br>
      <label for = 'toronycimke'>Telepítés éve:</label>
      <select id = 'toronyselect'></select>
	  <button>PDF készítés</button>
    </div>
	
	








