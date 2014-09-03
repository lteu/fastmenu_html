$(function(){


  if (piattiltfomat != null) {
    var arr = piattiltfomat.split("@");
    $(arr).each(function(){
      if (this != "") {
        var splitted = this.split(";");
    //alert(splitted[1])
    var piattoid = splitted[0];
    var piatto = splitted[1];
    var prezzo = splitted[2];
    var nota = splitted[3];
    aggiungipiattohtml(piattoid,piatto,prezzo,nota);
    prezzototale();
  };
  })
  }


  if(stato =="libero"){
    $(".funcbutt").hide();
  }else{
    $(".apbutt").hide();
  }
//buttons apertura e chiusura

$(".apbutt").click(function(){
  call_apri();
})
$(".cdbutt").click(function(){
  call_chiudi();
})

$(".spbutt").click(function(){
  call_listaliberi();
})


$("#confermapiatto").click(function(){
  var piatto = $("#nomepiatto").val();
  var prezzo = $("#prezzopiatto").val();
  var nota = $("#notapiatto").val();

  var piattoid = Date.now()+makeid()+idtavolo;

  call_ordina(piatto,prezzo,nota,piattoid);
})

// -----------------   autocomplete -----------------

var states = [];
for (var i = 0; i < arraypiatti.length; i++) {
  states.push(arraypiatti[i][1]);
       //states.push("aa")
     }

     var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substrRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });

    cb(matches);
  };
};

$('.typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  displayKey: 'value',
  source: substringMatcher(states)
});

$('.typeahead').bind("typeahead:selected", function(obj, datum, name) {
  var piatto = $(this).val();

  for (var i = 0; i < arraypiatti.length; i++) {
    if(piatto == arraypiatti[i][1]){
      var prezzo =   arraypiatti[i][2];
      $("#prezzopiatto").val(prezzo);

      var ingre =   arraypiatti[i][3];
      $(".ricetta span").remove();
      if (ingre != undefined) {

        $(".ricetta").append("<span>ingredienti: "+ingre+"</span>");
      }
    }
       //states.push("aa")
     }
   });


})

function makeid()
{
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for( var i=0; i < 5; i++ )
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}


function prezzototale(){
  var costo = 0.00;
  $(".prezzosingolo").each(function(){
    costo += parseFloat($(this).text());
  });
  $(".prezzototale").text(costo);
}


function bindButtons(pid){
 
  //abilita il pulsante di Cancella piatto
$("#cbutt_"+pid).click(function(){
 var btid = $(this).attr("id");
 var splitted = btid.split("_");
 var piattoid = splitted[1];
 call_cancellapiatto(piattoid);
//alert(3)
   //ajax call piatto id
 });

//abilita il pulsante di Cancella piatto
$("#fbutt_"+pid).click(function(){
 var btid = $(this).attr("id");
 var splitted = btid.split("_");
 var piattoid = splitted[1];
 var parent = $(this).parent();
 var nota = $(parent).find("input").val();
 call_modificanota(nota,piattoid);
   //ajax call id piatto e nota associata
  // alert(nota);
 });
}


function aggiungipiattohtml(piattoid,piatto,prezzo,nota){
  var piattohtmid = "p_"+piattoid;
  var html = "<div class='panel-heading "+piattohtmid+"'>"
  +"<a data-toggle='collapse' data-parent='#accordion' href='#collapse"+piattohtmid+"'>"
  +" <h4 class='panel-title'>"+piatto+" - <span class='prezzosingolo'>"+prezzo+"</span>€"+"<div class='pull-right'>dettagli</div></h4> </a></div>"
  +"<div id='collapse"+piattohtmid+"' class='collapse "+piattohtmid+"'><div class='panel-body'>"
  +"<div class='list-group-item'><input class='form-control' type='text' placeholder='inserire una nota' value='"+nota+"'>"
  +"<br /><button id='fbutt_"+piattoid+"' type='button' class='btn btn-primary buttconf'>Confermo Modifica</button>"
  +"<button id='cbutt_"+piattoid+"' type='button' class='btn btn-danger pull-right buttcancella'>Cancella Piatto</button></div></div></div>";
//var html = "aaa";
$(".panellopiatti").append(html);
bindButtons(piattoid);
}



