/*****
*
*   AJAX
*
* */



function call_apri()
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/tavoloapri.php",
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            var splitted = res.split(";");
            if (splitted[0] == "ok") {
                $(".fgroup").show();
                $(".apbutt").hide();
                idconto = splitted[1];
            }else{
                alert("non e' possibile aprire tavolo" + res);
            }
        },
        error: function(r) {
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
        }
    });
}
function call_chiudi(totale)
{   

    $.ajax({
        type: 'POST',
        url: "cgi-bin/tavolochiudi.php",
        data:{
            conto:idconto,
            totale:totale

        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
                $(".apbutt").show();
                $(".funcbutt").hide();
                window.document.location.href='tables.php';
            }else{
                alert("non e' possibile chiudere tavolo" + res);
            }
        },
        error: function(r) {
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
        }
    });
}

function call_listaliberi()
{   
    $.ajax({
        type: 'GET',
        url: "cgi-bin/listaliberi.php",
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            $(".listatavoli button").remove();
            var data = jQuery.parseJSON(res);
            var html = "";
            $(data).each(function(){
             html += "<button type='button' class='btn btn-info btn-lg keypad tavolodest'>"+this+"</button>"
         });
            $(".listatavoli").append(html);
            $(".tavolodest").click(function(){
                var tid = $(this).text();
                call_sposta(tid);
            })

        },
        error: function(r) {
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
        }
    });
}
function call_sposta(t)
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/tavolosposta.php",
        data: {
            tavolo: t
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
               window.document.location.href='tables.php';
           };
       },
       error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
});
}

//mando info piatto e id conto
function call_ordina(piatto,prezzo,nota,piattoid)
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/piattoordina.php",
        data: {
            conto: idconto,
            piatto:piatto,
            prezzo:prezzo,
            nota:nota,
            piattoid:piattoid
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
                
            aggiungipiattohtml(piattoid,piatto,prezzo,nota);
            $('#dialog').modal('hide');

            $("#nomepiatto").val("");
            $("#prezzopiatto").val("");
            $("#notapiatto").val("");
            prezzototale();
        }else{
            alert("problema"+res);
        }

    },
    error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
});
}

//mando info piatto e id conto
function call_cancellapiatto(piattoid)
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/piattocancella.php",
        data: {
            piattoid:piattoid
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            $(".p_"+piattoid).remove();
            prezzototale();
    },
    error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
    });
}
//mando info piatto e id conto
function call_modificanota(nota,piattoid)
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/piattonota.php",
        data: {
            piattoid: piattoid,
            nota:nota
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
                  var notainput = $(".p_"+piattoid).find(".notainput");
                  var wrapper = $(notainput).parent();

    if ($(wrapper).hasClass("has-warning")) {
      $(wrapper).removeClass("has-warning");
      $(wrapper).find(".glyphicon").remove();

      $(wrapper).addClass("has-success");
      $(wrapper).append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
    };
            };
    },
    error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
    });
}

//
function call_aggiornaclienti(nclienti)
{   

    $.ajax({
        type: 'POST',
        url: "cgi-bin/tavoloclienti.php",
        data: {
            nclienti: nclienti
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            //alert(res)
            
    },
    error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
    });
}
