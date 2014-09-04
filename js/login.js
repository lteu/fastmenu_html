$(function(){
    clickcount = 0;
    seq = "";

    $(".loginkeypad button").click(function(){
        var num = $(this).text();
        seq += num+"";
        clickcount ++;

        //alert(1)

        $(".notif .pinspan").remove();
        $(".notif").append("<span class='pinspan'>"+seq+"</span>");
        $(".notif .resspan").remove();

        if (clickcount == 4) {

            //alert(seq)
            callLogin(seq);

            clickcount = 0;
            seq = "";
        }
        
    })
  
})

function callLogin(seq){
    $(".notif .pinspan").remove();
    
    $.ajax({
        type: 'POST',
        url: "cgi-bin/utentelogin.php",
        data: {
            pin: seq
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
               window.document.location.href='tables.php';
           }else{
             $(".notif").append("<span class='resspan'>"+res+"</span>");
           }
       },
       error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
})
}