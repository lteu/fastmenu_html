$(function(){

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
 
// var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
//   'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
//   'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
//   'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
//   'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
//   'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
//   'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
//   'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
//   'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
// ];
 
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

//abilita il pulsante di Cancella piatto
$(".buttcancella").click(function(){
   var btid = $(this).attr("id");
   var splitted = btid.split("_");
   var piattohtmlid = splitted[1];
   $("."+piattohtmlid).remove();

   //ajax call piatto id
});

//abilita il pulsante di Cancella piatto
$(".buttconf").click(function(){
   var btid = $(this).attr("id");
   var splitted = btid.split("_");
   var piattohtmlid = splitted[1];
   var parent = $(this).parent();
   var nota = $(parent).find("input").val();

   //ajax call id piatto e nota associata
   //alert(nota);
});


$("#confermapiatto").click(function(){
    var piatto = $("#nomepiatto").val();
    var prezzo = $("#prezzopiatto").val();
    var nota = $("#notapiatto").val();

    var piattoid = "piatto"+Date.now()+makeid();

    //alert(piattoid);
    var html = "<div class='panel-heading "+piattoid+"'><a data-toggle='collapse' data-parent='#accordion' href='#collapse"+piattoid+"'> <h4 class='panel-title'>"+piatto+"<div class='pull-right'>+</div></h4> </a></div><div id='collapse"+piattoid+"' class='collapse "+piattoid+"'><div class='panel-body'><div class='list-group-item'><input class='form-control' type='text' placeholder='inserire una nota' value='"+nota+"'><br /><button id='fbutt_"+piattoid+"' type='button' class='btn btn-primary buttconf'>Confermo Modifica</button><button id='cbutt_"+piattoid+"' type='button' class='btn btn-danger pull-right buttcancella'>Cancella Piatto</button></div></div></div>";
    //var html = "aaa";
    $(".panellopiatti").append(html);
    $('#dialog').modal('hide');

    $("#nomepiatto").val("");
    $("#prezzopiatto").val("");
    $("#notapiatto").val("");
})

// $('input.typeahead').typeahead({
//       name: 'accounts',
//       local: ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen']
//     });

})

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}


