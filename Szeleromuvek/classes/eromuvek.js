function megyek() {
    $.post(
        "eromuvek.php",
        {"op" : "megye"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#megyeselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#megyeselect");
        },
        "json"                                                    
    );
};

function helyszinek() {
    $("#helyszinselect").html("");
    $("#toronyselect").html("");
    $(".adat").html("");
    var megyeid = $("#megyeselect").val();
    if (megyeid != 0) {
        $.post(
            "eromuvek.php",
            {"op" : "helyszin", "id" : megyeid},
            function(data) {
                $("#helyszinselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#helyszinselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
				if(lista.length==0)
					$("#helyszinselect").html('<option value="0">Nem található erőmű</option>');
            },
            "json"                                                    
        );
    }
}

function tornyok() {
    $("#toronyselect").html("");
    $(".adat").html("");
    var helyszinid = $("#helyszinselect").val();
    if (helyszinid != 0) {
        $.post(
            "eromuvek.php",
            {"op" : "torony", "id" : helyszinid},
            function(data) {
                $("#toronyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#toronyselect").append('<option value="'+lista[i].id+'">'+lista[i].kezdev+'</option>');
            },
            "json"                                                    
        );
    }
}

function torony() {
    $(".adat").html("");
    var toronyid = $("#toronyselect").val();
    if (toronyid != 0) {
        $.post(
            "eromuvek.php",
            {"op" : "info", "id" : toronyid},
            function(data) {
                $("#db").text(data.db);
                $("#teljesitmeny").text(data.teljesitmeny);
				$( "button" ).click(function() {
					$.post("./classes/test.php", {"db": data.db},"json");
					console.log("success");
				})
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
   megyek();
   
   $("#megyeselect").change(helyszinek);
   $("#helyszinselect").change(tornyok);
   $("#toronyselect").change(torony);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});