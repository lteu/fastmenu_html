$(function(){


   // $(".tablesearch").click(function(){alert(1)})
   //alert(arraytables.length);

    //Filter textfield function
    $('.tablesearch').bind("keyup", function(event){
        var attualVal = $('.tablesearch').val();
        if (attualVal <= arraytables.length && attualVal > 0) {
            var tst = arraytables[attualVal-1][1];
            var tablehtml = "";
            if (tst == "occupato") {
                tablehtml = "<a href='table.php?table="+attualVal+"'><button type='button' class='btn btn-warning btn-lg keypad'>"+attualVal+"</button></a>";
            }else{
                tablehtml = "<a href='table.php?table="+attualVal+"'><button type='button' class='btn btn-info btn-lg keypad'>"+attualVal+"</button></a>";
            }

            $(".tablePanel a").remove();
            $(".tablePanel").append(tablehtml);
        }else if (attualVal == "")
            reloadTables("all");
    });

    $(".butt_libero").click(function(){
        reloadTables("libero");
    })
    $(".butt_occupato").click(function(){
        reloadTables("occupato");
    })
    $(".butt_tutti").click(function(){
        reloadTables("all");
    })

})

function reloadTables(arg){
    var tablehtml = "";
    for (var i = 0; i < arraytables.length; i++) {
        var tst = arraytables[i][1];
        var indx = i+1;

        if (tst == "occupato") {
            if (arg == "occupato" || arg == "all" )
            tablehtml += "<a href='table.php?table="+indx+"'><button type='button' class='btn btn-warning btn-lg keypad'>"+indx+"</button></a>";
        }else if(tst == "libero") {
            if (arg == "libero" || arg == "all" )
            tablehtml += "<a href='table.php?table="+indx+"'><button type='button' class='btn btn-info btn-lg keypad'>"+indx+"</button></a>";
        }
    }
    $(".tablePanel a").remove();
    $(".tablePanel").append(tablehtml);
}
