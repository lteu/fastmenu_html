$(function(){
    clickcount = 0;
    seq = "";

    $(".main button").click(function(){
        var num = $(this).text();
        seq += num+"";
        clickcount ++;

        $(".notif span").remove();

        if (clickcount == 4) {
            //alert(seq)
            callLogin(seq);

            clickcount = 0;
            seq = "";
        }
        
    })
  
})

function callLogin(sq){

    res = false;
    if (sq == "1234") {
        res = true;
         window.document.location.href='tables.php';
    }else{
        $(".notif").append("<span>codice personale sbagliato</span>");
    }

}