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
 
  //clicca CANCELLA
$("#cbutt_"+pid).click(function(){
 call_cancellapiatto(pid);
 });

  //clicca CONFERMA
$("#fbutt_"+pid).click(function(){
 var parent = $(this).parent();
 var nota = $(parent).find("input").val();
 call_modificanota(nota,pid);
 });

  //text changed listener
  $(".p_"+pid).find(".notainput").on("keyup", function(){
    var wrapper = $(this).parent();
    if ($(wrapper).hasClass("has-success")) {
      $(wrapper).find(".glyphicon").remove();
      $(wrapper).removeClass("has-success");
    }
    if (!$(wrapper).hasClass("has-warning")) {
      $(wrapper).addClass("has-warning");
      $(wrapper).addClass("has-feedback");
      $(wrapper).append("<span class='glyphicon glyphicon-warning-sign form-control-feedback'></span>");
    };

})
}


function aggiungipiattohtml(piattoid,piatto,prezzo,nota){
  var piattohtmid = "p_"+piattoid;
  var html = "<div class='panel-heading "+piattohtmid+"'>"
  +"<a data-toggle='collapse' data-parent='#accordion' href='#collapse"+piattohtmid+"'>"
  +" <h4 class='panel-title'>"+piatto+" - <span class='prezzosingolo'>"+prezzo+"</span>€"+"<div class='pull-right'>dettagli</div></h4> </a></div>"
  +"<div id='collapse"+piattohtmid+"' class='collapse "+piattohtmid+"'>"
  +"<div class='panel-body'>"
  +"<div class='form-group'>"
  +"<label class='sr-only'>srlabel</label>"
  +"<input class='form-control notainput' type='text' placeholder='inserire una nota' value='"+nota+"'>"
  +"</div>"
  +"<button id='fbutt_"+piattoid+"' type='button' class='btn btn-primary buttconf'>Confermo Modifica</button>"
  +"<button id='cbutt_"+piattoid+"' type='button' class='btn btn-danger pull-right buttcancella'>Cancella Piatto</button>"
  +"</div></div>";
//var html = "aaa";
$(".panellopiatti").append(html);
bindButtons(piattoid);
}



