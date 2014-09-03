$(function(){

call_piatti();
$(".aggiungipiatto").click(function(){
    
    var nm = $("#nomepiatto").val();
    var pz = $("#prezzopiatto").val();
    var id = $("#idpiatto").val();
    var ig = $("#ingredientipiatto").val();
    var ct = $("#categpiatto").val();

    call_aggiungipiatto(nm,pz,id,ig,ct);
    //call_chiudi();
    //alert(ct);
})

})



function call_aggiungipiatto(nm,pz,id,ig,ct)
{   
    $.ajax({
        type: 'POST',
        url: "cgi-bin/aggiungipiatto.php",
        data: {
            nm : nm,
            pz : pz,
            id : id,
            ig : ig,
            ct : ct
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            call_piatti();
        },
        error: function(r) {
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
        }
    });
}

function call_piatti(){
   $(".listapiatti div").remove();
  $.ajax({
        type: 'GET',
        url: "cgi-bin/listapiatti.php",
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
          var html = "";
          var d = jQuery.parseJSON(res);
          $(d).each(function(){
            var id = this.id;
            var nm = this.nome;
            var pz = this.prezzo;

            html += "<div>"+id+" "+nm+"  "+pz+"</div>";
          })
          $(".listapiatti").append(html);

          $("#nomepiatto").val("");
          $("#prezzopiatto").val("");
          $("#ingredientipiatto").val("");
        },
        error: function(r) {
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
        }
    });
}